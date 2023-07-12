<!DOCTYPE html>
<html lang="en">
<head>

  <?php   
  include "includes/dbh.inc.php";

  session_start();
  $overall_rating=0;
  $average_waste_management_rating=0;
  $average_air_quality_rating=0;
  $average_water_quality_rating=0;
  $average_biodiversity_rating=0;
  $id=$_GET['id'];
  $waste_management_rating=0;
  $air_quality_rating=0;
  $water_quality_rating=0;
  $biodiversity_rating=0;

  ?>

  <title> Go Green </title>
  <link rel="stylesheet" href="css/style.css">
  <!--<link rel="stylesheet" href="css/wholeindexstyle.css">-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" ></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.10.2/dist/sweetalert2.all.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/star.css"> 

  <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">-->
  <style>@import url('https://fonts.googleapis.com/css2?family=Londrina+Solid:wght@300&display=swap');</style>
</head>

<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">
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
          <p class="promo-title">Place</p>
          <p>View all the places here. You are able to rate and view the feedbacks provided by previous users that had attended the particular places. 
            </p>
        </div>
        <div class="col-md-6 text-center">
          <!--<img src="img/CHIA.png" class="img-fluid">-->
          <img src="img/place1.png" class="img-fluid" width="300px" height="300px">
        </div>
      </div>
    </div>
  </section>

