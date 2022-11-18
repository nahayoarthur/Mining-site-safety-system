<?php
require_once "../actions/db.php";
session_start();
// print_r($_POST);
$uname = validateName($_POST['username']);
$phone = validateNumber($_POST['phone']);
$pass = validatePassword($_POST['password']);


// insert query
$qry = "INSERT INTO `users`(`name`, `password`, `phone`) VALUES ('$uname','$pass','$phone')";
$res = mysqli_query($con,$qry);
if($res){
    $_SESSION['success'] = "Account created successfly! <br>";
    header("location:../profileSetting.php");
}else{
    $_SESSION['error'] = "Something went wrong, Try again! <br>";
    header("location:../profileSetting.php");
}
// validation
function validateNumber($data){
    if(preg_match('/^[0-9]{10}+$/', $data)) {
       return $phone = $data;
    }   else{
        $_SESSION['error'] = "Enter Phone Number with correct format <br>";
        }
}
function validatePassword($data){
    if(preg_match('/[a-z0-9]/i', $data)) {
       return $pass = $data;
    }   else{
        $_SESSION['error'] = "Enter Phone Number with correct format <br>";
        print "Enter Password with correct format <br>";
        }
}
function validateName($data){
    if(preg_match('/[a-zA-Z]/i', $data)) {
     return $uname = $data;
    }   else{
        $_SESSION['error'] = "Enter Phone Number with correct format <br>";
        print "Enter Name with correct format <br>";
        }
}


