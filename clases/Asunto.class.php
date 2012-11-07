<?php

/**
 * Description of Asunto
 *
 * @author Edgar Rincon
 */
require_once ('Conexion.class.php');

class Asunto extends Conexion {

    protected $id;
    protected $descripcion;

    function __construct($id='', $desc='') {
        $this->id = $id;
        $this->descripcion = $desc;
    }

    public function buscar() {
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare('SELECT * FROM asuntos ORDER BY orden');
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
            $exec = $this->conexion->prepare("INSERT INTO asunto (descripcion) VALUES('" . $this->descripcion . "')RETURNING id_asunto;");
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
            $exec = $this->conexion->prepare("UPDATE asunto SET descripcion = '" . $this->descripcion . "' WHERE id_asunto='" . $this->id . "';");
            $exec->execute();
            echo "Asunto actualizado exitosamente";
        } catch (PDOException $e) {
            echo "Error en la Consulta:" . $e->getMessage();
        }
    }

    public function eliminar() {
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare("DELETE FROM asunto WHERE id_asunto = " . $this->id . "");
            $exec->execute();
            echo "Asunto eliminado exitosamente";
        } catch (PDOException $e) {
            echo "Error en la Consulta:" . $e->getMessage();
        }
    }

    public function obtenerSubasuntos($idAsunto) {
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare("SELECT s.id_subasunto
            FROM subasuntos s
            JOIN relaciones r ON r.id_subasunto = s.id_subasunto
            WHERE r.id_asunto = $idAsunto
            ");
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
