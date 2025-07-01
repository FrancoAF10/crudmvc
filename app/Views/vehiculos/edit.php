<?php include __DIR__ . '/../layout/header.php'; ?>

<h1 class="mb-4">Editar Vehiculo</h1>

<?php if (isset($error)): ?>
  <div class="alert alert-danger" role="alert">
    <?= htmlspecialchars($error) ?>
  </div>
<?php endif; ?>

<?php if (isset($vehiculo)): ?>
  <form action="/vehiculos/update/<?= htmlspecialchars($vehiculo['id']) ?>" method="POST">
    <div class="mb-3">
      <label for="marca" class="form-label">Nombre del Vehiculo</label>
      <input type="text" class="form-control" id="marca" name="marca" value="<?= htmlspecialchars($vehiculo['marca']) ?>"
        required>
    </div>
    <div class="mb-3">
      <label for="modelo" class="form-label">Modelo</label>
      <input type="text" class="form-control" id="modelo" name="modelo"
        value="<?= htmlspecialchars($vehiculo['modelo']) ?>" required>
    </div>
    <div class="mb-3">
      <label for="precio" class="form-label">Precio</label>
      <input type="number" step="0.01" class="form-control" id="precio" name="precio"
        value="<?= htmlspecialchars($vehiculo['precio']) ?>" required>
    </div>
    <div class="mb-3">
      <label for="color" class="form-label">Color</label>
      <input type="text" class="form-control" id="color" name="color"
        value="<?= htmlspecialchars($vehiculo['color']) ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Actualizar Vehiculos</button>
    <a href="/vehiculos" class="btn btn-secondary ms-2">Cancelar</a>
  </form>
<?php else: ?>
  <div class="alert alert-warning" role="alert">
    Vehiculo no encontrado.
  </div>
  <a href="/vehiculos" class="btn btn-secondary">Volver a la lista</a>
<?php endif; ?>

<?php include __DIR__ . '/../layout/footer.php'; ?>