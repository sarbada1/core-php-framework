<?php
namespace App\Core\Config;

class Repository
{
    /**
     * All of the configuration items
     * 
     * @var array
     */
    protected $items = [];
    
    /**
     * Create a new configuration repository
     * 
     * @return void
     */
    public function __construct()
    {
        $this->loadConfigFiles();
    }
    
    /**
     * Load the configuration files
     * 
     * @return void
     */
    protected function loadConfigFiles()
    {
        $configPath = BASE_PATH . '/config';
        
        if (!is_dir($configPath)) {
            return;
        }
        
        $files = scandir($configPath);
        
        foreach ($files as $file) {
            if (substr($file, -4) === '.php') {
                $name = substr($file, 0, -4);
                $this->items[$name] = require $configPath . '/' . $file;
            }
        }
    }
    
    /**
     * Get a configuration value
     * 
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function get($key, $default = null)
    {
        $keys = explode('.', $key);
        $value = $this->items;
        
        foreach ($keys as $segment) {
            if (!isset($value[$segment])) {
                return $default;
            }
            
            $value = $value[$segment];
        }
        
        return $value;
    }
    
    /**
     * Set a configuration value
     * 
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function set($key, $value)
    {
        $keys = explode('.', $key);
        $items = &$this->items;
        
        while (count($keys) > 1) {
            $key = array_shift($keys);
            
            if (!isset($items[$key]) || !is_array($items[$key])) {
                $items[$key] = [];
            }
            
            $items = &$items[$key];
        }
        
        $items[array_shift($keys)] = $value;
    }
}
