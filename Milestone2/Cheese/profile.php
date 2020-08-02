<!-- Group 4 Project Cheese profile.html Tyler Do-->
<?php
	session_start();
	if(!isset($_GET['id'])){
		header('location: index.php');
		exit();
	}
	else{
		$user_id2 = $_GET['id'];
	}
    if(isset($_SESSION['user_id'])) //IF LOGGED IN 
    {
		include('./inc/headers/logged-in-header.php');
    } 
    else //IF LOGGED OUT
    {
        include("./inc/headers/logged-out-header.php");
	}   

	//GET USERNAME
	require "./inc/connection.php";
	$sql = "SELECT username FROM users WHERE user_id = '$user_id2'";
	$sql_result = mysqli_query($con, $sql);
	if($row = mysqli_fetch_assoc($sql_result)){
		$username = $row['username'];
	}
	else{
		echo 'profile does not exist';
		exit();
	}
	include('./inc/functions.php');
	
	if(isset($_POST['increment'])){
        if(isset($_SESSION['user_id'])){
            if(isset($_POST['post_id'])){
                
                $post_id = (int)$_POST['post_id'];
                if($post_id != 0){
                    increment($post_id, "p");
                }
            }
            elseif(isset($_POST['comment_id'])){
                $comment_id = (int)$_POST['comment_id'];
                if($comment_id != 0){
                    increment($comment_id, "c");
                }
            }
            
        }
    }

    if(isset($_POST['decrement'])){
        if(isset($_SESSION['user_id'])){
            if(isset($_POST['post_id'])){
                $post_id = (int)$_POST['post_id'];
                if($post_id != 0){
                    decrement($post_id, "p");
                }
            }
            elseif(isset($_POST['comment_id'])){
                $comment_id = (int)$_POST['comment_id'];
                if($comment_id != 0){
                    decrement($comment_id, "c");
                }
            }
            
        }
    }
?>

<?php if(isset($_SESSION['success'])) : ?>
               <div class="alert alert-success text-center">
                   <?php echo $_SESSION['success']; 
						unset($_SESSION['success'])
						//SUCCESS MESSAGES?> 
               </div>

    <?php endif ?>
       
        <?php if(isset($_SESSION['error'])) : ?>
               <div class="alert alert-danger text-center">
                   <?php echo $_SESSION['error']; 
						unset($_SESSION['error'])
						//ERROR MESSAGES?> 
               </div>

    <?php endif ?>
		
	<!-- Body Section -->
		<div class="container ">
		<!-- Modal -->
			<div class="modal fade" id="updateProfile">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h1 class="modal-title">Edit Profile</h1>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
						</div>
						<div class="modal-body">
							<form action="./inc/update-profile-handler.php" method="POST" enctype="multipart/form-data" >
								
								<div class="form-group">
									<label for="hobbies">Name</label>
									<input name="name" type="text" class="form-control" id="profileHobbies">
								</div>
								<div class="form-group">
									<label for="location">Location</label>
									<input name="location" type="text" class="form-control" id="profileLocation">
								</div>
								<div class="form-group">
									<label for="major">Major</label>
									<input name="major" type="text" class="form-control" id="profileMajor">
								</div>
								<div class="form-group">
									<label for="hobbies">Hobbies</label>
									<input name="hobbies" type="text" class="form-control" id="profileHobbies">
								</div>
								<div class="form-group">
									<label for="hobbies">Description</label>
									<input name="description" type="text" class="form-control" id="profileHobbies">
								</div>
								 <div class="form-group">
									<label for="image">Profile Picture</label>
									<div>
  	  									<input type="file" class="form-control"name="image"accept="image/*">
  									</div>
								</div>
							
							</div>
							<div class="modal-footer">
								<button type="button" class="button-style btn btn-info btn-sm" data-dismiss="modal">Close</button>

								<button name="update-profile" type="submit" class="button-style btn btn-info btn-sm" >Commit Changes</button>
							</div>
						</form>
					</div>
				</div>
			</div>

			<?php getProfile($user_id2);?>
			<!-- Center for block post -->
				<div class="col-md-8">
					<h3 class="head text-center mt-2"><?php echo $username;?> Posts</h3>
					<div class="dropdown-divider"></div>

							<?php 
							getPosts($user_id2);
							

							?>
					<h3 class="head text-center mt-2"><?php echo $username;?> Comments</h3>
					<article class="block mb-3 shadow">
					<div class="dropdown-divider">
					</div>
							<?php 
							getUserComments($user_id2);
							
							?>
					</article>
				</div>
				
				</div>
			</div>	
		</div>
	</body>
</html>