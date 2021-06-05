<?php
  return [
    'development' => [
      'host' => $_ENV['DEVELOPEMENT_DATABASE_HOST'],
      'name' => $_ENV['DEVELOPEMENT_DATABASE_NAME'],
      'user' => $_ENV['DEVELOPEMENT_DATABASE_USER'],
      'pass' => $_ENV['DEVELOPEMENT_DATABASE_PASSWORD'],
      'port' => $_ENV['DEVELOPEMENT_DATABASE_PORT'],
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
