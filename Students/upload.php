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

   //Transaction key generator
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
        <option value="1">Select Assignment</option>
      </select><br/>
      <label>URL Attachment:</label><br/>
      <input type="url" name="txtAttachmentLink" class="form-control" required/><br/>
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


?>