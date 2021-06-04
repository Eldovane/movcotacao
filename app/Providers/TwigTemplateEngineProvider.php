<?php

namespace App\Providers;
use DI\Container;
use Slim\Views\Twig;
use Twig\Loader\FilesystemLoader;

class TwigTemplateEngineProvider {
  /**
   * Função que implementar o Twig template no servidor
   * Uma vez carregar essa função, é possível utilizar a sintaxe do twig nos códigos HTML.
   */
  public static function loadTemplate(Container $container) {
    // Definindo Twig no atributo view do Container
    $container->set('view', function() use ($container) {

      // Carregando as template para o Twig.
      // O diretório desta pasta que possui os arquivos HTMLs;
      $loader = new FilesystemLoader(__DIR__ . '/../../src/views');

      // Criando a intância do Twig para ser usado no ciclo de vida do servidor
      // Cache é definido como false mas ainda não sei muito bem como funciona.
      return new Twig($loader, [
        'cache' => false,
      ]);
    });
  }
}
