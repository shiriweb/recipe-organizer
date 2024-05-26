<?php
class User
{
    public $user_id, $username, $email, $password, $con_password, $created_date, $token, $expiretoken;


    public function set($property, $value)
    {
        $this->$property = $value;
    }
    public function signup()
    {
        $conn = mysqli_connect('localhost', 'root', '', 'sem_project');
        if ($this->password !== $this->con_password) {
            return "Passwords do not match";
        }
        $encryptedPassword1 = md5($this->con_password);
        $encryptedPassword2 = md5($this->password);
        $sql = "insert into user(username, email, password, con_password, created_date) values('$this->username', '$this->email', '$encryptedPassword1', '$encryptedPassword2' ,'$this->created_date')";
        mysqli_query($conn, $sql);
        if ($conn->affected_rows > 0) {
            header('Location: login.php');
        } else {
            $error = "Failed to create account. Please try again.";
            return $error;
        }
    }


    public function login()
    {
        $conn = mysqli_connect('localhost', 'root', '', 'sem_project');
        $encryptedPassword = md5($this->password);
        $sql = "select * from user where email = '$this->email' and password = '$encryptedPassword' ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $data = $result->fetch_object();
            session_start();
            $_SESSION['id'] = $data->id;
            $_SESSION['username'] = $data->username;
            setcookie('username', $data->username, time() + 60 * 60);
            header('location:index.php');
        } else {
            $error = "Invalid Information";
            return $error;
        }
    }

    public function retrieve()
    {
        $conn = mysqli_connect('localhost', 'root', '', 'sem_project');
        $sql = "select * from user";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $datalist = $result->fetch_all(MYSQLI_ASSOC);
            return $datalist;
        } else {
            return false;
        }
    }



}
