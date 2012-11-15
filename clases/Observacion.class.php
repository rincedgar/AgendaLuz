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

    function __construct($con, $punto, $desc) {
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
            $exec = $this->conexion->prepare("SELECT descripcion FROM observaciones WHERE id_punto = '".$this->idPunto."' AND id_consejero = '".$this->idConsejero."'");
            $exec->execute();
            $consulta = $exec->fetchAll();
            if(count($consulta)!=0)
            $this->descripcion = $consulta[0]['descripcion'];
        } catch (PDOException $e) {
            echo "Error en la Consulta:" . $e->getMessage();
        }
    }

    public function insertar() {
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare("INSERT INTO observaciones (id_consejero, id_punto, descripcion) VALUES('".$this->idConsejero."','".$this->idPunto."','".$this->descripcion."');");
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
            $exec = $this->conexion->prepare("UPDATE observaciones SET descripcion = '" . $this->descripcion . "' WHERE id_cosejero='" . $this->idConsejero . "' AND id_punto'" . $this->idPunto . "';");
            $exec->execute();
            echo "Estatus actualizado exitosamente";
        } catch (PDOException $e) {
            echo "Error en la Consulta:" . $e->getMessage();
        }
    }

    public function eliminar() {
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare("DELETE FROM observaciones WHERE id_cosejero='" . $this->idConsejero . "' AND id_punto'" . $this->idPunto . "';");
            $exec->execute();
            echo "obsevacion eliminado exitosamente";
        } catch (PDOException $e) {
            echo "Error en la Consulta:" . $e->getMessage();
        }
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getIdConsejero() {
        return $this->idConsejero;
    }

    public function getIdPunto() {
        return $this->idPunto;
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
