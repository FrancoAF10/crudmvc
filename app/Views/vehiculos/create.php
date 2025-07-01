<?php include __DIR__ . '/../layout/header.php'; ?>

<h1 class="mb-4">Crear Nuevo Vehiculo</h1>

<?php if (isset($error)): ?>
  <div class="alert alert-danger" role="alert">
    <?= htmlspecialchars($error) ?>
  </div>
<?php endif; ?>

<form action="/vehiculos/store" method="POST" autocomplete="off" id="form-vehiculos">
  <div class="mb-3">
    <label for="marca" class="form-label">Marca del vehiculo</label>
    <input type="text" class="form-control" id="marca" name="marca" required>
  </div>
  <div class="mb-3">
    <label for="modelo" class="form-label">Modelo</label>
    <input type="text" class="form-control" id="modelo" name="modelo" required>
  </div>
  <div class="mb-3">
    <label for="precio" class="form-label">Precio</label>
    <input type="number" step="0.01" class="form-control" id="precio" name="precio" required>
  </div>
    <div class="mb-3">
    <label for="color" class="form-label">Modelo</label>
    <select name="color" id="color">
        <option value="">Seleccione opcion</option>
        <option value="blanco">blanco</option>
        <option value="negro">negro</option>
        <option value="azul">azul</option>
    </select>
  </div>
  <button type="submit" class="btn btn-primary">Guardar Vehiculo</button>
  <a href="/vehiculos" class="btn btn-secondary ms-2">Cancelar</a>
</form>

<script>
  document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector("#form-vehiculos")
    form.addEventListener("submit", (event) => {
      event.preventDefault()

      if (confirm("¿Registramos un nuevo vehiculo?")){
        form.submit()
      }
    })
  })
</script>

<?php include __DIR__ . '/../layout/footer.php'; ?>