<?php //DELETE COMMENT HANDLER
session_start();

require "connection.php";
		if(isset($_GET['delete'])){
            $comment_id = (int)$_GET['delete'];
			if(!is_int($comment_id)){
				$_SESSION['error'] = "Bad Post Number";
				header('location: ../index.php');
				exit();
			}
			if(!$_SESSION['user_id']){
				$_SESSION['error'] = "Not signed in";
				header('location: ../index.php');
				exit();
			}

			$user_id = $_SESSION['user_id'];
    
			$sql = "SELECT * FROM comment WHERE comment_id='$comment_id'";
			$result = mysqli_query($con, $sql);
		
			if($row = mysqli_fetch_assoc($result)){
				if($_SESSION['user_id'] !== $row['user_id']){
					$_SESSION['error'] = "Comment is not yours";
					header('location: ../index.php');
					exit();
				}
				
				// sql to delete a record
				$sql = "DELETE FROM comment WHERE comment_id='$comment'";

					if (mysqli_query($con, $sql)) {
						$_SESSION['success'] = "Comment Deleted";
						header('location: ../index.php?');
					} else {
						$_SESSION['error'] = "Failed to delete";
						header('location: ../index.php?');
					}
                mysqli_close($conn);
		}
	}
		
?>