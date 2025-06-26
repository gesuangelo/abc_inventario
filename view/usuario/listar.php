<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Usuarios registrados</title>
    <link rel="stylesheet" href="/abc_inventario/assets/css/style.css">
</head>
<body>
<?php include __DIR__ . '/../templates/header.php'; ?>
<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<div class="card fit">
    <h2>Usuarios registrados</h2>
    <?php if (!empty($_GET['msg'])): ?>
        <p class="ok centrado">Usuario <?= htmlspecialchars($_GET['msg']) ?> correctamente</p>
    <?php endif; ?>
    <table border="1">
        <thead>
            <tr><th>ID</th><th>Nombre</th><th>Rol</th><th>Acciones</th></tr>
        </thead>
        <tbody>
        <?php while ($u = $usuarios->fetch_assoc()): ?>
            <tr>
                <td><?= $u['id'] ?></td>
                <td><?= htmlspecialchars($u['nombre']) ?></td>
                <td><?= htmlspecialchars($u['rol']) ?></td>
                <td class="acciones">
                    <a class="action edit" href="index.php?ruta=usuario_editar&id=<?= $u['id'] ?>">Editar</a>
                    <a class="action delete" href="index.php?ruta=usuario_eliminar&id=<?= $u['id'] ?>" onclick="return confirm('¿Eliminar este usuario?')">Borrar</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
    <a href="index.php?ruta=registro">➕ Nuevo usuario</a> |
    <a href="index.php?ruta=menu">⬅ Volver al menú</a>
</div>
<?php include __DIR__ . '/../templates/footer.php'; ?>
</body>
</html>
