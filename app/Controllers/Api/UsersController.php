<?php
  namespace App\Controllers\Api;
  use DI\Container;
  use Psr\Http\Message\ServerRequestInterface as Request;
  use Psr\Http\Message\ResponseInterface as Response;
  use App\Services\CreateUserService;

  class UsersController {
    private $container;

    public function __construct(Container $container) {
      $this->container = $container;
    }

    public function create(Request $request, Response $response): Response {
      $body = $request->getParsedBody();

      $createUser = new CreateUserService(
        $this->container->get('HashProvider')
      );

      $createUser->execute(
        $body['name'],
        $body['email'],
        $body['password'],
        $body['user'],
        $body['document'],
        $body['type'],
        $body['company_id']
      );

      return $response->withStatus(201);
    }
  }
?>
