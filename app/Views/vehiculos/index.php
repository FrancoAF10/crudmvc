<?php include __DIR__ . '/../layout/header.php'; ?>

<h1 class="mb-4">Lista de Vehiculos</h1>

<a href="/vehiculos/create" class="btn btn-success mb-3">Agregar</a>
<a href="/vehiculos/search" class="btn btn-success mb-3">Buscador</a>

<div class="table-responsive">
  <table class="table table-striped table-hover">
    <thead>
      <tr>
        <th>ID</th>
        <th>Marca</th>
        <th>Modelo</th>
        <th>Precio</th>
        <th>Color</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php if (empty($vehiculos)): ?>
        <tr>
          <td colspan="6" class="text-center">No hay vehiculos registrados.</td>
        </tr>
      <?php else: ?>
        <?php foreach ($vehiculos as $vehiculo): ?>
          <tr>
            <td><?= htmlspecialchars($vehiculo['id']) ?></td>
            <td><?= htmlspecialchars($vehiculo['marca']) ?></td>
            <td><?= htmlspecialchars($vehiculo['modelo']) ?></td>
            <td>S/ <?= number_format(htmlspecialchars($vehiculo['precio']), 2) ?></td>
            <td><?= htmlspecialchars($vehiculo['color']) ?></td>
            <td>
              <a href="/vehiculos/edit/<?= htmlspecialchars($vehiculo['id']) ?>"
                class="btn btn-warning btn-sm me-2">Editar</a>
              <form action="/vehiculos/delete/<?= htmlspecialchars(string: $vehiculo['id']) ?>" method="POST" class="d-inline"
                onsubmit="return confirm('¿Estás seguro de que quieres eliminar este vehiculo?');">
                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>