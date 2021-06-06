<?php
  namespace App\Controllers\Api;
  use DI\Container;
  use Psr\Http\Message\ServerRequestInterface as Request;
  use Psr\Http\Message\ResponseInterface as Response;
  use App\Services\AuthenticateUserService;

  class AuthenticateUserController {
    private $container;

    public function __construct(Container $container) {
      $this->container = $container;
    }

    public function create(Request $request, Response $response): Response {
      $body = $request->getParsedBody();

      $authenticateUser = new AuthenticateUserService(
        $this->container->get('HashProvider')
      );

      $token = $authenticateUser->execute($body['user'], $body['password']);

      setcookie('@movcotacao:token', $token, time() + (86400 * 30), '/');

      return $response;
    }
  }
?>
