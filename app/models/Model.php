<?php

namespace App\Models;
use PDO;

abstract class Model {

    protected $conn;
    protected $app;
    protected $table;
    protected $query;

    public function __construct() 
    {
        $this->app = \Slim\Slim::getInstance();
        $this->conn = $this->app->database;
    }
    
    protected function reset(): void
    {
        $this->query = new \stdClass;
    }

    public function createInsertQuery(): Model 
    {

        $sql = "INSERT INTO " . $this->table();

        $columns = array_values($this->fields());

        $fields = '(' . '`' . implode('`, `', $columns) . '`' . ')';
        $values = "(" . substr(str_repeat('?,', count($this->fields())), 0, -1) . ")";

        $sql .= $fields . " VALUES " . $values;

        return $sql;
    }

    public function select(array $columns = ['*']): Model
    {
        $this->reset(); 
        $this->query->sql = "SELECT " . implode(", ", $columns) . " FROM " . $this->table;
        $this->query->type = "select";

        return $this;
    }

    public function where(string $field, string $operator = '=', string $value): Model
    {   
        if (!in_array($this->query->type, ['select'])) {
            throw new \Exception("Incorrect using of WHERE clause");
        }
        $this->query->where []= "$field $operator '$value'";
        
        if(!empty($this->query)){
            $this->query->sql .= " WHERE ". implode(' AND ', $this->query->where);
        }

        return $this;
    }

    public function orderBy(string $column, string $sort = "ASC"): Model
    {
        $this->query->sql .= " ORDER BY $column $sort";
        return $this;
    }

    public function limit(int $limit): Model 
    {
        $this->query->sql .= " LIMIT $limit ";
        return $this;
    }

    public function offset(int $offset = 0): Model 
    {
        $this->query->sql .= " OFFSET $offset ";
        return $this;
    }

    public function fetchOne(): array
    {
        return $this->conn->query($this->query->sql)->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Table name
     */
    abstract function table() : string;

    /**
     * Table columns
     */
    abstract function fields() : string;

    /**
     * Number of columns in table
     */
    abstract function length() : int;
}
