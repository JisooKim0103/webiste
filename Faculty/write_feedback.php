<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SEC - Assignment Feedback</title>

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
    $SubmissionID = $_GET['submission_id'];   
    if(empty($SubmissionID))
    {
        echo "<script>alert(`Assignment submission does not exist!`);window.location.href='documents.php';</script>";
    }
  ?>

  <!-- Page Content -->
  <div class="container-fluid">
  <h1>Submission Details</h1>
  <div class="row">
  <div class="col-md-4">
    </div>
    <div class="col-md-4">
      <form method="post">

      <div class="form-group">
      <?php
            $query = "SELECT assignment_submission.submission_id, course.course_code, assignment_submission.submission_link, student.firstname, student.lastname, assignment_submission.submission_date FROM `assignment_submission`
            inner join `student` on assignment_submission.student_id = student.student_id
            inner join `assignment` on assignment_submission.assignment_id = assignment.assignment_id
            inner join `course` on assignment.class_id = course.course_id 
            WHERE assignment.faculty_id = :id;
            ";
            $statement = $connection->prepare($query);
            $statement->execute([":id"=>$ID]);
            foreach($statement as $row)
            {
              echo "<b>Course Code: ".$row['course_code']."</b><br/>Submitted by: <u>".$row['lastname'].", ".$row['firstname']." on ".$row['submission_date']."</u>";
              echo "<br/><b>Submission link: </b><a href='".$row['submission_link']."' target='_blank'>".$row['submission_link']."</a>";
            }
          ?>
      </div>
      <label>Feedback/Comments</label>
      <div class="form-group">
        <!-- <input type="text" name="txtFeedback" class="form-control" style="width: 75%;" placeholder="Write feedback.."/>  -->
        <textarea name="txtFeedback" class="form-control" style="width: 75%;" row=10 cols=50 required></textarea>
      </div>
      <button type="submit" class="btn btn-info" name="btnWriteFeedback" style="width: 75%;">&nbsp;Write Feedback</button>
      </form>
    </div>
    <div class="col-md-4">
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
<?php
if(isset($_POST['btnWriteFeedback']))
{
  try{
    $SubmissionID = $SubmissionID;
    $Feedback = $_POST['txtFeedback'];
    $query = "UPDATE `assignment_submission` SET feedback = :feedback WHERE submission_id = :id;";
    $statement = $connection->prepare($query);
    $statement->execute([
      ":feedback" => $Feedback,
      ":id" => $SubmissionID
    ]);
    echo "<script>alert(`Feedback added!`);window.location.href='documents.php';</script>";
  }catch(Exception $e)
  {
    $e->getMessage();
  }

}
?>

</body>
</html>
