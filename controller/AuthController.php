<?php
/**
 * Controlador encargado de la autenticacion de usuarios.
 * Maneja formularios de login y registro.
 */
// controller/AuthController.php
require_once __DIR__.'/../model/Usuario.php';

class AuthController
{
    /**
     * Muestra el formulario de inicio de sesión
     */
    public static function mostrarLogin()
    {
        include __DIR__.'/../view/auth/login.php';
    }

    /**
     * Muestra el formulario de registro (solo gerencia)
     */
    public static function mostrarRegistro()
    {
        //session_start();
        if (empty($_SESSION['usuario']) ||
            $_SESSION['usuario']['rol'] !== 'gerencia') {
            header('Location: index.php?ruta=menu');
            exit;
        }
        include __DIR__.'/../view/auth/registro.php';
    }

    /**
     * Valida las credenciales y crea la sesion de usuario
     */
    public static function procesarLogin()
{
    $nombre = trim($_POST['usuario'] ?? '');
    $clave  = trim($_POST['clave']   ?? '');

    $usuario = Usuario::obtenerPorNombre($nombre);

  
    if ($usuario && $usuario['clave'] === $clave) {
        // Login exitoso
        $_SESSION['usuario'] = $usuario;
        header('Location: index.php?ruta=menu');
        exit;
    } else {
        $error = 'Usuario o contraseña incorrectos';
        include __DIR__.'/../view/auth/login.php';
    }
}


    /**
     * Procesa el formulario de registro y crea un nuevo usuario
     */
    public static function procesarRegistro()
    {
        session_start();
        if (empty($_SESSION['usuario']) ||
            $_SESSION['usuario']['rol'] !== 'gerencia') {
            header('Location: index.php?ruta=menu');
            exit;
        }
        $nombre = $_POST['usuario'] ?? '';
        $clave  = $_POST['clave']   ?? '';
        $rol    = $_POST['rol']     ?? 'operario';
        if (!in_array($rol, ['gerencia', 'operario'])) {
            $rol = 'operario';
        }

        if (Usuario::crear($nombre, $clave, $rol)) {
            header('Location: index.php?ruta=login&exito=1');
            exit;
        } else {
            $error = 'Nombre ya registrado';
            include __DIR__.'/../view/auth/registro.php';
        }
    }
}
