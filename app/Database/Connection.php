<?php
  namespace App\Database;

  use Exception;
  use mysqli;

  class Connection {
    public static function getConnection() {
      $connection = new mysqli(
        $_ENV['DATABASE_HOST'],
        $_ENV['DATABASE_USER'],
        $_ENV['DATABASE_PASSWORD'],
        $_ENV['DATABASE_NAME'],
        $_ENV['DATABASE_PORT']
      );

      if ($connection->connect_error) {
        throw new Exception('Houve um erro ao criar uma conexão com o banco de dados.');
      }

      return $connection;
    }
  }
?>
