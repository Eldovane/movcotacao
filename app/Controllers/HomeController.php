<?php
  namespace App\Controllers;
  use DI\Container;
  use Psr\Http\Message\ServerRequestInterface as Request;
  use Psr\Http\Message\ResponseInterface as Response;

  class HomeController {
    private $container;

    public function __construct(Container $container) {
      $this->container = $container;
    }

    public function show(Request $request, Response $response): Response {
      if(isset($_COOKIE['@movcotacao:token'])) {
        $settings = $this->container->get('settings');
        return $response->withHeader('Location', $settings['app_url'] . '/lista');
      }

      return $this->container->get('view')->render($response, 'index.html');
    }
  }
?>
