<?php
  use Psr\Http\Message\ServerRequestInterface as Request;
  use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

  return function (Request $request, RequestHandler $handler) {
    $accessKey = $request->getHeader('authorization')[0];

    if ($accessKey !== $_ENV['APP_KEY']) {
      throw new Exception('Requisição não autorizada', 401);
    }

    $response = $handler->handle($request);
    return $response;
  }
?>
