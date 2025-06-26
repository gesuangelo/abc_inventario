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
        $stmt->execute();
        return $stmt->affected_rows === 1;
    }

    /** Devuelve todos los usuarios */
    public static function obtenerTodos()
    {
        $db = Conexion::getConexion();
        return $db->query("SELECT id, nombre, rol FROM usuarios ORDER BY id DESC");
    }

    /** Obtiene un usuario por id */
    public static function obtenerPorId($id)
    {
        $db   = Conexion::getConexion();
        $stmt = $db->prepare("SELECT * FROM usuarios WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    /** Actualiza un usuario */
    public static function actualizar($id, $nombre, $clavePlano, $rol)
    {
        $db   = Conexion::getConexion();
        $stmt = $db->prepare(
            "UPDATE usuarios SET nombre = ?, clave = ?, rol = ? WHERE id = ?"
        );
        $stmt->bind_param('sssi', $nombre, $clavePlano, $rol, $id);
        return $stmt->execute();
    }

    /** Elimina un usuario */
    public static function eliminar($id)
    {
        $db   = Conexion::getConexion();
        $stmt = $db->prepare("DELETE FROM usuarios WHERE id = ?");
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }
}
