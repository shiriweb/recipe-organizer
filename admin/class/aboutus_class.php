<?php
require_once ('common_class.php');

class About extends Common
{
    public $id, $description, $short_detail, $image1, $created_date, $modified_date;

    public function save()
    {
        $conn = mysqli_connect('localhost', 'root', '', 'sem_project');
        $sql = "insert into about_us(description, short_detail, image1, created_date, modified_date) values('$this->description', '$this->short_detail', '$this->image1', '$this->created_date' , '$this->modified_date')";
        if ($conn->query($sql)) {
            return $conn->insert_id;
        } else {
            return false;
        }
    }

    public function retrieve()
    {
        $conn = mysqli_connect('localhost', 'root', '', 'sem_project');
        $sql = "SELECT * FROM about_us";
        $var = $conn->query($sql);
        if ($var->num_rows > 0) {
            $datalist = $var->fetch_all(MYSQLI_ASSOC);
            return $datalist;
        } else {
            return false;
        }
    }


    public function edit()
    {
        $conn = mysqli_connect('localhost', 'root', '', 'sem_project');
        $sql = "update about_us set description = '$this->description', short_detail = '$this->short_detail', image1 = '$this->image1',  modified_date = '$this->modified_date' where id = '$this->id'";
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
        $sql = "delete from about_us where id = '$this->id'";
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
        $sql = "SELECT * FROM about_us WHERE id = '$this->id'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $data = $result->fetch_object();
            return $data;
        } else {
            $error = "Error occurred";
            return $error;
        }
    }
}
?>