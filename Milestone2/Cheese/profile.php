<!-- Group 4 Project Cheese profile.html Tyler Do-->
<?php
    session_start();
    if(isset($_SESSION['user_id'])) //IF LOGGED IN 
    {
		include('./inc/headers/logged-in-header.php');
		require "./inc/connection.php";
		//GET USERNAME
		$user_id = $_SESSION['user_id'];
		$sql = "SELECT username FROM users WHERE user_id = '$user_id'";
		$sql_result = mysqli_query($con, $sql);
		if($row = mysqli_fetch_assoc($sql_result)){
			$username = $row['username'];
		}
    } 
    else //IF LOGGED OUT
    {
        header('location: index.php');
    }   
    
    include('./inc/functions.php');
?>
		
	<!-- Body Section -->
		<div class="container">
			<div class="row">
			<!-- Left side for user profile -->
				<div class="col-md-4"">
					<div class="card" style="width: 18rem;">
						<img src="default-picture.jpg" class="card-img-top" alt="...">
						<div class="card-body">
							<h5 class="card-title"><?php echo $username;?></h5>
						</div>
						<ul class="list-group list-group-flush">
							<li class="list-group-item">Location</li>
							<li class="list-group-item">Major</li>
							<li class="list-group-item">Hobbies</li>
						</ul>
						<div class="card-body">
							<a href="post.html" class="card-link">Bookmarked Posts</a>
						</div>
					</div>
				</div>
			<!-- Center for block post -->
				<div class="col-md-8">
					<h3 class="head text-center mt-2"><?php echo $username;?> Posts</h3>
					<div class="dropdown-divider"></div>
					<article class="block mb-3 shadow">
							<?php getPosts();?>
					</article>
				</div>
			</div>	
	</body>
</html>