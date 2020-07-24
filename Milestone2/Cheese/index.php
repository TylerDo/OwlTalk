<?php 
    session_start();
    include("./inc/functions.php");
    if(isset($_SESSION['user_id'])) 
         {
             include("./inc/headers/homepage-logged-in-header.php");
         } //IF LOGGED IN 
      else
         {
             include("./inc/headers/logged-out-header.php");
         } //IF LOGGED IN      
              
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
                if($commentj_id != 0){
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
                if($commentj_id != 0){
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
			</div>
		</div>
	</div>
</section>
		<script src="update.js"></script>
        <script src="script.js"></script>
	</body>
</html>