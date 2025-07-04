<?php
// Formulario de inicio de sesión
if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="/abc_inventario/assets/css/style.css">
</head>
<body>
<?php include __DIR__.'/../templates/header.php'; ?>
<div class="card form-centered">
    <h2>Login</h2>
    <form method="POST" action="index.php?ruta=verificar_login">
    <label>Usuario
        <input type="text" name="usuario" required>
    </label><br>
    <label>Contraseña
        <input type="password" name="clave" required>
    </label><br>
    <button type="submit">Entrar</button>
</form>

    <?php if (!empty($_GET['exito'])): ?>
        <p class="ok">¡Registrado correctamente, ahora inicia sesión!</p>
    <?php endif; ?>

    <?php if (!empty($error)): ?>
        <p class="error"><?= $error ?></p>
    <?php endif; ?>
</div>


<?php include __DIR__.'/../templates/footer.php'; ?>
</body>
</html>
