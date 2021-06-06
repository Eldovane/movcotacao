<?php
  use Slim\App;
  use Slim\Routing\RouteCollectorProxy as RouteGroup;

  /**
   * Rotas para API
   * São rotas para webservices (API)
   * Não são para views, páginas da aplicação.
   */
  return function (App $app) {
    $app->group('/api', function (RouteGroup $group) {
      // Middlewares da API
      $ensureHaveAccess = require __DIR__ . '/../middlewares/ensureHaveAccess.php';

      $group->group('/users', function (RouteGroup $group) use($ensureHaveAccess) {

        $group->post('', 'Api\UserController:create')->add($ensureHaveAccess);

        $group->post('/authenticate', 'Api\AuthenticateUserController:create');
      });
    });
  }

?>
