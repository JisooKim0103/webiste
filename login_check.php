<?php

$host = "localhost";
$user= "root"
$password ="";

$db="account_management1"

$data = mysqli_connect($host,$user,$password,$db);

if ($data===false)
{
	die("connection error");
}

/*if ($_SERVER["$_REQUEST_METHOD"]==POST)
{
	$name = $_POST['name'];

	$pass = $_POST['password'];

	$sql = "select * from user where username = ' ".$name."' AND 
		password = '".$pass."' ";

	$result=mysqli_query($data,$sql);

	$row=mysqli_fetch_array($result);

	if($row["usertype"]=="student")
	{
		header("location:HOME.html")
	}


	elseif($row["usertype"]=="admin")
	{
		header("location:HOME.html")
	}

	else 
	{
		echo "username or password do not match";
	}
}
*/
?>