<?php

/**
 * Description of Participantes
 *
 * @author Edgar Rincon
 */
require_once ('Conexion.class.php');

class Participantes extends Conexion{

    protected $agenda;
    protected $consejero;
    protected $rol;

    function __construct($age, $cons, $rol) {
        $this->agenda = $age;
        $this->consejero = $cons;
        $this->rol = $rol;
    }

    public function __destruct() {
        foreach ($this as $key => $value) {
            unset($this->$key);
        }
    } 
    
    public function buscar($idAgenda) {
        try {
            $this->getConexion();
            $consul = "SELECT *
            FROM participantes
            WHERE id_agenda = $idAgenda
            ";
            $exec = $this->conexion->prepare($consul);
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
            $exec = $this->conexion->prepare("INSERT INTO participantes (id_agenda,id_consejero,id_rol) VALUES('" . $this->agenda . "','" . $this->consejero . "','" . $this->rol . "');");
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
            $exec = $this->conexion->prepare("UPDATE participantes SET id_consejero='" . $this->consejero . "', id_rol='" . $this->rol . "'WHERE id_agenda='" . $this->agenda . "';");
            $exec->execute();
            echo "Participante actualizado exitosamente";
        } catch (PDOException $e) {
            echo "Error en la Consulta:" . $e->getMessage();
        }
    }

    public function eliminar() {
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare("DELETE FROM participantes WHERE id_agenda = " . $this->agenda . "");
            $exec->execute();
            echo "Asunto eliminado exitosamente";
        } catch (PDOException $e) {
            echo "Error en la Consulta:" . $e->getMessage();
        }
    }

    public function getAgenda() {
        return $this->agenda;
    }

    public function getConsejero() {
        return $this->consejero;
    }

    public function getRol() {
        return $this->rol;
    }

    public function setAgenda($agen) {
        $this->agenda = $agen;
    }

    public function setConsejero($cons) {
        $this->consejero = $cons;
    }

    public function setRol($rol) {
        $this->rol = $rol;
    }

}

?>
