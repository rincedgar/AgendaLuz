<?php


/**
 * Description of Relaciones
 *
 * @author Edgar Rincon
 */
class Relaciones extends Conexion {

    protected $asunto;
    protected $subasunto;

    function __construct($asun, $sub) {
        $this->asunto = $asun;
        $this->subasunto = $sub;
    }

    public function __destruct() {
        foreach ($this as $key => $value) {
            unset($this->$key);
        }
    } 

    public function buscar() {
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare('SELECT * FROM relaciones');
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
            $exec = $this->conexion->prepare("INSERT INTO relaciones (id_asunto,id_subasunto) VALUES('" . $this->asunto . "','" . $this->subasunto . "');");
            $exec->execute();
            $consulta = $exec->fetchAll();
            return $consulta;
        } catch (PDOException $e) {
            echo "Error en la Consulta:" . $e->getMessage();
        }
    }

    public function actualizar($asun, $subasun) {
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare("UPDATE relaciones SET id_asunto = '" . $asun . "',id_subasunto='" . $subasun . "' WHERE id_asunto='" . $this->asunto . "' AND id_subasunto='" . $this->subasunto . "';");
            $exec->execute();
            echo "Relacion actualizada exitosamente";
        } catch (PDOException $e) {
            echo "Error en la Consulta:" . $e->getMessage();
        }
    }

    public function eliminar() {
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare("DELETE FROM relaciones WHERE id_asunto='" . $this->asunto . "' AND id_subasunto='" . $this->subasunto . "'");
            $exec->execute();
            echo "Relacion eliminada exitosamente";
        } catch (PDOException $e) {
            echo "Error en la Consulta:" . $e->getMessage();
        }
    }

}

?>
