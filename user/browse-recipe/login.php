<?php
include ('../class/user_class.php');
$userObject = new User();
$error = [];

if (isset($_POST['submit'])) {
    if (isset($_POST['email']) && !empty($_POST['email'])) {
        $userObject->email = $_POST['email'];
    } else {
        $error['msg'] = "Email is required";
    }
    if (isset($_POST['password']) && !empty($_POST['password'])) {
        $userObject->password = $_POST['password'];
    } else {
        $error['msg'] = "Password is required";
    }
    if (count($error) < 1) {
        $result = $userObject->login();
    } else {
        $error['msg'] = "Try again......";
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
    <style>
        label.error {
            color: red;
        }
    </style>

</head>

<body>
    <div class="container" id="popupContainer">
        <div class="userform">
            <form action="" method="post" novalidate>
                <fieldset>
                    <div class="close-icon" onclick="toggleForms()">
                        <i class="fas fa-times"></i>
                        <div class="title">
                            <h3>Login</h3>
                        </div>

                        <?php
                        if (isset($status)) {
                            echo "<label class='error'>$result</label>";
                        }
                        ?>
                        <?php if (isset($error['msg']) && !empty($error['msg'])) { ?>
                            <label class="error"><?php echo $error['msg']; ?></label>
                        <?php } ?>

                        <div class="form-grp">
                            <input type="text" name="email" type="email" placeholder="Email">
                        </div>
                        <div class="form-grp">
                            <input type="password" name="password" type="password" placeholder="Password">

                        </div>
                        <button type="submit" name="submit" value="Log In">Login</button>
                        <!-- <hr> -->
                        <p>Don't have an account?
                            <a href="signin.php" class="signup">Sign up</a>
                        </p>
                        <a href="reset_password.php" class="forgot-password">Forgot Password?</a>

                </fieldset>
            </form>
        </div>

    </div>
    </div>




</body>

</html>