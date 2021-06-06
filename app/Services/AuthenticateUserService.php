<?php
  namespace App\Services;
  use App\Database\Connection;
  use App\Providers\HashProvider;
  use Firebase\JWT\JWT;
  use Exception;

class AuthenticateUserService {
  private $hashProvider;

  function __construct(HashProvider $hashProvider)
  {
    $this->hashProvider = $hashProvider;
  }

  public function execute(string $user, string $password): string {
    $connection = Connection::getConnection();

    $searchUserQuery = "SELECT id, senha FROM usuarios WHERE ";

    if (filter_var($user, FILTER_VALIDATE_EMAIL)) {
      $searchUserQuery .= "email = '{$user}'";
    } else if (
      !is_nan(intval($user)) &&
      (strlen($user) === 11 || strlen($user) === 14)
    ) {
      $searchUserQuery .= "documento = '{$user}'";
    } else {
      $searchUserQuery .= "usuario = '{$user}'";
    }

    $result = $connection->query($searchUserQuery);

    $findUser = $result->fetch_assoc();

    $connection->close();

    if (!$findUser) {
      throw new Exception('Usuário ou senha incorretos.', 400);
    }

    $matched = $this->hashProvider->compare($password, $findUser['senha']);

    if (!$matched) {
      throw new Exception('Usuário ou senha incorretos.', 400);
    }

    $payload = [
      'user' => $findUser['id'],
      'company' => $findUser['empresa_id']
    ];

    $token = JWT::encode($payload, $_ENV['JWT_KEY']);

    return $token;
  }
  }
?>
