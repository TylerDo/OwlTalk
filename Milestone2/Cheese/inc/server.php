<?php

session_start();

include("connection.php");

$username = "";
$email = "";

$errors = array();
//Register Users

if(isset($_POST['create'])){
    $username  = mysqli_real_escape_string($con, $_POST['username']);
    $email     = mysqli_real_escape_string($con, $_POST['email']);
    $password1 = mysqli_real_escape_string($con, $_POST['password1']);
    $password2 = mysqli_real_escape_string($con, $_POST['password2']);

    if(empty($username)){array_push($errors, "Username is required");}
    if(empty($email)){array_push($errors, "Email is required");}
    if(empty($password1) or empty($password2)){array_push($errors, "Password is required");}
    if($password1 != $password2) { array_push($errors, "Passwords need to be the same");}

    //check db for existing user with same username

    $user_check_query = "SELECT * FROM users WHERE username='$username' or email='$email' LIMIT 1";

    $results = mysqli_query($con, $user_check_query);
    $user = mysqli_fetch_assoc($results);

    if($user){
        if($user['username'] == $username){array_push($errors, "Username already exists");}
        if($user['email'] == $email){array_push($errors, "Email has already been used");}
    }

    //Register the user if no error

    if(count($errors) == 0){

        $password = md5($password1); //encrypt password
        $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";

        mysqli_query($con, $query);
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "You are now logged in";

        header('location: ../index.php');
    }
    if(count($errors) > 0){
        $_SESSION['creation_error'] = array_pop(array_reverse($errors));
    }
    header("location: ../createaccount.php");
}


















?>