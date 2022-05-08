<?php
ob_start();
session_start();
if(isset($_SESSION['logged_faculty'])){
   header("location: index.php");
}
include("../db/database.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SEC - Faculty Login</title>
      <link rel="stylesheet" href="../css/bootstrap.min.css">
      <link href="../css/style.css" rel="stylesheet">
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
         <h1 class="text-info text-center"><img src = "http://southeastern.com.ph/img/logo.png" height="50"/>Faculty Portal</h1><hr/>
         <form method="POST" class="form-group">
         <table>
         <tr>
            <th></th>
            <th></th>
         </tr>
            <tr>
               <td class="text-info font-weight-bold">Faculty ID</td>
               <td><input type="text" name="loginID" class="form-control mb-5 mt-5 ml-5" required="true"/></td>
            </tr>  
            <tr>
               <td><label class="text-info font-weight-bold">Password</label></td>
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
      $query = "SELECT `faculty_password` from faculty_credential where faculty_code = :uname LIMIT 1;";
      $statement = $connection->prepare($query);
   
      $statement->execute(array(
         ":uname" => $LoginID
      ));
   
      foreach($statement as $row)
      {
         if(password_verify($LoginPassword, $row['faculty_password'])){
            $_SESSION['logged_faculty'] = $LoginID;
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