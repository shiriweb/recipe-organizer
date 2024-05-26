<?php
session_start();
session_destroy();
// unset($_SESSION['username']);
setcookie('username', '', Time() - 60 * 60);
header('location: index.php');
