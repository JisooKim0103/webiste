<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SEC - Events Management</title>

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
 
  <h1 class = "text-center"><i class="fas fa-users-cog"></i>&nbsp;Events Management </h1>
  <hr/>

  <div class="row">
  <!-- Add Faculty -->
    <div class="col-sm-5 col-md-5 col-lg-5 col-xl-5" >
   
      <form method="POST" class="form-group" enctype="multipart/form-data">
        <h2>Add Event</h2>
        <input type="text" name="EventName" class="form-control" placeholder="Event Name" style="width:75%;" required/> </br>
        <textarea name="EventDescription" class="form-control" style="width:75%;" placeholder="Type event description here" required>
        </textarea><br/>
        <input type="date" name="EventDate" style="width:75%;" class="form-control" required/><br/>
        <button type="submit" name="btnAddEvent" style="width:75%;" class="btn btn-info">
        <i class="fas fa-calendar-plus"></i>&nbsp;Add Event
        </button>
      </form>
    </div>
    <!-- Faculty Table -->
    <div class="col-sm-7 col-md-7 col-lg-7 col-xl-7">
    <div class="table-responsive">
        <table class="table table-boredered" id = "table">
        <thead>
        <tr>
          <th>Event Name</th>
          <th>Description</th>
          <th>Event Date</th>
          <th>Event Duration</th>
          </tr>
        </thead>
          <tbody>
            <?php
              $statement = $connection->prepare("SELECT * FROM `schoolevent`;");
              $statement->execute();
              foreach($statement as $row)
              {
                echo "<tr>";
                echo "<td>".$row['event_name']."</td>";
                echo "<td>".$row['event_description']."</td>";
                echo "<td>".$row['event_date']."</td>";
                echo "<td>".$row['event_end']."</td>";
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
if(isset($_POST['btnAddEvent']))
{

    $Title = $_POST['EventName'];
    $Description = $_POST['EventDescription'];
    $Date = $_POST['EventDate'];

  try{
   
     
        $query = "INSERT INTO `schoolevent`(`event_name`,`event_description`,`event_date`,`datecreated`) VALUES (:title, :body, :eventdate, now());";
        $statement = $connection->prepare($query);
        $statement->execute(array(
            ":title" => $Title,
            ":body" => $Description,
            ":eventdate" => $Date
        ));

        echo "<script>alert(`Event Added!`); window.location.href='events.php';</script>";
  }catch(PDOException $e)
  {
  echo "Error: ".$e->getMessage();
  }catch(Exception $e)
  {
    $e->getMessage();
  }

  
}
?>