<?php
// app/Core/Database.php

namespace App\Core;

use PDO;
use PDOException;

class Database
{
  private static ?PDO $instance = null;
  private array $config;

  private function __construct()
  {
    $this->config = require __DIR__ . '/../Config/database.php';
    $this->connect();
  }

  private function connect()
  {
    $dsn = "mysql:host={$this->config['host']};dbname={$this->config['dbname']};charset={$this->config['charset']}";
    $options = [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::ATTR_EMULATE_PREPARES => false,
    ];

    try {
      self::$instance = new PDO($dsn, $this->config['user'], $this->config['password'], $options);
    } catch (PDOException $e) {
      throw new PDOException($e->getMessage(), (int) $e->getCode());
    }
  }

  public static function getInstance(): PDO
  {
    if (self::$instance === null) {
      new self(); // Llama al constructor para establecer la conexión
    }
    return self::$instance;
  }
}