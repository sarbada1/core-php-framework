<?php
/**
 * Main entry point for the application
 */

// Define the application start time
define('APP_START', microtime(true));

// Define the base path
define('BASE_PATH', dirname(__DIR__));

try {
    // Load the autoloader and bootstrap the application
    $app = require_once BASE_PATH . '/bootstrap/app.php';

    // Get the request
    $request = \App\Core\Http\Request::capture();

    // Run the application and get the response
    $response = $app->handle($request);

    // Send the response
    $response->send();

    // Terminate the application
    $app->terminate($request, $response);
} catch (\Exception $e) {
    // Handle any exceptions
    http_response_code(500);
    echo '<h1>Internal Server Error</h1>';
    
    // Show detailed error information in debug mode
    if (getenv('APP_DEBUG') == 'true') {
        echo '<h2>Error: ' . htmlspecialchars($e->getMessage()) . '</h2>';
        echo '<pre>' . htmlspecialchars($e->getTraceAsString()) . '</pre>';
    }
}