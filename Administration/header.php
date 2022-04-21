<!-- Navigation -->
<?php
 if(empty($_SESSION['logged_admin'])){
  header("location: login.php");
}
?>
<nav class="navbar navbar-expand-lg bg-light static-top">
    <div class="container">
      <a class="navbar-brand text-info" href="index.php" >
      <img src = "http://southeastern.com.ph/img/logo.png" height="50"/>
      <b>SEC School Management Admin</b>
      </a>
      <button class="navbar-toggler bg-light" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php"><i class="fas fa-tachometer-alt"></i>&nbsp;Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="faculty.php"><i class="fas fa-users-cog"></i>&nbsp;Faculty</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="student.php"><i class="fas fa-user-graduate"></i>&nbsp;Students</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="events.php"><i class="fas fa-calendar-alt"></i>&nbsp;Events</a>
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