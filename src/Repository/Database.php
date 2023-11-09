<?php
namespace App\Repository;
use mysqli;
class Database {
    protected ?mysqli $conn = null;
    protected function connect()
    {
        $servername = getenv('DB_HOST');
        $dbname = getenv('DB_NAME');
        $username = getenv('DB_USERNAME');
        $password = getenv('DB_PASS');
        // Create connection
        $this->conn = new mysqli($servername, $username, $password);
        // Check connection
        if ($this->conn->connect_error) {
            echo "Connection failed: " . $this->conn->connect_error;
        }else{
            $this->conn->select_db($dbname);
        }
    }
    protected function close()
    {
        $this->conn->close();
    }
}
