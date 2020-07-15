<?php
//$con = mysqli_connect("localhost","cen4010s2020_g04","faueng2020","cen4010s2020_g04");
//
//if(!$con){
//    die("CONNECTION TO DB FAILED. " . mysqli_error($con));
//}

$con = mysqli_connect("localhost","root","","production");

if(!$con){
    die("CONNECTION TO DB FAILED. " . mysqli_error($con));
}


?>