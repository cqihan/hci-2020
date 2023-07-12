<?php
  session_start();
  include "includes/dbh.inc.php";
  $place_id=$_GET['id'];

  $queryCheckRating="SELECT count(*) As rater from rating WHERE place_id='$place_id'";
  $checkRating=mysqli_query($conn, $queryCheckRating);
  $resultCheckRating=mysqli_fetch_assoc($checkRating);

  $placeRating="SELECT ROUND(SUM(waste_management_rating)/count(username),1) AS average_waste_management_rating, ROUND(SUM(air_quality_rating)/count(username),1) AS average_air_quality_rating, ROUND(SUM(water_quality_rating)/count(username),1) AS average_water_quality_rating, ROUND(SUM(biodiversity_rating)/count(username),1) AS average_biodiversity_rating FROM rating WHERE place_id='$place_id'";
          $ratingResult=mysqli_query($conn,$placeRating);
          $rating=mysqli_fetch_assoc($ratingResult);

          $average_waste_management_rating=$rating['average_waste_management_rating'];
          $average_air_quality_rating=$rating['average_air_quality_rating'];
          $average_water_quality_rating=$rating['average_water_quality_rating'];
          $average_biodiversity_rating=$rating['average_biodiversity_rating'];
?>
<div id="refresh_categories_rating">
  <?php
    if($resultCheckRating['rater'] > 0){
  ?>
    <p style="white-space: pre-wrap;">Categories Rating: <br></p>

    <p style="margin: 0; padding: 0;">Waste Management: <?php echo $average_waste_management_rating ?></p>
    <p style="margin: 0; padding: 0;">Air Quality: <?php echo $average_air_quality_rating ?></p>
    <p style="margin: 0; padding: 0;">Water Quality: <?php echo $average_water_quality_rating ?></p>
    <p style="margin: 0; padding: 0;">Biodiversity: <?php echo $average_biodiversity_rating ?></p>
  <?php
    }
  ?>
</div>