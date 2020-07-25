<?php

session_start();

require "connection.php";

if(isset($_POST['update-profile'])){
    if(!$_SESSION['user_id']){
        $_SESSION['error'] = "Not signed in";
        header('location: ../login.php');
        exit();
    }
    
	if(file_exists($_FILES['image']['tmp_name']) && is_uploaded_file($_FILES['image']['tmp_name'])){
        $target='images/'.$_SESSION['user_id'];
        if(!move_uploaded_file($_FILES['image']['tmp_name'], $target)){ //if failure to add img to server
             $_SESSION['error'] = "Could not upload image to server".$_FILES['image']['name'];
            header('location: ../profile.php?id='.$_SESSION['user_id']);
            exit();
        }
        $image=$target; //img =path to file in server
    }else{
        $image = "";
    }
    if($_POST['name']){
        $name  = $_POST['name'];
    }else{
        $name = "";
    }
    if($_POST['location']){
        $location = $_POST['location'];
    }else{
        $location = "";
    }
    if($_POST['major']){
        $major = $_POST['major'];
    }else{
        $major = "";
    }
    if($_POST['hobbies']){
        $hobbies  = $_POST['hobbies'];
    }else{
        $hobbies = "";
    }

    $user_id  = $_SESSION['user_id'];


    if(empty($image) && empty($name) && empty($location) && empty($major) && empty($hobbies)){
        $_SESSION['error'] = "Please fill out at least one field";
        header('location: ../profile.php?id='.$user_id);
        exit();
    }
    
    $sql = "SELECT * FROM profiles WHERE user_id='$user_id'";
    $result = mysqli_query($con, $sql);

    if($row = mysqli_fetch_assoc($result)){ 
        //IF PROFILE EXISTS IN THE DATABASE--UPDATE
        if($user_id !== $row['user_id']){
            $_SESSION['error'] = "Profile is not yours";
            header('location: ../index.php');
            exit();
        }
        //if any of the updated fields are empty, fill them with old data so we don't loose it
        if(empty($image)){
            $image=$row['image'];
        }
        if(empty($name)){
            $name=$row['name'];
        } 
        if(empty($major)){
            $major=$row['major'];
        }
        if(empty($hobbies)){
            $hobbies=$row['hobbies'];
        }
        if(empty($location)){
            $location=$row['location'];
        }
        //UPDATE PROFILE
        $sql = "UPDATE profiles SET  name=?, location=?, major=?, hobbies=?, image=? WHERE user_id=?";
        $stmt = mysqli_stmt_init($con);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            $_SESSION['error'] = "SQL error";
            header('location: ../profile.php?id='. $user_id);
            exit();
        }
        else{ //UPDATE POST IN DATABASE
            mysqli_stmt_bind_param($stmt, "sssssi", $name, $location, $major, $hobbies,$image, $user_id);
            mysqli_stmt_execute($stmt);
    
            $_SESSION['success'] = "Profile updated!";
            header('location: ../profile.php?id='. $user_id);
            exit();
        }
           mysqli_stmt_close($stmt);
           mysqli_close($conn);
    }
    else{
        //ELSE CREATE THE PROFILE

        $sql = "INSERT INTO profiles (user_id, image, name, location, major, hobbies) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($con);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            $_SESSION['error'] = "SQL error";
            header('location: ../profile.php?id='. $user_id);
            exit();
        }
        else{ //UPDATE POST IN DATABASE
            mysqli_stmt_bind_param($stmt, "isssss", $user_id, $image, $name, $location, $major, $hobbies);
            mysqli_stmt_execute($stmt);
    
            $_SESSION['success'] = "Profile updated!";
            header('location: ../profile.php?id='. $user_id);
            exit();
        }
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
    }
}

?>