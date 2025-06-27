<!-- Historial de movimientos del producto -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Historial de ubicaciones</title>
    <link rel="stylesheet" href="/abc_inventario/assets/css/style.css">
</head>
<body>
<?php include __DIR__ . '/../templates/header.php'; ?>
<div class="card form-centered">
    <p class="centrado">
        <a href="index.php?ruta=producto_listar">⬅ Volver al listado</a>
    </p>
    <thead>
        <tr><th>Ubicación</th><th>Fecha y hora</th></tr>
    </thead>
    <tbody>
    <?php while ($m = $movimientos->fetch_assoc()): ?>
        <tr>
            <td><?= $m['ubicacion'] ?></td>
            <td><?= $m['fecha_hora'] ?></td>
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>
</div>


<a href="index.php?ruta=producto_listar">⬅ Volver al listado</a>

<?php include __DIR__ . '/../templates/footer.php'; ?>
</body>
</html>
