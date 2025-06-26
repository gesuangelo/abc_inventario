<?php
// controller/AuthController.php
require_once __DIR__.'/../model/Usuario.php';

class AuthController
{
    public static function mostrarLogin()
    {
        include __DIR__.'/../view/auth/login.php';
    }

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

    public static function procesarLogin()
{
    $nombre = trim($_POST['usuario'] ?? '');
    $clave  = trim($_POST['clave']   ?? '');

    $usuario = Usuario::obtenerPorNombre($nombre);

    // Antes: if ($usuario && password_verify($clave, $usuario['clave'])) { … }
    // Ahora, comparación directa de texto plano:
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
