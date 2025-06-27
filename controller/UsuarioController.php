<?php
/**
 * Controlador para gestion de usuarios del sistema.
 */
// controller/UsuarioController.php

require_once __DIR__ . '/../model/Usuario.php';

class UsuarioController
{
    /**
     * Comprueba que el usuario autenticado sea de gerencia
     */
    private static function asegurarGerencia()
    {
        if (empty($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'gerencia') {
            header('Location: index.php?ruta=menu');
            exit;
        }
    }

    /**
     * Lista todos los usuarios registrados
     */
    public static function listar()
    {
        //session_start();
        self::asegurarGerencia();
        $usuarios = Usuario::obtenerTodos();
        include __DIR__ . '/../view/usuario/listar.php';
    }

    /**
     * Despliega el formulario de edicion de un usuario
     */
    public static function mostrarEditar()
    {
        //session_start();
        self::asegurarGerencia();
        $id     = $_GET['id'] ?? 0;
        $usuario = Usuario::obtenerPorId($id);
        if (!$usuario) { echo "Usuario no encontrado"; return; }
        include __DIR__ . '/../view/usuario/editar.php';
    }

    /**
     * Guarda los cambios realizados a un usuario
     */
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

    /**
     * Elimina un usuario del sistema
     */
    public static function eliminar()
    {
        session_start();
        self::asegurarGerencia();
        $id = $_GET['id'] ?? 0;
        Usuario::eliminar($id);
        header('Location: index.php?ruta=usuario_listar&msg=eliminado');
    }
}
