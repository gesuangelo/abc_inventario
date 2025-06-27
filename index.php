<?php
// index.php: punto de entrada de la aplicación
session_start();

// Incluir la conexión y controladores
require_once 'conexion/Conexion.php';
require_once 'controller/AuthController.php';
require_once 'controller/ProductoController.php';
require_once 'controller/UsuarioController.php';

// Determinar la ruta (por ejemplo: ?ruta=login, ?ruta=registro, ?ruta=productos)
//Si existe una ruta en la url se le asigna a la variable ruta, si no, le asigna login 
$ruta = isset($_GET['ruta']) ? $_GET['ruta'] : 'login';

//opciones de ruta en un switch
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
    case 'menu':                 
        include __DIR__.'/view/index.php';
        break;

    default:
        echo 'Ruta no encontrada';
        break;
}
?>
