<?php
$conn= mysqli_connect('localhost','root','','mss-system') or die('cannot connect to the DB');

if(!$conn){
    die("Database connection failed: ". mysqli_connect_error());
}
else{
  echo "DB connection successfull<br/>";
}
$lpg = $_POST["lpg"];
$co = $_POST["co"];
$smoke = $_POST["smoke"];
$temp = $_POST["temp"];
$time_stamp = date('y-m-d h:i:s');
$sql = "INSERT INTO `site-1` (lpg, smoke, carbon, time) VALUES ('$lpg','$smoke', '$co', '$time_stamp')"; 
if ($conn->query($sql) == TRUE){
echo "worked<br/>";
}
else{
    die('Failed query:' .$sql);
    }
?>