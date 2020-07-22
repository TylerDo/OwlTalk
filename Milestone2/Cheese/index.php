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