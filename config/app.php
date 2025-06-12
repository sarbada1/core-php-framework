<?php
return [
    'name' => getenv('APP_NAME') ?: 'My App',
    'env' => getenv('APP_ENV') ?: 'production',
    'debug' => (bool) (getenv('APP_DEBUG') ?: false),
    'url' => getenv('APP_URL') ?: 'http://localhost',
    
    'providers' => [
        \App\Providers\AppServiceProvider::class,
        \App\Providers\RouteServiceProvider::class,
    ],
];
