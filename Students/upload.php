<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SEC - Upload Assignment</title>

  <!-- Bootstrap core CSS -->
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/general.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
</head>

<body>
<?php 
   ob_start();
  //  declare(strict_types=1);

  
   include('session.php');
   include('header.php');
   include("../db/database.php");
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
  <div class = "row">
    <div class = "col-md-4">
    <h1><i class="fas fa-upload"></i>&nbsp;Upload Assignment</h1>
    <hr/>
    <form method="post" class="form-group" enctype="multipart/form-data">
      <label>Assignment Date and Topic:</label><br/>
      <select name="cmbAssignmentTopic" class="form-control" required>
        <option value="">Select Assignment</option>
        <?php
          $assignment_query = "SELECT 
            assignment.assignment_id, assignment.title, course.course_code  from `assignment` INNER JOIN `enrollmentlist` on
            assignment.class_id = enrollmentlist.class_id 
            INNER JOIN `course` on
            assignment.class_id = course.course_id
            WHERE enrollmentlist.student_id = :id and assignment.submission_date >= now();";
          $assignment_queryStatement = $connection->prepare($assignment_query);
          $assignment_queryStatement->execute(array(
            ":id" => $ID
          ));
          foreach($assignment_queryStatement as $assignment)
          {
            echo "<option value='".$assignment['assignment_id']."'>".$assignment['title']."-".$assignment['course_code']."</option>";
          }
        ?>
      </select><br/>
      <label>URL Attachment:</label><br/>
      <input type="url" name="txtAttachmentLink" class="form-control" placeholder="Enter submission link" required/><br/>
      <button name="btnSubmitAssignment" class="btn btn-info" type="submit">Submit Assignment</button>
    </form>
    </div>
    <div class = "col-md-8">
      <h1>Assignment Listings</h1>
          <table id="tableAssignment" class="table">
            <thead>
              <tr>
                <td>Course</td>
                <td>Instruction</td>
                <td>Submission Date</td>
                <td>Feedback/Comments</td>
              </tr>
            </thead>
            <tbody>
            <?php
              $assignment_query = "SELECT 
                course.course_code, assignment.description, assignment.submission_date, assignment_submission.feedback  from `assignment` INNER JOIN `enrollmentlist` on
                assignment.class_id = enrollmentlist.class_id 
                INNER JOIN `course` on assignment.class_id = course.course_id
                INNER JOIN `assignment_submission` on assignment_submission.assignment_id = assignment.assignment_id
                WHERE enrollmentlist.student_id = :id;
              ";
              $assignment_queryStatement = $connection->prepare($assignment_query);
              $assignment_queryStatement->execute(array(
                ":id" => $ID
              ));
              foreach($assignment_queryStatement as $assignment)
              {
                echo "<tr>
                  <td>".$assignment['course_code']."</td>
                  <td>".$assignment['description']."</td>
                  <td>".$assignment['submission_date']."</td>
                  <td>".$assignment['feedback']."</td>
                </tr>";
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
    $('#tableAssignment').DataTable();
} );
</script>
</body>
</html>
<?php
if(isset($_POST['btnSubmitAssignment']))
{
  try{
    $AssignmentID = $_POST['cmbAssignmentTopic'];
    $AssignmentLink = $_POST['txtAttachmentLink'];
    $SubmittedBy = $_SESSION['logged_student'];
  
    $query = "INSERT INTO `assignment_submission`(`assignment_id`, `student_id`, `submission_link`, `submission_date`)";
    $query .= "VALUES (:assignid, :studid, :link, now());";
    $statement=$connection->prepare($query);
    $statement->execute(array(
      ":assignid" => $AssignmentID,
      ":studid" => $ID,
      ":link" => $AssignmentLink
    ));
  
    echo "<script>alert(`Assignment uploaded!`);window.location.href='upload.php';</script>";
  }catch(Exception $e)
  {
    $e->getMessage();
  }
}

?>