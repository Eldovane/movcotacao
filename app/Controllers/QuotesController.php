<?php
  namespace App\Controllers;
  use DI\Container;
  use Psr\Http\Message\ServerRequestInterface as Request;
  use Psr\Http\Message\ResponseInterface as Response;
  use Firebase\JWT\JWT;
  use App\Services\ListQuotesOpeningService;

  class QuotesController {
    private $container;

    public function __construct(Container $container) {
      $this->container = $container;
    }

    public function index(Request $request, Response $response): Response {
      $listQuotesOpening = new ListQuotesOpeningService();

      $result = $listQuotesOpening->execute(
        1,
        2
      );

      return $this
        ->container
          ->get('view')
          ->render($response, 'cotacao.html', $result);
    }
  }
?>
