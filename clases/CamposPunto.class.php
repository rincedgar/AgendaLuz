<?php


/**
 * Description of campos_punto
 *
 * @author Edgar Rincon
 */
class CamposPunto extends Conexion{

    protected $punto;
    protected $campo;
    protected $contenido;

    function __construct($punto='', $campo='',$contenido='') {
        $this->punto = $punto;
        $this->campo = $campo;
        $this->contenido = $contenido;
    }

    public function __destruct() {
        foreach ($this as $key => $value) {
            unset($this->$key);
        }
    } 

    public function buscar() {
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare("SELECT id_campo, contenido FROM campos_punto WHERE id_punto = '".$this->punto."'");
            $exec->execute();
            $consulta = $exec->fetchAll();
            return $consulta;
        } catch (PDOException $e) {
            echo "Error en la Consulta:" . $e->getMessage();
        }
    }

    public function buscarTodos() {
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare('SELECT * FROM campos_punto');
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
            $exec = $this->conexion->prepare("INSERT INTO campos_punto (id_punto,id_campo,contenido) VALUES('" . $this->punto . "','" . $this->campo."','" . $this->contenido. "');");
            $exec->execute();
            $consulta = $exec->fetchAll();
            return $consulta;
        } catch (PDOException $e) {
            echo "Error en la Consulta:" . $e->getMessage();
        }
    }

    public function actualizar($punto, $campo, $contenido) {
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare("UPDATE campos_punto SET id_punto = '" . $punto . "',id_campo='" . $campo . "',contenido='" . $contenido . "' WHERE id_punto='" . $this->punto . "' AND id_campo='" . $this->campo . "';");
            $exec->execute();
            echo "Relacion actualizada exitosamente";
        } catch (PDOException $e) {
            echo "Error en la Consulta:" . $e->getMessage();
        }
    }

    public function eliminar() {
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare("DELETE FROM campos_punto WHERE id_punto='" . $this->punto . "' AND id_campo='" . $this->campo . "'");
            $exec->execute();
            echo "Relacion eliminada exitosamente";
        } catch (PDOException $e) {
            echo "Error en la Consulta:" . $e->getMessage();
        }
    }

    public function getPunto() {
        return $this->punto;
    }

    public function getCampo() {
            return $this->campo;
    }

    public function getContenido() {
        return $this->contenido;
    }

    public function setPunto($punto) {
        $this->punto=$punto;
    }

    public function setCampo($campo) {
        $this->campo= $campo;
    }

    public function setContenido($contenido) {
        $this->contenido = $contenido;
    }
}

?>
