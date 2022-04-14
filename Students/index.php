<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>DMIS - Dashboard</title>

  <!-- Bootstrap core CSS -->
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/general.css" rel="stylesheet">
</head>

<body>
  <?php 
  ob_start();
  include('session.php');
  include('header.php');
  include('../db/database.php');
  ?>

  <!-- Page Content -->
  <div class="container-fluid">

  <div class = "text-center">
<img src = "../assets/eacimg.jpg" style="max-width:100%" class = "img-fluid rounded"/>
</div>
  

      <div class = "fixed-bottom">
<!-- First Card Row -->
      <div class ="row mt-5">
        <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2">
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
        <!-- <h2 class="text-success"> </h2> -->
        <hr>
        <h3 class="text-center text-success"><a href="document.php" target="_blank" class = "btn btn-light">
        <?php
        $query = "SELECT COUNT(*) FROM filesubmissions;";
        $statement = $connection->query($query);
        echo $statement->fetchColumn();
        ?>
        <i class="fas fa-file-alt"></i>&nbsp;Document Submission(s)
        </a></h3>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
        <!-- <h2 class="text-warning"></h2> -->
        <hr>
        <h3 class="text-center text-success"><a href="backups.php" target="_blank" class = "btn btn-light">
        <?php
        $query = "SELECT COUNT(*) FROM activitylogs where activity = 'FILE BACKUP' and resolve = '';";
        $statement = $connection->query($query);
        echo $statement->fetchColumn();
        ?>
        <i class="far fa-question-circle"></i>&nbsp;Backup Request(s)
        </a></h3>
        </div>
        <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2">
        </div>
      </div>
      </div>
      </div>
  </div>
  <!-- Bootstrap core JavaScript -->
 <!-- <?php include('footer.php');?> -->
</body>
</html>
