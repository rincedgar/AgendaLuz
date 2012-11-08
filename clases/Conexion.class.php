<?php

/**
 * Description of bdConexion
 *
 * @author Edgar Rincon
 */
abstract class Conexion {

    protected $manejador = 'pgsql';
    protected $dbname = 'agenda';
    private static $servidor = 'localhost';
    private static $usuario = 'postgres';
    private static $contraseña = 'postgres';
    protected $conexion;

    protected function getConexion() {
        try {
            $this->conexion = new PDO($this->manejador . ":host=" . self::$servidor . ";dbname=" . $this->dbname, self::$usuario, self::$contraseña, array(PDO::ATTR_PERSISTENT => true));
            return $this->conexion;
        } catch (PDOException $e) {
            echo "Error de conexión:" . $e->getMessage();
        }
    }

}

?>