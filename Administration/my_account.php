<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>DMIS - My Profile</title>

  <!-- Bootstrap core CSS -->
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/style.css" rel="stylesheet">
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
  <div class = "row">
    <div class = "col-md-4"></div>
    <div class = "col-md-4">
    <h1><i class="far fa-address-card"></i>&nbsp;Update Profile</h1>
    <hr/>
    <form method="POST" class="form-group">
      <label for="">Enter New Password</label><br/>
      <input type="password" name="new_password1" class="form-control" required="true" placeholder="Enter New Password"/>
       <br/>
       <label for="">Re-enter New Password</label><br/>
       <input type="password" name="new_password2" class="form-control" required="true" placeholder="Re-type New Password"/>
       <br/>
       <button type="submit" name="btnUpdate" class="btn btn-info" style="width:100%;"><i class="fas fa-chevron-circle-up"></i>&nbsp;Update Account</button>
    </form>
    </div>
    <div class = "col-md-4"></div>
  </div>
  </div>

  <!-- Bootstrap core JavaScript -->
  <?php include('footer.php');?>

</body>

</html>
<?php
if(isset($_POST['btnUpdate']))
{
  try{
    $NewPassword1 = $_POST['new_password1'];
    $NewPassword2 = $_POST['new_password2'];
    if($NewPassword1==$NewPassword2)
    {
     $statement = $connection->prepare("UPDATE `web_admin` set `adminpass` = :pword where `admincode` = :uname;");
     $statement->execute(array(
       ":pword" => $NewPassword1,
       ":uname" => $_SESSION['logged_admin']
     ));
     echo "Password updated";
     header("refresh:3; url=index.php");
    }else{
     echo "Password does not match!";
    }
  }catch(Exception $e)
  {
    $e->getMessage();
  } 
}
?>
