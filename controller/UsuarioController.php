<?php
// controller/UsuarioController.php

require_once __DIR__ . '/../model/Usuario.php';

class UsuarioController
{
    private static function asegurarGerencia()
    {
        if (empty($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'gerencia') {
            header('Location: index.php?ruta=menu');
            exit;
        }
    }

    public static function listar()
    {
        //session_start();
        self::asegurarGerencia();
        $usuarios = Usuario::obtenerTodos();
        include __DIR__ . '/../view/usuario/listar.php';
    }

    public static function mostrarEditar()
    {
        //session_start();
        self::asegurarGerencia();
        $id     = $_GET['id'] ?? 0;
        $usuario = Usuario::obtenerPorId($id);
        if (!$usuario) { echo "Usuario no encontrado"; return; }
        include __DIR__ . '/../view/usuario/editar.php';
    }

    public static function procesarActualizar()
    {
        session_start();
        self::asegurarGerencia();
        $id    = $_POST['id'];
        $nombre = $_POST['usuario'] ?? '';
        $clave  = $_POST['clave']   ?? '';
        $rol    = $_POST['rol']     ?? 'operario';
        Usuario::actualizar($id, $nombre, $clave, $rol);
        header('Location: index.php?ruta=usuario_listar&msg=actualizado');
    }

    public static function eliminar()
    {
        session_start();
        self::asegurarGerencia();
        $id = $_GET['id'] ?? 0;
        Usuario::eliminar($id);
        header('Location: index.php?ruta=usuario_listar&msg=eliminado');
    }
}
