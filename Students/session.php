<?php
session_start();
  if(empty($_SESSION['logged_student'])){
    header("location: login.php");
  }
?>