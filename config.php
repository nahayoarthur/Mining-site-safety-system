<?php
session_start();
define("URL","localhost");
define("USER","root");
define("PASS","");
try{
    $conn = mysqli_connect(URL,USER,PASS);
    // print $conn? "YES":"No";
}catch(Exception $error){
    $_SESSION['error'] = $error.getMessage();
}
