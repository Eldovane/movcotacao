<?php

return
[
  'paths' => [
    'migrations' => '%%PHINX_CONFIG_DIR%%/phinx/migrations',
    'seeds' => '%%PHINX_CONFIG_DIR%%/phinx/seeds'
  ],
  'environments' => [
    'default_migration_table' => 'phinxlog',
    'default_environment' => 'development',
    'production' => [
      'adapter' => 'mysql',
      'host' => $_ENV['PRODUCTION_DATABASE_HOST'],
      'name' => $_ENV['PRODUCTION_DATABASE_NAME'],
      'user' => $_ENV['PRODUCTION_DATABASE_USER'],
      'pass' => $_ENV['PRODUCTION_DATABASE_PASSWORD'],
      'port' => $_ENV['PRODUCTION_DATABASE_PORT'],
      'charset' => 'utf8',
    ],
    'development' => [
      'adapter' => 'mysql',
      'host' => $_ENV['DEVELOPMENT_DATABASE_HOST'],
      'name' => $_ENV['DEVELOPMENT_DATABASE_NAME'],
      'user' => $_ENV['DEVELOPMENT_DATABASE_USER'],
      'pass' => $_ENV['DEVELOPMENT_DATABASE_PASSWORD'],
      'port' => $_ENV['DEVELOPMENT_DATABASE_PORT'],
      'charset' => 'utf8mb4',
    ],
    'testing' => [
      'adapter' => 'mysql',
      'host' => $_ENV['TESTING_DATABASE_HOST'],
      'name' => $_ENV['TESTING_DATABASE_NAME'],
      'user' => $_ENV['TESTING_DATABASE_USER'],
      'pass' => $_ENV['TESTING_DATABASE_PASSWORD'],
      'port' => $_ENV['TESTING_DATABASE_PORT'],
      'charset' => 'utf8',
    ]
  ],
  'version_order' => 'creation'
];
