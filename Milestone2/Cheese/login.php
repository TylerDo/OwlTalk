
<?php 
include("./inc/login.php");
include("./inc/headers/header.php");

if(isset($_SESSION['username'])){
    header('location: ./index.php');
}
?>

		<!-- Icon/Logo Section -->
	<section>
		<div class="container text-center" style="padding-top: 50px;">
		<h2 style="padding-bottom: 25px;">Cheese</h2>
			<figure class="figure">
				<i class="fa fa-grav" aria-hidden="true" style="font-size: 10em;"></i>
			</figure>
			<h3 style="padding-top: 25px;">Log in to your OwlTalk account</h3>
		</div>
	</section>
	
		<!-- User Form -->
		<form action="./inc/login.php" method="POST">
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
                            <span class="input-group-text" id="inputGroup-sizing-lg">Password</span>
                        </div>
                        <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" name="password" required>
                    </div>
                </div>
            </section>

                <!-- Buttons -->
                <div class="container">
                    <div class="row">
                        <div class="col-md">
                            <button type="submit" name="login" class="button-style btn btn-info btn-lg" data-toggle="tooltip" data-placement="bottom" title="Login!">
                            Login
                            </button>
                        </div>
                        <div class="col-md">
                            <?php echo '<a href="./createAccount.php">Create Account</a>' ?>
                            <i class="fa fa-plus-circle" style="padding-left: 5px;" aria-hidden="true"></i>
                        </div>
                        <div class="col-md">
                            <a href="#">Forgot Password</a>
                            <i class="fa fa-unlock" style="padding-left: 5px;" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
        </form>
        
        <?php if(isset($_SESSION['success'])): ?>
             <div class="alert alert-success text-center">
                <?php echo $_SESSION['success'];
                unset($_SESSION['success']);?>
            </div>
        <?php endif?>
        
        <?php if(isset($_SESSION['login_error'])): ?>
             <div class="alert alert-danger text-center">
                <?php echo $_SESSION['login_error'];
                unset($_SESSION['login_error']);?>
            </div>
        <?php endif?>
	</body>
</html>