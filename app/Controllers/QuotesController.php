<?php
  namespace App\Controllers;
  use DI\Container;
  use Psr\Http\Message\ServerRequestInterface as Request;
  use Psr\Http\Message\ResponseInterface as Response;
  use Firebase\JWT\JWT;
  use App\Services\ListQuotesOpeningService;
  use App\Services\GetOpenQuoteDataService;
  use App\Services\SaveQuotationService;

  class QuotesController {
    private $container;

    public function __construct(Container $container) {
      $this->container = $container;
    }

    public function index(Request $request, Response $response, $parameters): Response
    {
      if(!isset($_COOKIE['@movcotacao:token'])) {
        $settings = $this->container->get('settings');
        return $response->withHeader('Location', $settings['app_url'] . '/');
      }

      $userAuthenticatedToken = $_COOKIE['@movcotacao:token'];

      $userAuthenticated = JWT::decode(
        $userAuthenticatedToken,
        $_ENV['JWT_KEY'],
        ['HS256']
      );

      $listQuotesOpening = new ListQuotesOpeningService();

      $result = $listQuotesOpening->execute(
        $userAuthenticated->company
      );

      return $this
        ->container
          ->get('view')
          ->render($response, 'lista.html', [ 'listQuotesOpening' => $result ]);
    }

    public function show(Request $request, Response $response, $parameters): Response
    {
      if(!isset($_COOKIE['@movcotacao:token'])) {
        $settings = $this->container->get('settings');
        return $response->withHeader('Location', $settings['app_url'] . '/');
      }

      $userAuthenticatedToken = $_COOKIE['@movcotacao:token'];

      $userAuthenticated = JWT::decode(
        $userAuthenticatedToken,
        $_ENV['JWT_KEY'],
        ['HS256']
      );

      $getOpenQuoteData = new GetOpenQuoteDataService();

      $result = $getOpenQuoteData->execute(
        $userAuthenticated->company,
        intval($parameters['quoteNumber'])
      );

      return $this
        ->container
          ->get('view')
          ->render($response, 'cotacao.html', $result);
    }

    public function update(Request $request, Response $response) {
      if(!isset($_COOKIE['@movcotacao:token'])) {
        $settings = $this->container->get('settings');
        return $response->withHeader('Location', $settings['app_url'] . '/');
      }

      $userAuthenticatedToken = $_COOKIE['@movcotacao:token'];

      $userAuthenticated = JWT::decode(
        $userAuthenticatedToken,
        $_ENV['JWT_KEY'],
        ['HS256']
      );

      $body = $request->getParsedBody();

      $saveQuotes = new SaveQuotationService();

      $saveQuotes->execute(
        $userAuthenticated->company,
        $body['quotationInfo'],
        $body['quotationItems'],
        isset($body['is_closing'])
      );

      $settings = $this->container->get('settings');

      return $response->withHeader('Location', $settings['app_url'] . '/lista');
    }
  }
?>
