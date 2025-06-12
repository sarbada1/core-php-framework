<?php
/**
 * Web Routes
 */

$router = \App\Core\Application::make('router');

$router->get('/', function () {
    return \App\Core\Http\Response::view('welcome', [
        'title' => 'My Awesome PHP Application',
        'message' => 'Welcome to my custom PHP framework built with core PHP!',
    ]);
});

$router->get('/about', 'HomeController@about');
$router->get('/team', 'HomeController@team');

$router->get('/contact', function () {
    return \App\Core\Http\Response::view('contact', [
        'title' => 'Contact Us',
        'email' => 'info@example.com',
        'phone' => '+1 234 567 890'
    ]);
});
