<?php
session_start();
session_destroy();
setcookie('username', '', Time() - 60 * 60);
header('locstion: ../index.php');