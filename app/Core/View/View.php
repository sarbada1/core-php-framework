<?php
namespace App\Core\View;

class View
{
    /**
     * The view name
     * 
     * @var string
     */
    protected $view;
    
    /**
     * The view data
     * 
     * @var array
     */
    protected $data;
    
    /**
     * The layout to use
     * 
     * @var string|null
     */
    protected $layout = 'layouts.app';
    
    /**
     * Create a new view instance
     * 
     * @param string $view
     * @param array $data
     * @param string|null $layout
     */
    public function __construct($view, $data = [], $layout = null)
    {
        $this->view = $view;
        $this->data = $data;
        
        if ($layout !== null) {
            $this->layout = $layout;
        }
    }
    
    /**
     * Render the view
     * 
     * @return string
     */
    public function render()
    {
        $viewPath = BASE_PATH . '/resources/views/' . str_replace('.', '/', $this->view) . '.php';
        
        if (!file_exists($viewPath)) {
            throw new \Exception("View {$this->view} not found");
        }
        
        // If no layout is specified, just render the view
        if ($this->layout === null) {
            return $this->renderView($viewPath, $this->data);
        }
        
        // Otherwise, render the view within the layout
        $layoutPath = BASE_PATH . '/resources/views/' . str_replace('.', '/', $this->layout) . '.php';
        
        if (!file_exists($layoutPath)) {
            throw new \Exception("Layout {$this->layout} not found");
        }
        
        $content_view = $this->view;
        $data = array_merge($this->data, ['content_view' => $content_view]);
        
        return $this->renderView($layoutPath, $data);
    }
    
    /**
     * Render a view file
     * 
     * @param string $path
     * @param array $data
     * @return string
     */
    protected function renderView($path, $data)
    {
        extract($data);
        
        ob_start();
        include $path;
        return ob_get_clean();
    }
    
    /**
     * Set the layout for this view
     * 
     * @param string|null $layout
     * @return $this
     */
    public function withLayout($layout)
    {
        $this->layout = $layout;
        return $this;
    }
    
    /**
     * Render the view without a layout
     * 
     * @return $this
     */
    public function withoutLayout()
    {
        $this->layout = null;
        return $this;
    }
}