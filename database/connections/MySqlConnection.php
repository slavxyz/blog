<?php
namespace Db\Connections;
use Db\Interfaces\IConnections;
use PDO;

class MySqlConnection implements IConnections {

    public $connection;
    
    private $host;
    private $dbName;
    private $user;
    private $password;
    
    public function __construct($connection){
        $this->host = $connection->host;
        $this->dbName = $connection->db_name;
        $this->user = $connection->user;
        $this->password = $connection->password;
    }
    
    public function getConnection()
    {
        try {
            $this->connection = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbName, $this->user, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        return $this->connection;
    }

}
