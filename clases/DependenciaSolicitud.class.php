<?php


/**
 * Description of dependencia_solicitudes
 *
 * @author Edgar Rincon
 */
class DependenciaSolicitud extends Conexion {

    protected $dependencia;
    protected $solicitud;

    function __construct($depe, $soli) {
        $this->dependencia = $depe;
        $this->solicitud = $soli;
    }

    public function __destruct() {
        foreach ($this as $key => $value) {
            unset($this->$key);
        }
    } 

    public function buscar() {
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare('SELECT * FROM dependencia_solicitudes');
            $exec->execute();
            $consulta = $exec->fetchAll();
            return $consulta;
        } catch (PDOException $e) {
            echo "Error en la Consulta:" . $e->getMessage();
        }
    }

     public function buscarSolicitudes(){
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare("SELECT id_tipo_solicitud FROM dependencia_solicitudes WHERE id_dependencia ='".$this->dependencia."' ORDER BY id_tipo_solicitud");
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
            $exec = $this->conexion->prepare("INSERT INTO dependencia_solicitudes (id_dependencia,id_tipo_solicitud) VALUES('" . $this->dependencia . "','" . $this->solicitud . "');");
            $exec->execute();
            $consulta = $exec->fetchAll();
            return $consulta;
        } catch (PDOException $e) {
            echo "Error en la Consulta:" . $e->getMessage();
        }
    }

    public function actualizar($depe, $soli) {
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare("UPDATE dependencia_solicitudes SET id_dependencia = '" . $depe . "',id_tipo_solicitud='" . $soli . "' WHERE id_dependencia='" . $this->dependencia . "' AND id_tipo_solicitud='" . $this->solicitud . "';");
            $exec->execute();
            echo "Relacion actualizada exitosamente";
        } catch (PDOException $e) {
            echo "Error en la Consulta:" . $e->getMessage();
        }
    }

    public function eliminar() {
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare("DELETE FROM dependencia_solicitudes WHERE id_dependencia='" . $this->dependencia . "' AND id_tipo_solicitud='" . $this->solicitud . "'");
            $exec->execute();
            echo "Relacion eliminada exitosamente";
        } catch (PDOException $e) {
            echo "Error en la Consulta:" . $e->getMessage();
        }
    }

     public function getDependencia() {
        return $this->dependencia;
    }

    public function getSolicitud() {
        return $this->solicitud;
    }

    public function setDependencia($dependencia) {
        $this->dependencia = $dependencia;
    }

    public function setSolicitud($solicitud) {
        $this->solicitud = $solicitud;
    }
}

?>
