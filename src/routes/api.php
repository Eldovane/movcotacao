<?php
  use Slim\App;
  use Slim\Routing\RouteCollectorProxy as RouteGroup;

  /**
   * Rotas para API
   * São rotas para webservices (API)
   * Não são para views, páginas da aplicação.
   */
  return function (App $app) {
    // Middlewares da API
    // $ensureAuthenticateMiddleware = require __DIR__ . '/../middlewares/ensureAuthenticated.php';
    $ensureHaveAccess = require __DIR__ . '/../middlewares/ensureHaveAccess.php';

    $app->group('/users', function (RouteGroup $group) use($ensureHaveAccess) {

      $group->post('', 'UserController:create')->add($ensureHaveAccess);

      $group->post('/authenticate', 'AuthenticateUserController:create');
    });
  }

?>
