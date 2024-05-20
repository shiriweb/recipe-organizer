<?php

class Recipe1
{
    public $id, $recipe_name, $cooking_time, $cooking_level, $serving, $details, $ingredients, $instructions, $short_details, $nutritional_info, $image, $category, $keywords, $created_date, $modified_date;

    public function breakfast()
    {
        $conn = mysqli_connect('localhost', 'root', '', 'sem_project');
        $sql = "select * from recipe where category='Breakfast'";
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
        $sql = "select * from recipe where category ='Lunch'";
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
        $sql = "select * from recipe where category ='Snacks'";
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
        $sql = "select * from recipe where category ='Dinner'";
        $var = $conn->query($sql);
        if ($var->num_rows > 0) {
            $datalist = $var->fetch_all(MYSQLI_ASSOC);
            return $datalist;
        } else {
            return false;
        }
    }

    public function desert()
    {
        $conn = mysqli_connect('localhost', 'root', '', 'sem_project');
        $sql = "select * from recipe where category ='Desert'";
        $var = $conn->query($sql);
        if ($var->num_rows > 0) {
            $datalist = $var->fetch_all(MYSQLI_ASSOC);
            return $datalist;
        } else {
            return false;
        }
    }
}