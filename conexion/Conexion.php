<?php
/**
 * Conexion.php
 * Clase para gestionar la conexión a la base de datos MySQL
 */
class Conexion {
    // Datos de conexión
    private static $host = 'localhost';
    private static $db   = 'abc_inventario';
    private static $user = 'root';
    private static $pass = '';
    private static $conn = null;

    /**
     * Devuelve un único objeto mysqli conectado
     * @return mysqli
     */
    public static function conectar() {
        if (self::$conn === null) {
            self::$conn = new mysqli(
                self::$host,
                self::$user,
                self::$pass,
                self::$db
            );

            // Manejo de errores de conexión
            if (self::$conn->connect_error) {
                die('Error de conexión (' 
                    . self::$conn->connect_errno 
                    . '): ' 
                    . self::$conn->connect_error
                );
            }
        }
        return self::$conn;
    }
    public static function getConexion() {
        return self::conectar();
    }
}
?>