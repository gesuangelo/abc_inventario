<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar usuario</title>
    <link rel="stylesheet" href="/abc_inventario/assets/css/style.css">
</head>
<body>
<?php include __DIR__ . '/../templates/header.php'; ?>
<div class="card form-centered">
    <h2>Editando usuario: <?= $usuario['nombre'] ?></h2>
    <form method="POST" action="index.php?ruta=usuario_actualizar">
        <input type="hidden" name="id" value="<?= $usuario['id'] ?>">
        <label>Usuario
            <input type="text" name="usuario" value="<?= htmlspecialchars($usuario['nombre']) ?>" required>
        </label><br>
        <label>Contraseña
            <input type="text" name="clave" value="<?= htmlspecialchars($usuario['clave']) ?>" required>
        </label><br>
        <label>Rol
            <select name="rol">
                <option value="gerencia" <?= $usuario['rol']==='gerencia'? 'selected':'' ?>>Gerencia</option>
                <option value="operario" <?= $usuario['rol']==='operario'? 'selected':'' ?>>Operario</option>
            </select>
        </label><br>
        <button type="submit">Actualizar</button>
        <a href="index.php?ruta=usuario_listar">Cancelar</a>
    </form>
</div>
<?php include __DIR__ . '/../templates/footer.php'; ?>
</body>
</html>
