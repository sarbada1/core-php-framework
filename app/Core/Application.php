<?php
namespace App\Core;

class Application
{
    /**
     * The base path of the application
     *
     * @var string
     */
    protected $basePath;

    /**
     * The service container
     *
     * @var Container
     */
    protected static $container;

    /**
     * Create a new application instance
     *
     * @param string $basePath
     */
    public function __construct($basePath = null)
    {
        $this->basePath = $basePath;
        static::$container = new Container();
        $this->registerBaseBindings();
    }

    /**
     * Register the basic bindings into the container
     *
     * @return void
     */
    protected function registerBaseBindings()
    {
        static::$container->bind('app', $this);
        static::$container->bind('config', function () {
            return new \App\Core\Config\Repository();
        });
    }

    /**
     * Register all of the service providers
     *
     * @return void
     */
    public function registerServiceProviders()
    {
        $providers = [];
        
        // Load service providers from config if available
        $config = static::$container->make('config');
        if ($config->get('app.providers')) {
            $providers = $config->get('app.providers');
        } else {
            // Fallback to default providers
            $providers = [
                \App\Providers\AppServiceProvider::class,
                \App\Providers\RouteServiceProvider::class,
            ];
        }
        
        // Register each provider
        foreach ($providers as $provider) {
            try {
                $provider = new $provider($this);
                $provider->register();
            } catch (\Exception $e) {
                throw new \Exception("Error registering service provider {$provider}: " . $e->getMessage());
            }
        }
    }

    /**
     * Get the base path of the Laravel installation
     *
     * @param string $path Optional path to append to the base path
     * @return string
     */
    public function basePath($path = '')
    {
        return $this->basePath . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }

    /**
     * Handle the incoming request
     *
     * @param \App\Core\Http\Request $request
     * @return \App\Core\Http\Response
     */
    public function handle($request)
    {
        static::$container->bind('request', $request);
        
        // Make sure the router is registered and available
        if (!static::$container->has('router')) {
            throw new \Exception("Router not registered in container. Did you register the RouteServiceProvider?");
        }
        
        $router = static::$container->make('router');
        return $router->dispatch($request);
    }

    /**
     * Terminate the application
     *
     * @param \App\Core\Http\Request $request
     * @param \App\Core\Http\Response $response
     * @return void
     */
    public function terminate($request, $response)
    {
        // Perform any clean-up operations
    }

    /**
     * Get the service container
     *
     * @return Container
     */
    public static function container()
    {
        return static::$container;
    }

    /**
     * Resolve an instance from the container
     *
     * @param string $abstract
     * @return mixed
     */
    public static function make($abstract)
    {
        return static::$container->make($abstract);
    }
}