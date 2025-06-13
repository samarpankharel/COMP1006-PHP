<?php
class database {
    private $host = "172.31.22.43";
    private $username = "Samarpan200597568";
    private $password = "rBy2TvFwdj";
    private $database = "Samarpan200597568"; //database name
    public $conn;



    //Creating function
    public function __construct()
    {
        if (!isset($this->conn)) {
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);
            if ($this->conn->connect_error) {
                echo('Connection failed: ' . $this->conn->connect_error);
                $this->conn = null;
            }
            else{
                echo"Connected successfully";
            }
        }
        return $this->conn;
    }
}
?>