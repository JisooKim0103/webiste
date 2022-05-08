<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SEC - Faculty Management</title>

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
 
  <h1 class = "text-center"><i class="fas fa-users-cog"></i>&nbsp;Faculty Management </h1>
  <hr/>

  <div class="row">
  <!-- Add Faculty -->
    <div class="col-sm-5 col-md-5 col-lg-5 col-xl-5" >
   
      <form method="POST" class="form-group" enctype="multipart/form-data">
        <h2>Add Teacher</h2>
        <input type="text" name="SchoolID" class="form-control" placeholder="Employee ID" style="width:60%;" required/> </br>
        <input type="text" name="FirstName" class="form-control" placeholder="First Name" style="width:60%;" required/> </br>
        <input type="text" name="MiddleName" class="form-control" placeholder="Middle Name" style="width:60%;"/> </br>
        <input type="text" name="LastName" class="form-control" placeholder="Last Name" style="width:60%;" required/> </br>
        <input type="email" name="UserName" class="form-control" placeholder="SEC email address" style="width:60%;" required/> </br>
        <select name = "cmbDepartment" required = "true" class = "form-control"  style="width:60%;">
        <option value = "">Select Department</option>
        <?php
         $statement = $connection->prepare("SELECT * from program;");
         $statement->execute();
         foreach($statement as $row)
         {
           echo "<option value = '".$row['program_id']."'>".$row['program_code']."</option>";
         }
        ?>
        </select><br/>
        <button type="submit" name="btnRegisterFaculty" style="width:60%;" class="btn btn-info">
        <i class="fas fa-user-plus"></i>&nbsp;Add Faculty
        </button>
      </form>
    </div>
    <!-- Faculty Table -->
    <div class="col-sm-7 col-md-7 col-lg-7 col-xl-7">
    <div class="table-responsive">
        <table class="table table-boredered" id = "table">
        <thead>
        <tr>
          <th>Faculty Name</th>
          <th>Department</th>
          <th>Actions</th>
          </tr>
        </thead>
          <tbody>
            <?php
              $statement = $connection->prepare("SELECT faculty.faculty_id, faculty.firstname, faculty.lastname, faculty.middlename, program.program_code as `DepartmentName` FROM `faculty` 
              inner join program
              on faculty.department = program.program_id;");
              $statement->execute();
              foreach($statement as $row)
              {
                echo "<tr>";
                echo "<td>".$row['firstname']." ".$row['middlename']." ".$row['lastname']."</td>";
                echo "<td>".$row['DepartmentName']."</td>";
                echo "<td><a href='faculty_info.php?userid=".$row['faculty_id']."' target='_blank'>View Info</a></td>";
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
if(isset($_POST['btnRegisterFaculty']))
{
  $FirstName = $_POST['FirstName'];
  $MiddleName = $_POST['MiddleName'];
  $LastName = $_POST['LastName'];
  $UserName = $_POST['UserName'];
  $DeptID = $_POST['cmbDepartment'];
  $SchoolID = $_POST['SchoolID'];

  try{

        $query = "INSERT INTO `faculty`(`firstname`, `middlename`, `lastname`, `department`, `program_id`, `date_created`)";
        $query .= "VALUES (:fname, :mname, :lname, :deptid, :deptid, now());";
        $statement = $connection->prepare($query);
        $statement->execute(array(
            ":fname" => $FirstName,
            ":mname" => $MiddleName,
            ":lname" => $LastName,
            ":deptid" => $DeptID
        ));
    
        $query_second = "INSERT INTO `faculty_credential` (`faculty_code`, `faculty_password`, `faculty_id`)";
        $query_second .= "VALUES (:uname, :upass, :uid);";
        $statement_second = $connection->prepare($query_second);
        $statement_second->execute(array(
          ":uname" => $UserName,
          ":upass" => PASSWORD_HASH($SchoolID, PASSWORD_BCRYPT),
          ":uid" => $SchoolID
        ));

        echo "<script>alert(`Faculty added!`);window.location.href='faculty.php';</script>";
  }catch(PDOException $e)
  {
  echo "Error: ".$e->getMessage();
  }catch(Exception $e)
  {
    $e->getMessage();
  }

  
}
?>