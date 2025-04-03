<?php 
include('config.php');
include('function.php');
unset($_SESSION['id']);
unset($_SESSION['uname']);
redirect('signup.php');
?>