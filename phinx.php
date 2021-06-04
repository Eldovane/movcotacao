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
      'host' => 'localhost',
      'name' => 'production_db',
      'user' => 'root',
      'pass' => '',
      'port' => '3306',
      'charset' => 'utf8',
    ],
    'development' => [
      'adapter' => 'mysql',
      'host' => 'localhost',
      'name' => 'movcotacao',
      'user' => 'root',
      'pass' => 'pedro123',
      'port' => '3306',
      'charset' => 'utf8mb4',
    ],
    'testing' => [
      'adapter' => 'mysql',
      'host' => 'localhost',
      'name' => 'testing_db',
      'user' => 'root',
      'pass' => '',
      'port' => '3306',
      'charset' => 'utf8',
    ]
  ],
  'version_order' => 'creation'
];
