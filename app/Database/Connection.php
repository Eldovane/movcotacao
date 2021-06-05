<?php
  namespace App\Database;

  use Exception;
  use mysqli;

  class Connection {
    public static function getConnection() {
      // Importando a configuração do banco de dados do projeto.
      $databaseConfig = require __DIR__ . '/../../src/config/database.php';

      // Selecionando qual conexão a aplicação irá trabalhar.
      // Lembrar de trocar para produção quando for subir a aplicação.
      // Por enquanto não sei como mudar issi dinâmicamente.
      $connectionProperties = $databaseConfig['testing'];

      // Criando a instância do mysqli;
      $connection = new mysqli(
        $connectionProperties['host'],
        $connectionProperties['user'],
        $connectionProperties['pass'],
        $connectionProperties['name'],
        $connectionProperties['port']
      );

      // Verificando se houve algum erro ao tentar criar a instância do mysqli.
      if ($connection->connect_error) {
        throw new Exception('Houve um erro ao criar uma conexão com o banco de dados.');
      }

      // Entregando a conexão criar no instânciamento do mysqli.
      return $connection;
    }
  }
?>
