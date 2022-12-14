<?php
$conn= mysqli_connect('localhost','root','','mss-system') or die('cannot connect to the DB');

if(!$conn){
    die("Database connection failed: ". mysqli_connect_error());
}
else{
  echo "DB connection successfull ";
}
$lpg = $_POST["lpg"];
$co = $_POST["co"];
$smoke = $_POST["smoke"];
$temp = $_POST["temp"];
$panic = $_POST["panic"];

$tz = 'Africa/Harare';
$timestamp = time();
$dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
$dt->setTimestamp($timestamp); //adjust the object to correct timestamp

$sql = "INSERT INTO `site-1` (lpg, smoke, carbon, temp, panic, time) VALUES ('$lpg','$smoke', '$co', '$temp', '$panic', '$dt->format('h:i:s d-m-y');')"; 
if ($conn->query($sql) == TRUE){
echo "worked";
}
else{
    die('Failed query:' .$sql);
    }
?>