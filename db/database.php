<?php
//Online DB Use
// $ServerName = "";
// $Username = "";
// $Password ="";
// $Database = "";

//Local DB use
$ServerName = "localhost";
$Username = "root";
$Password ="";
$Database = "db_cpstnsec";



try{
$connection = new PDO("mysql:host=$ServerName;dbname=$Database",$Username,$Password);

// set the PDO error mode to exception
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

echo "<div class ='text-left'><h4 class='text-success'>Connection:&nbsp;<i class='fas fa-signal'></i>&nbsp;Stable</h4></div>";

}catch(PDOException $e)
{
    echo "Error: ".$e->getMessage();
}
?>