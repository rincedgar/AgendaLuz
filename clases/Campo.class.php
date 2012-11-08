<?php

/*
 * Description of Campo
 *
 * @author Edgar Rincon
 */
require_once ('Conexion.class.php');

class Campo extends Conexion {

    protected $id;
    protected $descripcion;

    function __construct($id='', $desc='') {
        $this->id = $id;
        $this->descripcion = $desc;
    }

    public function __destruct() {
        foreach ($this as $key => $value) {
            unset($this->$key);
        }
    } 
    
    public function buscarTodos() {
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare('SELECT id_campo FROM campos');
            $exec->execute();
            $consulta = $exec->fetchAll();
            return $consulta;
        } catch (PDOException $e) {
            echo "Error en la Consulta:" . $e->getMessage();
        }
    }

     public function buscar() {
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare("SELECT descripcion FROM campos WHERE id_campo = '".$this->id."'");
            $exec->execute();
            $consulta = $exec->fetchAll();
            $this->descripcion=$consulta[0]['descripcion'];
        } catch (PDOException $e) {
            echo "Error en la Consulta:" . $e->getMessage();
        }
    }
    public function insertar() {
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare("INSERT INTO campos (descripcion) VALUES('" . $this->descripcion . "')RETURNING id_campo;");
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
            $exec = $this->conexion->prepare("UPDATE campos SET descripcion = '" . $this->descripcion . "' WHERE id_campo='" . $this->id . "';");
            $exec->execute();
            echo "Campo actualizado exitosamente";
        } catch (PDOException $e) {
            echo "Error en la Consulta:" . $e->getMessage();
        }
    }

    public function eliminar() {
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare("DELETE FROM campos WHERE id_campo = " . $this->id . "");
            $exec->execute();
            echo "Campo eliminado exitosamente";
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
