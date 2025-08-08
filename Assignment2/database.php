<?php
class Database {
    private $host = "172.31.22.43";
    private $username = "Samarpan200597568";
    private $password = "rBy2TvFwdj";
    private $database = "Samarpan200597568";
    public $conn;

    // Constructor connects to DB using PDO
    public function connect() {
        if (!isset($this->conn)) {
            try {
                $this->conn = new PDO("mysql:host={$this->host};dbname={$this->database}", $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                echo "Connected successfully";
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
                $this->conn = null;
            }
        }
        return $this->conn;
    }
}
?>