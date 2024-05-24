<?php
require_once ('common_class.php');
class Recipe extends Common
{
    public $id, $recipe_name, $total_time, $preparation_time, $cooking_time, $cooking_level, $serving, $details, $ingredients, $instructions, $short_details, $description, $nutritional_info, $image, $category, $created_date, $modified_date;

    public function save()
    {
        $conn = mysqli_connect('localhost', 'root', '', 'sem_project');
        $sql = "insert into recipe (recipe_name, total_time, preparation_time, cooking_time, cooking_level, serving, details, ingredients, instructions, short_details, description, nutritional_info, image, category, created_date, modified_date) 
        values ('$this->recipe_name', '$this->total_time', '$this->preparation_time', '$this->cooking_time', '$this->cooking_level', '$this->serving', '$this->details', '$this->ingredients', '$this->instructions', '$this->short_details', '$this->description', '$this->nutritional_info', '$this->image', '$this->category', '$this->created_date', '$this->modified_date')";
        if ($conn->query($sql)) {
            return $conn->insert_id;
        } else {
            return false;
        }
    }


    public function retrieve()
    {
        $conn = mysqli_connect('localhost', 'root', '', 'sem_project');
        $sql = "select * from recipe";
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
        $sql = "update recipe SET recipe_name = '$this->recipe_name', cooking_time = '$this->cooking_time', cooking_level = '$this->cooking_level',  serving = '$this->serving', details = '$this->details' ,ingredients = '$this->ingredients', instructions = '$this->instructions', short_details = '$this->short_details', description = '$this->description',nutritional_info = '$this->nutritional_info', image = '$this->image' , category = '$this->category', created_date = '$this->created_date', modified_date = '$this->modified_date' WHERE id = '$this->id'";
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
        $sql = "delete from recipe where id = '$this->id'";
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
        $sql = "select * from recipe where id = '$this->id'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $data = $result->fetch_object();
            return $data;
        } else {
            $error = "Error occured";
            return $error;
        }
    }

    public function recentlyAdded()
    {
        $conn = mysqli_connect('localhost', 'root', '', 'sem_project');
        $sql = "select * from recipe order by created_date DESC limit 3";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $data = $result->fetch_all(MYSQLI_ASSOC);
            return $data;
        } else {
            $error = "Error Occurred";
            return $error;
        }
    }

    public function breakfast()
    {
        $conn = mysqli_connect('localhost', 'root', '', 'sem_project');
        $sql = "SELECT * FROM recipe r JOIN category c ON r.category = c.id WHERE c.name = 'Breakfast'";
        $var = $conn->query($sql);
        if ($var->num_rows > 0) {
            $datalist = $var->fetch_all(MYSQLI_ASSOC);
            return $datalist;
        } else {
            return false;
        }
    }

    public function lunch()
    {
        $conn = mysqli_connect('localhost', 'root', '', 'sem_project');
        $sql = "SELECT * FROM recipe r JOIN category c ON r.category = c.id WHERE c.name = 'Lunch'";
        $var = $conn->query($sql);
        if ($var->num_rows > 0) {
            $datalist = $var->fetch_all(MYSQLI_ASSOC);
            return $datalist;
        } else {
            return false;
        }
    }


    public function snacks()
    {
        $conn = mysqli_connect('localhost', 'root', '', 'sem_project');
        $sql = "SELECT * FROM recipe r JOIN category c ON r.category = c.id WHERE c.name = 'Snacks'";
        $var = $conn->query($sql);
        if ($var->num_rows > 0) {
            $datalist = $var->fetch_all(MYSQLI_ASSOC);
            return $datalist;
        } else {
            return false;
        }
    }
    public function dinner()
    {
        $conn = mysqli_connect('localhost', 'root', '', 'sem_project');
        $sql = "SELECT * FROM recipe r JOIN category c ON r.category = c.id WHERE c.name = 'Dinner'";
        $var = $conn->query($sql);
        if ($var->num_rows > 0) {
            $datalist = $var->fetch_all(MYSQLI_ASSOC);
            // return $datalist;
            print_r($datalist);
        } else {
            return false;
        }
    }


    public function desert()
    {
        $conn = mysqli_connect('localhost', 'root', '', 'sem_project');
        $sql = "SELECT * FROM recipe r JOIN category c ON r.category = c.id WHERE c.name = 'Desert'";
        $var = $conn->query($sql);
        if ($var->num_rows > 0) {
            $datalist = $var->fetch_all(MYSQLI_ASSOC);
            return $datalist;
        } else {
            return false;
        }
    }

    // Inside your Recipe class
public function fetch() {
    $conn = mysqli_connect('localhost', 'root', '', 'sem_project');
    $id = $this->id; 
    $sql = "SELECT * FROM recipe WHERE id = '$id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $data = $result->fetch_all(MYSQLI_ASSOC);
        return $data;
        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";

    } else {
        $error = "Error occurred";
        return $error;
    }
}

}