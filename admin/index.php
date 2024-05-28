<?php
@session_start();
if (array_key_exists('username', $_SESSION) && array_key_exists('username', $_COOKIE)) {
    header('Location:recipe-organizer/listCategory.php');
}

include ('class/admin_class.php');
$adminObject = new Admin();
$error = [];

if (isset($_POST['submit'])) {
    if (isset($_POST['email']) && !empty($_POST['email'])) {
        $adminObject->email = $_POST['email'];
    } else {
        $error['msg'] = "Email is required";
    }
    if (isset($_POST['password']) && !empty($_POST['password'])) {
        $adminObject->password = $_POST['password'];
    } else {
        $error['msg'] = "Password is required";
    }
    if (count($error) < 1) {
        $status = $adminObject->login();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="css/admin.css">

</head>

<body>
    <div class="container">
        <div class="userform">
            <form action="" method="post" novalidate>
                <fieldset>
                    <div class="title">
                        <h3>Admin Login</h3>
                    </div>

                    <!-- error msg print -->
                    <?php
                    if (isset($status)) {
                        echo "<label class='error'>$status</label>";
                    }
                    ?>
                    <?php if (isset($error['msg']) && !empty($error['msg'])) { ?>
                        <label class="error"><?php echo $error['msg']; ?></label>
                    <?php } ?>



                    <div class="form-grp">
                        <label>E-mail</label>
                        <input type="text" name="email" type="email" required>
                    </div>
                    <div class="form-grp">
                        <label>Password</label>
                        <input type="password" name="password" type="password" required>
                        <!-- <br> -->
                        <!-- <a href="recipe-organizer/change_pw.php" class="forgot-password">Change Password?</a> -->
                    </div>
                    <button type="submit" name="submit" value="Log In">Login</button>
                </fieldset>
            </form>
        </div>
    </div>
</body>
</html>