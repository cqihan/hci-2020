<?php
session_start();
include "includes/dbh.inc.php";
$place_id=$_GET['id'];

$queryCheckRating="SELECT count(*) As rater from rating WHERE place_id='$place_id'";
$checkRating=mysqli_query($conn, $queryCheckRating);
$resultCheckRating=mysqli_fetch_assoc($checkRating);
$rater=$resultCheckRating['rater'];

$placeRating="SELECT ROUND(((SUM(waste_management_rating) + SUM(air_quality_rating) + SUM(water_quality_rating) + SUM(biodiversity_rating))/4)/count(username),1) as overall_rating FROM rating WHERE place_id='$place_id'";
$ratingResult=mysqli_query($conn,$placeRating);
$rating=mysqli_fetch_assoc($ratingResult);
$overall_rating=$rating['overall_rating'];
?>

<div id="refresh_overall">
	<p><?php echo "Overall Rating: " . $overall_rating;?></p>
	<p><?php echo "Total Rater: " . $rater;?></p>
</div>