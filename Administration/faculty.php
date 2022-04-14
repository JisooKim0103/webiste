<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>DMIS - Faculty Management</title>

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
        <input type="text" name="FirstName" class="form-control" placeholder="First Name" style="width:60%;" required/> </br>
        <input type="text" name="MiddleName" class="form-control" placeholder="Middle Name" style="width:60%;"/> </br>
        <input type="text" name="LastName" class="form-control" placeholder="Last Name" style="width:60%;" required/> </br>
        <input type="email" name="UserName" class="form-control" placeholder="SEC email address" style="width:60%;" required/> </br>
        <select name = "cmbDepartment" required = "true" class = "form-control"  style="width:60%;">
        <option value = "">Select Department</option>
        <?php
          $statement = $connection->prepare("SELECT * from department;");
          $statement->execute();
          foreach($statement as $row)
          {
            echo "<option value = '".$row['DepartmentID']."'>".$row['DepartmentName']."</option>";
          }
        ?>
        </select><br/>
        <input type="password" name="Password1" class="form-control" pattern = "(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" 
        title = "Password must be at least 8 characters including at least 1 of the following: Upper Case, Lower Case, Number, and Special Character"
        placeholder="Enter Password" style="width:60%;" required/> </br>
        <input type="password" name="Password2" class="form-control" pattern = "(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" 
        title = "Password must be at least 8 characters including at least 1 of the following: Upper Case, Lower Case, Number, and Special Character" placeholder="Re-enter Password" style="width:60%;"required/> </br>
        <button type="submit" name="btnRegisterFaculty" style="width:60%;" class="btn btn-info">
        <i class="fas fa-user-plus"></i>&nbsp;Add User
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
          <th>Account ID</th>
          <th>Department</th>
          <th>Actions</th>
          </tr>
        </thead>
          <tbody>
            <?php
              $statement = $connection->prepare("SELECT * from facultyusers
                inner join department on facultyusers.department_id = department.DepartmentID
               where usertype = 1;");
              $statement->execute();
              foreach($statement as $row)
              {
                echo "<tr>";
                echo "<td>".$row['FirstName']." ".$row['MiddleName']." ".$row['LastName']."</td>";
                echo "<td>".$row['UserName']."</td>";
                echo "<td>".$row['DepartmentName']."</td>";
                echo "<td><a href='faculty_info.php?userid=".$row['UserName']."' target='_blank'>View Info</a></td>";
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
  $Password1 = $_POST['Password1'];
  $Password2 = $_POST['Password2'];
  #Signature File
  // $sig_file_name = $_FILES['signature_file']['name'];
  // $sig_file_temp_loc = $_FILES['signature_file']['tmp_name'];
  // $sig_file_type = $_FILES['signature_file']['type'];
  // $sig_file_destination = "../user_signatures/".$sig_file_name;

  try{
    if(strpos($UserName, '@sec.edu.ph') !== false)
    {
      if($Password1==$Password2)
      {
        $query = "INSERT INTO facultyusers (FirstName,MiddleName,LastName,UserName,UserPass,date_registered,usertype, department_id)";
        $query .= "VALUES (:fname, :mname, :lname, :uname, :pword, now(), :usertype, :deptid);";
        $statement = $connection->prepare($query);
        $statement->execute(array(
            ":fname" => $FirstName,
            ":mname" => $MiddleName,
            ":lname" => $LastName,
            ":uname" => $UserName,
            ":pword" => $Password1,
            ":usertype" => 1,
            ":deptid" => $_POST['cmbDepartment']
        ));
    
        echo "<script>alert(`Faculty Registered!`);</script>";
    
        // move_uploaded_file($sig_file_temp_loc,$sig_file_destination);
        header("refresh: 5; url = faculty.php");
      }else{
       echo "<script>alert(`Password does not match!`);</script>";
      }
    }else{
      echo "<script>alert(`Email address isn't part of the EAC domain!`);</script>";
    }
   
  }catch(PDOException $e)
  {
  echo "Error: ".$e->getMessage();
  }catch(Exception $e)
  {
    $e->getMessage();
  }

  
}
?>