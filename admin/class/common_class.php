<?php
abstract class Common
{
    abstract function save();
    abstract function retrieve();
    abstract function edit();
    abstract function delete();


    public function set($property, $value)
    {
        $this->$property = $value;
    }


    public function select($sql)
    {
        $conn = mysqli_connect('localhost', 'root', '', 'sem_project');
        $var = $conn->query($sql);
        if ($var->num_rows > 0) {
            $datalist = $var->fetch_all(MYSQLI_ASSOC);
            return $datalist;
        } else {
            return false;
        }

    }
}