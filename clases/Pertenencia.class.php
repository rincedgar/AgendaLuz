<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pertenencia
 *
 * @author Edgar Rincon
 */
class Pertenencia {
    protected $dependencia;
    protected $consejero;

    function __construct($depen='', $conse='') {
        $this->dependencia = $depen;
        $this->consejero = $conse;
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

    public function insertar() {
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare("INSERT INTO pertenecia (id_dependencia,id_consejero) VALUES('" . $this->dependencia. "','" . $this->consejero. "');");
            $exec->execute();
            $consulta = $exec->fetchAll();
            return $consulta;
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
}

?>
