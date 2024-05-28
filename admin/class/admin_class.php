<?php
class Admin
{
    public $id, $name, $username, $email, $password,
    $status, $role, $last_login, $change_password;

    public function login()
    {
        $conn = mysqli_connect('localhost', 'root', '', 'sem_project');
        $encryptedPassword = md5($this->password);
        $sql = "select * from admin where email = '$this->email' and password = '$encryptedPassword';";
        $var = $conn->query($sql);

        if ($var->num_rows > 0) {
            $data = $var->fetch_object();
            @session_start();
            $_SESSION['id'] = $data->id;
            $_SESSION['name'] = $data->name;
            $_SESSION['username'] = $data->username;
            $_SESSION['role'] = $data->role;
            setcookie('username', $data->username, time() + 60 * 60);
            header('location:recipe-organizer/listCategory.php');
        } else {
            $error = "Invalid Credentials!";
            return $error;
        }
    }
}