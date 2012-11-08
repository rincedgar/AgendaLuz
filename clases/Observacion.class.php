<?php

/**
 * Description of observacion
 *
 * @author Edgar Rincon
 */
require_once ('Conexion.class.php');

class Observacion extends Conexion {

    protected $id;
    protected $descripcion;
    protected $idConsejero;
    protected $idPunto;

    function __construct($id, $punto, $desc, $con) {
        $this->id = $id;
        $this->descripcion = $desc;
        $this->idConsejero = $con;
        $this->idPunto = $punto;
    }

    public function __destruct() {
        foreach ($this as $key => $value) {
            unset($this->$key);
        }
    } 

    public function buscar() {
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare('SELECT * FROM observaciones');
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
            $exec = $this->conexion->prepare("INSERT INTO observaciones (descripcion,id_consejero,id_punto) VALUES('" . $this->descripcion . "','" . $this->idConsejero . "','" . $this->idPunto . "')RETURNING id_observacion;");
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
            $exec = $this->conexion->prepare("UPDATE observaciones SET descripcion = '" . $this->descripcion . "',id_cosejero='" . $this->idConsejero . "',id_punto'" . $this->idPunto . "' WHERE id_observacion='" . $this->id . "';");
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

    public function getIdConsjero() {
        return $this->idConsejero;
    }

    public function getIdPunto() {
        return $this->idPunto;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setDescripcion($desc) {
        $this->descripcion = $desc;
    }

    public function setIdConsjero($cons) {
        $this->idConsejero = $cons;
    }

    public function setIdPunto($pun) {
        $this->idPunto = $pun;
    }

}

?>
