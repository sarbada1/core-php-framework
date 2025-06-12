<?php
namespace App\Core\Database;

class Connection
{
    /**
     * The active database connections
     *
     * @var array
     */
    protected static $connections = [];

    /**
     * Create a new database connection
     *
     * @param array $config
     * @return \PDO
     */
    public static function make(array $config)
    {
        $key = md5(serialize($config));

        if (isset(static::$connections[$key])) {
            return static::$connections[$key];
        }

        return static::$connections[$key] = static::createConnection($config);
    }

    /**
     * Create a new PDO connection
     *
     * @param array $config
     * @return \PDO
     */
    protected static function createConnection(array $config)
    {
        $dsn = $config['driver'] . ':host=' . $config['host'] . ';dbname=' . $config['database'];
        $options = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES => false,
        ];

        try {
            $pdo = new \PDO(
                $dsn,
                $config['username'],
                $config['password'],
                $options
            );

            if (isset($config['charset'])) {
                $pdo->exec("SET NAMES '{$config['charset']}'");
            }

            return $pdo;
        } catch (\PDOException $e) {
            throw new \PDOException(
                "Could not connect to database. {$e->getMessage()}", 
                (int) $e->getCode()
            );
        }
    }
}