<!DOCTYPE html>
<html lang="en">
<head>

  <?php   
  include "includes/dbh.inc.php";

  session_start();

  ?>

  <title> Go Green </title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/wholeindexstyle.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" ></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
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
            <p class="promo-title">LIVING A SUSTAINABLE LIFE</p>
            <p>Hub for all environment loving people! Rate, review and participate in places and organized events alike!</p>
          </div>
          <div class="col-md-6 text-center">
            <!--<img src="img/CHIA.png" class="img-fluid">-->
            <img src="img/planet-earth1.png" class="img-fluid">
          </div>
        </div>
      </div>
    </section>

  <!------------------Services section------------------>
  <section id="services">
    <div class="container">
      <h1 class="title text-center">WHAT IS OFFERED?</h1>
      <div class="row text-center">
        <div class="col-md-4 services">
          <img src="img/rating1.png" class="service-img">
          <h4>Rate</h4>
          <p> You can rate places based on your previous experiences.</p>
        </div>
        <div class="col-md-4 services">
          <img src="img/review1.png" class="service-img">
          <h4>Review</h4>
          <p> You can also review places that you have visited.</p>
        </div>
        <div class="col-md-4 services">
          <img src="img/joinevent1.png" class="service-img">
          <h4>Join an event</h4>
          <p> You can join events that you are interested in.</p>
        </div>
      </div>
    </div>
   </section>
  <!---------------------Rating description section-------------------->
<section id="about-us">
  <div class="container">
    <h1 class="title text-center">RATING METRICS</h1>
    <div class="about-us text-center">
      <p class="text-center">What rating metrics used for review?</p>
      <p class="text-center">The rating system for sustainable places is based on global environmental metrics that are classified to four different categories 
      </p>
      <br>
      <div class="row">
        <div class="col-sm-6">
            <p class="text-center bg-success"><strong>Waste Management </strong></p><br>
            <a href="#demo" data-toggle="collapse">
              <img src="img/wastemanagement.png" class="img-circle person img-fluid" alt="Random Name" width="255" height="255">
            </a>
          <p>Reusing and recycling of products</p>
          </div>
        <div class="col-sm-6">
            <p class="text-center bg-success"><strong>Air quality</strong></p><br>
            <a href="#demo" data-toggle="collapse">
              <img src="img/airquality.png" class="img-circle person img-fluid" alt="Random Name" width="255" height="255">
            </a>
          <p>General cleanliness of the air</p>
          </div>
        <div class="col-sm-6">
            <p class="text-center bg-success"><strong>Water quality</strong></p><br>
            <a href="#demo" data-toggle="collapse">
              <img src="img/waterquality.png" class="img-circle person img-fluid" alt="Random Name" width="255" height="255">
            </a>
          <p>General cleanliness of the water</p>
          </div>
		  <div class="col-sm-6">
            <p class="text-center bg-success"><strong>Biodiversity</strong></p><br>
            <a href="#demo" data-toggle="collapse">
              <img src="img/biodiversity.jpg" class="img-circle person img-fluid" alt="Random Name" width="255" height="255">
            </a>
          <p>The variety of plant and/or animal species</p>
          </div>
      </div>
    </div>
  </div>

