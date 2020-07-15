<?php

session_start();

require "connection.php";

if(isset($_POST['create'])){
    $username  = mysqli_real_escape_string($con, $_POST['username']);
    $email     = mysqli_real_escape_string($con, $_POST['email']);
    $password1 = mysqli_real_escape_string($con, $_POST['password1']);
    $password2 = mysqli_real_escape_string($con, $_POST['password2']);

    //CHECK FOR EMPTY FIELDS
    if(empty($username) || empty($email) || empty($password1) || empty($password2)){ 
        $_SESSION['creation_error'] = "Empty Fields";
        header('location: ../createAccount.php');
        exit();
    }
    
    //CHECK FOR VALID USERNAME
    if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
        $_SESSION['creation_error'] = "Invalid username";
        header('location: ../createAccount.php');
        exit();
    }
    
    //CHECK FOR VALID EMAIL
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $_SESSION['creation_error'] = "Invalid email";
        header('location: ../createAccount.php');
        exit();
    }
    
    
       
    //CHECK IF PASSWORDS MATCH
    if($password1 != $password2) { 
        $_SESSION['creation_error'] = "Passwords need to match";
        header('location: ../createAccount.php');
        exit();
    }


    //check db for existing user with same username
    $sql = "SELECT * FROM users WHERE username=?";
    $stmt = mysqli_stmt_init($con);
    
    //CHECK IF CONNECTION IS MADE
    if(!mysqli_stmt_prepare($stmt, $sql)){
        $_SESSION['creation_error'] = "SQL error";
        header('location: ../createAccount.php');
        exit();
    }
    else{ //QUERY THE DATABASE -- CHECK IF USERNAME IS TAKEN
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resultCheck = mysqli_stmt_num_rows($stmt);
        
        if($resultCheck > 0){ 
            $_SESSION['creation_error'] = "Username already taken";
            header('location: ../createAccount.php');
            exit();
        }
        else{
            $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
            $stmt = mysqli_stmt_init($con);
            if(!mysqli_stmt_prepare($stmt, $sql)){
                $_SESSION['creation_error'] = "SQL error";
                header('location: ../createAccount.php');
                exit();
            }
            else{ //ADD USER INTO DATABASE
                $hashedPassword = password_hash($password1, PASSWORD_DEFAULT);
                mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPassword);
                mysqli_stmt_execute($stmt);
                
                $_SESSION['success'] = "Account Created! Please log in";
                header('location: ../login.php');
                exit();
            }
        }
    }
       mysqli_stmt_close($stmt);
       mysqli_close($conn);
}

?>