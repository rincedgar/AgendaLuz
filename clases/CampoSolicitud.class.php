    <?php


/**
 * Description of campos_solicitud
 *
 * @author Edgar Rincon
 */
require_once ('Conexion.class.php');

class CampoSolicitud extends Conexion{

    protected $tipo_solicitud;
    protected $campo;

    function __construct($solicitud='', $campo='') {
        $this->tipo_solicitud = $solicitud;
        $this->campo = $campo;
    }
    
    public function __destruct() {
        foreach ($this as $key => $value) {
            unset($this->$key);
        }
    } 

    public function buscar() {
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare('SELECT * FROM campos_solicitud');
            $exec->execute();
            $consulta = $exec->fetchAll();
            return $consulta;
        } catch (PDOException $e) {
            echo "Error en la Consulta:" . $e->getMessage();
        }
    }

    public function buscarCampos(){
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare("SELECT id_campo FROM campos_solicitud WHERE id_tipo_solicitud ='".$this->tipo_solicitud."'");
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
            $exec = $this->conexion->prepare("INSERT INTO campos_solicitud (id_tipo_solicitud,id_campo) VALUES('" . $this->tipo_solicitud . "','" . $this->campotipo_solicitud . "');");
            $exec->execute();
            $consulta = $exec->fetchAll();
            return $consulta;
        } catch (PDOException $e) {
            echo "Error en la Consulta:" . $e->getMessage();
        }
    }

    public function actualizar($solicitud, $campo) {
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare("UPDATE campos_solicitud SET id_tipo_solicitud = '" . $solicitud . "',id_campo='" . $campo . "' WHERE id_tipo_solicitud='" . $this->tipo_solicitud . "' AND id_campo='" . $this->campo . "';");
            $exec->execute();
            echo "Relacion actualizada exitosamente";
        } catch (PDOException $e) {
            echo "Error en la Consulta:" . $e->getMessage();
        }
    }

    public function eliminar() {
        try {
            $this->getConexion();
            $exec = $this->conexion->prepare("DELETE FROM campos_solicitud WHERE id_tipo_solicitud='" . $this->tipo_solicitud . "' AND id_campo='" . $this->campo . "'");
            $exec->execute();
            echo "Relacion eliminada exitosamente";
        } catch (PDOException $e) {
            echo "Error en la Consulta:" . $e->getMessage();
        }
    }

}

?>
