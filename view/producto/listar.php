<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de productos</title>
    <link rel="stylesheet" href="/abc_inventario/assets/css/style.css">
</head>
<body>
<?php include __DIR__ . '/../templates/header.php'; ?>



<?php
if (session_status() === PHP_SESSION_NONE) session_start(); 
$esGerencia = ($_SESSION['usuario']['rol'] === 'gerencia');  
?>

<?php if (isset($_GET['msg'])): ?>
    <p class="ok">Producto <?= htmlspecialchars($_GET['msg']) ?> correctamente</p>
<?php endif; ?>
<div  class="card fit">
    <h2>Productos registrados</h2>
    <table border="1">
    <thead>
        <tr>
            <th>ID</th><th>Nombre</th><th>Ubicación</th>
            <th>Llegada</th><th>Despacho</th><th>Seguimiento</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    <?php while ($p = $productos->fetch_assoc()): ?>
        <tr>
            <td><?= $p['id'] ?></td>
            <td><?= htmlspecialchars($p['nombre']) ?></td>
            <td><?= htmlspecialchars($p['ubicacion']) ?></td>
            <td><?= $p['fecha_llegada'] ?></td>
            <td><?= $p['fecha_despacho'] ?></td>
            <td><?= htmlspecialchars($p['numero_seguimiento']) ?></td>
            <td class="acciones">
            <a class="action edit"
            href="index.php?ruta=producto_editar&id=<?= $p['id'] ?>">Editar</a>

            <?php if ($esGerencia): ?>
            <a class="action delete"
           href="index.php?ruta=producto_eliminar&id=<?= $p['id'] ?>"
           onclick="return confirm('¿Eliminar este producto?')">Borrar</a>
    <?php endif; ?>

    <a class="action hist"
       href="index.php?ruta=producto_movimientos&id=<?= $p['id'] ?>">Historial</a>
</td>
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>

<a href="index.php?ruta=producto_crear">➕ Nuevo producto</a> |
<a href="index.php?ruta=menu">⬅ Volver al menú</a>
</div>


<?php include __DIR__ . '/../templates/footer.php'; ?>
</body>
</html>
