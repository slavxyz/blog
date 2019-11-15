<?php

namespace App\Models;
use PDO;

abstract class Model {

    protected $conn;
    protected $app;
    protected $table;
    protected $query;

    public function __construct() {
        $this->app = \Slim\Slim::getInstance();
        $this->conn = $this->app->database;
    }
    
    protected function reset(): void
    {
        $this->query = new \stdClass;
    }

    public function createInsertQuery() {

        $sql = "INSERT INTO " . $this->table();

        $columns = array_values($this->fields());

        $fields = '(' . '`' . implode('`, `', $columns) . '`' . ')';
        $values = "(" . substr(str_repeat('?,', count($this->fields())), 0, -1) . ")";

        $sql .= $fields . " VALUES " . $values;

        return $sql;
    }

    public function select(array $columns = ['*'])
    {
        $this->reset(); 
        $this->query->sql = "SELECT " . implode(", ", $columns) . " FROM " . $this->table;
        $this->query->type = "select";

        return $this;
    }

    public function where(string $field, string $operator = '=', string $value)
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

    public function orderBy($column, $sort = "ASC") {
        $this->query->sql .= " ORDER BY $column $sort";
        return $this;
    }

    public function limit($limit) {
        $this->query->sql .= " LIMIT $limit ";
        return $this;
    }

    public function offset($offset = 0) {
        $this->query->sql .= " OFFSET $offset ";
        return $this;
    }

    public function fetchOne() {
        return $this->conn->query($this->query->sql)->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Table name
     */
    abstract function table();

    /**
     * Table columns
     */
    abstract function fields();

    /**
     * Number of columns in table
     */
    abstract function length();
}
