<?php
@session_start();
// if (!array_key_exists('user_id', $_SESSION) && !array_key_exists('user_id', $_COOKIE)) {
//     header('location:login.php');

// }

include ('../class/user_class.php');
include ('../class/comment_class.php');

$userObj = new User();
$commentObj = new Comment();
$error[] = "";


if (isset($_POST['submit'])) {
    if (isset($_POST['comment']) && !empty($_POST['comment'])) {
        $commentObj->set('comment', $_POST['comment']);
        $commentObj->set('commented_date', date('Y-m-d H:i:s'));
        $result = $commentObj->save();
        if ($result) {
            $msg = "Comment posted successfully";
        } else {
            $error['msg'] = "Failed to post the comment";
        }
    } else {
        $error['msg'] = "Category already taken";
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
    <title>Document</title>
</head>

<body>
    <div class="container">
        <h1>Feedback</h1>
        <div class="comment">

            <form action="" method="post">

                <?php if (isset($error['msg']) && !empty($error['msg'])) { ?>
                    <label class="error" style="color:red"><?php echo $error['msg']; ?></label>
                <?php } ?>
                <?php if (isset($msg) && !empty($msg)) { ?>
                    <label style="color:orange"><?php echo $msg; ?></label>
                <?php } ?>
                <!-- <br> -->
                <!-- <label for="">Username</label> 
                <div class="form-grp">
                    <input type="text" name="username">
                </div>
                <br> -->
                <textarea name="comment" id="comment" cols="58" rows="6" required></textarea>
                <div class="submit">
                    <input type="submit" name="submit" value="Post">
                </div>
                <!-- <div class="button">
            <a class= "edit" href=""> <i class="fas fa-edit"></i> Edit</a>
            <a class= "delete" href""><i class="fas fa-trash"></i> Delete</a>
        </div> -->
            </form>
            <p> Please login to comment <a href="login.php">Login</a></p>
        </div>
        <!-- Code injected by live-server -->
    </div>

</body>

</html>