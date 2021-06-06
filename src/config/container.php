<?php

  use DI\Container;
  use Slim\App;
  use App\Providers\TwigTemplateEngineProvider;
  use App\Providers\HashProvider;
  use App\Controllers\HomeController;
  use App\Controllers\AuthController;
  use App\Controllers\QuotesController;
  use App\Controllers\Api\AuthenticateUserController;
  use App\Controllers\Api\UsersController;

  return function (App $app, Container $container) {
    // Carrengando configurações do projeto
    $settings = require __DIR__ . '/../config/settings.php';

    $container->set('settings', function () use ($settings) {
      return $settings;
    });

    // Carrengando os providers
    TwigTemplateEngineProvider::loadTemplate($container);

    $container->set('HashProvider', function() {
      return new HashProvider();
    });

    // Carregandos os controllers
    // Controllers comuns
    $container->set('HomeController', function(Container $container) {
      return new HomeController($container);
    });

    $container->set('AuthController', function(Container $container) {
      return new AuthController($container);
    });

    $container->set('QuotesController', function(Container $container) {
      return new QuotesController($container);
    });

    // Controllers api
    $container->set('Api\AuthenticateUserController', function(Container $container) {
      return new AuthenticateUserController($container);
    });

    $container->set('Api\UserController', function(Container $container) {
      return new UsersController($container);
    });
  }
?>
