<?php

  use DI\Container;
  use Slim\Factory\AppFactory;
  use Dotenv\Dotenv;

  // Importação do arquivo principal do composer.
  // Esse arquivo carrega todas as dependências usadas no projeto;
  // Sem ele não é possível utilizar nenhuma dependência do projeto;
  require_once __DIR__ . '/../vendor/autoload.php';

  // Carregando as variáveis de ambiente na aplicação
  $dotenv = Dotenv::createImmutable(__DIR__. '/..');
  $dotenv->load();

  // Instânciando o container PHP Dependency Injection;
  // Esse container é usado para fazer a injeção de recursos no servidor;
  $container = new Container();

  // Configurando o container no app (servidor)
  AppFactory::setContainer($container);

  // Criando o app (servidor).
  $app = AppFactory::create();

  // Carregando as middlewares do Slim
  $app->addBodyParsingMiddleware();
  $app->addRoutingMiddleware();

  // Importando middleware para tratar erros na aplicação
  $handleException = require __DIR__ . '/../src/middlewares/handleException.php';

  // Adicionando middleware para erros na aplicação
  $errorMiddleware = $app->addErrorMiddleware(true, true, true);
  $errorMiddleware->setDefaultErrorHandler($handleException);

  // Carrengando as dependências do projeto
  $containerConfig = require __DIR__ . '/../src/config/container.php';
  $containerConfig($app, $container);

  // Carregandos routes (Rotas da aplicação)
  $webRoutes = require __DIR__ . '/../src/routes/web.php';
  $apiRoutes = require __DIR__ . '/../src/routes/api.php';

  $webRoutes($app);
  $apiRoutes($app);

  // Iniciando a aplicação (Colocando ela para rodar);
  $app->run();
?>
