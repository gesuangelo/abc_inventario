<?php
if (session_status() === PHP_SESSION_NONE) session_start();
if (empty($_SESSION['usuario'])) {
    header('Location: index.php?ruta=login');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inventario | Menú</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<?php include __DIR__ . '/templates/header.php'; ?>
<div class="card form-centered">
   <h2>Bienvenido, <?= htmlspecialchars($_SESSION['usuario']['nombre']) ?></h2>

<nav>
    <a href="index.php?ruta=producto_crear">➕ Crear producto</a> |
    <a href="index.php?ruta=producto_listar">📋 Ver productos</a> |
<?php if ($_SESSION['usuario']['rol'] === 'gerencia'): ?>
    <a href="index.php?ruta=registro">👤 Nuevo usuario</a> |
    <a href="index.php?ruta=usuario_listar">👥 Ver usuarios</a> |
<?php endif; ?>
    <a href="index.php?ruta=logout">⏻ Cerrar sesión</a>
</nav>
</div>


<?php include __DIR__ . '/templates/footer.php'; ?>
</body>
</html>
