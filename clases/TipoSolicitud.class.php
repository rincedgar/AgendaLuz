<?php

/*
 * Description of Tipo de Solicitud
 *
 * @author Edgar Rincon
 */
require_once ('Conexion.class.php');

class TipoSolicitud extends Conexion {

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
            $exec = $this->conexion->prepare('SELECT id_tipo_solicitud FROM tipo_solicitud');
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
            $exec = $this->conexion->prepare("SELECT descripcion FROM tipo_solicitud WHERE id_tipo_solicitud = '".$this->id."'");
            $exec->execute();
            $consulta = $exec->fetchAll();
            $this->descripcion=$consulta[0]['descripcion'];
        } catch (PDOException $e) {
            echo "Error en la Consulta:" . $e->getMessage();
        }
    }

    public function buscarDescripcion() {
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare("SELECT id_tipo_solicitud FROM tipo_solicitud WHERE descripcion = '".$this->descripcion."'");
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
            $exec = $this->conexion->prepare("INSERT INTO tipo_solicitud (descripcion) VALUES('" . $this->descripcion . "')RETURNING id_tipo_solicitud;");
            $exec->execute();
            $consulta = $exec->fetchAll();
            return $consulta[0]['id_tipo_solicitud'];
        } catch (PDOException $e) {
            echo "Error en la Consulta:" . $e->getMessage();
        }
    }

    public function actualizar() {
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare("UPDATE tipo_solicitud SET descripcion = '" . $this->descripcion . "' WHERE id_tipo_solicitud='" . $this->id . "';");
            $exec->execute();
            echo "Tipo de Solicitud actualizado exitosamente";
        } catch (PDOException $e) {
            echo "Error en la Consulta:" . $e->getMessage();
        }
    }

    public function eliminar() {
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare("DELETE FROM tipo_solicitud WHERE id_tipo_solicitud = " . $this->id . "");
            $exec->execute();
            echo "Tipo de Solicitud eliminado exitosamente";
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
