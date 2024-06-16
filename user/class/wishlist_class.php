<?php
class Wishlist
{
    private $conn;
    public $recipe_id, $user_id;
    public function __construct()
    {
        $this->conn = mysqli_connect('localhost', 'root', '', 'sem_project');
    }

    public function save()
    {
        $sql = "insert into recipe_joins(recipe_id, user_id, wishlist_status) values ($this->recipe_id, $this->user_id, 1);";
        mysqli_query($this->conn, $sql);
        if ($this->conn->affected_rows > 0) {
            return true;
        } else {
            return 0;
        }
    }

    public function delete()
    {
        $sql = "delete from recipe_joins where recipe_id = $this->recipe_id and user_id = $this->user_id and wishlist_status = 1;";
        mysqli_query($this->conn, $sql);
        if ($this->conn->affected_rows > 0) {
            return true;
        } else {
            return 0;
        }
    }

    public function getrecipeId()
    {
        $sql = "select recipe_id  from recipe_joins where user_id = '$this->user_id' and wishlist_status = 1;";
        $res = mysqli_query($this->conn, $sql);
        $output = array();
        while ($row = mysqli_fetch_assoc($res)) {
            $output[] = $row['recipe_id'];
        }
        if (count($output) > 0) {
            $data =  implode(',', $output);
            return $data;
        } else {
            return 0;
        }
    }

    public function fetchById()
    {
        $ids = $this->getrecipeId();

        $sql = "SELECT r.* 
        FROM recipe r 
         JOIN recipe_joins rj ON r.id = rj.recipe_id 
        WHERE r.id IN ($ids) 
        GROUP BY r.id ; ";

        $res = mysqli_query($this->conn, $sql);
        if ($res->num_rows > 0) {
            $data = $res->fetch_all(MYSQLI_ASSOC);
            return $data;
        } else {
            return false;
        }
    }

    public function checkWishlist()
    {
        $checks = $this->getrecipeId();
        if ($checks) {
            $check = explode(',', $checks);
            $status = 0;
            foreach ($check as  $value) {
                // echo $value;
                // echo $this->recipe_id;
                if ($value == $this->recipe_id) {
                    $status = 1;
                }
            }
            if ($status) {
                return true;
            } else {
                return  0;
            }
        } else {
            return 0;
        }
    }
}
