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
    <title>DMIS - Student Login</title>
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
         <h1 class="text-danger text-center"><img src = "https://eac.edu.ph/wp-content/uploads/2018/10/emblem.png" height="50"/>Administration Portal</h1><hr/>
         <form method="POST" class="form-group">
         <table>
         <tr>
            <th></th>
            <th></th>
         </tr>
            <tr>
               <td>Student ID</td>
               <td><input type="text" name="loginID" class="form-control mb-5 mt-5 ml-5" required="true"/></td>
            </tr>  
            <tr>
               <td><label>Password</label></td>
               <td><input type="password" name="loginPassword" class="form-control ml-5" required="true"/></td>
            </tr>
            <tr>
               <td></td>
               <td><button type="submit" class="btn btn-info mt-5 ml-5" name="btnLogin"><i class="fas fa-sign-in-alt"></i>&nbsp;Login</button></td>
            </tr>
         </table>    
         </form> 
        </div>
       <div class = "col-md-4"></div>
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
      $query = "SELECT COUNT(student_code) from student_credential where student_code = :uname and student_password = :pword;";
      $statement = $connection->prepare($query);
   
      $statement->execute(array(
         ":uname" => $LoginID,
         ":pword" => $LoginPassword
      ));
   
      $result = $statement->fetchColumn();
   
      if($result==1)
      {
         $_SESSION['logged_student'] = $LoginID;
         echo "<center class='text-success'>Login Sucess! Redirecting in few seconds..</center>";
         header("refresh:3; url = index.php");
      }else{
         echo "<center class = 'text-danger text-center'>Username or Password not found!</center>";
      }
   }catch(Exception $e)
   {
      $e->getMessage();
   }
  

}
?>