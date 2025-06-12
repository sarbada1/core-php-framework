# Core PHP Framework

A Laravel-like PHP framework built from scratch using core PHP.

## Features

- MVC architecture
- Routing system
- Dependency injection container
- View rendering
- Database abstraction layer
- Environment configuration

## Installation

1. Clone the repository
2. Run `composer install` to install dependencies
3. Configure your web server to point to the `public` directory
4. Copy `.env.example` to `.env` and configure your environment variables
5. Start building your application!

## Running the Application

### Using PHP's Built-in Server

The quickest way to run your application locally is using PHP's built-in web server:

```bash
# Navigate to the public directory
cd public

# Start the built-in PHP server
php -S localhost:8000

## Directory Structure

- `app/` - Application code
- `bootstrap/` - Application bootstrap files
- `config/` - Configuration files
- `database/` - Database migrations and seeds
- `public/` - Public files and entry point
- `resources/` - Views and assets
- `routes/` - Route definitions
- `storage/` - Application storage
- `tests/` - Test files
- `vendor/` - Composer dependencies

## Usage

```php
// Define a route in routes/web.php
$router->get('/hello/{name}', function ($request) {
    $name = $request->get('name');
    return "Hello, {$name}!";
});


Now you have a Laravel-like folder structure and basic framework built with core PHP. This implementation includes:

1. An MVC architecture
2. A routing system similar to Laravel
3. A dependency injection container
4. View rendering
5. Configuration management
6. Database abstraction
7. Service providers
8. Environment variable loading

To use this framework:

1. Install Composer dependencies:
    ``bash
composer install


2. Configure your web server (Apache or Nginx) to point to the `public` directory as the document root.

3. Start building your application by adding models, controllers, and views following the Laravel-like pattern.

This is a basic implementation that provides the foundation for a Laravel-like framework. You can extend it by adding more features as needed, such as:

1. Middleware support
2. More robust validation
3. Authentication system
4. Database migrations
5. Cache systems
6. Session management

