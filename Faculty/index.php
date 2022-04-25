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
  <link href="../css/style.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
</head>

<body>
  <?php 
  ob_start();
  include('session.php');
  include('header.php');
  include('../db/database.php');
  $ID = "";
    $idQuery = $connection->prepare("SELECT faculty_logid from faculty_credential where faculty_code = :code;");
    $idQuery->execute(array(":code" => $_SESSION['logged_faculty']));


    foreach($idQuery as $idrow)
    {
        $ID = $idrow['faculty_logid'];
    }
  ?>

  <!-- Page Content -->
  <div class="container-fluid">

  <div class = "text-center">
    <img src = "http://southeastern.com.ph/img/logo.png" style="max-width:100%" height="100px" width="100px" class = "img-fluid rounded"/>
  </div>
  <div class="row">
    
  <div class="col-md-6">
    <h2>Course(s) assigned</h2>
    <table id="course" class="table">
      <thead>
        <tr>
          <th>Course</th>
          <th>Program</th>
        </tr>
      </thead>
      <tbody>
          <?php
            $sqlCoursesHandledQuery = "SELECT course.course_code, program.program_code from `course`
            INNER JOIN `program` ON course.program_id = program.program_id
            INNER JOIN `course_handled` ON course_handled.course_id = course.course_id
            WHERE course_handled.faculty_id = :id;";
            $statement = $connection->prepare($sqlCoursesHandledQuery);
            $statement->execute([":id" => $ID]);
            foreach($statement as $row)
            { 
                echo "<tr>
                  <td>".$row['course_code']."</td>
                  <td>".$row['program_code']."</td>
                </tr>";
            }
          ?>
      </tbody>
    </table>
    </div>
    
    <div class="col-md-6">
      <h2>Events</h2>
      <div style="height: 500px; overflow: auto">
        <table id="event" class="table" >
        <thead>
          <tr>
            <th>Event</th>
            <th>Date</th>
          </tr>
        </thead>
        <tbody>
          <?php
              $query = "SELECT * from schoolevent where event_date >= curdate();";
              $statement = $connection->prepare($query);
              $statement->execute();

              foreach($statement as $row)
              {
                echo "<tr>
                    <td>".$row['event_name']."</td>
                    <td>".$row['event_date']."</td>
                </tr>";
              }
          ?>
        </tbody>
      </table>  
      </div>
    </div>
  </div>

     
  </div>
  <!-- Bootstrap core JavaScript -->
 <?php include('footer.php');?>
 <script>
$(document).ready( function () {
    $('#course').DataTable();
    $('#event').DataTable();
} );
</script>
</body>
</html>
