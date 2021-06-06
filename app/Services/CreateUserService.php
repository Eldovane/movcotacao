<?php
  namespace App\Services;
  use App\Database\Connection;
  use App\Providers\HashProvider;
  use Exception;

  class CreateUserService {
    private $hashProvider;

    function __construct(HashProvider $hashProvider)
    {
      $this->hashProvider = $hashProvider;
    }

    public function execute(
      string $name,
      string $email,
      string $password,
      string $user,
      string $document,
      string $type,
      string $companyId
    ) {
      $connection = Connection::getConnection();

      $checkUserExistsQuery = "SELECT id FROM usuarios WHERE email = '{$email}'";

      $checkUserExists = $connection
        ->query($checkUserExistsQuery)
        ->fetch_assoc();

      if ($checkUserExists) {
        throw new Exception(
          'Esse e-mail já está sendo usado por uma conta.',
          400
        );
      }

      $checkUsernameExistsQuery =
        "SELECT id FROM usuarios WHERE usuario = '{$user}'";

      $checkUsernameExists = $connection
        ->query($checkUsernameExistsQuery)
        ->fetch_assoc();

      if ($checkUsernameExists) {
        throw new Exception(
          'Esse nome de usuário já está sendo usado por uma conta.',
          400
        );
      }

      $checkDocumentExistsQuery =
        "SELECT id FROM usuarios WHERE documento = '{$document}'";

      $checkDocumentExists = $connection
        ->query($checkDocumentExistsQuery)
        ->fetch_assoc();

      if ($checkDocumentExists) {
        throw new Exception(
          'Esse documento já está sendo usado por uma conta.',
          400
        );
      }

      if (
        $type !== 'Fornecedor' &&
        $type !== 'Comprador' &&
        $type !== 'Fornecedor/Comprador'
      ) {
        throw new Exception(
          'Tipo de usuário deve ser "Fornecedor", "Comprador" ou "Fornecedor/Comprador"',
          400
        );
      }

      $hashedPassword = $this->hashProvider->hash($password);


      $insertUserQuery = "
        INSERT INTO usuarios (nome, email, usuario, senha, documento, tipo, empresa_id)
          VALUES (
            '{$name}',
            '{$email}',
            '{$user}',
            '{$hashedPassword}',
            '{$document}',
            '{$type}',
            '{$companyId}'
          )
        ";

      $result = $connection->query($insertUserQuery);

      if (!$result) {
        throw new Exception(
          "Houve um erro ao tentar cadastrar o usuário! {$connection->error}",
          500
        );
      }

      $connection->close();

      return $result;
    }
  }
?>
