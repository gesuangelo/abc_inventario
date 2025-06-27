<?php
/**
 * Modelo de acceso a la tabla de productos.
 */

// Acceso CRUD a la tabla productos

require_once __DIR__ . '/../conexion/Conexion.php';

class Producto
{
    /** Devuelve un array con todos los productos */
    public static function obtenerTodos()
    {
        $db = Conexion::conectar();
        $sql = "SELECT * FROM productos ORDER BY id DESC";
        return $db->query($sql);
    }

    /** Devuelve un producto por id (o null) */
    public static function obtenerPorId($id)
    {
        $db = Conexion::conectar();
        $stmt = $db->prepare("SELECT * FROM productos WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    /** Crea un nuevo registro */
    public static function crear($datos)
    {
        $db = Conexion::conectar();
        $stmt = $db->prepare(
            "INSERT INTO productos
               (nombre, ubicacion, fecha_llegada, fecha_despacho, numero_seguimiento)
             VALUES (?,?,?,?,?)"
        );
        $stmt->bind_param(
            'sssss',
            $datos['nombre'],
            $datos['ubicacion'],
            $datos['fecha_llegada'],
            $datos['fecha_despacho'],
            $datos['numero_seguimiento']
        );
        return $stmt->execute();
    }

    /** Actualiza un producto existente */
    public static function actualizar($id, $datos)
    {
        $db = Conexion::conectar();
        $stmt = $db->prepare(
            "UPDATE productos SET
                 nombre = ?, ubicacion = ?, fecha_llegada = ?, fecha_despacho = ?, numero_seguimiento = ?
             WHERE id = ?"
        );
        $stmt->bind_param(
            'sssssi',
            $datos['nombre'],
            $datos['ubicacion'],
            $datos['fecha_llegada'],
            $datos['fecha_despacho'],
            $datos['numero_seguimiento'],
            $id
        );
        return $stmt->execute();
    }

    /** Elimina un producto */
    public static function eliminar($id)
    {
        $db = Conexion::conectar();
        $stmt = $db->prepare("DELETE FROM productos WHERE id = ?");
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }
}
