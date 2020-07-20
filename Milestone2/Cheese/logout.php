<?php 
include("./inc/headers/header.php");
include("./inc/logout.php");
?>



<form action="./inc/logout-handler.php" method="POST">
    <div>
        <button type="submit" name="logout" class="button-style btn btn-info btn-lg" data-toggle="tooltip" data-placement="bottom" title="Logout!">
        Logout
        </button>
    </div>
</form>