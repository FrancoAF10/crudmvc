<?php include __DIR__ . '/../layout/header.php'; ?>

<h1 class="mb-4">Crear Nuevo Producto</h1>

<?php if (isset($error)): ?>
  <div class="alert alert-danger" role="alert">
    <?= htmlspecialchars($error) ?>
  </div>
<?php endif; ?>

<form action="/products/store" method="POST">
  <div class="mb-3">
    <label for="name" class="form-label">Nombre del Producto</label>
    <input type="text" class="form-control" id="name" name="name" required>
  </div>
  <div class="mb-3">
    <label for="category" class="form-label">Categoría</label>
    <input type="text" class="form-control" id="category" name="category" required>
  </div>
  <div class="mb-3">
    <label for="price" class="form-label">Precio</label>
    <input type="number" step="0.01" class="form-control" id="price" name="price" required>
  </div>
  <button type="submit" class="btn btn-primary">Guardar Producto</button>
  <a href="/products" class="btn btn-secondary ms-2">Cancelar</a>
</form>

<?php include __DIR__ . '/../layout/footer.php'; ?>