<?php
namespace App\Providers;

use App\Core\Application;
use App\Core\Database\DatabaseManager;

class DatabaseServiceProvider
{
    /**
     * The application instance
     *
     * @var \App\Core\Application
     */
    protected $app;

    /**
     * Create a new service provider instance
     *
     * @param \App\Core\Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Register the service provider
     *
     * @return void
     */
    public function register()
    {
        $this->app::container()->singleton('db', function () {
            return new DatabaseManager($this->app);
        });
    }
}