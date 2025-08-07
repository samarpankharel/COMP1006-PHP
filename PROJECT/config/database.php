<?php

class database
{
    private $host = "172.31.22.43";
    private $username = "Samarpan200597568";
    private $password = "rBy2TvFwdj";
    private $database = "Samarpan200597568";  // property name is $database
    public $conn;

    // Creating connection function
    public function connect()
    {
        $this->conn = null;

        try {
            // Use $this->database instead of $this->db_name
            $this->conn = new PDO(
                "mysql:host=$this->host;dbname=$this->database",
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection Error: " . $e->getMessage();
        }

        return $this->conn;
    }
}
