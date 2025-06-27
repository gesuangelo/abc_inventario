<?php
/**
 * Modelo que registra y consulta movimientos de productos.
 */

require_once __DIR__ . '/../conexion/Conexion.php';

class Movimiento
{
    /** Registra un nuevo movimiento */
    public static function registrar($productoId, $ubicacion)
    {
        $db = Conexion::conectar();
        $stmt = $db->prepare(
            "INSERT INTO producto_movimientos (producto_id, ubicacion) VALUES (?,?)"
        );
        $stmt->bind_param('is', $productoId, $ubicacion);
        return $stmt->execute();
    }

    /** Devuelve todos los movimientos de un producto */
    public static function obtenerPorProducto($productoId)
    {
        $db = Conexion::conectar();
        $stmt = $db->prepare(
            "SELECT ubicacion, fecha_hora
             FROM producto_movimientos
             WHERE producto_id = ?
             ORDER BY fecha_hora DESC"
        );
        $stmt->bind_param('i', $productoId);
        $stmt->execute();
        return $stmt->get_result();
    }
}
