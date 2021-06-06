<?php
  namespace App\Controllers;
  use DI\Container;
  use Psr\Http\Message\ServerRequestInterface as Request;
  use Psr\Http\Message\ResponseInterface as Response;

  class AuthController {
    private $container;

    public function __construct(Container $container) {
      $this->container = $container;
    }

    public function delete(Request $request, Response $response): Response {
      setcookie('@movcotacao:token', '', time() - 3600, '/');

      $settings = $this->container->get('settings');
      return $response->withHeader('Location', $settings['app_url'] . '/');
    }
  }
?>
