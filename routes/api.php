<?php
/**
 * API Routes
 */

$router = \App\Core\Application::make('router');

$router->get('/api/users', function () {
    return \App\Core\Http\Response::json([
        'users' => [
            ['id' => 1, 'name' => 'John Doe'],
            ['id' => 2, 'name' => 'Jane Doe'],
        ],
    ]);
});
