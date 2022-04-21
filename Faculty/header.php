<!-- Navigation -->
<?php
 if(empty($_SESSION['logged_faculty'])){
  header("location: login.php");
}
?>
<nav class="navbar navbar-expand-lg bg-light static-top">
    <div class="container">
      <a class="navbar-brand text-danger" href="index.php" >
      <img src = "http://southeastern.com.ph/img/logo.png" height="50"/>
      <b>SEC Faculty<br/>Logged as: <?php echo $_SESSION['logged_faculty'];?></b>
      </a>
      <button class="navbar-toggler bg-danger" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php"><i class="fas fa-tachometer-alt"></i>&nbsp;Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="students.php"><i class="fas fa-user-graduate"></i>&nbsp;Students</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="documents.php"><i class="fas fa-file-alt"></i>&nbsp;Documents</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="my_account.php"><i class="fas fa-user-cog"></i>&nbsp;Profile</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>