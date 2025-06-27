<?php
/**
 * Punto de entrada principal de la aplicacion.
 * Segun el parametro "ruta" se dirige al controlador correspondiente.
 */
// index.php: punto de entrada de la aplicación
session_start();

// Incluir la conexión y controladores
require_once 'conexion/Conexion.php';
require_once 'controller/AuthController.php';
require_once 'controller/ProductoController.php';
require_once 'controller/UsuarioController.php';

// Determinar la ruta (por ejemplo: ?ruta=login, ?ruta=registro, ?ruta=productos)
$ruta = isset($_GET['ruta']) ? $_GET['ruta'] : 'login';

// Enrutamos la peticion segun la ruta indicada
switch ($ruta) {
    case 'producto_movimientos':
        ProductoController::movimientos();
        break;
    case 'producto_crear':
        ProductoController::mostrarCrear();
        break;
    
    case 'producto_guardar':
        ProductoController::procesarCrear();
        break;
    
    case 'producto_listar':
        ProductoController::listar();
        break;
    
    case 'producto_editar':
        ProductoController::mostrarEditar();
        break;
    
    case 'producto_actualizar':
        ProductoController::procesarEditar();
        break;
    
    case 'producto_eliminar':
        ProductoController::eliminar();
        break;

    case 'usuario_listar':
        UsuarioController::listar();
        break;
    case 'usuario_editar':
        UsuarioController::mostrarEditar();
        break;
    case 'usuario_actualizar':
        UsuarioController::procesarActualizar();
        break;
    case 'usuario_eliminar':
        UsuarioController::eliminar();
        break;
        
    
    /* ---------- cerrar sesión ---------- */
    case 'logout':
        session_start();
        session_destroy();
        header('Location: index.php?ruta=login');
        break;

    case 'login':
        AuthController::mostrarLogin();
        break;
    case 'registro':
        AuthController::mostrarRegistro();
        break;
    case 'verificar_login':
        AuthController::procesarLogin();
        break;
    case 'procesar_registro':
        AuthController::procesarRegistro();
        break;
    case 'menu':                 // pequeño menú después del login
        include __DIR__.'/view/index.php';
        break;

    
        // Aquí luego pondrás rutas para productos, logout, etc.

    default:
        echo 'Ruta no encontrada';
        break;
}
?>
