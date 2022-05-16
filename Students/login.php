<?php
ob_start();
session_start();
if(isset($_SESSION['logged_student'])){
   header("location: index.php");
}
include("../db/database.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SEC - Student Login</title>
      <link rel="stylesheet" href="../css/bootstrap.min.css">
      <link href="../css/general.css" rel="stylesheet">
      <style>
    button{
       width:100%;
    }
    </style>
</head>
<body>
    <div class="container-fluid">
      <div class="row">
       <div class = "col-md-4"></div>
       <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
         <h1 class="text-info text-center"><img src = "http://southeastern.com.ph/img/logo.png" height="50"/>Student Portal</h1><hr/>
         <form method="POST" class="form-group">
         <table>
         <tr>
            <th></th>
            <th></th>
         </tr>
            
            <tr>
               <td class="text-info font-weight-bold">Student Email</td>
               <td><input type="text" name="loginID" class="form-control mb-5 mt-5 ml-5" required="true"/></td>
            </tr>  
            <tr>
               <td><label class="text-info font-weight-bold">Password</label></td>
               <td><input type="password" name="loginPassword" class="form-control ml-5" required="true"/></td>
            </tr>
            <tr>
               <td class="text-info font-weight-bold">Student ID</td>
               <td><input type="password" name="studentID" class="form-control mb-5 mt-5 ml-5" required="true"/></td>
            </tr> 
            <tr>
               <td></td>
               <td><button type="submit" class="btn btn-info " name="btnLogin"><i class="fas fa-sign-in-alt"></i>&nbsp;Login</button></td>
            </tr>
         </table>    
         </form> 
        </div>
       <div class = "col-md-4"></div>
      </div>
      <div class="text-center">
         <a href="../">Return to Main Page</a>
      </div>
    </div>
    <?php include('footer.php');?>
</body>
</html>
<?php
if(isset($_POST['btnLogin']))
{
   try{
      $LoginID = $_POST['loginID'];
      $LoginPassword = $_POST['loginPassword'];
      $StudentID = $_POST['studentID'];
      $query = "SELECT `student_password` from student_credential where student_code = :uname AND student_id=:id;";
      $statement = $connection->prepare($query);
   
      $statement->execute(array(
         ":uname" => $LoginID,
         ":id" => $StudentID
      ));

      foreach($statement as $row)
      {
         if(password_verify($LoginPassword, $row['student_password'])){
            $_SESSION['logged_student'] = $LoginID;
            echo "<center class='text-success'>Login Sucess! Redirecting in few seconds..</center>";
            header("refresh:3; url = index.php");
         }else{
            echo "<center class = 'text-danger text-center'>Username or Password not found!</center>";
         }
      }
   }catch(Exception $e)
   {
      $e->getMessage();
   }
  

}
?>
