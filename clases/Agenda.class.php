<?php

/**
 * Description of Agenda
 *
 * @author Edgar Rincon
 */
require_once ('Conexion.class.php');

class Agenda extends Conexion {
    
    protected $idAgenda;
    protected $fecha;
    protected $estatus;
    

    function __construct($id="", $fecha="") {
        $this->idAgenda = $id;
        $this->fecha = $fecha;
    }

    public function __destruct() {
        foreach ($this as $key => $value) {
            unset($this->$key);
        }
    }
     
    public function buscar() {
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare('SELECT * FROM agenda');
            $exec->execute();
            $consulta = $exec->fetchAll();
            return $consulta;
        } catch (PDOException $e) {
            echo "Error en la Consulta:" . $e->getMessage();
        }
    }

    public function insertar() {
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare("INSERT INTO agenda (fecha) VALUES('" . $this->fecha . "') RETURNING id_agenda;");
            $exec->execute();
            $consulta = $exec->fetchAll();
            return $consulta[0]['id_agenda'];
        } catch (PDOException $e) {
            echo "Error en la Consulta:" . $e->getMessage();
        }
    }

    public function actualizar() {
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare("UPDATE agenda SET fecha = '" . $this->fecha . "' WHERE id_agenda='" . $this->idAgenda . "';");
            $exec->execute();
            echo "Agenda actualizada exitosamente";
        } catch (PDOException $e) {
            echo "Error en la Consulta:" . $e->getMessage();
        }
    }

    public function eliminar() {
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare("DELETE FROM agenda WHERE id_agenda = '". $this->idAgenda."'");
            $exec->execute();
            echo "Agenda eliminada exitosamente";
        } catch (PDOException $e) {
            echo "Error en la Consulta:" . $e->getMessage();
        }
    }

    public function obtenerDatos() {
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare("SELECT a.id_agenda, a.fecha, d.id_dependencia, d.descripcion as dependencia, tc.id_tipo_consejo, tc.descripcion,tc.siglas, EXTRACT(YEAR FROM a.fecha) as anio 
                FROM agenda a 
                JOIN tipo_agenda ta on ta.id_agenda=a.id_agenda 
                JOIN tipo_consejo tc on tc.id_tipo_consejo=ta.id_tipo_consejo 
                JOIN dependencias d on d.id_dependencia=ta.id_dependencia 
                WHERE a.id_agenda='".$this->idAgenda."'
                GROUP BY a.id_agenda, a.fecha, d.descripcion, tc.descripcion, tc.siglas,d.id_dependencia,tc.id_tipo_consejo 
                ORDER BY a.fecha");

            $exec->execute();
            $consulta = $exec->fetchAll();
            return $consulta;
        } catch (PDOException $e) {
            echo "Error en la Consulta:" . $e->getMessage();
        }
    }

    public function obtenerParticipantes() {
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare("SELECT a.id_agenda, a.fecha, d.id_dependencia, d.descripcion as dependencia, tc.id_tipo_consejo, tc.descripcion,tc.siglas, EXTRACT(YEAR FROM a.fecha) as anio 
                FROM agenda a 
                JOIN tipo_agenda ta on ta.id_agenda=a.id_agenda 
                JOIN tipo_consejo tc on tc.id_tipo_consejo=ta.id_tipo_consejo 
                JOIN dependencias d on d.id_dependencia=ta.id_dependencia 
                WHERE a.id_agenda=$this->idAgenda 
                GROUP BY a.id_agenda, a.fecha, d.descripcion, tc.descripcion, tc.siglas,d.id_dependencia,tc.id_tipo_consejo 
                ORDER BY a.fecha");

            $exec->execute();
            $consulta = $exec->fetchAll();
            return $consulta;
        } catch (PDOException $e) {
            echo "Error en la Consulta:" . $e->getMessage();
        }
    }

    public function obtenerPuntos() {
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare("SELECT p.id_punto
            FROM punto p
            JOIN agenda a ON a.id_agenda = p.id_agenda
            WHERE p.id_agenda = $this->idAgenda");

            $exec->execute();
            $consulta = $exec->fetchAll();
            return $consulta;
        } catch (PDOException $e) {
            echo "Error en la Consulta:" . $e->getMessage();
        }
    }

    public function consecutivo($dependencia, $consejo, $fecha, $anio) {

        try {
            $this->getConexion();
            $anio = $anio.'-01-01';
            $consul = "SELECT count(a.id_agenda)as consecutivo
            FROM tipo_agenda ta
            join agenda a on a.id_agenda=ta.id_agenda
            join tipo_consejo tc on tc.id_tipo_consejo=ta.id_tipo_consejo
            WHERE a.fecha between '".$anio."' AND '".$fecha."' AND ta.id_tipo_consejo='".$consejo."' AND ta.id_dependencia='".$dependencia."'";
            $exec = $this->conexion->prepare($consul);
            $exec->execute();

            $consulta = $exec->fetchAll();

            return $consulta;
        } catch (PDOException $e) {
            echo "Error en la Consulta:" . $e->getMessage();
        }
    }

    public function getId() {
        return $this->idAgenda;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    public function setId($id) {
        $this->idAgenda = $id;
    }

}
?>

