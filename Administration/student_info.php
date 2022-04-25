<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>SEC - Student Info</title>
  <!-- Bootstrap core CSS -->
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/general.css" rel="stylesheet">
</head>
<body>
<?php 
if(empty($_GET))
{
    header('Location: student.php');
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
    <h2 class = "text-center"><i class="fas fa-user-cog"></i>&nbsp;Student Info</h2><hr style="width:100%"/>
    <?php
        $statement = $connection->prepare("SELECT 
        student.firstname, student.middlename, student.lastname,
        student.program_id,  student_credential.student_password
        from `student_credential` 
        inner join `student` on
          student.student_id = student_credential.student_logid
        where student.student_id =:username;");

        $statement->execute(array(
            ":username" => $_GET['userid']
        ));

        foreach($statement as $row)
        {
            echo "<input type='text' class='form-control' style='width:100%;' name='FirstName' value='".$row['firstname']."' required placeholder='Enter First Name'><br>";
            echo "<input type='text' class='form-control' style='width:100%;' name='MiddleName' value='".$row['middlename']."' placeholder='Enter Middle Name'/><br>";
            echo "<input type='text' class='form-control' style='width:100%;' name='LastName' value='".$row['lastname']."' required placeholder='Enter Last Name'/><br>";
            echo "<input type='password' class='form-control' style='width:100%;' name='OriginalPassword' value='".$row['student_password']."' readonly required placeholder='Enter Original Password'/><br>";
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
      <input type="password" class="form-control mt-2" name="Password1" pattern = "(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" 
              title = "Password must be at least 8 characters including at least 1 of the following: Upper Case, Lower Case, Number, and Special Character" style="width:100%;" required placeholder='Enter New Password'/><br/>
      <input type="password" class="form-control" name="Password2" pattern = "(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" 
              title = "Password must be at least 8 characters including at least 1 of the following: Upper Case, Lower Case, Number, and Special Character" style="width:100%;" required placeholder='Re-type new Password'/><br/>
      <button name="btnUpdate" type="submit" class="btn btn-info" style="width:100%;"><i class="fas fa-pen-alt"></i>&nbsp;Update Info</button>
      </form>
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
  $ProgramID = $_POST['cmbProgram'];
  $OriginalPassword = $_POST['OriginalPassword'];
  $Password1 = $_POST['Password1'];
  $Password2 = $_POST['Password2'];

  if(!empty($OriginalPassword))
  {
    if($Password1==$Password2)
    {
      try{
        $query = "UPDATE `student_credential` SET student_password = :pword
         where student_logid = :uname;";
        $statement = $connection->prepare($query);
        $statement->execute(array(
            ":pword" => $Password1,
            ":uname" => $UserName
        ));

        $updateStudentStatement = $connection->prepare("UPDATE `student` SET  firstname = :fname, middlename = :mname, lastname = :lname,
        program_id = :programid WHERE student_id = :uname;");
        $updateStudentStatement->execute(array(
          ":fname" => $FirstName,
          ":mname" => $MiddleName,
          ":lname" => $LastName,
          ":programid" => $ProgramID,
          ":uname" => $UserName
        ));
        echo "<h3 class='text-center text-success'>Student credentials Updated!</h3>";
        header("refresh:3; url = student.php");
      }catch(Exception $e)
      {
        $e->getMessage();
      }
    }else{
     echo "<h3 class='text-danger'>Passwords does not match!</h2>";
    }
  }
  
}
?>