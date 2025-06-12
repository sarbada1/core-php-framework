<?php
namespace App\Core\Database;

use App\Core\Application;

class Model
{
    /**
     * The table name
     * 
     * @var string
     */
    protected $table;
    
    /**
     * The primary key
     * 
     * @var string
     */
    protected $primaryKey = 'id';
    
    /**
     * The model attributes
     * 
     * @var array
     */
    protected $attributes = [];
    
    /**
     * Get the database connection
     * 
     * @return \PDO
     */
    protected static function getConnection()
    {
        $config = Application::make('config');
        $dbConfig = $config->get('database.connections.' . $config->get('database.default'));
        
        $dsn = "mysql:host={$dbConfig['host']};dbname={$dbConfig['database']};charset=utf8";
        
        return new \PDO($dsn, $dbConfig['username'], $dbConfig['password'], [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        ]);
    }
    
    /**
     * Find a model by its primary key
     * 
     * @param mixed $id
     * @return static|null
     */
    public static function find($id)
    {
        $model = new static();
        $table = $model->getTable();
        $primaryKey = $model->getPrimaryKey();
        
        $conn = static::getConnection();
        $stmt = $conn->prepare("SELECT * FROM {$table} WHERE {$primaryKey} = :id");
        $stmt->execute(['id' => $id]);
        
        $data = $stmt->fetch();
        
        if (!$data) {
            return null;
        }
        
        return $model->fill($data);
    }
    
    /**
     * Get all records
     * 
     * @return array
     */
    public static function all()
    {
        $model = new static();
        $table = $model->getTable();
        
        $conn = static::getConnection();
        $stmt = $conn->query("SELECT * FROM {$table}");
        
        $models = [];
        
        foreach ($stmt->fetchAll() as $data) {
            $models[] = (new static())->fill($data);
        }
        
        return $models;
    }
    
    /**
     * Fill the model with attributes
     * 
     * @param array $attributes
     * @return $this
     */
    public function fill($attributes)
    {
        $this->attributes = $attributes;
        
        return $this;
    }
    
    /**
     * Save the model
     * 
     * @return bool
     */
    public function save()
    {
        $table = $this->getTable();
        $primaryKey = $this->getPrimaryKey();
        
        $conn = static::getConnection();
        
        if (isset($this->attributes[$primaryKey])) {
            // Update
            $fields = array_keys($this->attributes);
            $setFields = array_map(function ($field) {
                return "{$field} = :{$field}";
            }, array_filter($fields, function ($field) use ($primaryKey) {
                return $field !== $primaryKey;
            }));
            
            $sql = "UPDATE {$table} SET " . implode(', ', $setFields) . " WHERE {$primaryKey} = :{$primaryKey}";
            $stmt = $conn->prepare($sql);
            
            return $stmt->execute($this->attributes);
        } else {
            // Insert
            $fields = array_keys($this->attributes);
            $placeholders = array_map(function ($field) {
                return ":{$field}";
            }, $fields);
            
            $sql = "INSERT INTO {$table} (" . implode(', ', $fields) . ") VALUES (" . implode(', ', $placeholders) . ")";
            $stmt = $conn->prepare($sql);
            
            $result = $stmt->execute($this->attributes);
            
            if ($result) {
                $this->attributes[$primaryKey] = $conn->lastInsertId();
            }
            
            return $result;
        }
    }
    
    /**
     * Delete the model
     * 
     * @return bool
     */
    public function delete()
    {
        $table = $this->getTable();
        $primaryKey = $this->getPrimaryKey();
        
        if (!isset($this->attributes[$primaryKey])) {
            return false;
        }
        
        $conn = static::getConnection();
        $stmt = $conn->prepare("DELETE FROM {$table} WHERE {$primaryKey} = :{$primaryKey}");
        
        return $stmt->execute([
            $primaryKey => $this->attributes[$primaryKey]
        ]);
    }
    
    /**
     * Get the table name
     * 
     * @return string
     */
    public function getTable()
    {
        if ($this->table) {
            return $this->table;
        }
        
        $class = get_class($this);
        $parts = explode('\\', $class);
        $className = end($parts);
        
        return strtolower($className) . 's';
    }
    
    /**
     * Get the primary key
     * 
     * @return string
     */
    public function getPrimaryKey()
    {
        return $this->primaryKey;
    }
    
    /**
     * Get an attribute
     * 
     * @param string $key
     * @return mixed
     */
    public function __get($key)
    {
        return $this->attributes[$key] ?? null;
    }
    
    /**
     * Set an attribute
     * 
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function __set($key, $value)
    {
        $this->attributes[$key] = $value;
    }
}
