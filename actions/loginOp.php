<?php
include 'db.php';
session_start();
$name=$_POST['username'];
$pwd=$_POST['password'];

    $sql = mysqli_query($con,"SELECT * FROM users WHERE name = '$name' AND password = '$pwd'") or die(mysqli_error($con));
    if (mysqli_num_rows($sql) == 1)
        {   
            $_SESSION["uname"]=$name;
            if($name=="Admin"){
            header("location: ../index.php");
            }else{
                header("location: ../user/index.php");
            }
        }else{
            $_SESSION['error'] = "Invalid Username or password";
            header("location:../login.php");
        }  
?>