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
        $sql = "SELECT * FROM users WHERE username='$username' OR email='$email'";
        $result = mysqli_query($con, $sql);
        
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

?>