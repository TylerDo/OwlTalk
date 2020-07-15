<?php 

session_start();

include("connection.php");

if(isset($_POST['login'])){
    if(isset($_SESSION['username'])){
        $_SESSION['login_error'] = "Already logged in";
        header("location: ../login.php");
    }
    else {
        $username  = mysqli_real_escape_string($con, $_POST['username']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        
        //CHECK FOR EMPTY FIELDS
        if(empty($username) || empty($password)){ 
            $_SESSION['login_error'] = "Empty Fields";
            header('location: ../login.php');
            exit();
        }
        //PREPARE SQL STATEMENT
        $sql = "SELECT * FROM users WHERE username=? OR email=?";
        $stmt = mysqli_stmt_init($con);
        
        //CHECK IF CONNECTION IS MADE
        if(!mysqli_stmt_prepare($stmt, $sql)){
            $_SESSION['login_error'] = "SQL error";
            header('location: ../login.php');
            exit();
        }
        else{ //QUERY THE DATABASE -- Check if user exists
            mysqli_stmt_bind_param($stmt, "ss", $username, $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
                if($row = mysqli_fetch_assoc($result)){ 
                    $pwdCheck = password_verify($password, $row['password']);
                    if($pwdCheck == false){
                        $_SESSION['login_error'] = "password is not correct";
                        header("location: ../login.php");
                        exit();
                    }
                    else if($pwdCheck == true){
                        $_SESSION['user_id'] = $row['user_id'];
                        $_SESSION['success'] = "You are logged in!";
                        header('location: ../index.php');
                        exit();
                    }
                    else{
                        $_SESSION['login_error'] = "unknown error occurred";
                        header("location: ../login.php");
                        exit();
                        
                    }
                }
                else{
                    $_SESSION['login_error'] = "User not found";
                    header("location: ../login.php");
                    exit();
                }
                
            }
        }
    
}

?>