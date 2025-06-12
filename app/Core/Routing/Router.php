<?php
namespace App\Core\Routing;

use App\Core\Http\Request;
use App\Core\Http\Response;

class Router
{
    /**
     * The registered routes
     * 
     * @var array
     */
    protected $routes = [];
    
    /**
     * Register a route
     * 
     * @param string $method
     * @param string $uri
     * @param mixed $action
     * @return void
     */
    public function addRoute($method, $uri, $action)
    {
        $this->routes[$method][$uri] = $action;
    }
    
    /**
     * Register a GET route
     * 
     * @param string $uri
     * @param mixed $action
     * @return void
     */
    public function get($uri, $action)
    {
        $this->addRoute('GET', $uri, $action);
    }
    
    /**
     * Register a POST route
     * 
     * @param string $uri
     * @param mixed $action
     * @return void
     */
    public function post($uri, $action)
    {
        $this->addRoute('POST', $uri, $action);
    }
    
    /**
     * Register a PUT route
     * 
     * @param string $uri
     * @param mixed $action
     * @return void
     */
    public function put($uri, $action)
    {
        $this->addRoute('PUT', $uri, $action);
    }
    
    /**
     * Register a DELETE route
     * 
     * @param string $uri
     * @param mixed $action
     * @return void
     */
    public function delete($uri, $action)
    {
        $this->addRoute('DELETE', $uri, $action);
    }
    
    /**
     * Dispatch the request to the appropriate route
     * 
     * @param \App\Core\Http\Request $request
     * @return \App\Core\Http\Response
     */
    public function dispatch(Request $request)
    {
        $method = $request->method();
        $uri = parse_url($request->uri(), PHP_URL_PATH);
        
        // Remove trailing slashes
        $uri = rtrim($uri, '/');
        
        // Always have at least '/' as the URI
        if (empty($uri)) {
            $uri = '/';
        }
        
        if (isset($this->routes[$method][$uri])) {
            $action = $this->routes[$method][$uri];
            
            if (is_callable($action)) {
                return $this->callAction($action, $request);
            }
            
            if (is_string($action)) {
                return $this->callControllerAction($action, $request);
            }
        }
        
        return new Response('404 Not Found', 404);
    }
    
    /**
     * Call an action callable
     * 
     * @param callable $action
     * @param \App\Core\Http\Request $request
     * @return \App\Core\Http\Response
     */
    protected function callAction($action, $request)
    {
        $result = call_user_func($action, $request);
        
        if ($result instanceof Response) {
            return $result;
        }
        
        return new Response($result);
    }
    
    /**
     * Call a controller action
     * 
     * @param string $action
     * @param \App\Core\Http\Request $request
     * @return \App\Core\Http\Response
     */
    protected function callControllerAction($action, $request)
    {
        list($controller, $method) = explode('@', $action);
        
        $controller = "App\\Controllers\\{$controller}";
        $controller = new $controller();
        
        $result = $controller->$method($request);
        
        if ($result instanceof Response) {
            return $result;
        }
        
        return new Response($result);
    }
    
    /**
     * Load routes from a file
     * 
     * @param string $path
     * @return void
     */
    public function loadRoutes($path)
    {
        if (file_exists($path)) {
            require $path;
        }
    }
}
