<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SEC - Dashboard</title>

  <!-- Bootstrap core CSS -->
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/general.css" rel="stylesheet">
</head>

<body>
  <?php 
  ob_start();
  include('session.php');
  include('header.php');
  include('../db/database.php');
  ?>

  <!-- Page Content -->
  <div class="container-fluid">

  <div class = "text-center">
    <img src = "http://southeastern.com.ph/img/logo.png" height="75px" width="150px" style="max-width:100%" class = "img-fluid rounded"/>
  </div>
  
  <div class="row mt-5">
     <!-- Enrolled Students -->
    <div class="col-md-4">
      <div class="card" style="width: 25rem;">
        <div class="card-body">
          <h5 class="card-title text-info"><i class="fas fa-user-graduate"></i>&nbsp;Current Enrolled Students</h5>
          <h6 class="card-subtitle mb-2 text-muted"><hr/></h6>
          <p class="card-text">
            <?php
                  $teacherQuery = "SELECT COUNT(student.firstname) as `student_count` from `student`;";
                  $teacherQueryStatement = $connection->prepare($teacherQuery);
                  $teacherQueryStatement->execute();
                  foreach($teacherQueryStatement as $row)
                  {
                    echo "<h2 class='text-info'>(".$row['student_count'].") Student(s)</h2>";
                  }
              ?>
          </p>
        </div>
      </div>
    </div>
    <!-- Current Teachers -->
    <div class="col-md-4">
      <div class="card" style="width: 25rem;">
        <div class="card-body">
          <h5 class="card-title text-success"><i class="fas fa-chalkboard-teacher"></i>&nbsp;Available Teachers</h5>
          <h6 class="card-subtitle mb-2 text-muted"><hr/></h6>
          <p class="card-text">
            <?php
                $teacherQuery = "SELECT COUNT(faculty.firstname) as `teacher_count` from `faculty`;";
                $teacherQueryStatement = $connection->prepare($teacherQuery);
                $teacherQueryStatement->execute();
                foreach($teacherQueryStatement as $row)
                {
                  echo "<h2 class='text-success'>(".$row['teacher_count'].") Teacher(s)</h2>";
                }
            ?>
          </p>
        </div>
      </div>
    </div>
     <!-- Current Events -->
    <div class="col-md-4">
      <div class="card" style="width: 25rem;">
        <div class="card-body">
          <h5 class="card-title text-warning"><i class="fas fa-calendar-alt"></i>&nbsp;Current School Events</h5>
          <h6 class="card-subtitle mb-2 text-muted"><hr/></h6>
          <p class="card-text">
          <?php
                $teacherQuery = "SELECT COUNT(schoolevent.event_name) as `event_count` from `schoolevent`;";
                $teacherQueryStatement = $connection->prepare($teacherQuery);
                $teacherQueryStatement->execute();
                foreach($teacherQueryStatement as $row)
                {
                  echo "<h2 class='text-warning'>(".$row['event_count'].") Event(s)</h2>";
                }
            ?>
          </p>
        </div>
      </div>
    </div>
  </div>
    
     
  </div>
  <!-- Bootstrap core JavaScript -->
 <?php include('footer.php');?>
</body>
</html>
