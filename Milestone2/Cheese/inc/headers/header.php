<!-- Group 4 Project Cheese profile.html Tyler Do-->
<html>

	<head>
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-174156488-1%22%3E"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());
		  
			gtag('config', 'UA-174156488-1');
		  </script>
		<title>Profile Page</title>
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
		<!-- Google Fonts -->
		<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
		<!-- Font Awesome Icons 4.7.0 -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<!-- Main color Scheme -->
		<link rel="stylesheet" href="css/main.css">
		
	</head>


	<body>
	<!-- Header Section -->
		<!-- Nav Bar -->
		<nav class="navbar navbar-expand-lg">
			<div class="container">
			<!-- User Icon -->
			<nav class="navbar navbar-light">
				<?php echo '<a class="navbar-brand" href="profile.php">
				<i class="fa fa-user-circle-o" aria-hidden="true"></i>
				</a>' ?>
			</nav>
			<?php echo '<a class="navbar-brand" href="index.php">Cheese</a>' ?>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
				<div class="navbar-nav">
					<?php echo '<a class="nav-item nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>' ?>
					<?php echo '<a class="nav-item nav-link" href="#">People</a>' ?>
					<?php echo '<a class="nav-item nav-link" href="#">School</a>' ?>
					<?php echo '<a class="nav-item nav-link" href="#">Hobbies</a>' ?>
				</div>
			</div>
			<!-- Help Button -->
			<button type="button" class="button-style btn btn-info" data-toggle="tooltip" data-placement="bottom" title="Click for help" onclick="alert('Welcome to Cheese! The site to help people connect during COVID. Create a User profile by selecting the user icon in the top left. To post a block click on the new block button. The main page displays recent and popular blocks from other students. The navigation bar links will help you navigate through different categories on the site. Thank you for becoming apart of the cheese family!')">
			<i class="fa fa-question-circle" aria-hidden="true"></i>
			</button>
			</div>
		</nav>
		
		<div class="container text-center">
		
	