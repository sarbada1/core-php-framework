<?php
namespace App\Core\Database;

abstract class Migration
{
    /**
     * The database connection
     *
     * @var \PDO
     */
    protected $connection;

    /**
     * Create a new migration instance
     *
     * @param \PDO $connection
     */
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Run the migrations
     *
     * @return void
     */
    abstract public function up();

    /**
     * Reverse the migrations
     *
     * @return void
     */
    abstract public function down();
    
    /**
     * Execute a query
     * 
     * @param string $sql
     * @return bool
     */
    protected function execute($sql)
    {
        return $this->connection->exec($sql);
    }
}