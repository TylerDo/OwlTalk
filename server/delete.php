<?php 
include 'connection.php';
if(isset($_GET['delete_id'])){
	$id = $_GET['delete_id'];
	$query = mysqli_query($con, "DELETE FROM users WHERE id = '$id'");
	if($query){
		header("location:index.php");
	}else{
		echo "<script>alert('Sorry delete query not work!')</script>";
	}
}

 ?>