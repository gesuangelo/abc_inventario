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
        include __DIR__.'/../view/auth/registro.php';
    }

    public static function procesarLogin()
{
    $nombre = trim($_POST['usuario'] ?? '');
    $clave  = trim($_POST['clave']   ?? '');

    $usuario = Usuario::obtenerPorNombre($nombre);

    if ($usuario && password_verify($clave, $usuario['clave'])) {
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
        $nombre = $_POST['usuario'] ?? '';
        $clave  = $_POST['clave']   ?? '';

        if (Usuario::crear($nombre, $clave)) {
            header('Location: index.php?ruta=login&exito=1');
        } else {
            $error = 'Nombre ya registrado';
            include __DIR__.'/../view/auth/registro.php';
        }
    }
}
