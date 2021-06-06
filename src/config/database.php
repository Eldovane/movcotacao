<?php
  return [
    'development' => [
      'host' => $_ENV['DEVELOPMENT_DATABASE_HOST'],
      'name' => $_ENV['DEVELOPMENT_DATABASE_NAME'],
      'user' => $_ENV['DEVELOPMENT_DATABASE_USER'],
      'pass' => $_ENV['DEVELOPMENT_DATABASE_PASSWORD'],
      'port' => $_ENV['DEVELOPMENT_DATABASE_PORT'],
    ],
    'production' => [
      'host' => $_ENV['PRODUCTION_DATABASE_HOST'],
      'name' => $_ENV['PRODUCTION_DATABASE_NAME'],
      'user' => $_ENV['PRODUCTION_DATABASE_USER'],
      'pass' => $_ENV['PRODUCTION_DATABASE_PASSWORD'],
      'port' => $_ENV['PRODUCTION_DATABASE_PORT'],
    ],
    'testing' => [
      'host' => $_ENV['TESTING_DATABASE_HOST'],
      'name' => $_ENV['TESTING_DATABASE_NAME'],
      'user' => $_ENV['TESTING_DATABASE_USER'],
      'pass' => $_ENV['TESTING_DATABASE_PASSWORD'],
      'port' => $_ENV['TESTING_DATABASE_PORT'],
    ],
  ];
?>
