<?php

/**
 * Description of punto
 *
 * @author Edgar Rincon
 */
require_once ('Conexion.class.php');

class Punto extends Conexion {

    protected $id;
    protected $agenda;
    protected $estatus;
    protected $subasunto;
    protected $solicitud;
    protected $detalle;
    protected $otro;
    protected $decision;

    function __construct($id='',$agenda='',$estatus="",$subasunto="",$solicitud='',$detalle='',$otro='',$decision='') {
        $this->id=$id;
        $this->agenda=$agenda;
        $this->estatus=$estatus;
        $this->subasunto=$subasunto;
        $this->solicitud=$solicitud;
        $this->detalle=$detalle;
        $this->otro=$otro;
        $this->decision=$decision;
    }

    public function __destruct() {
        foreach ($this as $key => $value) {
            unset($this->$key);
        }
    } 

     public function obtenerDatos() {
        try {
            $this->getConexion();
            $consul = "SELECT *
            FROM punto
            WHERE id_punto = '".$this->id."' order by id_punto";
            $exec = $this->conexion->prepare($consul);
            $exec->execute();

            $consulta = $exec->fetchAll();
            $this->agenda=$consulta[0]['id_agenda'];
            $this->estatus=$consulta[0]['id_estatus'];
            $this->subasunto=$consulta[0]['id_subasunto'];
            $this->solicitud=$consulta[0]['id_tipo_solicitud'];
            $this->detalle=$consulta[0]['detalle'];
            $this->otro=$consulta[0]['otro'];
            $this->otro=$consulta[0]['decision'];
        } catch (PDOException $e) {
            echo "Error en la Consulta:" . $e->getMessage();
        }
    }

    public function insertar(){
        try {
            $this->getConexion();
            if($this->solicitud!='NULL')
                $exec = $this->conexion->prepare("INSERT INTO punto (id_agenda,id_estatus,id_subasunto,id_tipo_solicitud,detalle,otro) VALUES('" . $this->agenda . "','" . $this->estatus . "','" . $this->subasunto . "','" . $this->solicitud . "','" . $this->detalle . "'," . $this->otro . ") RETURNING id_punto;");
            else
                $exec = $this->conexion->prepare("INSERT INTO punto (id_agenda,id_estatus,id_subasunto,id_tipo_solicitud,detalle,otro) VALUES('" . $this->agenda . "','" . $this->estatus . "','" . $this->subasunto . "'," . $this->solicitud . ",'" . $this->detalle . "'," . $this->otro . ") RETURNING id_punto;");
            $exec->execute();
            $consulta = $exec->fetchAll();
            return $consulta[0]['id_punto'];
        } catch (PDOException $e) {
            echo "Error en la Consulta:" . $e->getMessage();
        }
    }

    public function decidir() {
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare("UPDATE punto SET id_estatus = '".$this->estatus."' WHERE id_punto='".$this->id."';");
            $exec->execute();
            echo "Agenda actualizada exitosamente";
        } catch (PDOException $e) {
            echo "Error en la Consulta:" . $e->getMessage();
        }
    }    

    public function decision() {
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare("UPDATE punto SET decision = '".$this->decision."' WHERE id_punto='".$this->id."';");
            $exec->execute();
        } catch (PDOException $e) {
            echo "Error en la Consulta:" . $e->getMessage();
        }
    }

    public function getId() {
        return $this->id;
    }

    public function getIdAgenda() {
        return $this->idAgenda;
    }

    public function getEstatus() {
         return $this->estatus;
    }

    public function getSubasunto() {
        return $this->subasunto;
    }

    public function getSolicitud() {
        return $this->solicitud;
    }

    public function getDetalle() {
        return $this->detalle;
    }

    public function getDecision() {
        return $this->decision;
    }

     public function setId($id) {
        $this->id = $id;
    }

    public function getOtro() {
        return $this->otro;
    }

    public function setIdAgenda($agenda) {
        $this->idAgenda = $agenda;
    }
    
    public function setEstatus($estatus) {
        $this->estatus = $estatus;
    }

    public function setSubasunto($subasunto) {
        $this->subasunto = $subasunto;
    }

    public function setSolicitud($solicitud) {
        $this->solicitud = $solicitud;
    }

    public function setDetalle($detalle) {
        $this->detalle = $detalle;
    }

    public function setOtro($otro) {
        $this->otro = $otro;
    }

    public function setDecision($decision) {
        $this->otro = $decision;
    }
}

?>
