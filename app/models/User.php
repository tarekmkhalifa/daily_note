<?php
require_once __DIR__ . "\../config\database.php";
require_once __DIR__ . "\../interface\Select.php";
require_once __DIR__ . "\../interface\Insert.php";


class User extends Database implements Select, Insert
{
    // Attributes
    private $id;
    private $first_name;
    private $last_name;
    private $email;
    private $password;
    private $created_at;
    private $updated_at;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getFirst_name()
    {
        return $this->first_name;
    }

    public function setFirst_name($first_name)
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLast_name()
    {
        return $this->last_name;
    }

    public function setLast_name($last_name)
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = sha1($password);
    }

    public function getCreated_at()
    {
        return $this->created_at;
    }

    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdated_at()
    {
        return $this->updated_at;
    }

    public function setUpdated_at($updated_at)
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    // Methods
    public function selectData()
    {
        $query = "SELECT * FROM `users` WHERE `users`.`email` = '$this->email' AND `users`.`password` = '$this->password' ";
        return $this->runDQL($query);
    }

    public function checkByEmail()
    {
        $query = "SELECT * FROM `users` WHERE `users`.`email` = '$this->email'";
        return $this->runDQL($query);
    }

    public function insertData()
    {
        $query = "INSERT INTO `users` (first_name, last_name, email, password) VALUES ('$this->first_name' , '$this->last_name', '$this->email', '$this->password')";
        return $this->runDML($query);
    }
}
