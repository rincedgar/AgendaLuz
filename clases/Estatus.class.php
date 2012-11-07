<?php

/**
 * Description of Estatus
 *
 * @author Edgar Rincon
 */
require_once ('Conexion.class.php');

class Estatus extends Conexion {

    protected $id;
    protected $descripcion;

    function __construct($id='') {
        $this->id=$id;
           try {
            
            $this->getConexion();
            $consul = "SELECT descripcion
            FROM estatus
            WHERE id_estatus = $id
            ";
            $exec = $this->conexion->prepare($consul);
            $exec->execute();

            $consulta = $exec->fetchAll();
            $this->descripcion = $consulta[0]['descripcion'];
        } catch (PDOException $e) {
            echo "Error en la Consulta:" . $e->getMessage();
        }
        
        
    }

    public function buscar() {
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare('SELECT * FROM estatus');
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
            $exec = $this->conexion->prepare("INSERT INTO estatus (descripcion) VALUES('" . $this->descripcion . "')RETURNING id_estatus;");
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
            $exec = $this->conexion->prepare("UPDATE estatus SET descripcion = '" . $this->descripcion . "' WHERE id_estatus='" . $this->id . "';");
            $exec->execute();
            echo "Estatus actualizado exitosamente";
        } catch (PDOException $e) {
            echo "Error en la Consulta:" . $e->getMessage();
        }
    }

    public function eliminar() {
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare("DELETE FROM estatus WHERE id_estatus = " . $this->id . "");
            $exec->execute();
            echo "Estatus eliminado exitosamente";
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
