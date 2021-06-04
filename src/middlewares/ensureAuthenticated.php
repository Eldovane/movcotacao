<?php
  use Psr\Http\Message\ServerRequestInterface as Request;
  use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
  use Firebase\JWT\JWT;

  return function(Request $request, RequestHandler $handler) {
    $authorization = $request->getHeader('authorization')[0];

    if (
      !strpos($authorization, 'Bearer') &&
      strpos($authorization, 'Bearer') !== 0
    ) {
      throw new Exception('Token malformatted');
    }

    $token = str_replace('Bearer ', '', $authorization);

    try {
      $decoded = JWT::decode($token, $_ENV['JWT_KEY'], ['HS256']);
    } catch(Exception $e) {
      throw new Exception('Invalid token.', 401);
    }

    $requestWithAtribute = $request->withAttribute('authenticated_user', $decoded);
    $response = $handler->handle($requestWithAtribute);

    return $response;
  }
?>
