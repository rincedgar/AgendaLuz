<?php

/**
 * Description of Dependencias
 *
 * @author Edgar Rincon
 */
require_once ('Conexion.class.php');

class Dependencias extends Conexion {

    protected $id;
    protected $descripcion;

    function __construct($id,$desc) {
        $this->id=$id;
        $this->descripcion = $desc;
    }

    public function buscar() {
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare('SELECT * FROM dependencias');
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
            $exec = $this->conexion->prepare("INSERT INTO dependencias (descripcion) VALUES('" . $this->descripcion . "')RETURNING id_dependencia;");
            $exec->execute();
            $consulta = $exec->fetchAll();
            return $consulta;
        } catch (PDOException $e) {
            echo "Error en la Consulta:" . $e->getMessage();
        }
    }

    public function actualizar() {
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare("UPDATE dependencias SET descripcion = '" . $this->descripcion . "' WHERE id_dependencia='" . $this->id . "';");
            $exec->execute();
            echo "Dependencia eliminada exitosamente";
        } catch (PDOException $e) {
            echo "Error en la Consulta:" . $e->getMessage();
        }
    }

    public function eliminar() {
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare("DELETE FROM dependencias WHERE id_dependencia = " . $this->id . "");
            $exec->execute();
            echo "Dependencia eliminado exitosamente";
        } catch (PDOException $e) {
            echo "Error en la Consulta:" . $e->getMessage();
        }
    }

    public function getId() {
        return $this->id;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setDescripcion($desc) {
        $this->descripcion = $desc;
    }

}

?>
