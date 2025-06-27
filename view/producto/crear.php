<!-- Formulario para registrar un nuevo producto -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear producto</title>
    <link rel="stylesheet" href="/abc_inventario/assets/css/style.css">
</head>
<body>
<?php include __DIR__ . '/../templates/header.php'; ?>
<div class="card form-centered">
    <h2>Registrar nuevo producto</h2>
    <form method="POST" action="index.php?ruta=producto_guardar">
    <label>Nombre
        <input type="text" name="nombre" required>
    </label><br>
    <label>Ubicación
    <select name="ubicacion" required>
    <?php foreach (ProductoController::UBICACIONES as $u): ?>
        <option value="<?= $u ?>"
            <?= (isset($producto) && $producto['ubicacion'] === $u) ? 'selected' : '' ?>>
            <?= $u ?>
        </option>
    <?php endforeach; ?>
</select>

    </label><br>
    <label>Fecha de llegada
        <input type="date" name="fecha_llegada" required>
    </label><br>
    <label>Fecha de despacho
        <input type="date" name="fecha_despacho">
    </label><br>
    <label>Número de seguimiento
        <input type="text" name="numero_seguimiento">
    </label><br>
    <button type="submit">Guardar</button>
    <a href="index.php?ruta=producto_listar">Cancelar</a>
</form>
</div>


<?php include __DIR__ . '/../templates/footer.php'; ?>
</body>
</html>
