<?php
// Formulario de registro de usuario
if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de usuario</title>
    <link rel="stylesheet" href="/abc_inventario/assets/css/style.css">
</head>
<body>
<?php include __DIR__.'/../templates/header.php'; ?>
<div class="card form-centered">
    <h2>Registrarse</h2>
    <form method="POST" action="index.php?ruta=procesar_registro">
    <label>Usuario
        <input type="text" name="usuario" required>
    </label><br>
    <label>Contraseña
        <input type="password" name="clave" required>
    </label><br>

    <label>Rol
        <select name="rol">
            <option value="gerencia">Gerencia</option>
            <option value="operario" selected>Operario</option>
        </select>
    </label><br>

    <button type="submit">Crear cuenta</button>
</form>
</div>


<?php if (!empty($error)): ?>
    <p class="error"><?= $error ?></p>
<?php endif; ?>


<?php include __DIR__.'/../templates/footer.php'; ?>
</body>
</html>
