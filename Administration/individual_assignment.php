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
 
  <h1 class = "text-center"><i class="fas fa-graduation-cap"></i>&nbsp;Individual Class Assignment</h1>
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
        <label>Courses</label>
        <div class="form-group">
            <select name="cmbCourse" id="course" class="form-control" style="width:60%" required>
                <option value="">Select Course</option>
                <?php
                    $programQuery="SELECT course.course_id, course.course_code, course.course_description from `course`;";
                    $programQueryStatement = $connection->prepare($programQuery);
                    $programQueryStatement->execute();
                    foreach($programQueryStatement as $row)
                    {
                        echo "<option value='".$row['course_id']."'>".$row['course_code']." - ".$row['course_description']."</option>";
                    }
                ?>
            </select>
        </div>
        <button type="submit" name="btnRegisterClass" style="width:60%;" class="btn btn-info">
        <i class="fas fa-user-plus"></i>&nbsp;Add Class
        </button>
      </form>
      <div class="form-group mt-3">
        <button type="button" id="btnShowUpdate" onclick="flipPanel();" class="btn btn-outline-warning" style="width:60%;">
        <i class="fas fa-exchange-alt"></i>&nbsp;Change Course
        </button>

        <form class="form-group" id="updatePanel" method="post">
        <h2>Update Class</h2>
          <label>Select Student</label>
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
            <label>Old Course</label>
            <div class="form-group">
              <select name="cmbOldCourse" id="replaceCourse" class="form-control" style="width:60%" required>
                  <option value="">Select Course to Replace</option>
                  <?php
                      $programQuery="SELECT course.course_id, course.course_code, course.course_description from `course`;";
                      $programQueryStatement = $connection->prepare($programQuery);
                      $programQueryStatement->execute();
                      foreach($programQueryStatement as $row)
                      {
                          echo "<option value='".$row['course_id']."'>".$row['course_code']." - ".$row['course_description']."</option>";
                      }
                  ?>
            </select>
            </div>
            <label>New Course</label>
            <div class="form-group">
              <select name="cmbNewCourse" id="replaceCourse" class="form-control" style="width:60%" required>
                  <option value="">Select new Course</option>
                  <?php
                      $programQuery="SELECT course.course_id, course.course_code, course.course_description from `course`;";
                      $programQueryStatement = $connection->prepare($programQuery);
                      $programQueryStatement->execute();
                      foreach($programQueryStatement as $row)
                      {
                          echo "<option value='".$row['course_id']."'>".$row['course_code']." - ".$row['course_description']."</option>";
                      }
                  ?>
            </select>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-warning" style="width: 60%;" name="btnUpdateCourseAssignment"><i class="fas fa-pen-alt"></i>&nbsp;Update Course Assignment</button>
            </div>
        </form>
        <form method="post" class="form-group" id="deletePanel">
          <label>Select Course Assignment to Delete</label>
          <div class="form-group" >
            <select class="form-control" name="cmbStudentCourse" style="width: 60%;">
              <option value="">Select Student</option>
              <?php
                $query = "SELECT enrollmentlist.enrollment_id, course.course_code, student.firstname, student.lastname FROM `enrollmentlist`
                INNER JOIN `course` ON course.course_id = enrollmentlist.class_id
                INNER JOIN `student` ON enrollmentlist.student_id = student.student_id;";
                $statement = $connection->prepare($query);
                $statement->execute();

                 foreach($statement as $row)
                 {
                   echo "<option value='".$row['enrollment_id']."'>".$row['course_code']." - ".$row['lastname'].", ".$row['firstname']."</option>";
                 }
              ?>
            </select>
          </div>
          <div class="form-group">
            <button type="submit" name="btnDeleteCourse" class="btn btn-danger" style="width: 60%;"><i class="fas fa-eraser"></i>&nbsp;Delete Course Assignment</button>
          </div>
        </form>
      </div>
      
    </div>
    <!-- Faculty Table -->
    <div class="col-sm-7 col-md-7 col-lg-7 col-xl-7">
    <div class="table-responsive">
        <table class="table table-boredered" id = "table">
        <thead>
        <tr>
          <th>Program</th>
          <th>Student</th>
          <th>Course</th>
          </tr>
        </thead>
          <tbody>
            <?php
              $statement = $connection->prepare("SELECT program.program_code, student.firstname, student.middlename, student.lastname, course.course_code 
              from `enrollmentlist`
              inner join `course` on enrollmentlist.class_id = course.course_id
              inner join `student` on student.student_id = enrollmentlist.student_id
              inner join `program` on enrollmentlist.program_id = program.program_id;");
              $statement->execute();
              foreach($statement as $row)
              {
                echo "<tr>";
                echo "<td>".$row['program_code']."</td>";
                echo "<td>".$row['firstname']." ".$row['middlename']." ".$row['lastname']."</td>";
                echo "<td>".$row['course_code']."</td>";
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
   updatePanel.style.visibility="hidden";
   deletePanel.style.visibility="hidden";
   let flipper = false;
   function flipPanel()
   {
      flipper = !flipper;
      if(flipper)
      {
        updatePanel.style.visibility="visible";
        deletePanel.style.visibility="visible";
      }else{
        updatePanel.style.visibility="hidden";
        deletePanel.style.visibility="hidden";
      }
   }
 </script>
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
    $ID = $_POST['cmbStudent'];
    $CourseID = $_POST['cmbCourse'];
    $query = "SELECT student.program_id FROM `student` WHERE student.student_id = :id LIMIT 1;";
    $statement = $connection->prepare($query);
    $statement->execute([":id" => $ID]);
 
    foreach($statement as $row)
    {
      $ProgramID = $row['program_id'];
      $insertQuery = "INSERT INTO `enrollmentlist` (`student_id`, `program_id`, `class_id`, `academic_year`) VALUES (:studid, :pid, :cid, year(curdate()));";
      $insertClassQuery = $connection->prepare($insertQuery);
      $insertClassQuery->execute(array(
        ":studid" => $ID,
       ":pid" => $ProgramID,
       ":cid" => $CourseID
      ));
    }
  echo "<script>alert(`Student enrolled!`);</script>";
  header("refresh: 5; url = index.php");
  }catch(PDOException $e)
  {
  echo "Error: ".$e->getMessage();
  }catch(Exception $e)
  {
    $e->getMessage();
  } 
}elseif(isset($_POST['btnUpdateCourseAssignment']))
{
  $OldCourse = $_POST['cmbOldCourse'];
  $NewCourse = $_POST['cmbNewCourse'];
  $ID = $_POST['cmbStudent'];
  try{
    $query="UPDATE `enrollmentlist` SET `class_id` = :newclass WHERE class_id = :oldclass AND student_id = :studid;";
    $statement=$connection->prepare($query);
    $statement->execute([
      ":newclass" => $NewCourse,
      ":oldclass" => $OldCourse,
      ":studid" => $ID
    ]);

    echo "<script>alert(`Student course updated!`);</script>";
    header("refresh: 3; url = program_assignment.php");
  }catch(Exception $e)
  {
    $e->getMessage();
  }
}elseif(isset($_POST['btnDeleteCourse']))
{
  try{
    $EnrollmentID = $_POST['cmbStudentCourse'];
    $query="DELETE from `enrollmentlist` WHERE enrollmentlist.enrollment_id = :id";
    $statement=$connection->prepare($query);
    $statement->execute([":id"=>$EnrollmentID]);
    echo "<script>alert(`Student Course assignment deleted!`);</script>";
    header("refresh: 3; url = program_assignment.php");
  }catch(Exception $e)
  {
    $e->getMessage();
  }
}
?>