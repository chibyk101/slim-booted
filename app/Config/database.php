<?php

// return [
//     'dbname' => $_ENV['DB_DATABASE'],
//     'user' => $_ENV['DB_USERNAME'],
//     'password' => $_ENV['DB_PASSWORD'],
//     'host' => $_ENV['DB_HOST'],
//     'driver' => $_ENV['DB_CONNECTION'],
//     'port' => $_ENV['DB_PORT']
// ];

return [
    'driver' => env('DB_CONNECTION', 'mysql'),
    'host' => env('DB_HOST', 'localhost'),
    'database' => env('DB_DATABASE', 'slim'),
    'username' => env('DB_USERNAME', 'root'),
    'password' => env('DB_PASSWORD', ''),
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => '',
];
