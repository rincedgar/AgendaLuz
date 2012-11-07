<?php

/**
 * Description of TipoConsejo
 *
 * @author Edgar Rincon
 */
require_once 'Conexion.class.php';
class TipoConsejo extends Conexion {

    protected $id;
    protected $descripcion;
    protected $siglas;

    function __construct($id, $desc, $sig) {
        $this->id = $id;
        $this->descripcion = $desc;
        $this->siglas = $sig;
    }

    public function buscar() {
        try {

            if (!$this->getConexion())
                return 0;
            else {
                $exec = $this->conexion->prepare('SELECT * FROM tipo_consejo');
                $exec->execute();
                $consulta = $exec->fetchAll();
                return $consulta;
            }
        } catch (PDOException $e) {
            echo "Error de conexión:" . $e->getMessage();
        }
    }

    public function insertar() {
        try {

            $this->getConexion();
            $exec = $this->conexion->prepare("INSERT INTO tipo_consejo (descripcion,siglas) VALUES('" . $this->descripcion . "','" . $this->siglas . "')RETURNING id_tipo_consejo;");
            $exec->execute();
            $consulta = $exec->fetchAll();
            return $consulta;
        } catch (PDOException $e) {
            echo "Error de conexión:" . $e->getMessage();
        }
    }

    public function actualizar() {
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare("UPDATE tipo_consejo SET descripcion = '" . $this->descripcion . "',siglas='" . $this->siglas . "' WHERE id_asunto='" . $this->id . "';");
            $exec->execute();
            echo "Tipo de Consejo actualizado exitosamente";
        } catch (PDOException $e) {
            echo "Error en la Consulta:" . $e->getMessage();
        }
    }

    public function eliminar() {
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare("DELETE FROM tipo_consejo WHERE id_tipo_consejo = " . $this->id . "");
            $exec->execute();
            echo "Tipo de Consejo eliminado exitosamente";
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

    public function getSiglas() {
        return $this->siglas;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setDescripcion($desc) {
        $this->descripcion = $desc;
    }

    public function setSiglas($sig) {
        $this->siglas = $sig;
    }

}

?>
