<?php
@session_start();
include ('../class/user_class.php');
include ('../class/comment_class.php');

$commentObj = new Comment();
$error = "";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Assuming you have a method in your User class to fetch user data by id
    $userObj = new User();
    $userObj->set('id', $id);
    $data = $userObj->fetchById();
    if ($data) {
        $username = $data->username; // Storing username for use in form
    } else {
        $error = "User not found";
    }
}

if (isset($_POST['submit'])) {
    if (isset($_POST['comment']) && !empty($_POST['comment'])) {
        // Assuming username is stored in session or fetched from database
        // if(isset($_SESSION['username'])) {
        //     $username = $_SESSION['username'];
        // }
        // $commentObj->set('username', $username);
        $commentObj->set('comment', $_POST['comment']);
        $commentObj->set('commented_date', date('Y-m-d H:i:s'));
        $result = $commentObj->save();
        if ($result) {
            $msg = "Comment posted successfully";
        } else {
            $error = "Failed to post the comment";
        }
    } else {
        $error = "Comment field cannot be empty";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../csss/feedback.css">
    <title>Feedback</title>
</head>

<body>
    <div class="container">
        <h1>Feedback</h1>
        <div class="comment">
            <form action="" method="post">
                <?php if (isset($error) && !empty($error)) { ?>
                    <label class="error" style="color:red"><?php echo $error; ?></label>
                <?php } ?>
                <?php if (isset($msg) && !empty($msg)) { ?>
                    <label style="color:orange"><?php echo $msg; ?></label>
                <?php } ?>
                <!-- <label for="">Username</label> 
                <div class="form-grp">
                    <input type="text" name="username" value="" readonly>
                </div>
                <br> -->
                <textarea name="comment" id="comment" cols="58" rows="6" required></textarea>
                <div class="submit">
                    <input type="submit" name="submit" value="Post">
                </div>
            </form>
            <p> Please login to comment <a href="login.php">Login</a></p>
        </div>
    </div>
</body>

</html>