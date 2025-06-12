<?php
namespace App\Providers;

use App\Core\Application;
use App\Core\Routing\Router;

class RouteServiceProvider
{
    /**
     * The application instance
     * 
     * @var \App\Core\Application
     */
    protected $app;
    
    /**
     * Create a new provider instance
     * 
     * @param \App\Core\Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }
    
    /**
     * Register services
     * 
     * @return void
     */
    public function register()
    {
        // Create and register the router as a singleton
        $this->app::container()->singleton('router', function () {
            $router = new Router();
            return $router;
        });
        
        // Get the router instance
        $router = $this->app::container()->make('router');
        
        // Load the routes
        if (file_exists($this->app->basePath('routes/web.php'))) {
            require $this->app->basePath('routes/web.php');
        }
        
        if (file_exists($this->app->basePath('routes/api.php'))) {
            require $this->app->basePath('routes/api.php');
        }
    }
}