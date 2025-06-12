<?php
namespace App\Core;

class Container
{
    /**
     * The container's bindings
     *
     * @var array
     */
    protected $bindings = [];

    /**
     * The container's instances
     *
     * @var array
     */
    protected $instances = [];

    /**
     * The container's singleton identifiers
     *
     * @var array
     */
    protected $singletons = [];

    /**
     * Bind a type into the container
     *
     * @param string $abstract
     * @param mixed $concrete
     * @return void
     */
    public function bind($abstract, $concrete)
    {
        $this->bindings[$abstract] = $concrete;
    }

    /**
     * Register a shared binding in the container
     *
     * @param string $abstract
     * @param mixed $concrete
     * @return void
     */
    public function singleton($abstract, $concrete)
    {
        $this->bind($abstract, $concrete);
        $this->singletons[$abstract] = true;
    }

    /**
     * Resolve an instance from the container
     *
     * @param string $abstract
     * @return mixed
     */
    public function make($abstract)
    {
        // If we already have an instance for this singleton, return it
        if (array_key_exists($abstract, $this->instances)) {
            return $this->instances[$abstract];
        }

        // If we don't have a binding, try to instantiate it
        if (!array_key_exists($abstract, $this->bindings)) {
            // If it's a fully qualified class name, try to instantiate it
            if (class_exists($abstract)) {
                return new $abstract();
            }
            
            // Try with App namespace as a fallback for common components
            $className = 'App\\Core\\' . ucfirst($abstract);
            if (class_exists($className)) {
                return new $className();
            }
            
            throw new \Exception("Class {$abstract} not found");
        }

        // Get the concrete
        $concrete = $this->bindings[$abstract];

        // If the concrete is a closure, execute it
        if ($concrete instanceof \Closure) {
            $object = $concrete($this);
        } else {
            $object = is_string($concrete) ? new $concrete() : $concrete;
        }

        // If it's a singleton, store the instance
        if (isset($this->singletons[$abstract])) {
            $this->instances[$abstract] = $object;
        }

        return $object;
    }

    /**
     * Check if a binding exists
     *
     * @param string $abstract
     * @return bool
     */
    public function has($abstract)
    {
        return array_key_exists($abstract, $this->bindings) || 
               array_key_exists($abstract, $this->instances);
    }
}