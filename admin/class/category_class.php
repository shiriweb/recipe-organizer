<?php
require_once ('common_class.php');

class Category extends Common
{
    public $id, $name, $created_date, $modified_date;

    public function save()
    {
        $conn = mysqli_connect('localhost', 'root', '', 'sem_project');
        $sql = "insert into category(name, created_date ,modified_date ) values('$this->name', '$this->created_date' , '$this->modified_date' )";
        if ($conn->query($sql)) {
            return $conn->insert_id;
        } else {
            return false;
        }
    }


    public function retrieve()
    {
        $conn = mysqli_connect('localhost', 'root', '', 'sem_project');
        $sql = "select * from category";
        $var = $conn->query($sql);
        if ($var->num_rows > 0) {
            $dataliist = $var->fetch_all(MYSQLI_ASSOC);
            return $dataliist;
        } else {
            return false;
        }

    }


    public function edit()
    {
        $conn = mysqli_connect('localhost', 'root', '', 'sem_project');
        $sql = "update category set name = '$this->name', modified_date = '$this->modified_date' where id = '$this->id'";
        $conn->query($sql);
        if ($conn->affected_rows == 1) {
            return $this->id;
        } else {
            return false;
        }
    }

    public function delete()
    {
        $conn = mysqli_connect('localhost', 'root', '', 'sem_project');
        $sql = "delete from category where id = '$this->id'";
        $result = $conn->query($sql);

        if ($result) {
            return "success";
        } else {
            return "failed";
        }


    }


    public function fetchById()
    {
        $conn = mysqli_connect('localhost', 'root', '', 'sem_project');
        $sql = "select * from category where id = '$this->id'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $data = $result->fetch_object();
            return $data;
        } else {
            $error = "Error occured";
            return $error;
        }
    }


}

