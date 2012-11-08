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
    protected $descripcion;
    protected $observacion;

    function __construct($id='',$agenda='',$estatus="",$subasunto="",$descripcion="",$observacion="") {
        $this->id=$id;
        $this->agenda=$agenda;
        $this->estatus=$estatus;
        $this->subasunto=$subasunto;
        $this->descripcion=$descripcion;
        $this->observacion=$observacion;


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
            WHERE id_punto = $this->id
            ";
            $exec = $this->conexion->prepare($consul);
            $exec->execute();

            $consulta = $exec->fetchAll();
            $this->agenda=$consulta[0]['id_agenda'];
            $this->estatus=$consulta[0]['id_estatus'];
            $this->subasunto=$consulta[0]['id_subasunto'];
            $this->descripcion=$consulta[0]['descripcion'];
            $this->observacion=$consulta[0]['observacion'];
            
        } catch (PDOException $e) {
            echo "Error en la Consulta:" . $e->getMessage();
        }
    }

    public function insertar(){
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare("INSERT INTO punto (id_agenda,id_estatus,descripcion,observacion,id_subasunto) VALUES('" . $this->agenda . "','" . $this->estatus . "','" . $this->descripcion."','" . $this->observacion . "','" . $this->subasunto . "');");
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

    public function getIdAgenda() {
        return $this->idAgenda;
    }
    
    public function getIdSubasunto() {
        return $this->subasunto;
    }
    public function getEstatus() {
         return $this->estatus;
    }

    public function getSubasunto() {
        return $this->subasunto;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getObservacion() {
        return $this->observacion;
    }

     public function setId($id) {
        $this->id = $id;
    }

    public function setIdAgenda($agenda) {
        $this->idAgenda = $agenda;
    }
    
    public function setIdSubasunto($subasunto) {
        $this->subasunto = $subasunto; 
    }
    public function setEstatus($estatus) {
        $this->estatus = $estatus;
    }

    public function setSubasunto($subasunto) {
        $this->subasunto = $subasunto;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function setObservacion($observacion) {
        $this->observacion = $observacion;
    }

}

?>