<div class="container">

  <?php
    if(empty($_SESSION['username'])){
  ?>
    <p></p>
    <p style="text-align: center; font-size: 25px; font-family: 'Londrina Solid', cursive; text-transform: uppercase;" ><b><span>Please login to give us a rating and leave a comment.</span></b></p>
  <?php
    }
    else{
  ?>
    <p></p>
    <p style="text-align: center; font-size: 25px; font-family: 'Londrina Solid', cursive; text-transform: uppercase;" ><b><span>Please give us a rating and leave a comment below.</span></b></p>
  <?php
    }
  ?>

  <?php
    $displayPlace = " SELECT description, place_name, place_address, working_hours, contact_no, picture FROM place where place_id='$id'"; 
    $resultPlace = mysqli_query($conn,$displayPlace);
    while($rowPlace=mysqli_fetch_array($resultPlace)){

      $queryCheckRating="SELECT count(*) As rater from rating WHERE place_id='$id'";
      $checkRating=mysqli_query($conn, $queryCheckRating);
      $resultCheckRating=mysqli_fetch_assoc($checkRating);
      if($resultCheckRating['rater'] > 0){
          $placeRating="SELECT ROUND(((SUM(waste_management_rating) + SUM(air_quality_rating) + SUM(water_quality_rating) + SUM(biodiversity_rating))/4)/count(username),1) AS overall_rating, ROUND(SUM(waste_management_rating)/count(username),1) AS average_waste_management_rating, ROUND(SUM(air_quality_rating)/count(username),1) AS average_air_quality_rating, ROUND(SUM(water_quality_rating)/count(username),1) AS average_water_quality_rating, ROUND(SUM(biodiversity_rating)/count(username),1) AS average_biodiversity_rating FROM rating WHERE place_id='$id'";
          $ratingResult=mysqli_query($conn,$placeRating);
          $rating=mysqli_fetch_assoc($ratingResult);

          $overall_rating=$rating['overall_rating'];
          $average_waste_management_rating=$rating['average_waste_management_rating'];
          $average_air_quality_rating=$rating['average_air_quality_rating'];
          $average_water_quality_rating=$rating['average_water_quality_rating'];
          $average_biodiversity_rating=$rating['average_biodiversity_rating'];
      }
  ?>

  
  <div class="row" >
    <div class="col-sm-12"  style="background-image:  linear-gradient(to right, #89CFF0, #6CB4EE );  border-style: none; padding: 20px;">
      <div class="col-sm-8">
        <h2><?php echo $rowPlace['place_name'] ?></h2>
        <p><?php echo $rowPlace['description'] ?></p>
        <br>
        <p><b>Address: </b><?php echo $rowPlace['place_address'] ?></p>
        <p style="white-space: pre-wrap;"><b>Working Hours:</b><br><?php echo $rowPlace['working_hours'] ?></p>
        <p><b>Contact No: </b><?php echo $rowPlace['contact_no'] ?></p><br>
        <p><b>Categories Rating Description</b></p>
        <p>Waste Management &rarr; Reusing and recycling of products <br>
          Air Quality &rarr; General cleanliness of the air <br>
          Water Quality &rarr; General cleanliness of the water <br>
          Biodiversity &rarr; The variety of plant and/or animal species <br>
      </div>
      <div class="col-sm-4" style= "position:absolute; top:10px; right:5px; ">
        <div id="refresh_overall">
          <p style="text-align: left;font-size: 20px;"><b><?php if($resultCheckRating['rater'] > 0){ echo "Overall Rating: " . $overall_rating;}else{ echo "No rating"; }?> <img class="imgAlign" src = "img/star1.png" ></p>
          <p style="text-align: left;"><?php if($resultCheckRating['rater'] > 0){ echo "Total Respondents: " . $resultCheckRating['rater'];}?></p>
          </b>
        </div>
        <img src="<?php echo $rowPlace['picture'] ?>"style="width: 300px; height: 200px; padding: 5px;"><!-- style="width: 500px; height: 350px; padding: 5px; position: flex;float: right;"-->
        <br>
        <div id="refresh_categories">
          <?php
            if($resultCheckRating['rater'] > 0){
          ?>
            <p style="white-space: pre-wrap; text-align: left;"><b>Categories Rating: <br></p>

            <p style="margin: 0; padding: 0; text-align: left; font-size: 18px;"> Waste Management: <?php echo $average_waste_management_rating ?> <img class="imgAlign" src = "img/star1.png" ></p>
            <p style="margin: 0; padding: 0; text-align: left; font-size: 18px;"> Air Quality: <?php echo $average_air_quality_rating ?> <img class="imgAlign" src = "img/star1.png" ></p>
            <p style="margin: 0; padding: 0; text-align: left; font-size: 18px;"> Water Quality: <?php echo $average_water_quality_rating ?> <img class="imgAlign" src = "img/star1.png" ></p>
            <p style="margin: 0; padding: 0; text-align: left; font-size: 18px;"> Biodiversity: <?php echo $average_biodiversity_rating ?> <img class="imgAlign" src = "img/star1.png" ></p><br><br>
            </b>
          <?php
            }
          ?>
        </div>
      </div><br><br>
      
      <?php
      if(empty($_SESSION['username'])){
      ?>
      <!--Think a design to let user login for submit rating -->
      <?php
      }
      else{
        $queryCheckUserRating="SELECT count(*) As rater from rating WHERE place_id='$id' AND username='".$_SESSION['username']."'";
        $checkUserRating=mysqli_query($conn, $queryCheckUserRating);
        $resultCheckUserRating=mysqli_fetch_assoc($checkUserRating);

        if($resultCheckUserRating['rater'] > 0){
          $queryUserSelectedRating="SELECT waste_management_rating, air_quality_rating, water_quality_rating, biodiversity_rating from rating WHERE place_id='$id' AND username='".$_SESSION['username']."'";
          $userSelectedRating=mysqli_query($conn, $queryUserSelectedRating);
          $resultUserSelectedRating=mysqli_fetch_assoc($userSelectedRating);

          $waste_management_rating=$resultUserSelectedRating['waste_management_rating'];
          $air_quality_rating=$resultUserSelectedRating['air_quality_rating'];
          $water_quality_rating=$resultUserSelectedRating['water_quality_rating'];
          $biodiversity_rating=$resultUserSelectedRating['biodiversity_rating'];
      ?>
	  <div class="container">
    <br><h4><b>Rate Us: </b></h4>
        <div id="waste_management_error" style="display: none;">
          <label style="color: red;">Please rate on Waste Management</label>
          <br/>
        </div>
        <div id="air_quality_error" style="display: none;">
          <label style="color: red;">Please rate on Air Quality</label>
          <br/>
        </div>
        <div id="water_quality_error" style="display: none;">
          <label style="color: red;">Please rate on Water Quality</label>
          <br/>
        </div>
        <div id="biodiversity_error" style="display: none;">
          <label style="color: red;">Please rate on Biodiversity</label>
          <br/>
        </div>
        <div class="col-sm-6">
          <p><b>Waste Management</b></p>
          <div class="rating" style="margin-top: -45px; padding-bottom: 110px; display: inline-block;">
            <?php
              if($waste_management_rating==5){
            ?>
              <input type="radio" name="rating" id="r1" checked>
              <label for="r1"></label>
            <?php
            }
            else{
            ?>
              <input type="radio" name="rating" id="r1">
              <label for="r1"></label>
            <?php
            
            }
            ?>
            <?php
              if($waste_management_rating==4){
            ?>
              <input type="radio" name="rating" id="r2" checked>
              <label for="r2"></label>
            <?php
            }
            else{
            ?>
              <input type="radio" name="rating" id="r2">
              <label for="r2"></label>
            <?php
            
            }
            ?>
            <?php
              if($waste_management_rating==3){
            ?>
              <input type="radio" name="rating" id="r3" checked>
              <label for="r3"></label>
            <?php
            }
            else{
            ?>
              <input type="radio" name="rating" id="r3">
              <label for="r3"></label>
            <?php
            
            }
            ?>
            <?php
              if($waste_management_rating==2){
            ?>
              <input type="radio" name="rating" id="r4" checked>
              <label for="r4"></label>
            <?php
            }
            else{
            ?>
              <input type="radio" name="rating" id="r4">
              <label for="r4"></label>
            <?php
            
            }
            ?>
            <?php
              if($waste_management_rating==1){
            ?>
              <input type="radio" name="rating" id="r5" checked>
              <label for="r5"></label>
            <?php
            }
            else{
            ?>
              <input type="radio" name="rating" id="r5">
              <label for="r5"></label>
            <?php
            
            }
            ?>
          </div>
        </div>
      
        <div class="col-sm-6">
          <p><b>Air Quality</b></p>
          <div class="rating1" style="margin-top: -45px; padding-bottom: 110px; display: inline-block">
            <?php
              if($air_quality_rating==5){
            ?>
              <input type="radio" name="rating1" id="r6" checked>
              <label for="r6"></label>
            <?php
            }
            else{
            ?>
              <input type="radio" name="rating1" id="r6">
              <label for="r6"></label>
            <?php
            
            }
            ?>
            <?php
              if($air_quality_rating==4){
            ?>
              <input type="radio" name="rating1" id="r7" checked>
              <label for="r7"></label>
            <?php
            }
            else{
            ?>
              <input type="radio" name="rating1" id="r7">
              <label for="r7"></label>
            <?php
            
            }
            ?>
            <?php
              if($air_quality_rating==3){
            ?>
              <input type="radio" name="rating1" id="r8" checked>
              <label for="r8"></label>
            <?php
            }
            else{
            ?>
              <input type="radio" name="rating1" id="r8">
              <label for="r8"></label>
            <?php
            
            }
            ?>
            <?php
              if($air_quality_rating==2){
            ?>
              <input type="radio" name="rating1" id="r9" checked>
              <label for="r9"></label>
            <?php
            }
            else{
            ?>
              <input type="radio" name="rating1" id="r9">
              <label for="r9"></label>
            <?php
            
            }
            ?>
            <?php
              if($air_quality_rating==1){
            ?>
              <input type="radio" name="rating1" id="r10" checked>
              <label for="r10"></label>
            <?php
            }
            else{
            ?>
              <input type="radio" name="rating1" id="r10">
              <label for="r10"></label>
            <?php
            
            }
            ?>
          </div>
        </div>
        <div class="col-sm-6" >
          <div><p><b>Water Quality</b></p>
		  </div>
          <div class="rating2" style="margin-top: -45px; padding-bottom: 110px; display: inline-block">
            <?php
              if($water_quality_rating==5){
            ?>
              <input type="radio" name="rating2" id="r11" checked>
              <label for="r11"></label>
            <?php
            }
            else{
            ?>
              <input type="radio" name="rating2" id="r11">
              <label for="r11"></label>
            <?php
            
            }
            ?>
            <?php
              if($water_quality_rating==4){
            ?>
              <input type="radio" name="rating2" id="r12" checked>
              <label for="r12"></label>
            <?php
            }
            else{
            ?>
              <input type="radio" name="rating2" id="r12">
              <label for="r12"></label>
            <?php
            
            }
            ?>
            <?php
              if($water_quality_rating==3){
            ?>
              <input type="radio" name="rating2" id="r13" checked>
              <label for="r13"></label>
            <?php
            }
            else{
            ?>
              <input type="radio" name="rating2" id="r13">
              <label for="r13"></label>
            <?php
            
            }
            ?>
            <?php
              if($water_quality_rating==2){
            ?>
              <input type="radio" name="rating2" id="r14" checked>
              <label for="r14"></label>
            <?php
            }
            else{
            ?>
              <input type="radio" name="rating2" id="r14">
              <label for="r14"></label>
            <?php
            
            }
            ?>
            <?php
              if($water_quality_rating==1){
            ?>
              <input type="radio" name="rating2" id="r15" checked>
              <label for="r15"></label>
            <?php
            }
            else{
            ?>
              <input type="radio" name="rating2" id="r15">
              <label for="r15"></label>
            <?php
            
            }
            ?>
          </div>
        </div>
        <div class="col-sm-6">
          <div><p><b>Biodiversity</b></p>

          <div class="rating3" style="margin-top: -45px; padding-bottom: 110px;">
            <?php
              if($biodiversity_rating==5){
            ?>
              <input type="radio" name="rating3" id="r16" checked>
              <label for="r16"></label>
            <?php
            }
            else{
            ?>
              <input type="radio" name="rating3" id="r16">
              <label for="r16"></label>
            <?php
            
            }
            ?>
            <?php
              if($biodiversity_rating==4){
            ?>
              <input type="radio" name="rating3" id="r17" checked>
              <label for="r17"></label>
            <?php
            }
            else{
            ?>
              <input type="radio" name="rating3" id="r17">
              <label for="r17"></label>
            <?php
            
            }
            ?>
            <?php
              if($biodiversity_rating==3){
            ?>
              <input type="radio" name="rating3" id="r18" checked>
              <label for="r18"></label>
            <?php
            }
            else{
            ?>
              <input type="radio" name="rating3" id="r18">
              <label for="r18"></label>
            <?php
            
            }
            ?>
            <?php
              if($biodiversity_rating==2){
            ?>
              <input type="radio" name="rating3" id="r19" checked>
              <label for="r19"></label>
            <?php
            }
            else{
            ?>
              <input type="radio" name="rating3" id="r19">
              <label for="r19"></label>
            <?php
            
            }
            ?>
            <?php
              if($biodiversity_rating==1){
            ?>
              <input type="radio" name="rating3" id="r20" checked>
              <label for="r20"></label>
            <?php
            }
            else{
            ?>
              <input type="radio" name="rating3" id="r20">
              <label for="r20"></label>
            <?php
            
            }
            ?>
          </div>
        </div>
        <div>
          <button id="rating" class="btn btn-success" style="position:absolute; bottom:10px; right:10px;">Submit Rating</button>
        </div>
      </div>
      <?php
        }
        else{


      ?>
        <div class="col-sm-12">
        <h4><b>Rate Us</b></h4>
        <div id="waste_management_error" style="display: none;">
          <label style="color: red;">Please rate on Waste Management</label>
          <br/>
        </div>
        <div id="air_quality_error" style="display: none;">
          <label style="color: red;">Please rate on Air Quality</label>
          <br/>
        </div>
        <div id="water_quality_error" style="display: none;">
          <label style="color: red;">Please rate on Water Quality</label>
          <br/>
        </div>
        <div id="biodiversity_error" style="display: none;">
          <label style="color: red;">Please rate on Biodiversity</label>
          <br/>
        </div>
        <div class="col-sm-4">
          <div><p><b>Waste Management</b></p>
		  </div>
          <div class="rating" style="margin-top: -45px; padding-bottom: 110px;">
            <input type="radio" name="rating" id="r1">
            <label for="r1"></label>
            <input type="radio" name="rating" id="r2">
            <label for="r2"></label>
            <input type="radio" name="rating" id="r3">
            <label for="r3"></label>
            <input type="radio" name="rating" id="r4">
            <label for="r4"></label>
            <input type="radio" name="rating" id="r5">
            <label for="r5"></label>
          </div>
        </div>
        <div class="col-sm-4">
          <div><p><b>Air Quality</b></p>
		  </div>
          <div class="rating1" style="margin-top: -45px; padding-bottom: 110px;">
            <input type="radio" name="rating1" id="r6">
            <label for="r6"></label>
            <input type="radio" name="rating1" id="r7">
            <label for="r7"></label>
            <input type="radio" name="rating1" id="r8">
            <label for="r8"></label>
            <input type="radio" name="rating1" id="r9">
            <label for="r9"></label>
            <input type="radio" name="rating1" id="r10">
            <label for="r10"></label>
          </div>
        </div>
        <div class="col-sm-4" style="padding-bottom: 110px;">
          <p><b>Water Quality</b></p>
          <div class="rating2" style="margin-top: -45px;">
            <input type="radio" name="rating2" id="r11">
            <label for="r11"></label>
            <input type="radio" name="rating2" id="r12">
            <label for="r12"></label>
            <input type="radio" name="rating2" id="r13">
            <label for="r13"></label>
            <input type="radio" name="rating2" id="r14">
            <label for="r14"></label>
            <input type="radio" name="rating2" id="r15">
            <label for="r15"></label>
          </div>
        </div>
        <div class="col-sm-4" style="padding-bottom: 110px;">
          <p><b>Biodiversity</b></p>
          <div class="rating3" style="margin-top: -45px;">
            <input type="radio" name="rating3" id="r16">
            <label for="r16"></label>
            <input type="radio" name="rating3" id="r17">
            <label for="r17"></label>
            <input type="radio" name="rating3" id="r18">
            <label for="r18"></label>
            <input type="radio" name="rating3" id="r19">
            <label for="r19"></label>
            <input type="radio" name="rating3" id="r20">
            <label for="r20"></label>
          </div>
        </div>
        <div class="col-sm-12">
          <button id="rating" class="btn btn-success">Submit Rating</button>
        </div>
      </div>
      <?php
        }
      }
      ?>

    </div>
  </div>
</div>


<div id="refresh_comment_count">
    <?php

      $checkComment = "SELECT * FROM comment where place_id='$id'"; 
      $commentResult = mysqli_query($conn,$checkComment);
      $commentCount=mysqli_num_rows($commentResult)
    ?>

    <div class="form-group" style="display: none;">
       <input type="text" name="comment_count" id="comment_count" class="form-control" placeholder="Enter Title" value="<?php echo $commentCount; ?>" />
    </div>
</div>
<br>
<div class="container" style="border-style: none; border-radius: 10px;">
  <div class="row">
    <div class="col-sm-12" style="background: none;">
    <h2>Comments</h2>
      <?php
        if(!empty($_SESSION['username'])){
      ?>
        <label id="comment_error" style="display: none; color: red;">Please enter comment</label>
        <textarea name="comment_content" id="comment_content" class="form-control" placeholder="Enter Comment" rows="5"></textarea>
        <br>
        <button onclick="addComment()" class="btn btn-info">Add Comment</button>
        <br>
        <?php
        }
        ?>
        <br>
        <div id="display_comment"></div>
        <div id="display_button"></div>
        <br>
    </div>
  </div>
</div>
    





<?php

  }
