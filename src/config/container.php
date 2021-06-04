<?php

  use DI\Container;
  use App\Providers\TwigTemplateEngineProvider;
  use App\Providers\HashProvider;
  use App\Controllers\AuthenticateUserController;
  use App\Controllers\UsersController;

  return function (Container $container) {
    // Carrengando os providers
    TwigTemplateEngineProvider::loadTemplate($container);

    $container->set('HashProvider', function() {
      return new HashProvider();
    });

    // Carregandos os controllers
    $container->set('AuthenticateUserController', function(Container $container) {
      return new AuthenticateUserController($container);
    });

    $container->set('UserController', function(Container $container) {
      return new UsersController($container);
    });
  }
?>
