<?php
//connection to database
$conn= mysqli_connect('localhost','root','','mss-system') or die('cannot connect to the DB');

if(!$conn){
    die("Database connection failed: ". mysqli_connect_error());
}
else{
  echo "DB connection successfull<br/>";
}

//$temperature=$_GET['temperature']

$time = time(); //adds time stamp
$lpg = $_POST["lpg"];
$co = $_POST["co"];
$smoke = $_POST["smoke"];
$time_stamp = date('d-m-y h:i:s');
$sql = "INSERT INTO `site-1` (lpg, smoke, carbon) VALUES ('$lpg','$smoke', '$co')"; 
if ($conn->query($sql) == TRUE){
echo "worked<br/>";
}
else{
    die('Failed query:' .$sql); //Kills the connection to the database if the query fails
    }
?>