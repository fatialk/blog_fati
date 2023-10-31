<?php
namespace App\Repository;
use mysqli;

class ParentRepository {
    
    protected ?mysqli $conn = null;

    private string $test;

    protected function connect(string $bddName)
    {
        $servername = "127.0.0.1";
        $username = "root";
        $password = "";
        // Create connection
        $this->conn = new mysqli($servername, $username, $password);
        // Check connection
        if ($this->conn->connect_error) {
            die(htmlentities("Connection failed: " . $this->conn->connect_error));
        }
        $this->conn->select_db($bddName); 
        
    }

    protected function close()
    { 
        $this->conn->close();
    }

    
}
?>