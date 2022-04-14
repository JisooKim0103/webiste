<?php
session_start();
  if(empty($_SESSION['logged_admin'])){
    header("location: login.php");
  }
?>