<?php
return [
    'default' => getenv('DB_CONNECTION') ?: 'mysql',
    
    'connections' => [
        'mysql' => [
            'driver' => 'mysql',
            'host' => getenv('DB_HOST') ?: 'localhost',
            'database' => getenv('DB_DATABASE') ?: 'homestead',
            'username' => getenv('DB_USERNAME') ?: 'homestead',
            'password' => getenv('DB_PASSWORD') ?: 'secret',
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
        ],
        
        'sqlite' => [
            'driver' => 'sqlite',
            'database' => getenv('DB_DATABASE') ?: BASE_PATH . '/database/database.sqlite',
            'prefix' => '',
        ],
    ],
];
