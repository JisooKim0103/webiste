<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SEC - Assignments</title>

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
  include("../db/database.php");
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
    <div class = "row">
    <!-- First Column -->
    <div class = "col-md-4">
       <h1><i class="fas fa-tasks"></i>&nbsp;Add Assignment</h1>
    <hr/>
    <form method="POST">
    <label>Select Course/Section</label>
    <div class="form-group">
        <select name="cmbCurrentCourse" class="form-control">
            <option value="">Select Course/Section</option>
            <?php
                $sqlCoursesHandledQuery = "SELECT course.course_id, course.course_code, program.program_code from `course`
                INNER JOIN `program` ON course.program_id = program.program_id
                INNER JOIN `course_handled` ON course_handled.course_id = course.course_id
                WHERE course_handled.faculty_id = :id;";
                $statement = $connection->prepare($sqlCoursesHandledQuery);
                $statement->execute([":id" => $ID]);
                foreach($statement as $row)
                { 
                    echo "<option value='".$row['course_id']."'>".$row['course_code']." / ".$row['program_code']."</option>";
                }
            ?>
        </select>
    </div>
    <label>Title</label>
      <div class="form-group">
          <input type="text" name="txtTitle" class="form-control" placeholder="Enter Assignment title" required/>
      </div>
    <label>Description</label>
      <div class="form-group">
        <input type="text" name="txtDescription" class="form-control" placeholder="Enter Assignment instructions" required/>
      </div>
    <label>Date of Submission</label>
      <div class="form-group">
        <input type="date" name="txtDateOfSubmission" class="form-control" required/>
      </div> 
    <div class="form-group">
        <button type="submit" name="btnAddAssignment" class="btn btn-info" style="width:100%;"><i class="fas fa-chevron-circle-up"></i>&nbsp;Add Assignment</button>
    </div>
    </form>
    <!-- Update form   -->
    <div class="form-group">
    <button type="button" id="btnShowUpdate" onclick="flipPanel();" class="btn btn-outline-warning" style="width:100%;">
        <i class="fas fa-exchange-alt"></i>&nbsp;Change Assignment</button>
    </div>
    <form method="post" id="updatePanel">
      <label>Select Assignment</label>
      <div class="form-group">
        <select name="cmbAssignmentID" class="form-control">
          <option value="">Select Assignment</option>
        <?php
          $query="SELECT assignment.assignment_id, assignment.title FROM `assignment` INNER JOIN `faculty` on assignment.faculty_id = faculty.faculty_id where faculty.faculty_id=:id;";
          $statement=$connection->prepare($query);
          $statement->execute([":id"=>$ID]);
          foreach($statement as $row)
          {
            echo "<option value='".$row['assignment_id']."'>".$row['title']."</option>";
          }
        ?>
        </select>
      </div>
      <label>Updated Description</label>
      <div class="form-group">
        <input type="text" name="txtUpdateDescription" class="form-control" placeholder="Enter Assignment instructions" required/>
      </div>
    <label>Updated Date of Submission</label>
      <div class="form-group">
        <input type="date" name="txtUpdateDateOfSubmission" class="form-control" required/>
      </div> 
    <div class="form-group">
      <button type="submit" class="btn btn-warning" style="width: 100%;" name="btnUpdateAssignment"><i class="fas fa-pen-alt"></i>&nbsp;Update Assignment</button>
    </div>
    </form>
    <!--End of Update Form-->
    </div>
    <!-- Second Column -->
    <div class="col-md-8">
        <h1>Assignment Listings</h1><br/>
    <table id="table" class="table">
            <thead>
                <th>Assignment Title</th>
                <th>Instructions</th>
                <th>Submission Date</th>
            </thead>
            <tbody>
                <?php
                    $showAssignmentQuery="SELECT assignment.title, assignment.description, assignment.submission_date from `assignment` where assignment.faculty_id = :id;";
                    $query_showAssignment = $connection->prepare($showAssignmentQuery);
                    $query_showAssignment->execute(array(
                        ":id" => $ID
                    ));
                    foreach($query_showAssignment as $row)
                    {
                        echo "<tr>
                            <td>".$row['title']."</td>
                            <td>".$row['description']."</td>
                            <td>".$row['submission_date']."</td>
                        </tr>";
                    }
                    
                ?>
            </tbody>
        </table>
    </div>
  </div>

  <!-- Bootstrap core JavaScript -->
  <?php include('footer.php');?>
  <script>
   updatePanel.style.visibility="hidden";
   let flipper = false;
   function flipPanel()
   {
      flipper = !flipper;
      if(flipper)
      {
        updatePanel.style.visibility="visible";
      }else{
        updatePanel.style.visibility="hidden";
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
 
if(isset($_POST['btnAddAssignment']))
{
  try{
     $Course = $_POST['cmbCurrentCourse'];
     $Title = $_POST['txtTitle'];
     $Description = $_POST['txtDescription'];
     $SubmissionDate = $_POST['txtDateOfSubmission'];

     $query = "INSERT INTO `assignment` (`title`, `description`,`faculty_id`, `class_id`, `submission_date`, `date_created`)";
     $query .= "VALUES(:title, :details, :id, :courseid, :submissiondate, now());";
     $statement = $connection->prepare($query);
     $statement->execute(array(
         ":title" => $Title,
         ":details" => $Description,
         ":courseid" => $Course,
         ":submissiondate" => $SubmissionDate,
         ":id" => $ID
     ));
     echo "<script>alert(`Assignment added!`);window.location.href='index.php';</script>";
  }catch(Exception $e)
  {
    $e->getMessage();
  } 
}elseif(isset($_POST['btnUpdateAssignment']))
{
  try{
    $AssigmentID = $_POST['cmbAssignmentID'];
    $UpdateDescription = $_POST['txtUpdateDescription'];
    $UpdateSubmissionDate = $_POST['txtUpdateDateOfSubmission'];

    $query = "UPDATE `assignment` SET assignment.description = :assigndesc, assignment.submission_date = :subdate WHERE assignment.assignment_id = :assignid;";
    $statement = $connection->prepare($query);
    $statement->execute([
      ":assigndesc" => $UpdateDescription,
      ":subdate" => $UpdateSubmissionDate,
      ":assignid" => $AssigmentID
    ]);

    echo "<script>alert(`Assignment updated!`);window.location.href='assignments.php';</script>";
  }catch(Exception $e)
  {
    $e->getMessage();
  }
}
?>
