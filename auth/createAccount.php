<?php
require_once "../config.php";
print_r($_POST);
$uname = validateName($_POST['username']);
$phone = validateNumber($_POST['phone']);
$pass = validatePassword($_POST['password']);


// validation
function validateNumber($data){
    if(preg_match('/^[0-9]{10}+$/', $data)) {
       print $phone = $data;
    }   else{
        $_SESSION['error'] = "Enter Phone Number with correct format <br>";
        }
}
function validatePassword($data){
    if(preg_match('/[a-z0-9]/i', $data)) {
       print $pass = $data;
    }   else{
        $_SESSION['error'] = "Enter Phone Number with correct format <br>";
        print "Enter Password with correct format <br>";
        }
}
function validateName($data){
    if(preg_match('/[a-zA-Z]/i', $data)) {
       print $uname = $data;
    }   else{
        $_SESSION['error'] = "Enter Phone Number with correct format <br>";
        print "Enter Name with correct format <br>";
        }
}

