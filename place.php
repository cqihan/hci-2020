<!DOCTYPE html>
<html lang="en">
<head>

<?php   
  include "includes/dbh.inc.php";

  session_start();
  $overall_rating=0;
  ?>

  <title> Place </title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" ></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.10.2/dist/sweetalert2.all.min.js"></script>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  
</head>

<body>
<style>
  .imgAlign{
    width: 15px;
    height: 15px;
    vertical-align: inherit;
  }
</style>
  <!-----------------Navigation bar section-------------->
  <section id="nav-bar">

  <?php
  include "navigation.php";
  ?>
  </section>

  <!------------------Promotion section----------------->
  <section id="banner">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <p class="promo-title">Places</p>
          <p>View all the places here. You are able to rate and view the feedbacks provided by previous users that had attended the particular places. 
            </p>
        </div>
        <div class="col-md-6 text-center">
          <img src="img/place1.png" class="img-fluid" width="300px" height="300px">
        </div>
      </div>
    </div>
  </section>

<!------------------Content section----------------->
  <div class="container">
  <div class="col-sm-4" style="display:inline-block; margin-top: 20px;">
      <label>Search by Place Name:</label>
      <input type="text" class="form-control" placeholder="Enter place name" id="place_name" value="<?php if(!empty($_GET['name'])){ echo $_GET['name'];}?>">
      
    </div>
    <div class="col-sm-4" for="date" style="display:inline-block;">
      <label>Search by State</label>
      <select class="form-control" id="state">
        <?php
          if(empty($_GET['state'])){
        ?>
          <option selected value="">All</option>
          <option value="Johor">Johor</option>
          <option value="Kuala Lumpur">Kuala Lumpur</option>
          <option value="Selangor">Selangor</option>
        <?php
        }
        else{
          if($_GET['state']=="Johor"){
        ?>
          <option value="">All</option>
          <option value="Johor" selected>Johor</option>
          <option value="Kuala Lumpur">Kuala Lumpur</option>
          <option value="Selangor">Selangor</option>
        <?php
          }
          else if($_GET['state']=="Kuala Lumpur"){
        ?>
          <option value="">All</option>
          <option value="Johor">Johor</option>
          <option value="Kuala Lumpur" selected>Kuala Lumpur</option>
          <option value="Selangor">Selangor</option>
        <?php
          }
          else if($_GET['state']=="Selangor"){
        ?>
          <option value="">All</option>
          <option value="Johor">Johor</option>
          <option value="Kuala Lumpur">Kuala Lumpur</option>
          <option value="Selangor" selected>Selangor</option>
        <?php
          }
        }
        ?>
      </select>
    </div>
    <div class="col-sm-4" style="display:inline;">
      <button onclick="searchPlace()" class="btn btn-info">Search</button><br>
    </div>

    <div class="col-sm-12" style="display: none; background:transparent;" id="error_result">
      <p><b>No result found.</b></p>
    </div>

  <?php
    if(empty($_GET['name']) && empty($_GET['state'])){
      $displayPlace = " SELECT * FROM place"; 
    }
    else if(empty($_GET['name'])){
      $displayPlace = " SELECT * FROM place WHERE state='".$_GET['state']."'"; 
    }
    else if(empty($_GET['state'])){
      $displayPlace = "SELECT * FROM place WHERE LOWER(place_name) LIKE LOWER('%".$_GET['name']."%')"; 
    }
    else{
      $displayPlace = "SELECT * FROM place WHERE state='".$_GET['state']."' AND LOWER(place_name) LIKE LOWER('%".$_GET['name']."%')"; 
    }
    $resultPlace = mysqli_query($conn,$displayPlace);
    $countResultPlace=mysqli_num_rows($resultPlace);
    if($countResultPlace<1){
      echo "<script>$('#error_result').show();</script>";
    }

    while($rowPlace=mysqli_fetch_array($resultPlace)){
      $place_id=$rowPlace['place_id'];
      $queryCheckRating="SELECT count(*) As rater from rating WHERE place_id='$place_id'";
      $checkRating=mysqli_query($conn, $queryCheckRating);
      $resultCheckRating=mysqli_fetch_assoc($checkRating);

      if($resultCheckRating['rater'] > 0){
          $placeRating="SELECT ROUND(((SUM(waste_management_rating) + SUM(air_quality_rating) + SUM(water_quality_rating) + SUM(biodiversity_rating))/4)/count(username),1) as overall_rating FROM rating WHERE place_id='".$rowPlace['place_id']."'";
          $ratingResult=mysqli_query($conn,$placeRating);
          $rating=mysqli_fetch_assoc($ratingResult);
          $overall_rating=$rating['overall_rating'];
      }
  ?>

  <br>
  <div class="row" >
    <div class="col-sm-12" style="background-image:  linear-gradient(to right, #87CEEB, #87CEEB); ">
      <div class="col-sm-8" style="height: 320px; padding: 15px;">
        <h2><?php echo $rowPlace['place_name'] ?></h2>
        <p>Address: <?php echo $rowPlace['place_address'] ?></p>
        <p style="white-space: pre-wrap;">Working Hours:<br><?php echo $rowPlace['working_hours'] ?></p>
        <p>Contact No: <?php echo $rowPlace['contact_no'] ?></p>
      </div> <!-- close col-sm-8 -->
      <div class="col-sm-4" style="position:absolute; top:10px; right:0px;">
        <p id="rating" style=" color: black; font-weight: bold; font-size: 18px;">
          <?php if($resultCheckRating['rater'] > 0){ echo "Overall Rating: " . $overall_rating;}else{ echo "No rating"; }?> <img class="imgAlign" src = "img/star1.png" >
        </p>
      </div><!-- close col-sm-8 -->
      <div class="p_image">
      <br><br><img src="<?php echo $rowPlace['picture'] ?>" style="position:absolute; top:10px; right:10px; width: 350px; height: 250px; margin-top: 70px; padding: 5px; ">
        <br>
      </div>
      <div class="button">
        <button id="viewBtn" onclick="location.href='placeInfo.php?id=<?php echo $rowPlace['place_id'] ?>'" class="btn btn-primary" style="position: absolute;right: 20px;bottom: 20px;">View More Information</button>
      </div>
    </div>
  </div>

  <br>




<?php

  }
?>

</div>

<script type="text/javascript">
  function searchPlace(){
    var place_name=$.trim($('#place_name').val());
    var state=$('#state').val();
    if(place_name!="" && state!=""){
      window.location.href = 'place.php?name='+place_name+'&state='+state;
    }
    else if(state!=""){
      window.location.href = 'place.php?state='+state;
    }
    else if(place_name!=""){
      window.location.href = 'place.php?name='+place_name;
    }
    else{
      window.location.href = 'place.php';
    }
  }
</script>
</body>
</html>