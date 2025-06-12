<?php
namespace App\Core\Database;

use App\Core\Application;

class DatabaseManager
{
    /**
     * The application instance
     *
     * @var \App\Core\Application
     */
    protected $app;

    /**
     * The active connection instances
     *
     * @var array
     */
    protected $connections = [];

    /**
     * Create a new database manager instance
     *
     * @param \App\Core\Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Get a database connection instance
     *
     * @param string $name
     * @return \App\Core\Database\Connection
     */
    public function connection($name = null)
    {
        $name = $name ?: $this->getDefaultConnection();

        if (!isset($this->connections[$name])) {
            $this->connections[$name] = $this->makeConnection($name);
        }

        return $this->connections[$name];
    }

    /**
     * Make a new database connection
     *
     * @param string $name
     * @return \App\Core\Database\QueryBuilder
     */
    protected function makeConnection($name)
    {
        $config = $this->getConfig($name);

        $pdo = Connection::make([
            'driver'   => $config['driver'] ?? 'mysql',
            'host'     => $config['host'],
            'database' => $config['database'],
            'username' => $config['username'],
            'password' => $config['password'],
            'charset'  => $config['charset'] ?? 'utf8mb4'
        ]);

        return new QueryBuilder($pdo);
    }

    /**
     * Get the configuration for a connection
     *
     * @param string $name
     * @return array
     */
    protected function getConfig($name)
    {
        $name = $name ?: $this->getDefaultConnection();
        $config = $this->app->make('config')->get("database.connections.{$name}");

        if (is_null($config)) {
            throw new \Exception("Database connection [{$name}] not configured.");
        }

        return $config;
    }

    /**
     * Get the default connection name
     *
     * @return string
     */
    protected function getDefaultConnection()
    {
        return $this->app->make('config')->get('database.default', 'mysql');
    }

    /**
     * Set the default connection name
     *
     * @param string $name
     * @return void
     */
    public function setDefaultConnection($name)
    {
        $this->app->make('config')->set('database.default', $name);
    }

    /**
     * Dynamically pass methods to the default connection
     *
     * @param string $method
     * @param array $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return $this->connection()->$method(...$parameters);
    }
}