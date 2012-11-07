<?php

/**
 * Description of Subasunto
 *
 * @author Edgar Rincon
 */
require_once ('Conexion.class.php');

class Subasunto extends Conexion {

    protected $id;
    protected $descripcion;

    function __construct($id='',$desc='') {
        $this->id = $id;
        $this->descripcion=$desc;
    }

    public function buscar() {
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare('SELECT * FROM subasuntos');
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
            $exec = $this->conexion->prepare("INSERT INTO subasuntos (descripcion) VALUES('" . $this->descripcion . "')RETURNING id_subasuntos;");
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
            $exec = $this->conexion->prepare("UPDATE subasunto SET descripcion = '" . $this->descripcion . "' WHERE id_subasunto='" . $this->id . "';");
            $exec->execute();
            echo "Subasunto actualizado exitosamente";
        } catch (PDOException $e) {
            echo "Error en la Consulta:" . $e->getMessage();
        }
    }

    public function eliminar() {
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare("DELETE FROM subasunto WHERE id_subasunto = " . $this->id . "");
            $exec->execute();
            echo "Subasunto eliminado exitosamente";
        } catch (PDOException $e) {
            echo "Error en la Consulta:" . $e->getMessage();
        }
    }

    public function obtenerPuntos($idAgenda) {
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare("SELECT p.id_punto
            FROM punto p
            JOIN agenda a ON a.id_agenda = p.id_agenda
            WHERE p.id_agenda = $idAgenda AND p.id_subasunto = $this->id
            ");
            $exec->execute();
            $consulta = $exec->fetchAll();
            return $consulta;
        } catch (PDOException $e) {
            echo "Error en la Consulta:" . $e->getMessage();
        }
    }
    
    public function obtenerDescripcion() {
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare("SELECT descripcion FROM subasuntos
            WHERE id_subasunto = $this->id
            ");
            $exec->execute();
            $consulta = $exec->fetchAll();
            return $consulta[0]['descripcion'];
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
