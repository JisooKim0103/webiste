<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SEC - Program and Course Assignment Management</title>

  <!-- Bootstrap core CSS -->
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/general.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">

</head>

<body>
  <?php 
  //ob_start();
  include('session.php');
  include('header.php');
  include("../db/database.php");
  ?>

  <!-- Page Content -->
  <div class="container-fluid">
 
  <h1 class = "text-center"><i class="fas fa-graduation-cap"></i>&nbsp;Program/Class Assignment Management </h1>
  <hr/>

  <div class="row">
  <!-- Add Class Assignment -->
    <div class="col-sm-5 col-md-5 col-lg-5 col-xl-5" >
   
      <form method="POST" class="form-group" enctype="multipart/form-data">
        <h2>Add Class</h2>
        <label>Student</label>
        <div class="form-group">
            <select name="cmbStudent" class="form-control" style="width:60%" required>
                <option value="">Select Student</option>
                <?php
                    $studentQuery="SELECT student.student_id, student.firstname, student.middlename, student.lastname from `student`;";
                    $studentQueryStatement = $connection->prepare($studentQuery);
                    $studentQueryStatement->execute();
                    foreach($studentQueryStatement as $row)
                    {
                        echo "<option value='".$row['student_id']."'>".$row['firstname']." ".$row['lastname']."</option>";
                    }
                ?>
            </select>
        </div>
        <label>Program</label>
        <div class="form-group">
            <select name="cmbProgram" class="form-control" style="width:60%" required>
                <option value="">Select Program</option>
                <?php
                    $programQuery="SELECT program.program_id, program.program_code from `program`;";
                    $programQueryStatement = $connection->prepare($programQuery);
                    $programQueryStatement->execute();
                    foreach($programQueryStatement as $row)
                    {
                        echo "<option value='".$row['program_id']."'>".$row['program_code']."</option>";
                    }
                ?>
            </select>
        </div>
        <label>Year Level</label>
        <div class="form-group">
            <select name="cmbYearLevel" class="form-control" style="width:60%" required>
                <option value="">Select Level</option>
                <option value="1">1st Year</option>
                <option value="2">2nd Year</option>
                <option value="3">3rd Year</option>
                <option value="4">4th Year</option>
            </select>
        </div>
        <label>Semester</label>
        <div class="form-group">
            <select name="cmbSemester" class="form-control" style="width:60%" required>
                <option value="">Select Semester</option>
                <option value="1">1st Semester</option>
                <option value="2">2nd Semester</option>
                <option value="3">Summer</option>
            </select>
        </div>
        <button type="submit" name="btnRegisterClass" style="width:60%;" class="btn btn-info">
        <i class="fas fa-user-plus"></i>&nbsp;Add Class
        </button>
      </form>
    </div>
    <!-- Faculty Table -->
    <div class="col-sm-7 col-md-7 col-lg-7 col-xl-7">
    <div class="table-responsive">
        <table class="table table-boredered" id = "table">
        <thead>
        <tr>
          <th>Student</th>
          <th>Program</th>
          <th>Action</th>
          </tr>
        </thead>
          <tbody>
            <?php
              $statement = $connection->prepare("SELECT student.firstname, student.middlename, student.lastname,  program.program_code FROM `student` 
              inner join program
              on student.program_id = program.program_id;");
              $statement->execute();
              foreach($statement as $row)
              {
                echo "<tr>";
                echo "<td>".$row['firstname']." ".$row['middlename']." ".$row['lastname']."</td>";
                echo "<td>".$row['program_code']."</td>";
                echo "<td><a href='' target='_blank'>View Info</a></td>";
                echo "</tr>";
              }
            ?>
          </tbody>
        </table>
    </div>
  </div>
     
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

<?php
if(isset($_POST['btnRegisterClass']))
{
  try{
    $Student = intval($_POST['cmbStudent']);
    $Program = $_POST['cmbProgram'];
    $YearLevel = $_POST['cmbYearLevel'];
    $Semester = $_POST['cmbSemester'];

   // $query = "INSERT INTO `enrollmentlist` (`student_id`, `program_id`, `class_id`, `academic_year`)";
   //$query .= "VALUES(:sid, :pid, :cid, 2022)";
  // $statement=$connection->prepare($query);
   //  $statement->execute(array(
   //    ":studid" => $Student,
   //    ":pid" => $Program
   //  ));
   $query = "SELECT course.course_id from course where course.year_level = :lvl and course.semester = :sem and course.program_id = :pid;";
   $statement = $connection->prepare($query);
   $statement->execute(array(
     ":lvl" => $YearLevel,
     ":sem" => $Semester,
     ":pid" => $Program
   ));

   foreach($statement as $row)
   {
     $CourseID = $row['course_id'];
     $insertQuery = "INSERT INTO `enrollmentlist` (`student_id`, `program_id`, `class_id`, `academic_year`) VALUES (:studid, :pid, :cid, year(curdate()));";
     $insertClassQuery = $connection->prepare($insertQuery);
     $insertClassQuery->execute(array(
       ":studid" => $Student,
      ":pid" => $Program,
      ":cid" => $CourseID
     ));
   }
 
  echo "Student enrolled!";
  header("refresh: 5; url = index.php");
  }catch(PDOException $e)
  {
  echo "Error: ".$e->getMessage();
  }catch(Exception $e)
  {
    $e->getMessage();
  }

  
}
?>