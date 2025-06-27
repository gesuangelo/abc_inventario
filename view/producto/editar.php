<!-- Formulario de edición de producto -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar producto</title>
    <link rel="stylesheet" href="/abc_inventario/assets/css/style.css">
</head>
<body>
<?php include __DIR__ . '/../templates/header.php'; ?>
<div class="card form-centered">
    <h2>Editar producto #<?= $producto['id'] ?></h2>

<form method="POST" action="index.php?ruta=producto_actualizar">
    <!-- Campo oculto para mantener el id -->
    <input type="hidden" name="id" value="<?= $producto['id'] ?>">

    <label>Nombre
        <input type="text" name="nombre"
               value="<?= htmlspecialchars($producto['nombre']) ?>" required>
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
        <input type="date" name="fecha_llegada"
               value="<?= $producto['fecha_llegada'] ?>" required>
    </label><br>
    <label>Fecha de despacho
        <input type="date" name="fecha_despacho"
               value="<?= $producto['fecha_despacho'] ?>">
    </label><br>
    <label>Número de seguimiento
        <input type="text" name="numero_seguimiento"
               value="<?= htmlspecialchars($producto['numero_seguimiento']) ?>">
    </label><br>
    <button type="submit">Actualizar</button>
    <a href="index.php?ruta=producto_listar">Cancelar</a>
</form>
</div>


<?php include __DIR__ . '/../templates/footer.php'; ?>
</body>
</html>
