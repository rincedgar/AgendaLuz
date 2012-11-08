<?php

/**
 * Description of TipoAgenda
 *
 * @author Edgar Rincon
 */
class TipoAgenda extends Conexion {

    protected $agenda;
    protected $dependencia;
    protected $tipoConsejo;

    function __construct($age, $dep, $tipo) {
        $this->agenda = $age;
        $this->dependencia = $dep;
        $this->tipoConsejo = $tipo;
    }

    public function __destruct() {
        foreach ($this as $key => $value) {
            unset($this->$key);
        }
    } 

    public function buscar() {
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare('SELECT * FROM tipo_agenda');
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
            $exec = $this->conexion->prepare("INSERT INTO tipo_agenda (id_agenda,id_dependencia,id_tipo_consejo) VALUES('" . $this->agenda . "','" . $this->dependencia . "','" . $this->tipoConsejo . "');");
            $exec->execute();
            $consulta = $exec->fetchAll();
            return 'se inserto'.$this->agenda.$this->dependencia.$this->tipoConsejo;
        } catch (PDOException $e) {
            echo "Error en la Consulta:" . $e->getMessage();
        }
    }

    public function actualizar() {
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare("UPDATE tipo_agenda SET id_dependencia = '" . $this->dependencia . "',id_tipo_consejo='" . $this->tipoConsejo . "' WHERE id_agenda='" . $this->agenda . "';");
            $exec->execute();
            echo "Tipo de Agenda actualizado exitosamente";
        } catch (PDOException $e) {
            echo "Error en la Consulta:" . $e->getMessage();
        }
    }

    public function eliminar() {
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare("DELETE FROM tipo_agenda WHERE id_agenda= " . $this->agenda . "");
            $exec->execute();
            echo "Tipo de Agenda eliminado exitosamente";
        } catch (PDOException $e) {
            echo "Error en la Consulta:" . $e->getMessage();
        }
    }

    public function getAgenda() {
        return $this->agenda;
    }

    public function getDependencia() {
        return $this->dependencia;
    }

    public function getTipoConsejo() {
        return $this->tipoConsejo;
    }

    public function setAgenda($agenda) {
        $this->agenda = $agenda;
    }

    public function setDependencia($dep) {
        $this->dependencia = $dep;
    }

    public function setTipoConsejo($tipo) {
        $this->tipoConsejo = $tipo;
    }

}

?>
