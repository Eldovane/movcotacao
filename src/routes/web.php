<?php

use Slim\App;
use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

/**
 * Rotas da aplicação
 * São rotas que tem views, páginas da aplicação.
 * Não são webservices (API)
 */
return function (App $app) {
  $app->get('/', function (Request $resquest, Response $response) {
    return $this->get('view')->render($response, 'index.html', ['name' => 'John Doe']);
  });

  $app->get('/home', function(Request $request, Response $response) {
    return $this
      ->get('view')
      ->render(
        $response,
        'lista.html',
        [
          'name' => 'Eldovane',
          'email' => 'eldovane@email.com'
        ]
      );
  });

  $app->get('/cotacao', function (Request $request, Response $response) {
    return $this->get('view')->render($response, 'cotacao.html');
  });
}

?>
