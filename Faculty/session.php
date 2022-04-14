<?php
session_start();
  if(empty($_SESSION['logged_faculty'])){
    header("location: login.php");
  }
?>