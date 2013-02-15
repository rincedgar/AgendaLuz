<?php

/**
 * Description of consejeros
 *
 * @author Edgar Rincon
 */
require_once ('Conexion.class.php');

class Consejero extends Conexion {
    protected $id;
    protected $nombre;
    protected $apellido;
    protected $desde;
    protected $hasta;
    protected $email;
    protected $permiso;
    protected $imagen;

    function __construct($id="",$nombre="", $apellido="", $desde="", $hasta="",$email="",$permiso="",$imagen="") {
        $this->id=$id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->desde = $desde;
        $this->hasta = $hasta;
        $this->email = $email;
        $this->permiso = $permiso;
        $this->imagen = $imagen;
    }

    public function __destruct() {
        foreach ($this as $key => $value) {
            unset($this->$key);
        }
    } 

    public function buscar() {
        try {

            if (!$this->getConexion())
                return 0;
            else {
                $consul= "SELECT * FROM consejeros WHERE id_consejero = '".$this->id."'";
                $exec = $this->conexion->prepare($consul);
                $exec->execute();
                $consulta = $exec->fetchAll();
                $this->nombre=$consulta[0]['nombre'];
                $this->apellido=$consulta[0]['apellido'];
                $this->desde=$consulta[0]['desde'];
                $this->hasta=$consulta[0]['hasta'];
                $this->email=$consulta[0]['email'];
                $this->permiso=$consulta[0]['id_permiso'];
                $this->imagen=$consulta[0]['imagen'];
            }
        } catch (PDOException $e) {
            echo "Error de conexión:" . $e->getMessage();
        }
    }
    
    public function buscarTodos() {
        try {

            if (!$this->getConexion())
                return 0;
            else {
                $consul= "SELECT id_consejero FROM consejeros";
                $exec = $this->conexion->prepare($consul);
                $exec->execute();
                $consulta = $exec->fetchAll();
                return $consulta;
            }
        } catch (PDOException $e) {
            echo "Error de conexión:" . $e->getMessage();
        }
    }
    
    public function insertar() {
        try {
            $exec = $this->conexion->prepare("INSERT INTO consejeros (nombre,apellido,desde,hasta,email,id_permiso,imagen) VALUES('".$this->nombre."','".$this->apellido."','".$this->desde."','".$this->hasta."','".$this->email."','".$this->permiso."','".$this->imagen."')RETURNING id_consejero;");
            $exec->execute();
            $consulta = $exec->fetchAll();
            return $consulta;
        } catch (PDOException $e) {
            echo "Error de conexión:" . $e->getMessage();
        }
    }

    public function actualizar() {
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare("UPDATE consejeros SET nombre = '" . $this->nombre . "',apellido='" . $this->apellido . "',desde='" . $this->desde . "',hasta='" . $this->hasta . "' WHERE id_consejero='" . $this->id . "';");
            $exec->execute();
            echo "Consejero actualizado exitosamente";
        } catch (PDOException $e) {
            echo "Error en la Consulta:" . $e->getMessage();
        }
    }

    public function cambiarImagen() {
            try {
                $this->getConexion();
                $exec = $this->conexion->prepare("UPDATE consejeros SET imagen = '".$this->imagen."' WHERE id_consejero='".$this->id."';");
                $exec->execute();
                echo "Consejero actualizado exitosamente";
            } catch (PDOException $e) {
                echo "Error en la Consulta:" . $e->getMessage();
            }
    }

     public function nuevoPeriodo() {
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare("UPDATE consejeros SET desde='".$this->desde."', hasta='".$this->hasta."' WHERE id_consejero='".$this->id."';");
            $exec->execute();
        } catch (PDOException $e) {
            echo "Error en la Consulta:" . $e->getMessage();
        }
    }

    public function eliminar() {
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare("DELETE FROM consejeros WHERE id_consejero = '".$this->id."'");
            $exec->execute();
            echo "Consejero eliminado exitosamente";
        } catch (PDOException $e) {
            echo "Error en la Consulta:" . $e->getMessage();
        }
    }

    public function proximasAgendas() {
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare("select a.id_agenda  from participantes p
join agenda a on a.id_agenda=p.id_agenda 
where a.fecha >=current_date AND p.id_consejero='".$this->id."' 
group by a.id_agenda order by a.fecha limit 5");
            $exec->execute();
            $consulta = $exec->fetchAll();
            return $consulta;
        } catch (PDOException $e) {
            echo "Error en la Consulta:" . $e->getMessage();
        }
    }
    
    public function agendasActivas() {
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare("select a.id_agenda  from participantes p
join agenda a on a.id_agenda=p.id_agenda 
where a.en_sesion IS TRUE AND p.id_consejero='".$this->id."' 
group by a.id_agenda order by a.fecha limit 5");
            $exec->execute();
            $consulta = $exec->fetchAll();
            return $consulta;
        } catch (PDOException $e) {
            echo "Error en la Consulta:" . $e->getMessage();
        }
    }

    public function agendasAnteriores() {
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare("select a.id_agenda from participantes p
join agenda a on a.id_agenda=p.id_agenda 
join tipo_agenda ta on ta.id_agenda=a.id_agenda
join tipo_consejo tc on tc.id_tipo_consejo=ta.id_tipo_consejo
join dependencias d on d.id_dependencia=ta.id_dependencia
where a.fecha <=current_date AND p.id_consejero='".$this->id."'
group by a.id_agenda order by a.fecha limit 5");
            $exec->execute();
            $consulta = $exec->fetchAll();
            return $consulta;
        } catch (PDOException $e) {
            echo "Error en la Consulta:" . $e->getMessage();
        }
    }

    public function generarCodigo($dependencia, $consejo, $fecha, $anio) {

        try {
            $this->getConexion();
            $anio = $anio . '-01-01';

            $consul = "select count(a.id_agenda)as consecutivo
            from tipo_agenda ta
            join agenda a on a.id_agenda=ta.id_agenda
            join tipo_consejo tc on tc.id_tipo_consejo=ta.id_tipo_consejo
            where a.fecha between '$anio' AND '$fecha' AND ta.id_tipo_consejo=$consejo AND ta.id_dependencia=$dependencia";
            $exec = $this->conexion->prepare($consul);
            $exec->execute();

            $consulta = $exec->fetchAll();

            return $consulta;
        } catch (PDOException $e) {
            echo "Error en la Consulta:" . $e->getMessage();
        }
    }

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getApellido() {
        return $this->apellido;
    }

    public function getDesde() {
        return $this->desde;
    }

    public function getHasta() {
        return $this->hasta;
    }

    public function getEmail() {
        return $this->email;
    }

     public function getPermiso() {
        return $this->permiso;
    }
    
     public function getimagen() {
        return $this->imagen;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setApellido($apellido) {
        $this->apellido = $apellido;
    }

    public function setDesde($desde) {
        $this->desde = $desde;
    }

    public function setHasta($hasta) {
        $this->hasta = $hasta;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPermiso($permiso) {
        $this->permiso = $permiso;
    }

    public function setImagen($imagen) {
        $this->imagen = $imagen;
    }
}

?>
