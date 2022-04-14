<?php
session_start();
unset($_SESSION['logged_student']);
header("location: login.php");
?>