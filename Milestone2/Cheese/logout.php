<?php 
include("./inc/headers/header.php");
include("./inc/logout-handler.php");
?>



<form action="./inc/logout-handler.php" method="POST" style="visibility: hidden;">
    <div>
        <button type="submit" name="logout" class="button-style btn btn-info btn-lg" data-toggle="tooltip" id="logoutbtn"data-placement="bottom" title="Logout!">
        Logout
        </button>
    </div>
</form>
<script type="text/javascript">
document.getElementById("logoutbtn").click();
</script>