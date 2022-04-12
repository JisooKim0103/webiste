<?

$firstname = $_POST['name'];
$yrandcourse = $_POST['yrandcourse'];
$email = $_POST['email'];
$phonenumber = $_POST['phonenumber'];
$password = $_POST['password'];
$gender = $_POST['gender'];
//$studentid = $_POST ['']

//Database Connection

$conn = new mysqli('localhost','root','','account_management1');
if ($conn->connect_error){
	die('connection failed :' .$conn->connect_error);
}else{
	$stmt = $conn->prepare("insert into registration(fullname,yrandcourse,phone,email,,password,gender) 
		values (?,?,?,?,?,?,?)");
	$stmt->bind_param("sssis",$fullname,$yrandcourse,$phone,$email,$password,$gender);
	$stmt->execute();
	echo "registration successfully";
	$stmt->close();
	$conn->close();
}



?>