</section>
<!--------------------About Us Section---------------
<section id="about-us">
  <div class="container">
    <h1 class="title text-center">ABOUT US</h1>
    <div class="about-us text-center">
      <p class="text-center">Who are we?</p>
      <p class="text-center">We are Uni students with a heart for the environment! We strive to help promote and spread out the phenomenal idea of sustainable living.
        Through our very very cool platform, you are able to achieve the sustainable living with events that we offer here. #WorkHardLiveEcofriendly
      </p>
      <br>
      <div class="row">
        <div class="col-sm-4">
            <p class="text-center bg-success"><strong>Wong Yew Onn</strong></p><br>
            <a href="#demo" data-toggle="collapse">
              <img src="img/CHIA.png" class="img-circle person img-fluid" alt="Random Name" width="255" height="255">
            </a>
          <p> Leader always cool</p>
          </div>
        <div class="col-sm-4">
            <p class="text-center bg-success"><strong>Teoh</strong></p><br>
            <a href="#demo" data-toggle="collapse">
              <img src="img/CHIA.png" class="img-circle person img-fluid" alt="Random Name" width="255" height="255">
            </a>
          <p> stay cool man </p>
          </div>
        <div class="col-sm-4">
            <p class="text-center bg-success"><strong>Chan Qi Han</strong></p><br>
            <a href="#demo" data-toggle="collapse">
              <img src="img/CHIA.png" class="img-circle person img-fluid" alt="Random Name" width="255" height="255">
            </a>
          <p> cant stay cool anymore </p>
          </div>
        <div class="col-sm-4">
            <p class="text-center bg-success"><strong>Wei Shen</strong></p><br>
            <a href="#demo" data-toggle="collapse">
              <img src="img/CHIA.png" class="img-circle person img-fluid" alt="Random Name" width="255" height="255">
            </a>
          <p> stay cool man </p>
          </div>
        <div class="col-sm-4">
            <p class="text-center bg-success"><strong>Matt</strong></p><br>
            <a href="#demo" data-toggle="collapse">
              <img src="img/CHIA.png" class="img-circle person img-fluid" alt="Random Name" width="255" height="255">
            </a>
          <p> I want to die </p>
          </div>
        <div class="col-sm-4">
            <p class="text-center bg-success"><strong>Prof. Lee Chien Sing</strong></p><br>
            <a href="#demo" data-toggle="collapse">
              <img src="img/LCS.png" class="img-circle person img-fluid" alt="Random Name" width="255" height="255">
            </a>
          <p> stay cool man </p>
        </div>	
      </div>
    </div>
  </div>

</section>-->

<section id="services">
<div class="container">
<h1 class="title text-center">Contact Us!</h1>

<div class="row">
    <div class="col-md-4 col1">
      <p>Sunway College Johor Bahru, Malaysia</p>
      <p>Phone: +6012-1234567</p>
      <p><a href="mailto:secure&safe817@gmail.com"></span>Email: secure&safe817@gmail.com</a></p>

  	</br>
    </div>
       
    <div class="col-md-4">
		<br>
        <p class="">Useful Links</p>
          <ul>
           <li><a href="#myPage">Home</a></li>
           <li><a href="#about">About us</a></li>
           <li><a href="signup.php">No Account?</a></li>
           <li><a href="login.php">Already have an Account?</a></li>
          </ul>
        </br>           
    </div>
        
    <div class="col-md-4">
        <br>
        <p class="">Our Social Media</p>
        <a href=""><i class="fa fa-twitter fa-2x" aria-hidden="true"></i></a>
		<a href=""><i class="fa fa-instagram fa-2x" aria-hidden="true"></i></a>
		<a href=""><i class="fa fa-facebook fa-2x" aria-hidden="true"></i></a>
		<a href=""><i class="fa fa-whatsapp fa-2x" aria-hidden="true"></i></a>
		<a href=""><i class="fa fa-snapchat fa-2x" aria-hidden="true"></i></a>
		<a href=""><i class="fa fa-linkedin fa-2x" aria-hidden="true"></i></a>
        </br>
    </div>

</div>
</div>
</section>

<section id="footer">
<footer class="text-center">
  <a class="up-arrow" href="index.html" data-toggle="tooltip" title="TO TOP">
    <!--<i class="fa fa-twitter fa-2x" aria-hidden="true"></i>-->
    <img src="img/copyright-symbol.png" width="50px" height="50x" alt="copyright">
  </a><br><br>
 <p>Implementation Project (To be Named) All rights reserved.</p> 
</footer>
</section>
</body>
</html>