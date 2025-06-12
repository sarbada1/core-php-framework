<?php
namespace App\Core\Controller;

use App\Core\Http\Response;
use App\Core\Application;

class Controller
{
    /**
     * The layout to use for views
     * 
     * @var string|null
     */
    protected $layout = 'layouts.app';
    
    /**
     * Return a view response
     * 
     * @param string $view
     * @param array $data
     * @param int $status
     * @param array $headers
     * @return \App\Core\Http\Response
     */
    protected function view($view, $data = [], $status = 200, $headers = [])
    {
        return Response::view($view, $data, $status, $headers, $this->layout);
    }
    
    /**
     * Set the layout for views
     * 
     * @param string|null $layout
     * @return $this
     */
    protected function setLayout($layout)
    {
        $this->layout = $layout;
        return $this;
    }
    
    /**
     * Return a JSON response
     * 
     * @param mixed $data
     * @param int $status
     * @param array $headers
     * @return \App\Core\Http\Response
     */
    protected function json($data, $status = 200, $headers = [])
    {
        return Response::json($data, $status, $headers);
    }
    
    /**
     * Get the config repository
     * 
     * @return \App\Core\Config\Repository
     */
    protected function config()
    {
        return Application::make('config');
    }
}