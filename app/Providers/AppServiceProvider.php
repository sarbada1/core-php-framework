<?php
namespace App\Providers;

use App\Core\Application;

class AppServiceProvider
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
        // Register application services
    }
}
