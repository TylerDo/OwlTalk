<?php 
    session_start();
    include("./inc/functions.php");
    if(isset($_SESSION['user_id'])) 
         {
             include("./inc/headers/logged-in-header.php");
         } //IF LOGGED IN 
      else
         {
             include("./inc/headers/logged-out-header.php");
         } //IF LOGGED IN      
               ?>
		
    <?php if(isset($_SESSION['success'])) : ?>
               <div class="alert alert-success text-center">
                   <?php echo $_SESSION['success']; 
						unset($_SESSION['success'])
						//SUCCESSFUL CREATION OF ACCOUNT?> 
               </div>

    <?php endif ?>
       
        <?php if(isset($_SESSION['error'])) : ?>
               <div class="alert alert-danger text-center">
                   <?php echo $_SESSION['error']; 
						unset($_SESSION['error'])
						//SUCCESSFUL CREATION OF ACCOUNT?> 
               </div>

    <?php endif ?>

	
        
<!-- Main Block Section -->
<section class="block-posts mt-4">
	<div class="container">
	<div class="row">
		<div class="col-md-12">
			<?php getAllPosts();?>
				<article class="block mb-3 shadow">
					<div class="row">
						<div class="col-sm-3">
							<img class="img-fluid rounded-circle"  style="width:150px"alt="" src="TylerDo.jpg">
						</div>
						<div class="col-sm-9">
							<form action="./inc/updatePost.php" method="POST" class="">
								<div class="form-group">
									<label for="title">Title</label>
									<input name="title" type="text" class="form-control" id="blockTitle">
								</div>
								<div class="form-group">
									<label for="textareaBlock">Write Post</label>
									<textarea name="body" class="form-control" id="blockTextArea" rows= "5"></textarea>
								</div>
								
								<button type="submit" name="login" class="btn btn-success btn-md" data-toggle="tooltip" data-placement="bottom" title="Login!">
                            	Submit
                            	</button>
								<button onClick 
								onclick="editPost('. $post_id .');"
								class="cancelButton" data-toggle="tooltip" data-placement="bottom" title="Login!">
                           		 Cancel
                            	</button>
							</form>
							<h3> My Block Post Title</h3>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,
							sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
							Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi
							ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit 
							in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur 
							sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt
							mollit anim id est laborum.
							</p>
							<div class="user-post-share">
							<button class="button-style btn btn-info btn-sm">
								<i class="fa fa-comment-o" aria-hidden="true"></i>
							</button>
							<button class="button-style btn btn-info btn-sm">
								<i class="fa fa-share-square-o" aria-hidden="true">
								</i>
							</button>
							<button class="button-style btn btn-info btn-sm">
							<i class="fa fa-bookmark-o" aria-hidden="true"></i></button>
							</div>
							<div class="user-likes">
							<!--LIKE BUTTON-->
							<button data-id="2" 
							onclick="like(2);"  class="button-style btn btn-info btn-sm"><i class="fa fa-caret-square-o-up like-btn" aria-hidden="true"></i></button>
							<!--DISLIKE BUTTON-->
							<button onclick="dislike(2);" class="button-style btn btn-info btn-sm"><i class="fa fa-caret-square-o-down dislike-btn" aria-hidden="true"></i></button>
							</div>
						</div>
					</div>
				</article>
		</div>
	</div>
	</div>
</section>
		<script src="update.js"></script>
        <script src="script.js"></script>
	</body>
</html>