<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>DMIS - Faculty Info</title>
  <!-- Bootstrap core CSS -->
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/general.css" rel="stylesheet">
</head>
<body>
<?php 
if(empty($_GET))
{
    header('Location: faculty.php');
}
  ob_start();
  include('session.php');
  include('header.php');
  include("../db/database.php");
?>

 <!-- Page Content -->
 <div class="container-fluid">
    <div class = "row">
    <div class = "col-md-3"></div>
    <div class = "col-md-6">
    
<form class="form-group" method="post">
<h2 class = "text-center"><i class="fas fa-user-cog"></i>&nbsp;Faculty Info</h2><hr style="width:100%"/>
    <?php
        $statement = $connection->prepare("SELECT * from facultyusers where UserName =:username;");

        $statement->execute(array(
            ":username" => $_GET['userid']
        ));

        foreach($statement as $row)
        {
            echo "<input type='text' class='form-control' style='width:100%;' name='FirstName' value='".$row['FirstName']."' required placeholder='Enter First Name'><br>";
            echo "<input type='text' class='form-control' style='width:100%;' name='MiddleName' value='".$row['MiddleName']."' placeholder='Enter Middle Name'/><br>";
            echo "<input type='text' class='form-control' style='width:100%;' name='LastName' value='".$row['LastName']."' required placeholder='Enter Last Name'/><br>";
            // echo "<img src ='../user_signatures/".$row['faculty_signature']."' class='img-responsive' height='150' width='300'/>";
        }
    ?>
<input type="password" class="form-control" name="Password1" pattern = "(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" 
        title = "Password must be at least 8 characters including at least 1 of the following: Upper Case, Lower Case, Number, and Special Character" style="width:100%;" required placeholder='Enter New Password'/><br/>
<input type="password" class="form-control" name="Password2" pattern = "(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" 
        title = "Password must be at least 8 characters including at least 1 of the following: Upper Case, Lower Case, Number, and Special Character" style="width:100%;" required placeholder='Re-type new Password'/><br/>
<button name="btnUpdate" type="submit" class="btn btn-info" style="width:100%;"><i class="fas fa-pen-alt"></i>&nbsp;Update Info</button>
</form>

<!-- <form method="post">
<input type="hidden" name = "UserName" value="<?php echo $_GET['userid']; ?>"/>
<button name="btnDelete" type="submit" class="btn btn-danger" style="width:100%;"><i class="fas fa-user-times"></i>&nbsp;Delete Info</button>
</form> -->
    </div>
    <div class = "col-md-3"></div>
    </div>
 </div>
 <?php include('footer.php');?>
</body>
</html>
<?php
if(isset($_POST['btnUpdate']))
{
 $FirstName = $_POST['FirstName'];
  $MiddleName = $_POST['MiddleName'];
  $LastName = $_POST['LastName'];
  $UserName = $_GET['userid'];
  $Password1 = $_POST['Password1'];
  $Password2 = $_POST['Password2'];

  if($Password1==$Password2)
  {
    try{
      $query = "UPDATE facultyusers set FirstName= :fname, MiddleName= :mname, LastName = :lname, UserPass = :pword where UserName = :uname;";
      $statement = $connection->prepare($query);
      $statement->execute(array(
          ":fname" => $FirstName,
          ":mname" => $MiddleName,
          ":lname" => $LastName,
          ":pword" => $Password1,
          ":uname" => $UserName
      ));
  
      echo "<h3 class='text-success'>Faculty Updated!</h3>";
      header("refresh:3; url = faculty.php");
    }catch(Exception $e)
    {
      $e->getMessage();
    }
   

  }else{
   echo "<h3 class='text-danger'>Password does not match!</h2>";
  }
}

if(isset($_POST['btnDelete'])){
    $UserName = $_GET['userid'];

    try{
      $statement = $connection->prepare("DELETE from facultyusers where UserName = :uname;");
      $statement->execute(array(
        ":uname" => $UserName
      ));
  
      echo "<h3 class='text-success'>User deleted!</h3>";
      header("refresh:3; url = faculty.php");
    }catch(Exception $e)
    {
      $e->getMessage();
    }
  
}
?>