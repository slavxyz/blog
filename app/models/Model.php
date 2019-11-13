<?php
namespace App\Models;
use PDO;

abstract class Model {
    
    protected $conn;
    protected $app;
    
    public function __construct(){
        $this->app = \Slim\Slim::getInstance();
        $this->conn = $this->app->database;
    }
}
