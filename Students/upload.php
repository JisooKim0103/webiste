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
  <div class="container-fluid center">
  <div class = "row">
    <div class = "col-md-4"></div>
    <div class = "com-md-4">
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
            WHERE enrollmentlist.student_id = :id;
          ";
          $assignment_queryStatement = $connection->prepare($assignment_query);
          $assignment_queryStatement->execute(array(
            ":id" => $ID
          ));
          foreach($assignment_queryStatement as $assignment)
          {
            echo "<option value='".$assignment['assignment_id']."'>".$assignment['title']."/".$assignment['course_code']."</option>";
          }
        ?>
      </select><br/>
      <label>URL Attachment:</label><br/>
      <input type="url" name="txtAttachmentLink" class="form-control" placeholder="Enter submission link" required/><br/>
      <button name="btnSubmitAssignment" class="btn btn-info" type="submit">Submit Assignment</button>
    </form>
    </div>
    <div class = "col-md-4"></div>
  </div>

  

  </div>

  <!-- Bootstrap core JavaScript -->
  <?php include('footer.php');?>

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
  
    echo "<div class='text-center text-info'>Assignment submitted!</div>";
    header("refresh:3; url=index.php");
  }catch(Exception $e)
  {
    $e->getMessage();
  }
}

?>