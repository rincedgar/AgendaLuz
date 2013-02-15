<?php

/**
 * Description of Permisos
 *
 * @author Edgar Rincon
 */
require_once ('Conexion.class.php');

class Permisos extends Conexion {

    protected $id;
    protected $descripcion;

    function __construct($id='',$desc='') {
        $this->id=$id;
        $this->descripcion=$desc;        
    }

    public function __destruct() {
        foreach ($this as $key => $value) {
            unset($this->$key);
        }
    } 

    public function buscar() {
           try {
            
            $this->getConexion();
            $consul = "SELECT descripcion
            FROM permisos
            WHERE id_permiso = ".$this->id."
            ";
            $exec = $this->conexion->prepare($consul);
            $exec->execute();

            $consulta = $exec->fetchAll();
            $this->descripcion = $consulta[0]['descripcion'];
        } catch (PDOException $e) {
            echo "Error en la Consulta:" . $e->getMessage();
        }
        
        
    }

    public function buscarTodos() {
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare('SELECT * FROM permisos');
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
            $exec = $this->conexion->prepare("INSERT INTO permisos (descripcion) VALUES('" . $this->descripcion . "')RETURNING id_permiso;");
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
            $exec = $this->conexion->prepare("UPDATE permisos SET descripcion = '" . $this->descripcion . "' WHERE id_permiso='" . $this->id . "';");
            $exec->execute();
            echo "permisos actualizado exitosamente";
        } catch (PDOException $e) {
            echo "Error en la Consulta:" . $e->getMessage();
        }
    }

    public function eliminar() {
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare("DELETE FROM permisos WHERE id_permiso = " . $this->id . "");
            $exec->execute();
            echo "permisos eliminado exitosamente";
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
