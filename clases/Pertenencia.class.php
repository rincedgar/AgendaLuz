<?php

/**
 * Description of Pertenencia
 *
 * @author Edgar Rincon
 */
require_once ('Conexion.class.php');

class Pertenencia extends Conexion{
    protected $dependencia;
    protected $consejero;

    function __construct($depen='', $conse='') {
        $this->dependencia = $depen;
        $this->consejero = $conse;
    }

    public function __destruct() {
        foreach ($this as $key => $value) {
            unset($this->$key);
        }
    } 

    public function buscarConsejeros($hoy) {
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare("SELECT p.id_consejero FROM pertenencia p JOIN consejeros c ON c.id_consejero = p.id_consejero
                                                WHERE p.id_dependencia = '".$this->dependencia."' AND '".$hoy."' between c.desde AND c.hasta
                                                ORDER BY p.id_consejero");
            $exec->execute();
            $consulta = $exec->fetchAll();
            return $consulta;
        } catch (PDOException $e) {
            echo "Error en la Consulta:" . $e->getMessage();
        }
    }

    public function buscarConsejerosPorDependencia() {
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare("SELECT id_consejero FROM pertenencia WHERE id_dependencia = '".$this->dependencia."' ORDER BY id_consejero");
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
            $exec = $this->conexion->prepare('SELECT * FROM pertenencia');
            $exec->execute();
            $consulta = $exec->fetchAll();
            return $consulta;
        } catch (PDOException $e) {
            echo "Error en la Consulta:" . $e->getMessage();
        }
    }

     public function buscarDependencias() {
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare("SELECT id_dependencia FROM pertenencia WHERE id_consejero = '".$this->consejero."'");
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
            $exec = $this->conexion->prepare("INSERT INTO pertenencia (id_dependencia,id_consejero) VALUES ('". $this->dependencia."','".$this->consejero."')");
            $exec->execute();
            $consulta = $exec->fetchAll();
        } catch (PDOException $e) {
            echo "Error en la Consulta:" . $e->getMessage();
        }
    }

    public function actualizar($depen, $conse) {
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare("UPDATE pertenencia SET id_dependencia= '" . $depen . "',id_consejero='" . $conse. "' WHERE id_dependencia='" . $this->dependencia. "' AND id_consejero='" . $this->consejero. "';");
            $exec->execute();
            echo "Pertenencia actualizada exitosamente";
        } catch (PDOException $e) {
            echo "Error en la Consulta:" . $e->getMessage();
        }
    }

    public function eliminar() {
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare("DELETE FROM pertenencia WHERE id_dependencia='" . $this->dependencia. "' AND id_consejero='" . $this->consejero. "'");
            $exec->execute();
            echo "Pertenencia eliminada exitosamente";
        } catch (PDOException $e) {
            echo "Error en la Consulta:" . $e->getMessage();
        }
    }

     public function getDependencia() {
        return $this->dependencia;
    }

    public function getConsejero() {
        return $this->consejero;
    }

    public function setDependencia($depen) {
        $this->dependencia = $depen;
    }

    public function setConsejero($conse) {
        $this->consejero = $conse;
    }

}

?>
