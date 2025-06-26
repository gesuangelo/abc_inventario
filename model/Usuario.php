<?php
// model/Usuario.php
require_once __DIR__.'/../conexion/Conexion.php';

class Usuario
{
    /** Busca un usuario por nombre y devuelve fila o null */
    public static function obtenerPorNombre($nombre)
    {
        $db = Conexion::getConexion();
        $stmt = $db->prepare("SELECT * FROM usuarios WHERE nombre = ?");
        $stmt->bind_param('s', $nombre);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc(); // false si no existe
    }

    /** Inserta nuevo usuario. Devuelve true/false según éxito */
    public static function crear($nombre, $clavePlano, $rol = 'operario')
    {
        // Guardamos la contraseña tal cual se recibe (texto plano)
        $db   = Conexion::getConexion();
        $stmt = $db->prepare(
            "INSERT INTO usuarios (nombre, clave, rol) VALUES (?,?,?)"
        );
        $stmt->bind_param('sss', $nombre, $clavePlano, $rol);
        return $stmt->execute();
    }
}
