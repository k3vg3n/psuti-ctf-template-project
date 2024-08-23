<?php

// Add one or more connection if you need

return [
    'mysql' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', 'localhost'),
        'port' => env('DB_PORT', '3306'),
        'username' => env('DB_USERNAME', 'root'),
        'password' => env('DB_PASSWORD', ''),
        'database' => env('DB_DATABASE', 'test'),
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
    ]
];