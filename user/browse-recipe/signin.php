<?php
include ('../class/user_class.php');

$userObject = new User();
$error = [];

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];

    if (isset($username) && !empty($username)) {
        $userObject->username = $username;
    } else {
        $error['msg'] = "All fields are required";
    }
    if (isset($email) && !empty($email)) {
        $userObject->email = $email;
    } else {
        $error['msg'] = "All fields are required";
    }
    if (isset($pass1) && !empty($pass1)) {
        $userObject->password = $pass1;
    } else {
        $error['msg'] = "All fields are required";
    }
    if (isset($pass2) && !empty($pass2)) {
        $userObject->con_password = $pass2;
    } else {
        $error['msg'] = "All fields are required";
    }
    $userObject->set('created_date', date('Y-m-d H:i:s'));

    if (count($error) < 1) {
        $status = $userObject->signup();
    }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="../style/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

</head>

<body>
    <div class="container">
        <div class="userform">
            <form action="" method="post" novalidate>
                <fieldset>
                    <!-- <i class="fas fa-times"></i> -->
                    <div class="title">
                        <h3> Create an account </h3>
                    </div>
                    <?php if (isset($status)) {
                        echo "<label class='error' style='color:green;'>$status</label>";
                    }
                    ?>

                    <?php if (isset($error['msg']) && !empty($error['msg'])) { ?>
                        <label class="error" style='color:red;'><?php echo $error['msg']; ?></label>
                    <?php } ?>

                    <div class="form-grp">
                        <input type="text" name="username" placeholder="Username" required>
                    </div>
                    <div class="form-grp">
                        <input type="text" name="email" placeholder="E-mail" required>
                    </div>
                    <div class="form-grp">
                        <input type="password" name="pass1" placeholder="Password" required>
                    </div>
                    <div class="form-grp">
                        <input type="password" name="pass2" placeholder="Confirm Password" required>
                    </div>
                    <button type="submit" name="submit">Sign Up</button>
                    <!-- <hr> -->
                    <p>Already have an account?
                        <a href="login.php" class="login">Log in</a>
                    </p>

                </fieldset>
            </form>
        </div>
    </div>
    </div>

</body>

</html>