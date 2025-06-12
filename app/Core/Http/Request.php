<?php
namespace App\Core\Http;

class Request
{
    /**
     * The request URI
     * 
     * @var string
     */
    protected $uri;
    
    /**
     * The request method
     * 
     * @var string
     */
    protected $method;
    
    /**
     * The request parameters
     * 
     * @var array
     */
    protected $params = [];
    
    /**
     * Create a new request instance
     * 
     * @param string $uri
     * @param string $method
     * @param array $params
     */
    public function __construct($uri = null, $method = null, $params = [])
    {
        $this->uri = $uri ?: $_SERVER['REQUEST_URI'];
        $this->method = $method ?: $_SERVER['REQUEST_METHOD'];
        $this->params = $params ?: array_merge($_GET, $_POST);
    }
    
    /**
     * Capture the current HTTP request
     * 
     * @return self
     */
    public static function capture()
    {
        return new static();
    }
    
    /**
     * Get the request URI
     * 
     * @return string
     */
    public function uri()
    {
        return $this->uri;
    }
    
    /**
     * Get the request method
     * 
     * @return string
     */
    public function method()
    {
        return $this->method;
    }
    
    /**
     * Get a parameter from the request
     * 
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function get($key, $default = null)
    {
        return $this->params[$key] ?? $default;
    }
    
    /**
     * Check if a parameter exists in the request
     * 
     * @param string $key
     * @return bool
     */
    public function has($key)
    {
        return isset($this->params[$key]);
    }
    
    /**
     * Get all parameters from the request
     * 
     * @return array
     */
    public function all()
    {
        return $this->params;
    }
}
