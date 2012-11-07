<?php

/**
 * Description of punto
 *
 * @author Edgar Rincon
 */
require_once ('Conexion.class.php');
include ('clases/Estatus.class.php');

class Punto extends Conexion {

    protected $id;
    protected $agenda;
    protected $estatus;
    protected $subasunto;
    protected $descripcion;
    protected $observacion;

    function __construct($id) {
        $this->id = $id;
        try {
            $this->getConexion();
            $consul = "SELECT *
            FROM punto
            WHERE id_punto = $id
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
        $estatus= new Estatus($this->estatus);
        return $estatus->getDescripcion();
    }

    public function getSubasunto() {
        $sub = new Subasunto($this->subasunto);
        return $sub->getDescripcion();
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getObservacion() {
        return $this->observacion;
    }

}

?>
