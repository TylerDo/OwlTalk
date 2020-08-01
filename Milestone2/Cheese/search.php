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
		<!-- Main Block Section -->
		<div class="main">
			<!-- Actual search box -->
			<form method="POST" action="" class="form-group has-search">
				<span class="fa fa-search form-control-feedback"></span>
				<input style="max-width: 800px;"name="search" type="text" class="form-control" placeholder="Search">
			</form>
			<div >
						<section>
						<?php
							if(isset($_POST['search'])){
								displaySearch($_POST['search']);
							}else{
								displaySearch("");
							}
						?>
						</section>
			</div>
		</div>
	</body>
</html>