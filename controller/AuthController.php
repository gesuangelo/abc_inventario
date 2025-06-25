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
        self::asegurarGerencia();
        include __DIR__.'/../view/usuario/crear.php';
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
        self::asegurarGerencia();
        $nombre = $_POST['usuario'] ?? '';
        $clave  = $_POST['clave']   ?? '';

        if (Usuario::crear($nombre, $clave)) {
            header('Location: index.php?ruta=login&exito=1');
        } else {
            $error = 'Nombre ya registrado';
            include __DIR__.'/../view/usuario/crear.php';
        }
    }

    /* ---------- helpers ---------- */

    private static function asegurarGerencia()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (empty($_SESSION['usuario'])) {
            header('Location: index.php?ruta=login');
            exit;
        }
        if ($_SESSION['usuario']['rol'] !== 'gerencia') {
            header('Location: index.php?ruta=menu&err=perm');
            exit;
        }
    }
}
