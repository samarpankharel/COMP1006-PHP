<?php
require_once "database.php";
//This class is an extension of database class where we excute database queries
class crud extends database{
    public function __construct(){
        parent::__construct();
    }
    public function getData($query){
        $result = $this->conn->query($query);
        if($result == false){
            return false;
        }
        $rows = array();
        while($row = $result->fetch_assoc()){
            $rows[] = $row;
        }
        return $rows;
    }
    public function execute($query)
    {
        $result = $this->conn->query($query);
        if ($result == false) {
            echo "<p> Error: Cannot execute query</p>";
            return false;
        } else {
            return true;
        }
    }
        public function escapeString($value){
            return $this->conn->real_escape_string($value);
        }
    }
    ?>
