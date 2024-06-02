<?php
include ('header.php');
include ('../../user/class/user_class.php');
@session_start();
if (isset($_SESSION['message']) && $_SESSION['message'] != "") {
    $message = $_SESSION['message'];
    $_SESSION['message'] = "";
}

$userObj = new User();

$datalist = $userObj->retrieve();

// echo "<pre>";
// print_r($datalist);
// echo "</pre>";

include ('sidebar.php');
?>

<div class="category">
    <div class="row">
        <div class="heading">
            <p>List of Users </p>
        </div>
    </div>
    <?php
    if (isset($message)) {
        echo '<div class="alert alert-success">' . $message . '</div>';
    }
    ?>
    <div class="row">
        <div class="headings">
            <table id="categorytable">
                <thead>
                    
                    <tr>
                        <th>S.No</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Created Date</th>
                        <!-- <th>Action</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($datalist as $key => $user) { ?>
                        <tr class="">
                            <td><?php echo $key + 1; ?></td>
                            <td><?php echo $user['username']; ?></td>
                            <td><?php echo $user['email']; ?></td>
                            <td><?php echo $user['created_date']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>