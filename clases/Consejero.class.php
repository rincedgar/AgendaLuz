<?php

/**
 * Description of consejeros
 *
 * @author Edgar Rincon
 */
require_once ('Conexion.class.php');

class Consejero extends Conexion {
    const SELECT_ALL_SQL = "SELECT * FROM consejeros";
    protected $id;
    protected $nombre = "";
    protected $apellido = "";
    protected $desde = null;
    protected $hasta = null;

    function __construct($id="",$nombre="", $apellido="", $desde="", $hasta="") {
        $this->id=$id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->desde = $desde;
        $this->hasta = $hasta;
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
                $consul= "SELECT * FROM consejeros";
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

            if (!$this->getConexion())
                return 0;
            else {
                //  $a="INSERT INTO consejeros (nombre,apellido,desde,hasta) VALUES('".$this->nombre."','".$this->apellido."','".$this->desde."','".$this->hasta."')RETURNING id_consejero;";
                // echo $a;
                $exec = $this->conexion->prepare("INSERT INTO consejeros (nombre,apellido,desde,hasta) VALUES('" . $this->nombre . "','" . $this->apellido . "','" . $this->desde . "','" . $this->hasta . "')RETURNING id_consejero;");

                // $exec= $this->conexion->prepare('INSERT INTO consejeros (nombre,apellido,desde,hasta) values("' . $this->nombre . '","' . $this->apellido . '",' . $this->desde . ',' . $this->hasta . ')RETURNING id_consejero;');
                //$parametros = array($this->nombre, $this->apellido, $this->desde, $this->hasta);
                //$consulta = $this->conexion->execute($sql, $parametros);
                $exec->execute();
                $consulta = $exec->fetchAll();
                return $consulta;
            }
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

    public function eliminar() {
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare("DELETE FROM consejeros WHERE id_consejero = " . $this->id . "");
            $exec->execute();
            echo "Consejero eliminado exitosamente";
        } catch (PDOException $e) {
            echo "Error en la Consulta:" . $e->getMessage();
        }
    }

    public function proximasAgendas($usuario) {
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare("select a.id_agenda, a.fecha, d.id_dependencia, d.descripcion as dependencia, tc.id_tipo_consejo, tc.descripcion,tc.siglas, EXTRACT(YEAR FROM a.fecha) as anio from participantes p
join agenda a on a.id_agenda=p.id_agenda 
join tipo_agenda ta on ta.id_agenda=a.id_agenda
join tipo_consejo tc on tc.id_tipo_consejo=ta.id_tipo_consejo
join dependencias d on d.id_dependencia=ta.id_dependencia
where a.fecha >=current_date AND p.id_consejero='".$usuario."' 
group by a.id_agenda, a.fecha, d.descripcion, tc.descripcion, tc.siglas,d.id_dependencia,tc.id_tipo_consejo
order by a.fecha limit 5");
            $exec->execute();
            $consulta = $exec->fetchAll();
            return $consulta;
        } catch (PDOException $e) {
            echo "Error en la Consulta:" . $e->getMessage();
        }
    }
    
    public function agendasAnteriores($usuario) {
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare("select a.id_agenda, a.fecha, d.id_dependencia, d.descripcion as dependencia, tc.id_tipo_consejo, tc.descripcion,tc.siglas, EXTRACT(YEAR FROM a.fecha) as anio from participantes p
join agenda a on a.id_agenda=p.id_agenda 
join tipo_agenda ta on ta.id_agenda=a.id_agenda
join tipo_consejo tc on tc.id_tipo_consejo=ta.id_tipo_consejo
join dependencias d on d.id_dependencia=ta.id_dependencia
where a.fecha <=current_date AND p.id_consejero='".$usuario."'
group by a.id_agenda, a.fecha, d.descripcion, tc.descripcion, tc.siglas,d.id_dependencia,tc.id_tipo_consejo
order by a.fecha limit 5");
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

}

?>
