<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SEC - Assignment Submission</title>

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
  <h2>Student(s) Submission</h2>
  <table id="table" class="table"> 
    <thead>
        <tr>
          <th>Date Submitted</th>
          <th>Student Name</th>
          <th>Course</th>
          <th>Program</th>
          <th>Assignment Link</th>
        </tr>
    </thead>
    <tbody>
        <?php
          $query = "SELECT student.firstname, student.lastname, assignment_submission.submission_link,
          assignment_submission.submission_date, course.course_code, program.program_code
          from `student`
          inner join `assignment_submission` on assignment_submission.student_id = student.student_id
          inner join `assignment` on assignment.assignment_id = assignment_submission.assignment_id
          inner join `course` on assignment.class_id = course.course_id
          inner join `program` on student.program_id = program.program_id
          where assignment.faculty_id = :id;
          ";
          $statement = $connection->prepare($query);
          $statement->execute([":id"=>$ID]);

          foreach($statement as $row)
          {
            echo "<tr>
              <td>".$row['submission_date']."</td>
              <td>".$row['firstname']." ".$row['lastname']."</td>
              <td>".$row['course_code']."</td>
              <td>".$row['program_code']."</td>
              <td><a href='".$row['submission_link']."'>".$row['submission_link']."</a></td>
            </tr>";
          }
        ?>
    </tbody>
  </table>

     
  </div>
  <!-- Bootstrap core JavaScript -->
 <?php include('footer.php');?>
 <script>
$(document).ready( function () {
    $('#table').DataTable();
} );
</script>
</body>
</html>
