<?php
/**
 * This file bootstraps the application
 */

// Define the base path if not already defined
if (!defined('BASE_PATH')) {
    define('BASE_PATH', dirname(__DIR__));
}

// Require the composer autoloader
if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
    require_once __DIR__ . '/../vendor/autoload.php';
} else {
    die('Autoloader not found. Did you run composer install?');
}

// Load environment variables if the class exists
if (class_exists('\App\Core\Environment\DotEnv')) {
    (new \App\Core\Environment\DotEnv(__DIR__ . '/../.env'))->load();
}

// Enable error reporting in debug mode
if (getenv('APP_DEBUG') == 'true') {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}

// Create the application
$app = new \App\Core\Application(BASE_PATH);

// Register service providers
try {
    $app->registerServiceProviders();
} catch (\Exception $e) {
    die('Error registering service providers: ' . $e->getMessage());
}

// Return the application instance
return $app;