?>

<script>
  $(document).ready(function() {
         $('#rating').click(function() {
             radiobtn1 = document.getElementById("r1");
             radiobtn2 = document.getElementById("r2");
             radiobtn3 = document.getElementById("r3");
             radiobtn4 = document.getElementById("r4");
             radiobtn5 = document.getElementById("r5");
             var waste_management_rating = "";
             radiobtn6 = document.getElementById("r6");
             radiobtn7 = document.getElementById("r7");
             radiobtn8 = document.getElementById("r8");
             radiobtn9 = document.getElementById("r9");
             radiobtn10 = document.getElementById("r10");
             var air_quality_rating = "";
             radiobtn11 = document.getElementById("r11");
             radiobtn12 = document.getElementById("r12");
             radiobtn13 = document.getElementById("r13");
             radiobtn14 = document.getElementById("r14");
             radiobtn15 = document.getElementById("r15");
             var water_quality_rating = "";
             radiobtn16 = document.getElementById("r16");
             radiobtn17 = document.getElementById("r17");
             radiobtn18 = document.getElementById("r18");
             radiobtn19 = document.getElementById("r19");
             radiobtn20 = document.getElementById("r20");
             var biodiversity_rating = "";
             var place_id="<?php echo $_GET['id']; ?>";
             //have not change else if
             if (radiobtn5.checked == true) {
                 radiobtn1.checked = false;
                 radiobtn2.checked = false;
                 radiobtn3.checked = false;
                 radiobtn4.checked = false;
                 radiobtn5.checked = true;
                 $('#waste_management_error').hide();
                 waste_management_rating = 1;
             } else if (radiobtn4.checked == true) {
                 radiobtn1.checked = false;
                 radiobtn2.checked = false;
                 radiobtn3.checked = false;
                 radiobtn4.checked = true;
                 radiobtn5.checked = false;
                 $('#waste_management_error').hide();
                 waste_management_rating = 2;
             } else if (radiobtn3.checked == true) {
                 radiobtn1.checked = false;
                 radiobtn2.checked = false;
                 radiobtn3.checked = true;
                 radiobtn4.checked = false;
                 radiobtn5.checked = false;
                 $('#waste_management_error').hide();
                 waste_management_rating = 3;
             } else if (radiobtn2.checked == true) {
                 radiobtn1.checked = false;
                 radiobtn2.checked = true;
                 radiobtn3.checked = false;
                 radiobtn4.checked = false;
                 radiobtn5.checked = false;
                 $('#waste_management_error').hide();
                 waste_management_rating = 4;
             } else if (radiobtn1.checked == true) {
                 radiobtn1.checked = true;
                 radiobtn2.checked = false;
                 radiobtn3.checked = false;
                 radiobtn4.checked = false;
                 radiobtn5.checked = false;
                 $('#waste_management_error').hide();
                 waste_management_rating = 5;
             } else{
              $('#waste_management_error').show();
             }
             if (radiobtn10.checked == true) {
                 radiobtn6.checked = false;
                 radiobtn7.checked = false;
                 radiobtn8.checked = false;
                 radiobtn9.checked = false;
                 radiobtn10.checked = true;
                 $('#air_quality_error').hide();
                 air_quality_rating = 1;
             } else if (radiobtn9.checked == true) {
                 radiobtn6.checked = false;
                 radiobtn7.checked = false;
                 radiobtn8.checked = false;
                 radiobtn9.checked = true;
                 radiobtn10.checked = false;
                 $('#air_quality_error').hide();
                 air_quality_rating = 2;
             } else if (radiobtn8.checked == true) {
                 radiobtn6.checked = false;
                 radiobtn7.checked = false;
                 radiobtn8.checked = true;
                 radiobtn9.checked = false;
                 radiobtn10.checked = false;
                 $('#air_quality_error').hide();
                 air_quality_rating = 3;
             } else if (radiobtn7.checked == true) {
                 radiobtn6.checked = false;
                 radiobtn7.checked = true;
                 radiobtn8.checked = false;
                 radiobtn9.checked = false;
                 radiobtn10.checked = false;
                 $('#air_quality_error').hide();
                 air_quality_rating = 4;
             } else if (radiobtn6.checked == true) {
                 radiobtn6.checked = true;
                 radiobtn7.checked = false;
                 radiobtn8.checked = false;
                 radiobtn9.checked = false;
                 radiobtn10.checked = false;
                 $('#air_quality_error').hide();
                 air_quality_rating = 5;
             } else{
              $('#air_quality_error').show();
             }
             if (radiobtn15.checked == true) {
                 radiobtn11.checked = false;
                 radiobtn12.checked = false;
                 radiobtn13.checked = false;
                 radiobtn14.checked = false;
                 radiobtn15.checked = true;
                 $('#water_quality_error').hide();
                 water_quality_rating = 1;
             } else if (radiobtn14.checked == true) {
                 radiobtn11.checked = false;
                 radiobtn12.checked = false;
                 radiobtn13.checked = false;
                 radiobtn14.checked = true;
                 radiobtn15.checked = false;
                 $('#water_quality_error').hide();
                 water_quality_rating = 2;
             } else if (radiobtn13.checked == true) {
                 radiobtn11.checked = false;
                 radiobtn12.checked = false;
                 radiobtn13.checked = true;
                 radiobtn14.checked = false;
                 radiobtn15.checked = false;
                 $('#water_quality_error').hide();
                 water_quality_rating = 3;
             } else if (radiobtn12.checked == true) {
                 radiobtn11.checked = false;
                 radiobtn12.checked = true;
                 radiobtn13.checked = false;
                 radiobtn14.checked = false;
                 radiobtn15.checked = false;
                 $('#water_quality_error').hide();
                 water_quality_rating = 4;
             } else if (radiobtn11.checked == true) {
                 radiobtn11.checked = true;
                 radiobtn12.checked = false;
                 radiobtn13.checked = false;
                 radiobtn14.checked = false;
                 radiobtn15.checked = false;
                 $('#water_quality_error').hide();
                 water_quality_rating = 5;
             } else{
              $('#water_quality_error').show();
             }
             if (radiobtn20.checked == true) {
                 radiobtn16.checked = false;
                 radiobtn17.checked = false;
                 radiobtn18.checked = false;
                 radiobtn19.checked = false;
                 radiobtn20.checked = true;
                 $('#biodiversity_error').hide();
                 biodiversity_rating = 1;
             } else if (radiobtn19.checked == true) {
                 radiobtn16.checked = false;
                 radiobtn17.checked = false;
                 radiobtn18.checked = false;
                 radiobtn19.checked = true;
                 radiobtn20.checked = false;
                 $('#biodiversity_error').hide();
                 biodiversity_rating = 2;
             } else if (radiobtn18.checked == true) {
                 radiobtn16.checked = false;
                 radiobtn17.checked = false;
                 radiobtn18.checked = true;
                 radiobtn19.checked = false;
                 radiobtn20.checked = false;
                 $('#biodiversity_error').hide();
                 biodiversity_rating = 3;
             } else if (radiobtn17.checked == true) {
                 radiobtn16.checked = false;
                 radiobtn17.checked = true;
                 radiobtn18.checked = false;
                 radiobtn19.checked = false;
                 radiobtn20.checked = false;
                 $('#biodiversity_error').hide();
                 biodiversity_rating = 4;
             } else if (radiobtn16.checked == true) {
                 radiobtn16.checked = true;
                 radiobtn17.checked = false;
                 radiobtn18.checked = false;
                 radiobtn19.checked = false;
                 radiobtn20.checked = false;
                 $('#biodiversity_error').hide();
                 biodiversity_rating = 5;
             } else{
              $('#biodiversity_error').show();
             }
             if((radiobtn1.checked == true || radiobtn2.checked == true || radiobtn3.checked == true || radiobtn4.checked == true || radiobtn5.checked == true) && (radiobtn6.checked == true || radiobtn7.checked == true || radiobtn8.checked == true || radiobtn9.checked == true || radiobtn10.checked == true) && (radiobtn11.checked == true || radiobtn12.checked == true || radiobtn13.checked == true || radiobtn14.checked == true || radiobtn15.checked == true) && (radiobtn16.checked == true || radiobtn17.checked == true || radiobtn18.checked == true || radiobtn19.checked == true || radiobtn20.checked == true)){
              $.ajax({
               url:"rating.php",
               method:"POST",
               data:{
                place_id:place_id,
                waste_management_rating:waste_management_rating,
                air_quality_rating:air_quality_rating,
                water_quality_rating:water_quality_rating,
                biodiversity_rating:biodiversity_rating},
               success:function(data)
               {
                if(data=="ok"){
                  $("#refresh_overall").load("refreshOverall.php?id=" + place_id);
                  $("#refresh_categories").load("refreshCategories.php?id=" + place_id);
                  $('#refresh_button').html("<button id='update_rating' class='btn btn-success'>Submit Rating</button>");
                   alert("ok");
                }
                else{
                  alert(data);
                }
               }
              })
             }
  
    });
});


