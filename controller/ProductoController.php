<?php
/**
 * Controlador para operaciones sobre productos del inventario.
 */
// controller/ProductoController.php

require_once __DIR__ . '/../model/Producto.php';
require_once __DIR__ . '/../model/Movimiento.php';

class ProductoController
{
    /* ---------- acciones de vista ---------- */

    /**
     * Muestra el listado de productos
     */
    public static function listar()
    {
        //session_start();                       // protege con login
        self::asegurarLogin();
        $productos = Producto::obtenerTodos();
        include __DIR__ . '/../view/producto/listar.php';
    }
    private const UBICACIONES = [
        'Bodega 1','Bodega 2','Bodega 3','Por enviar','Enviado'
    ];
    /**
     * Despliega el formulario para crear un producto
     */
    public static function mostrarCrear()
    {
        //session_start();
        self::asegurarLogin();
        include __DIR__ . '/../view/producto/crear.php';
    }

    /**
     * Carga el formulario de edicion para un producto
     */
    public static function mostrarEditar()
    {
        session_start();
        self::asegurarLogin();
        $id       = $_GET['id'] ?? 0;
        $producto = Producto::obtenerPorId($id);
        if (!$producto) {
            echo "Producto no encontrado";
            return;
        }
        include __DIR__ . '/../view/producto/editar.php';
    }

    /* ---------- procesadores de formularios ---------- */

    /**
     * Procesa el formulario de creacion y registra el producto
     */
    public static function procesarCrear()
{
    // 1. Guardamos el producto
    $ok = Producto::crear($_POST);

    if ($ok) {
        // 2. Obtenemos el id recién insertado
        $db = Conexion::conectar();
        $productoId = $db->insert_id;

        // 3. Registramos su primera ubicación
        Movimiento::registrar($productoId, $_POST['ubicacion']);
    }
    header('Location: index.php?ruta=producto_listar'
         . ($ok ? '&msg=creado' : '&err=1'));
}

    /**
     * Actualiza un producto existente
     */
public static function procesarEditar()
{
    $id         = $_POST['id'];
    $productoBD = Producto::obtenerPorId($id);
    $ok         = Producto::actualizar($id, $_POST);

    // Si la ubicación cambió y el UPDATE fue exitoso ⇒ registrar movimiento
    if ($ok && $productoBD['ubicacion'] !== $_POST['ubicacion']) {
        Movimiento::registrar($id, $_POST['ubicacion']);
    }
    header('Location: index.php?ruta=producto_listar'
         . ($ok ? '&msg=actualizado' : '&err=1'));
}


    /**
     * Elimina un producto del sistema
     */
    public static function eliminar()
    {
        session_start();
    self::asegurarLogin();

    /* 🔒 Permiso solo para GERENCIA */
    if ($_SESSION['usuario']['rol'] !== 'gerencia') {
        // Opcional: mensaje de “sin permiso”
        header('Location: index.php?ruta=producto_listar&err=perm');
        return;   // Abortamos la acción
    }
        $id = $_GET['id'] ?? 0;
        Producto::eliminar($id);
        header('Location: index.php?ruta=producto_listar&msg=eliminado');
    }

    /* ---------- helper ---------- */

    /**
     * Verifica que el usuario haya iniciado sesion
     */
    private static function asegurarLogin()
    {
        if (empty($_SESSION['usuario'])) {
            header('Location: index.php?ruta=login');
            exit;
        }
    }

    /**
     * Muestra el historial de ubicaciones de un producto
     */
    public static function movimientos()
{
    session_start();
    self::asegurarLogin();

    $id         = $_GET['id'] ?? 0;
    $producto   = Producto::obtenerPorId($id);
    if (!$producto) { echo "Producto no encontrado"; return; }

    $movimientos = Movimiento::obtenerPorProducto($id);
    include __DIR__ . '/../view/producto/movimientos.php';
}

    
}
