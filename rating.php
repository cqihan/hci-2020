<?php
session_start();
include "includes/dbh.inc.php";

$place_id=$_POST['place_id'];
$username=$_SESSION['username'];
$waste_management_rating=$_POST['waste_management_rating'];
$air_quality_rating=$_POST['air_quality_rating'];
$water_quality_rating=$_POST['water_quality_rating'];
$biodiversity_rating=$_POST['biodiversity_rating'];

$queryCheckUserRating="SELECT count(*) As rater from rating WHERE place_id='$place_id' AND username='$username'";
$checkUserRating=mysqli_query($conn, $queryCheckUserRating);
$resultCheckUserRating=mysqli_fetch_assoc($checkUserRating);

if($resultCheckUserRating['rater'] > 0){
	$sqlUpdate="UPDATE rating SET waste_management_rating='$waste_management_rating' , air_quality_rating='$air_quality_rating' , water_quality_rating='$water_quality_rating' , biodiversity_rating='$biodiversity_rating' WHERE username='$username' AND place_id='$place_id' ";
	$resultUpdate=mysqli_query($conn,$sqlUpdate);
	if($resultUpdate){
		echo "ok";
	}
	else{
		echo "fail";
	}
}
else{
	$sqlInsert="INSERT INTO rating(place_id, username, waste_management_rating, air_quality_rating, water_quality_rating, biodiversity_rating) VALUES ('$place_id', '$username', '$waste_management_rating', '$air_quality_rating','$water_quality_rating', '$biodiversity_rating');";
	$resultInsert=mysqli_query($conn,$sqlInsert);
	if($resultInsert){
		echo "ok";
	}
	else{
		echo "fail";
	}
}

?>