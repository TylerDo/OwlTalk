<?php

session_start();

include("connection.php");

$username = "";
$email = "";

$errors = array();
//Register Users

if(isset($_POST['logout'])){
    if(isset($_SESSION['username'])){
        session_unset();
        header("location: ../index.php");
    }
    echo "Hello";
}
?>