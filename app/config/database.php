<?php
class Database {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $dbName = "oop_todo_tasks";
    private $con;

    public function __construct()
    {
        $this->con = new mysqli($this->host, $this->username, $this->password, $this->dbName);
        if ($this->con->connect_error) {
            die("Connection Failed: $this->con->connect_error");
        }
    }

    public function runDML($query)
    {
        $result = $this->con->query($query);
        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function runDQL($query)
    {
        $result = $this->con->query($query);
        if ($result->num_rows > 0) {
            return $result;
        } else {
            return [];
        }
    }
}
// $test = new Database;