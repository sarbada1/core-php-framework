<?php
namespace App\Core\Database;

class QueryBuilder
{
    /**
     * The PDO instance
     *
     * @var \PDO
     */
    protected $pdo;

    /**
     * Create a new query builder instance
     *
     * @param \PDO $pdo
     */
    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Select all records from a database table
     *
     * @param string $table
     * @return array
     */
    public function all($table)
    {
        $statement = $this->pdo->prepare("SELECT * FROM {$table}");
        $statement->execute();
        
        return $statement->fetchAll();
    }

    /**
     * Find a record by ID
     *
     * @param string $table
     * @param int $id
     * @return array|bool
     */
    public function find($table, $id)
    {
        $statement = $this->pdo->prepare("SELECT * FROM {$table} WHERE id = :id");
        $statement->execute(['id' => $id]);
        
        return $statement->fetch();
    }

    /**
     * Insert a record into a database table
     *
     * @param string $table
     * @param array $parameters
     * @return bool
     */
    public function insert($table, array $parameters)
    {
        $sql = sprintf(
            'INSERT INTO %s (%s) VALUES (%s)',
            $table,
            implode(', ', array_keys($parameters)),
            ':' . implode(', :', array_keys($parameters))
        );

        try {
            $statement = $this->pdo->prepare($sql);
            return $statement->execute($parameters);
        } catch (\PDOException $e) {
            throw new \Exception("Error inserting into {$table}: " . $e->getMessage());
        }
    }

    /**
     * Update a record in a database table
     *
     * @param string $table
     * @param array $parameters
     * @param string $where
     * @return bool
     */
    public function update($table, array $parameters, $where)
    {
        $sets = [];
        foreach (array_keys($parameters) as $key) {
            $sets[] = "{$key} = :{$key}";
        }

        $sql = sprintf(
            'UPDATE %s SET %s WHERE %s',
            $table,
            implode(', ', $sets),
            $where
        );

        try {
            $statement = $this->pdo->prepare($sql);
            return $statement->execute($parameters);
        } catch (\PDOException $e) {
            throw new \Exception("Error updating {$table}: " . $e->getMessage());
        }
    }

    /**
     * Delete a record from a database table
     *
     * @param string $table
     * @param string $where
     * @param array $parameters
     * @return bool
     */
    public function delete($table, $where, array $parameters = [])
    {
        $sql = sprintf('DELETE FROM %s WHERE %s', $table, $where);

        try {
            $statement = $this->pdo->prepare($sql);
            return $statement->execute($parameters);
        } catch (\PDOException $e) {
            throw new \Exception("Error deleting from {$table}: " . $e->getMessage());
        }
    }

    /**
     * Run a raw SQL query
     *
     * @param string $sql
     * @param array $parameters
     * @return mixed
     */
    public function raw($sql, array $parameters = [])
    {
        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute($parameters);
            return $statement;
        } catch (\PDOException $e) {
            throw new \Exception("Error running raw SQL: " . $e->getMessage());
        }
    }
}