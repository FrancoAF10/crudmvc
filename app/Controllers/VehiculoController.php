<?php
// app/Controllers/ProductController.php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Vehiculo;

class VehiculoController extends Controller
{
  private Vehiculo $vehiculoModel;

  public function __construct()
  {
    $this->vehiculoModel = new Vehiculo();
  }

 
  //Es cuando ingresamos a la raíz de un determinado módulo

  public function index(): void
  {
    $vehiculos = $this->vehiculoModel->getAll();
    $this->view('vehiculos.index', ['vehiculos' => $vehiculos]);
  }

  public function search(): void
  {
    //VISTA
    $this->view('vehiculos.search');
  }

  public function create(): void
  {
    //$marcaModel = new Marca();
    //$marcas = $marcaModel->getAll();

    $this->view('vehiculos.create');
  }

  public function store(): void
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $marca = trim($_POST['marca'] ?? '');
      $modelo = trim($_POST['modelo'] ?? '');
      $precio = filter_var($_POST['precio'] ?? '', FILTER_VALIDATE_FLOAT);
      $color = trim($_POST['color'] ?? '');

      if ($marca && $modelo && $precio && $color !== false) {
        if ($this->vehiculoModel->create($marca, $modelo, $precio, $color)) {
          $this->redirect('/vehiculos');
        } else {
          // Manejar error de inserción
          $this->view('vehiculos.create', ['error' => 'Error al crear el vehiculo.']);
        }
      } else {
        $this->view('vehiculos.create', ['error' => 'Todos los campos son obligatorios y el precio debe ser un número válido.']);
      }
    }
  }

  public function edit(int $id): void
  {
    $vehiculo = $this->vehiculoModel->getById($id);
    if ($vehiculo) {
      $this->view('vehiculos.edit', ['vehiculo' => $vehiculo]);
    } else {
      http_response_code(404);
      $this->view('errors.404');
    }
  }

  public function update(int $id): void
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $marca = trim($_POST['marca'] ?? '');
      $modelo = trim($_POST['modelo'] ?? '');
      $precio = filter_var($_POST['precio'] ?? '', FILTER_VALIDATE_FLOAT);
      $color = trim($_POST['color'] ?? '');

      if ($marca && $modelo && $precio && $color !== false) {
        if ($this->vehiculoModel->update($id, $marca, $modelo, $precio, $color)) {
          $this->redirect('/vehiculos');
        } else {
          $vehiculo = $this->vehiculoModel->getById($id); // Recargar para la vista de error
          $this->view('vehiculos.edit', ['vehiculo' => $vehiculo, 'error' => 'Error al actualizar el vehiculo.']);
        }
      } else {
        $vehiculo = $this->vehiculoModel->getById($id); // Recargar para la vista de error
        $this->view('vehiculos.edit', ['vehiculo' => $vehiculo, 'error' => 'Todos los campos son obligatorios y el precio debe ser un número válido.']);
      }
    }
  }

  public function delete(int $id): void
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Usamos POST para la eliminación por seguridad
      if ($this->vehiculoModel->delete($id)) {
        $this->redirect('/vehiculos');
      } else {
        // Puedes redirigir con un mensaje de error o mostrar una vista de error
        $this->redirect('/vehiculos?error=delete_failed');
      }
    } else {
      // Si se intenta acceder directamente por GET, redirigir o mostrar 405
      http_response_code(405);
      $this->view('errors.405'); // Podrías crear una vista para el error 405
    }
  }

  public function searchById(int $id): void{
    header('Content-Type: application/json');
    $vehiculo = $this->vehiculoModel->getById($id);

    if ($vehiculo){
      echo json_encode(['success' => true, 'vehiculo' => $vehiculo]);
    }else{
      http_response_code(404);
      echo json_encode(['success' => false, 'message' => 'Vehiculo no encontrado']);
    }
    exit();
  }
}