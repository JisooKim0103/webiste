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
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
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
    <div class = "col-md-4">
    
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
    <input type="password" class="form-control"  style="width:100%;" name="OriginalPassword" required placeholder='Enter Original Password'/><br>
      <input type="password" class="form-control mt-2" name="Password1" pattern = "(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" 
              title = "Password must be at least 8 characters including at least 1 of the following: Upper Case, Lower Case, Number, and Special Character" style="width:100%;" required placeholder='Enter New Password'/><br/>
      <input type="password" class="form-control" name="Password2" pattern = "(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" 
              title = "Password must be at least 8 characters including at least 1 of the following: Upper Case, Lower Case, Number, and Special Character" style="width:100%;" required placeholder='Re-type new Password'/><br/>
      <button name="btnUpdate" type="submit" class="btn btn-info" style="width:100%;"><i class="fas fa-pen-alt"></i>&nbsp;Update Info</button>
        </div>
    </form>
    </div>
    <div class = "col-md-8">
    <h1>Courses Enrolled</h1>  
    <table class="table" id="studentEnrolledTable">
      <thead>
          <tr>
            <th>Course enrolled</th>
            <th>Instructor Name</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $query = "SELECT course.course_code, course.course_description, faculty.firstname, faculty.lastname from `course` 
            inner join `enrollmentlist` on course.course_id = enrollmentlist.class_id 
            inner join `course_handled` on course.course_id = course_handled.course_id 
            inner join `program` on course.program_id = program.program_id 
            inner join `faculty` on faculty.faculty_id = course_handled.faculty_id 
            WHERE enrollmentlist.student_id = :id";
            $statement = $connection->prepare($query);
            $statement->execute([":id"=> $_GET['userid']]);
            foreach($statement as $row)
            {
              echo "<tr>
                <td>".$row['course_code']."/".$row['course_description']."</td>
                <td>".$row['lastname'].", ".$row['firstname']."</td>
              </tr>";
            }
          ?>
        </tbody>
      </table>
    </div>
    </div>
 </div>
 <?php include('footer.php');?>
 <script>
$(document).ready( function () {
    $('#studentEnrolledTable').DataTable();
} );
</script>
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
        echo "<script>alert(`Student updated!`);window.location.href='student.php';</script>";
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