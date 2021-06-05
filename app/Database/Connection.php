<?php
  namespace App\Database;

  use Exception;
  use mysqli;

  class Connection {
    public static function getConnection() {
      $databaseConfig = require __DIR__ . '/../../src/config/database.php';

      $connectionProperties = $databaseConfig['testing'];

      $connection = new mysqli(
        $connectionProperties['host'],
        $connectionProperties['user'],
        $connectionProperties['pass'],
        $connectionProperties['name'],
        $connectionProperties['port']
      );

      if ($connection->connect_error) {
        throw new Exception('Houve um erro ao criar uma conexão com o banco de dados.');
      }

      return $connection;
    }
  }
?>
