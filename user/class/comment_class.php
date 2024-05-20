<?php
require_once ('../../admin/class/common_class.php');
class Comment extends Common
{
    public $id, $comment, $commented_date, $modified_date;


    public function save()
    {
        $conn = mysqli_connect('localhost', 'root', '', 'sem_project');
        $sql = "insert into comment(comment, commented_date, modified_date) values('$this->comment', '$this->commented_date', '$this->modified_date')";
        $result = mysqli_query($conn, $sql);
        if ($conn->query($sql)) {
            return $conn->insert_id;
        } else {
            return false;
        }
    }
    public function retrieve()
    {
        $conn = mysqli_connect('localhost', 'root', '', 'sem_project');
        $sql = "select * from comment";
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
        $conn = mysqli_connect('locahost', 'root', '', 'sem_project');
        $sql = " update comment SET comment = '$this->comment', modified_date = '$this->modified_date' WHERE id = '$this->id'";
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
        $sql = "delete from comment where id = '$this->id'";
        $result = $conn->query($sql);
        if ($result) {
            return "success";
        } else {
            return "failed";
        }

    }


}
