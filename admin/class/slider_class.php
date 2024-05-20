<?php
require_once ('common_class.php');

class ImageSlider extends Common
{

    public $id, $image, $uploaded_date, $modified_date;

    public function save()
    {
        $conn = mysqli_connect('localhost', 'root', '', 'sem_project');
        $sql = "insert into slider( image, uploaded_date, modified_date) values('$this->image', '$this->uploaded_date', '$this->modified_date' )";
        if ($conn->query($sql)) {
            return $conn->insert_id;
        } else {
            return false;
        }
    }

    public function retrieve()
    {
        $conn = mysqli_connect('localhost', 'root', '', 'sem_project');
        $sql = "select * from slider";
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
        $sql = "update slider set image='$this->image' , modified_date = '$this->modified_date' where id = '$this->id'";
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
        $sql = "delete from slider where id = '$this->id'";
        $result = $conn->query($sql);

        if ($result) {
            return "success";
        } else {
            return "failed";
        }
    }
}

