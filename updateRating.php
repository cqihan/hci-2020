<?php
session_start();
include "includes/dbh.inc.php";

$place_id=$_POST['place_id'];
$username=$_SESSION['username'];
$waste_management_rating=$_POST['waste_management_rating'];
$air_quality_rating=$_POST['air_quality_rating'];
$water_quality_rating=$_POST['water_quality_rating'];
$biodiversity_rating=$_POST['biodiversity_rating'];


$sqlUpdate="UPDATE rating SET waste_management_rating='$waste_management_rating' , air_quality_rating='$air_quality_rating' , water_quality_rating='$water_quality_rating' , biodiversity_rating='$biodiversity_rating' WHERE username='$username' AND place_id='$place_id' ";
$resultUpdate=mysqli_query($conn,$sqlUpdate);
if($resultUpdate){
	echo "ok";
}
else{
	echo "fail";
}

?>