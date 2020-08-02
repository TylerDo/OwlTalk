<!-- Group 4 Project Cheese index.html Tyler Do-->
<?php if(isset($_SESSION['user_id'])){
		$user_id = $_SESSION['user_id'];
}
	?>
<html>

	<head>
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-174156488-1%22%3E"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());
		  
			gtag('config', 'UA-174156488-1');
		  </script>
		<title>Cheese Home Page</title>
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
		<!-- Google Fonts -->
		<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
		<!-- Font Awesome Icons 4.7.0 -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<!-- Main color Scheme -->
		<link rel="stylesheet" href="style.css">
		<!-- Javascript -->
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
		<link rel="stylesheet" href="css/main.css">
		
	</head>


	<body>
		<!-- Header Section -->
		<!-- Nav Bar -->
		<nav class="navbar navbar-expand-lg">
			<div class="container">
			<!-- Logout Button -->
			<?php echo '<a class="button-style btn btn-info btn-sm" href="logout.php" role="button">logout
			<i class="fa fa-sign-in" style="padding-left: 5px;" aria-hidden="true"></i></a>'; ?>
			<!-- User Icon -->
			<nav class="navbar navbar-light">
				<?php echo '<a class=" btn button-style navbar-brand" href="profile.php?id='.$user_id.'">
				<i class="fa fa-user-circle-o" aria-hidden="true"></i>
				</a> '; ?> 
			</nav>
			<?php echo '<a class="navbar-brand" href="index.php">Cheese</a> '; ?>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
				<div class="navbar-nav">
					<?php echo '<a class="nav-item nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a> '; ?>
					<?php echo '<a class="nav-item nav-link" href="search.php">People</a> '; ?>
					<?php echo '<a class="nav-item nav-link" href="#">School</a> '; ?>
					<?php echo '<a class="nav-item nav-link" href="#">Hobbies</a> '; ?>
				</div>
			</div>
			<!-- Help Button -->
			<button type="button" class="button-style btn btn-info" data-toggle="tooltip" data-placement="bottom" title="Click for help" onclick="alert('Welcome to Cheese! The site to help people connect during COVID. Create a User profile by selecting the user icon in the top left. To post a block click on the new block button. The main page displays recent and popular blocks from other students. The navigation bar links will help you navigate through different categories on the site. Thank you for becoming apart of the cheese family!')">
			<i class="fa fa-question-circle" aria-hidden="true"></i>
			</button>
			</div>
		</nav>
		
	<!-- Main Block Section MODAL-->
		<div class="container text-center">
			<!-- Create a new block button with modal -->
				<button type="button" class="button-style btn btn-info btn-lg" style="margin-top:1rem;" id="createBlockButton" data-toggle="modal" data-target="#createBlock">Create Post</button>
			<!-- Modal -->
			<div class="modal fade" id="createBlock">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h1 class="modal-title">Post a Block</h1>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
						</div>
						<div class="modal-body">
							<form action="./inc/createPost-handler.php" method="POST">
								<div class="form-group">
									<label for="title">Title</label>
									<input name="title" type="text" class="form-control" id="blockTitle">
								</div>
								<div class="form-group">
									<label for="textareaBlock">Write Post</label>
									<textarea name="body" class="form-control" id="blockTextArea" rows= "5"></textarea>
								</div>
								<div class="modal-footer">
                                    <button type="button" class="button-style btn btn-info btn-sm" data-dismiss="modal">Close</button>
                                    <button type="submit" name="create-post" type="button" class="button-style btn btn-info btn-sm">Create Post</button>
						        </div>
							</form>
						
						
					</div>
				</div>
			</div>
            </div>