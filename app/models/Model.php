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

    public function createInsertQuery() {

        $sql = "INSERT INTO " . $this->table();

        $columns = array_values($this->fields());

        $fields = '(' . '`' . implode('`, `', $columns) . '`' . ')';
        $values = "(" . substr(str_repeat('?,', count($this->fields())), 0, -1) . ")";

        $sql .= $fields . " VALUES " . $values;

        return $sql;
    }

    public function select(array $columns = ['*']) {
        $this->query = "SELECT " . implode(", ", $columns) . " FROM " . $this->table;
        $this->query->type = "select";

        return $this;
    }

    public function where(string $field, string $operator = '=', string $value)
    {   
        if (!in_array($this->query->type, ['select'])) {
            throw new \Exception("Incorrect using of WHERE clause");
        }
        $this->query->where []= "$field $operator '$value'";
        
        if(!empty($this->query->where)){
            $this->query .= " WHERE ". implode(' AND ', $this->query->where);
        }

        return $this;
    }

    public function orderBy($column, $sort = "ASC") {
        $this->query .= " ORDER BY $column $sort";
        return $this;
    }

    public function limit($limit) {
        $this->query .= " LIMIT $limit ";
        return $this;
    }

    public function offset($offset = 0) {
        $this->query .= " OFFSET $offset ";
        return $this;
    }

    public function run() {
        return $this->conn->query($this->query)->fetchAll(PDO::FETCH_ASSOC);
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
