<?php

session_start();

require "connection.php";

if(isset($_POST['create-comment'])){
    $post_id = $_POST['post_id'];
    $body = $_POST['body'];
    $likes = 0;
    
    if(!$_SESSION['user_id']){
        $_SESSION['error'] = "Not signed in";
        header('location: ../login.php');
        exit();
    }

    $user_id = $_SESSION['user_id'];
    
    if(empty($user_id) || empty($body) || empty($post_id)){
        $_SESSION['error'] = "user_id = ". $user_id . "body = ". $body. "post_id = ". $post_id ;
        header('location: ../index.php');
        exit();
    } 
    
    //INSERT INTO COMMENTS TABLE
    
    $sql = "INSERT INTO comment (user_id, post_id, body, likes) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($con);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        $_SESSION['error'] = "SQL error";
        header('location: ../index.php');
        exit();
    }
    else{ //ADD COMMENT INTO DATABASE
        mysqli_stmt_bind_param($stmt, "iisi", $user_id, $post_id, $body, $likes);
        mysqli_stmt_execute($stmt);

        $_SESSION['success'] = "Comment Created!";
        header("location: ../post.php?id=".$post_id);
        exit();
    }
       mysqli_stmt_close($stmt);
       mysqli_close($conn);
}

?>