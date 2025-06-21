<?php
// public/index.php

// Define el directorio raíz de la aplicación para mayor claridad
define('APP_ROOT', dirname(__DIR__));

require APP_ROOT . '/app/Core/Autoloader.php';

// Registra el autocargador
//App\Core\Autoloader::register();
Autoloader::register();

use App\Core\Router;

$router = new Router();

// Rutas para los productos
$router->add('GET', '/', 'HomeController', 'index'); // Ruta para la página de inicio
$router->add('GET', '/products', 'ProductController', 'index');
$router->add('GET', '/products/create', 'ProductController', 'create');
$router->add('POST', '/products/store', 'ProductController', 'store');
$router->add('GET', '/products/edit/{id}', 'ProductController', 'edit'); // {id} para capturar el ID
$router->add('POST', '/products/update/{id}', 'ProductController', 'update');
$router->add('POST', '/products/delete/{id}', 'ProductController', 'delete');

// Un controlador básico para la página de inicio
class HomeController extends App\Core\Controller
{
  public function index()
  {
    $this->view('home.index');
  }
}

$router->dispatch();