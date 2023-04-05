<?php
require_once __DIR__ . "\../config\database.php";
require_once __DIR__ . "\../interface\Select.php";
require_once __DIR__ . "\../interface\Insert.php";
require_once __DIR__ . "\../interface\Delete.php";
class Task extends Database implements Select, Insert, Delete {

    // Attributes
    private $id;
    private $title;
    private $details;
    private $status;
    private $user_id;
    private $created_at;
    private $updated_at;

    // Setters & Getters
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }


    public function getTitle()
    {
        return $this->title;
    }


    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    public function getDetails()
    {
        return $this->details;
    }

    public function setDetails($details)
    {
        $this->details = $details;

        return $this;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    public function getUser_id()
    {
        return $this->user_id;
    }

    public function setUser_id($user_id)
    {
        $this->user_id = $user_id;

        return $this;
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
        $query = "SELECT * FROM `tasks` WHERE `tasks`.`user_id` = $this->user_id ORDER BY `tasks`.`id` DESC";
        $data = $this->runDQL($query);
        return $data;
    }

    public function getUserName()
    {
        $query = "SELECT `users`.`first_name`, `users`.`last_name` FROM `users` WHERE `users`.`id` = $this->user_id";
        $data = $this->runDQL($query)->fetch_object();
        return ucwords($data->first_name . " " . $data->last_name);
    }

    public function insertData()
    {
        $query = "INSERT INTO `tasks` (title, details, user_id) VALUES ('$this->title' , '$this->details', '$this->user_id')";
        $this->runDML($query);
    }

    public function deleteData()
    {
        $query = "DELETE FROM `tasks` WHERE `tasks`.`id` = $this->id";
        $this->runDML($query);
    }
};