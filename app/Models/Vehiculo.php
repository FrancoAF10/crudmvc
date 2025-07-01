<?php

namespace App\Models;

use App\Core\Database;
use Exception;
use PDO;

class Vehiculo
{
  private PDO $db;

  public function __construct()
  {
    $this->db = Database::getInstance();
  }

  public function getAll(): array
  {
    //A. Escribir una consulta | transacción básica y que no se utilice con frecuencia
    //B. Utilizar un SPU
    $query = "SELECT * FROM vehiculos ORDER BY id DESC";

    try{
      $stmt = $this->db->prepare($query);
      $stmt->execute(); //No hay variables de entrada
      return $stmt->fetchAll(PDO::FETCH_ASSOC); //Retornamos una colección de registros
    }catch(Exception $e){
      return [];
    }
  }

  public function getById(int $id): ?array
  {
    $stmt = $this->db->prepare("SELECT * FROM vehiculos WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $vehiculo = $stmt->fetch();
    return $vehiculo ?: null;
  }

  public function create(string $marca, string $modelo, float $precio, string $color): bool
  {
    $query = "INSERT INTO vehiculos (marca, modelo, precio, color) VALUES (:marca, :modelo, :precio, :color)";

    try{
      $stmt = $this->db->prepare($query);
      $stmt->bindParam(':marca', $marca);
      $stmt->bindParam(':modelo', $modelo);
      $stmt->bindParam(':precio', $precio);
      $stmt->bindParam(':color', $color);
      return $stmt->execute();
    }catch(Exception $e){
      return false;
    }
  }

  public function update(int $id, string $marca, string $modelo, float $precio, string $color): bool
  {
    $stmt = $this->db->prepare("UPDATE vehiculos SET marca = :marca, modelo = :modelo, precio = :precio, color= :color WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':marca', $marca);
    $stmt->bindParam(':modelo', $modelo);
    $stmt->bindParam(':precio', $precio);
    $stmt->bindParam(':color', $color);
    return $stmt->execute();
  }

  public function delete(int $id): bool
  {
    $stmt = $this->db->prepare("DELETE FROM vehiculos WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
  }
}