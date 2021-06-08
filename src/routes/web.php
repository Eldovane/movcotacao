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
  $app->get('/', 'HomeController:show');

  $app->get('/logout', 'AuthController:delete');

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

  $app->get('/lista', 'QuotesController:index');

  $app->get('/cotacao/{quoteNumber}', 'QuotesController:show');

  $app->post('/save_quotation_items', 'QuotesController:update');
}

?>