</script>

<script>
 var limit = 3;
 var start = 0;
 var place_id="<?php echo $_GET['id']; ?>";

load_comment(limit,start);


 function load_comment(limit,start)
 {
  $.ajax({
   url:"fetch_comment.php",
   method:"POST",
   data:{limit:limit,
    start:start,
    place_id:place_id},
   success:function(data)
   {
    $('#display_comment').append(data);
    if(data==""){
       $('#display_button').html("");
    }
    else{
       var count_comment=$('#comment_count').val();
       var check_comment_range=start+limit;
       if(count_comment>check_comment_range){ 
          $('#display_button').html("<button type='button' class='btn btn-info' id='btn_more'>Load More Comments</button>");
       }
      else{
          $('#display_button').html("");
       }
    }
    
   }
  })
 }
 

$(document).on('click', '#btn_more', function(){  
           start=start+limit;
           load_comment(limit,start);
           
      });  
 

  function load_add_comment()
  {
  var new_comment_start=0;
  var new_comment_limit=1;
  $.ajax({
   url:"fetch_comment.php",
   method:"POST",
   data:{limit:new_comment_limit,
    start:new_comment_start,
    place_id:place_id},
   success:function(data)
   {
    $('#display_comment').prepend(data);
   }
  })
 }


function addComment(){
  var comment_content=$.trim($('#comment_content').val());
  if (comment_content==""){
    $('#comment_error').show();
  }
  else{
    $.ajax({
   url:"addcomment.php",
   method:"POST",
   data:{comment_content:comment_content,
          place_id:place_id},
   success:function(data)
   {
    if(data=="ok")
    {
     $('#comment_content').val('');
     $('#comment_error').hide();
     $("#refresh_comment_count").load("refreshCommentCount.php?id=" + place_id);
     load_add_comment();
     start=start+1;
     limit=limit+1;
    }
   }
  })
  }
 }
</script>

</body>
</html>