<?php include "connection.php";
if(isset($_POST['update'])){
  $name        = $_POST['name'];
  $username    = $_POST['username'];
  $location    = $_POST['location'];
  $hobbies     = $_POST['hobbies'];
  $id          = $_POST['edit_id'];
  $query       = mysqli_query($con, "UPDATE users SET name = '$name' ,username = '$marks', department = '$department', result = '$result' WHERE id = '$id'");
    
  if ($query) {
    header("location:index.php");
  }else{
    echo "<script>alert('Sorry update query not work')</script>";
  }
}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>PHP Crud Using Mysqli</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
</head>
<body>
<div class="container" style="margin-top: 70px;">
	<div class="row justify-content-center">
		<div class="col-md-10 text-center">
			<?php

  if(isset($_GET['update_id'])): ?>
  <?php $id = $_GET['update_id']; ?>
  <?php $query = mysqli_query($con, "SELECT * FROM users WHERE id = '$id' ");
  $r = mysqli_fetch_array($query);
  $name = $r['name'];
  $marks = $r['username'];
  $department = $r['location'];
  $result = $r['hobbies'];
   ?>
    <form method="POST" action="update.php">
        <div class="form-group">
          <input type="text" name="name" class="form-control" placeholder="Enter Name..." required="" value="<?php echo $name; ?>">
        </div><!-- form-group -->
        <div class="form-group">
          <input type="text" name="username" class="form-control" placeholder="Enter username..." required="" value="<?php echo $marks; ?>">
        </div><!-- form-group -->
        <div class="form-group">
          <input type="text" name="location" class="form-control" placeholder="Enter location..." required="" value="<?php echo $department; ?>">
        </div><!-- form-group -->
        <div class="form-group">
          <input type="text" name="hobbies" class="form-control" placeholder="Enter hobbies..." required="" value="<?php echo $result; ?>">
        </div><!-- form-group -->
        <input type="hidden" name="edit_id" value="<?php echo $id; ?>">
        <div class="form-group">
          <input type="submit" name="update" class="btn btn-info" value="Edit Student">
        </div><!-- form-group -->
       </form><!-- form -->
<?php endif; ?>



		</div><!-- col -->
	</div><!-- row -->
</div><!-- container -->


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
</body>

</html>