<?php

session_start();

require "connection.php";

if(isset($_POST['update'])){
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $body = mysqli_real_escape_string($con, $_POST['body']);
    $likes = 0; //NEEDS TO BE CHANGED WHEN LIKES FUNCTIONALITY IS ADDED
    $post_id = mysqli_real_escape_string($con, $_POST['post_id']);
    
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
    
    $sql = "SELECT * FROM posts WHERE post_id='$post_id'";
    $result = mysqli_query($con, $sql);

    if($row = mysqli_fetch_assoc($result)){
        if($_SESSION['user_id'] !== $row['user_id']){
            $_SESSION['error'] = "Post is not yours";
            header('location: ../index.php');
            exit();
        }
        //UPDATE POST
        
        $sql = "UPDATE posts SET title=?, body=? WHERE post_id=?";
        $stmt = mysqli_stmt_init($con);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            $_SESSION['creation_error'] = "SQL error";
            header('location: ../index.php');
            exit();
        }
        else{ //UPDATE POST IN DATABASE
            mysqli_stmt_bind_param($stmt, "ssi", $title, $body, $post_id);
            mysqli_stmt_execute($stmt);
    
            $_SESSION['success'] = "Post updated!";
            header('location: ../index.php');
            exit();
        }
           mysqli_stmt_close($stmt);
           mysqli_close($conn);
    }
    else{
        $_SESSION['error'] = "Post not found";
        header('location: ../index.php');
    }
}

?>