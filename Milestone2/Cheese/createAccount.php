<?php 
include("./inc/createAccount.php");
include("./inc/headers/header.php")?>
		
		<!-- Icon/Logo Section -->
	<section>
		<div class="container text-center" style="padding-top: 50px;">
		<h2 style="padding-bottom: 25px;">Cheese</h2>
			<figure class="figure">
				<i class="fa fa-grav" aria-hidden="true" style="font-size: 10em;"></i>
			</figure>
			<h3 style="padding-top: 25px;">Create Your OwlTalk Account</h3>
		</div>
	</section>
	
		<!-- User Form -->
		
    <form action="./inc/createAccount-handler.php" method="POST">
	<section>
		<div class="container" style="padding-top: 50px;">
		    <div class="input-group input-group-sm mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputGroup-sizing-lg">Username</span>
				</div>
				<input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" name="username" required>
			</div>
			<div class="input-group input-group-sm mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputGroup-sizing-lg">Email</span>
				</div>
				<input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" name="email" required>
			</div>
			<div class="input-group input-group-sm mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputGroup-sizing-lg">Password</span>
				</div>
				<input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" name="password1" required>
			</div>
			<div class="input-group input-group-sm mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputGroup-sizing-lg">Confirm Password</span>
				</div>
				<input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" name="password2" required>
			</div>
		
			
		</div>
	</section>
		
		<!-- Buttons -->
		<div class="container">
			<div class="row">
				<div class="col-md">
					<button class="button-style btn btn-info btn-lg" data-toggle="tooltip" data-placement="bottom" title="Login!" type="submit" name="create">
					Create
					</button>
				</div>
				<div class="col-md text-right">
					<?php echo '<a href="login.php">Login</a>' ?>
					<i class="fa fa-plus-circle" style="padding-left: 5px;" aria-hidden="true"></i>
				</div>
			</div>
		</div>
		</form>
		
        <?php if(isset($_SESSION['creation_error'])) : ?>
                   <div class="alert alert-danger text-center">
                       <?php echo $_SESSION['creation_error']; //ERROR HANDLING
                               unset($_SESSION['creation_error']); ?>
                   </div>
                   
        <?php endif ?>
                   
        <?php if(isset($_SESSION['success'])) : ?>
                   <div class="alert alert-success text-center">
                       <?php echo $_SESSION['success']; 
                            unset($_SESSION['success'])//SUCCESSFUL CREATION OF ACCOUNT?> 
                   </div>
                   
        <?php endif ?>
                    
	</body>
</html>