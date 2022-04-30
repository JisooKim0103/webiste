<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SEC - Students</title>

  <!-- Bootstrap core CSS -->
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/general.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
</head>

<body>
  <?php 
  ob_start();
  include('session.php');
  include('header.php');
  include('../db/database.php');
  $id_query = "SELECT student_credential.student_logid from `student_credential` 
  WHERE student_credential.student_code = :id;";
  $id_queryStatement = $connection->prepare($id_query);
  $id_queryStatement->execute(array(
    ":id"=>$_SESSION['logged_student']
  ));
  $ID = "";
  foreach($id_queryStatement as $idRow)
  {
    $ID = $idRow['student_logid'];
  }
  ?>

  <!-- Page Content -->
  <div class="container-fluid">

  <div class = "text-center">
    <img src = "http://southeastern.com.ph/img/logo.png" style="max-width:100%" height="100" width="100" class = "img-fluid rounded"/>
    <?php
            $query = "SELECT count(assignment_id) as `assign_count` from `assignment`
            inner join `enrollmentlist` on enrollmentlist.class_id = assignment.class_id
            WHERE enrollmentlist.student_id = :id and assignment.submission_date >= now();";
            $statement=$connection->prepare($query);
            $statement->execute([":id"=>$ID]);
            foreach($statement as $row)
            {
              if($row['assign_count'] >= 1)
              {
                echo "<h2 class='text-warning'>Assignment Notice(s):".$row['assign_count']."</h2>";
              }
            }
    ?>
  </div>

  <div class="row">
    <div class="col-md-6">
    <h2>Currently Enrolled Course(s):</h2>  
    <div id="schedule">
    <table id="courseTable" class="table">
      <thead>
        <tr>
          <th>Course</th>
          <th>Course Description</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $query="SELECT course.course_code, course.course_description, program.program_code FROM `course`
          INNER JOIN `enrollmentlist`ON course.course_id = enrollmentlist.class_id
          INNER JOIN `program` ON program.program_id = enrollmentlist.program_id
          WHERE enrollmentlist.student_id = :id;";
          $statement = $connection->prepare($query);
          $statement->execute(array(
            ":id" => $ID
          ));
          
          foreach($statement as $row)
          {
            echo "<tr>
              <td>".$row['course_code']."</td>
              <td>".$row['course_description']."/ <b>".$row['program_code']."</b></td>
            </tr>";
          }
        ?>
      </tbody>
    </table>  
  </div>
    </div>
    <div class="col-md-6">
    <h2>Event(s):</h2>
      <div id="events">
        <table id="eventTable" class="table" >
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
    $('#courseTable').DataTable();
    $('#eventTable').DataTable();
} );
</script>
</body>
</html>
