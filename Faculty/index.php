<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SEC - Dashboard</title>

  <!-- Bootstrap core CSS -->
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/style.css" rel="stylesheet">
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
    <img src = "http://southeastern.com.ph/img/logo.png" style="max-width:100%" height="100px" width="100px" class = "img-fluid rounded"/>
  </div>
  <div class="row">
    
  <div class="col-md-6">
    <h2>Course(s) teached</h2>
    <table>
      <thead>
        <tr></tr>
      </thead>
      <tbody>
        <tr></tr>
      </tbody>
    </table>
    </div>
    
    <div class="col-md-6">
      <h2>Events</h2>
      <div style="height: 250px; overflow: auto">
        <table class="table" >
        <thead>
          <tr>
            <th>Event</th>
            <th>Date</th>
          </tr>
        </thead>
        <tbody>
          <?php
              $query = "SELECT * from schoolevent;";
              $statement = $connection->prepare($query);
              $statement->execute();

              foreach($statement as $row)
              {
                echo "<tr>
                    <td>".$row['event_name']."</td>
                    <td>".$row['event_date']."</td>
                </tr>";
              }
          ?>
        </tbody>
      </table>  
      </div>
    </div>
  </div>

     
  </div>
  <!-- Bootstrap core JavaScript -->
 <?php include('footer.php');?>
</body>
</html>
