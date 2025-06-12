<?php
namespace App\Core\Http;

class Response
{
    /**
     * The response content
     * 
     * @var string
     */
    protected $content;
    
    /**
     * The response status code
     * 
     * @var int
     */
    protected $statusCode = 200;
    
    /**
     * The response headers
     * 
     * @var array
     */
    protected $headers = [];
    
    /**
     * Create a new response instance
     * 
     * @param string $content
     * @param int $statusCode
     * @param array $headers
     */
    public function __construct($content = '', $statusCode = 200, $headers = [])
    {
        $this->content = $content;
        $this->statusCode = $statusCode;
        $this->headers = $headers;
    }
    
    /**
     * Send the response
     * 
     * @return void
     */
    public function send()
    {
        http_response_code($this->statusCode);
        
        foreach ($this->headers as $name => $value) {
            header("{$name}: {$value}");
        }
        
        echo $this->content;
    }
    
    /**
     * Create a new JSON response
     * 
     * @param mixed $data
     * @param int $statusCode
     * @param array $headers
     * @return self
     */
    public static function json($data, $statusCode = 200, $headers = [])
    {
        $headers['Content-Type'] = 'application/json';
        
        return new static(json_encode($data), $statusCode, $headers);
    }
    
    /**
     * Create a new view response
     * 
     * @param string $view
     * @param array $data
     * @param int $statusCode
     * @param array $headers
     * @param string|null $layout
     * @return self
     */
    public static function view($view, $data = [], $statusCode = 200, $headers = [], $layout = null)
    {
        $view = new \App\Core\View\View($view, $data, $layout);
        
        return new static($view->render(), $statusCode, $headers);
    }
}