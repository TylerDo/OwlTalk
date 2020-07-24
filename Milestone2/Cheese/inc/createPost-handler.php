<?php

session_start();

require "connection.php";

if(isset($_POST['create-post'])){
    $title = $_POST['title'];
    $body = $_POST['body'];
    $likes = 0;
    
    if(!$_SESSION['user_id']){
        $_SESSION['error'] = "Not signed in";
        header('location: ../login.php');
        exit();
    }
    
    if(empty($title) || empty($body)){
        $_SESSION['error'] = "Fields empty";
        header('location: ../index.php');
        exit();
    }
    
    $user_id = $_SESSION['user_id'];
    
    //INSERT INTO POSTS
    
    $sql = "INSERT INTO posts (user_id, title, body, likes) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($con);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        $_SESSION['creation_error'] = "SQL error";
        header('location: ../index.php');
        exit();
    }
    else{ //ADD POST INTO DATABASE
        mysqli_stmt_bind_param($stmt, "issi", $user_id, $title, $body, $likes);
        mysqli_stmt_execute($stmt);

        $_SESSION['success'] = "Post Created!";
        header('location: ../index.php');
        exit();
    }
       mysqli_stmt_close($stmt);
       mysqli_close($conn);
}

?>