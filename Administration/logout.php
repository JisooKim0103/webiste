<?php
session_start();
unset($_SESSION['logged_admin']);
header("location: login.php");
?>