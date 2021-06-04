<?php
  use Psr\Http\Message\ServerRequestInterface as Request;

  return function (
    Request $request,
    Throwable $exception
    ) use ($app) {
    $response = $app->getResponseFactory()->createResponse();

    if ($exception->getCode() === 404) {
      return $this->get('view')->render($response, '404.html');
    }

    if ($exception && $exception->getCode()) {
      $payload = [
        'message' => $exception->getMessage(),
        'status' => 'error'
      ];

      $response->getBody()->write(json_encode($payload));
      $responseError = $response->withStatus($exception->getCode());

      return $responseError;
    } else {
      $responseBody = [
        'message' => 'Ocorreu um erro inesperado.',
        'status' => 'error',
        'error' => $exception->getMessage(),
      ];

      $response->getBody()->write(json_encode($responseBody));

      return $response->withStatus(500);
    }
  }
?>
