<?php
session_start();
unset($_SESSION['logged_faculty']);
header("location: login.php");
?>