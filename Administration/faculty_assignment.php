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
  ob_start();
  include('session.php');
  include('header.php');
  include("../db/database.php");
  ?>

  <!-- Page Content -->
  <div class="container-fluid">
 
  <h1 class = "text-center"><i class="fas fa-chalkboard-teacher"></i>&nbsp;Faculty Assignment</h1>
  <hr/>

  <div class="row">
  <!-- Add Class Assignment -->
    <div class="col-sm-5 col-md-5 col-lg-5 col-xl-5" >
   
      <form method="POST" class="form-group" enctype="multipart/form-data">
        <h2>Add Class</h2>
        <label>Faculty</label>
        <div class="form-group">
            <select name="cmbFaculty" class="form-control" style="width:60%" required>
                <option value="">Select Faculty</option>
                <?php
                    $facultyQuery="SELECT faculty.faculty_id, faculty.firstname, faculty.middlename, faculty.lastname, program.program_description from `faculty`
                    INNER JOIN  `program` on faculty.program_id = program.program_id;";
                    $facultyQueryStatement = $connection->prepare($facultyQuery);
                    $facultyQueryStatement->execute();
                    foreach($facultyQueryStatement as $row)
                    {
                        echo "<option value='".$row['faculty_id']."'>".$row['firstname']." ".$row['lastname']."/".$row['program_description']."</option>";
                    }
                ?>
            </select>
        </div>
        <label>Course</label>
        <div class="form-group">
            <select name="cmbCourse" class="form-control" style="width:60%" required>
                <option value="">Select Course</option>
                <?php
                    $programQuery="SELECT course.course_id, course.course_code, program.program_code from `course`
                    INNER JOIN `program` ON course.program_id = program.program_id;";
                    $programQueryStatement = $connection->prepare($programQuery);
                    $programQueryStatement->execute();
                    foreach($programQueryStatement as $row)
                    {
                        echo "<option value='".$row['course_id']."'>".$row['course_code']."/".$row['program_code']."</option>";
                    }
                ?>
            </select>
        </div>
        <button type="submit" name="btnRegisterClass" style="width:60%;" class="btn btn-info">
        <i class="fas fa-user-plus"></i>&nbsp;Assign Course
        </button>
      </form>
    </div>
    <!-- Faculty Table -->
    <div class="col-sm-7 col-md-7 col-lg-7 col-xl-7">
    <div class="table-responsive">
        <table class="table table-boredered" id = "table">
        <thead>
        <tr>
          <th>Faculty</th>
          <th>Courses</th>
          </tr>
        </thead>
          <tbody>
            <?php
              $statement = $connection->prepare("SELECT faculty.firstname, faculty.middlename, faculty.lastname,  course.course_code, program.program_code FROM `course_handled` 
              inner join `course` on course_handled.course_id = course.course_id
              inner join `faculty`   on faculty.faculty_id = course_handled.faculty_id
              inner join `program` on course.program_id = program.program_id;");
              $statement->execute();
              foreach($statement as $row)
              {
                echo "<tr>";
                echo "<td>".$row['firstname']." ".$row['middlename']." ".$row['lastname']."</td>";
                echo "<td>".$row['course_code']."/".$row['program_code']."</td>";
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
    $Faculty = $_POST['cmbFaculty'];
    $Course = $_POST['cmbCourse'];

    $sqlQuery = "INSERT INTO `course_handled`(`course_id`, `faculty_id`, `date_create`) VALUES (:cid, :fid, now());";
    $statement = $connection->prepare($sqlQuery);
    $statement->execute([":cid" => $Course, ":fid" => $Faculty]);

    echo "Faculty Assigned!";
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