<?php


/**
 * Description of solicitud_punto
 *
 * @author Edgar Rincon
 */
class SolicitudPunto extends Conexion {

    protected $punto;
    protected $tipo_solicitud;

    function __construct($punto, $sub) {
        $this->punto = $punto;
        $this->tipo_solicitud = $sub;
    }

    public function __destruct() {
        foreach ($this as $key => $value) {
            unset($this->$key);
        }
    } 

    public function buscar() {
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare('SELECT * FROM solicitud_punto');
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
            $exec = $this->conexion->prepare("INSERT INTO solicitud_punto (id_punto,id_tipo_solicitud) VALUES('" . $this->punto . "','" . $this->tipo_solicitudpunto . "');");
            $exec->execute();
            $consulta = $exec->fetchAll();
            return $consulta;
        } catch (PDOException $e) {
            echo "Error en la Consulta:" . $e->getMessage();
        }
    }

    public function actualizar($punto, $solicitud) {
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare("UPDATE solicitud_punto SET id_punto = '" . $punto . "',id_tipo_solicitud='" . $solicitud . "' WHERE id_punto='" . $this->punto . "' AND id_tipo_solicitud='" . $this->tipo_solicitud . "';");
            $exec->execute();
            echo "Relacion actualizada exitosamente";
        } catch (PDOException $e) {
            echo "Error en la Consulta:" . $e->getMessage();
        }
    }

    public function eliminar() {
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare("DELETE FROM solicitud_punto WHERE id_punto='" . $this->punto . "' AND id_tipo_solicitud='" . $this->tipo_solicitud . "'");
            $exec->execute();
            echo "Relacion eliminada exitosamente";
        } catch (PDOException $e) {
            echo "Error en la Consulta:" . $e->getMessage();
        }
    }

}

?>
