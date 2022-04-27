<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>SEC - Faculty Info</title>
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
        $statement = $connection->prepare("SELECT 
        faculty.firstname, faculty.middlename, faculty.lastname, faculty_credential.faculty_password 
        from `faculty` 
        inner join `faculty_credential` 
        ON faculty.faculty_id = faculty_credential.faculty_logid
        where faculty.faculty_id =:username;");

        $statement->execute(array(
            ":username" => $_GET['userid']
        ));

        foreach($statement as $row)
        {
            echo "<input type='text' class='form-control' style='width:100%;' name='FirstName' value='".$row['firstname']."' required placeholder='Enter First Name'><br>";
            echo "<input type='text' class='form-control' style='width:100%;' name='MiddleName' value='".$row['middlename']."' placeholder='Enter Middle Name'/><br>";
            echo "<input type='text' class='form-control' style='width:100%;' name='LastName' value='".$row['lastname']."' required placeholder='Enter Last Name'/><br>";
        }
        $program_query = "SELECT * from `program`;";
         $program_query_statement = $connection->prepare($program_query);
         $program_query_statement->execute();
        
         echo "<select name ='cmbProgram' class='form-control' required>";
         echo "<option value=''>Select Program</option>";
         foreach($program_query_statement as $row)
         {
          echo "<option value='".$row['program_id']."'>".$row['program_code']."</option>";
         }
         echo "</select><br/>";
    ?>
    <div class="text-center">
      <button type="button" class="btn btn-outline-primary" onclick="flipPanel()">Update Account</button>
    </div>
    <br/>
    <div id="updatePanel">  
    <input type="password" class="form-control" style="width:100%;" name="OriginalPassword" required placeholder="Enter Original Password"/><br/>
      <input type="password" class="form-control" name="Password1" pattern = "(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" 
              title = "Password must be at least 8 characters including at least 1 of the following: Upper Case, Lower Case, Number, and Special Character" style="width:100%;" required placeholder='Enter New Password'/><br/>
      <input type="password" class="form-control" name="Password2" pattern = "(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" 
              title = "Password must be at least 8 characters including at least 1 of the following: Upper Case, Lower Case, Number, and Special Character" style="width:100%;" required placeholder='Re-type new Password'/><br/>
      <button name="btnUpdate" type="submit" class="btn btn-info" style="width:100%;"><i class="fas fa-pen-alt"></i>&nbsp;Update Info</button>
      </div>  
    </form>

    </div>
    <div class = "col-md-3"></div>
    </div>
 </div>
 <?php include('footer.php');?>
 <script>
   updatePanel.style.visibility="hidden";
   let flipper = false;
   console.log(flipper);
   function flipPanel()
   {
      flipper = !flipper;
      if(flipper)
      {
        updatePanel.style.visibility="visible";
        console.log(`${flipper} after visible`);
      }else{
        updatePanel.style.visibility="hidden";
        console.log(`${flipper} after hidden`);
      }
   }
 </script>
</body>
</html>
<?php
if(isset($_POST['btnUpdate']))
{
  $FirstName = $_POST['FirstName'];
  $MiddleName = $_POST['MiddleName'];
  $LastName = $_POST['LastName'];
  $UserName = $_GET['userid'];
  $ProgramID = $_POST['cmbProgram'];
  $OriginalPassword = $_POST['OriginalPassword'];
  $Password1 = $_POST['Password1'];
  $Password2 = $_POST['Password2'];

  if(!empty($OriginalPassword))
  {
    if($Password1==$Password2)
    {
      try{
        $query = "UPDATE `faculty_credential` set `faculty_password`= :pword where `faculty_logid` = :uname;";
        $statement = $connection->prepare($query);
        $statement->execute(array(
            ":pword" => $Password1,
            ":uname" => $UserName
        ));
        $updateFacultyStatement = $connection->prepare("UPDATE `faculty` SET  firstname = :fname, middlename = :mname, lastname = :lname,
        department = :programid WHERE faculty_id = :uname;");
        $updateFacultyStatement->execute(array(
          ":fname" => $FirstName,
          ":mname" => $MiddleName,
          ":lname" => $LastName,
          ":programid" => $ProgramID,
          ":uname" => $UserName
        ));
        echo "<h3 class='text-center text-success'>Faculty credentials Updated!</h3>";
        header("refresh:3; url = faculty.php");
      }catch(Exception $e)
      {
        $e->getMessage();
      }
    }else{
    echo "<h3 class='text-danger'>Password does not match!</h2>";
    }
  }
  
}
?>