<!DOCTYPE html>
<html lang="en">
<head>

  <title>Visitor Sign Up</title>
  
  <link rel="stylesheet" href="css/forms.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" ></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.10.2/dist/sweetalert2.all.min.js"></script>


</head>

<body>

<?php
   include "includes/dbh.inc.php";

  ?>

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php"><img src="img/planet-earth2.png" width="70px" height="70px" id="webIcon" ></a>
    </div>
    <div class="navigate" id="myNavbar">
      <ul class="nav navbar-nav ml-auto">
        <li><a href="index.php" class="nav-link" style="color: white;">
          <span>
            <i class="fa fa-arrow-left" aria-hidden="true"></i>
          </span>  BACK TO HOME PAGE</a></li>
        <li><a href="signup.php" class="nav-link" style="color: white;">
          <span>
            <i class="fa fa-user-plus" aria-hidden="true"></i>
          </span> SIGN UP</a>
        </li>
      </ul>
    </div>
  </div>
</nav>


<div>
<div class="wrap-container"> 
<h1 style="text-align: center;">Log In</h1>
<label id="error_login" style="color: red; display: none; margin-left: 330px;">Incorrect username or password.</label>
<br>
<br>


<form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">

  <div class="form-group">
    <label class="control-label col-sm-2 " for="uname" ><b>Username:</b></label>
    <div class="col-sm-9">
      <input style="border-style: solid 2px;" type="text" class="form-control" placeholder="Enter Username" name="uname" id="username" required><br>
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-2" for="psw"><b>Password:</b></label>
    <div class="col-sm-9">          
       <input type="password" class="form-control" placeholder="Enter Password" name="psw" required>
    </div>
    <br><br>
  </div>

  <div class="form-group">        
    <div class="col-sm-offset-2 col-sm-9">
       <button class="btn btn-success"style="border-radius: 5px; width: 100%; padding: 14px 40px; font-size: 20px;"  type="submit" name="submit">LOGIN</button>
    </div>
  </div>

  <div class="form-group">        
    <div class="col-sm-offset-2 col-sm-10">
      <div class="checkbox">
         Not registered? <a href="signup.php">Create an account</a></p>
      </div>
    </div>

  


</form>
</div>

<script>
$(document).ready(function(){
// Initialize Tooltip
$('[data-toggle="tooltip"]').tooltip(); 

// Add smooth scrolling to all links in navbar + footer link
$(".navbar a, footer a[href='#myPage']").on('click', function(event) {

  // Make sure this.hash has a value before overriding default behavior
  if (this.hash !== "") {

    // Prevent default anchor click behavior
    event.preventDefault();

    // Store hash
    var hash = this.hash;

    // Using jQuery's animate() method to add smooth page scroll
    // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
    $('html, body').animate({
      scrollTop: $(hash).offset().top
    }, 900, function(){
 
      // Add hash (#) to URL when done scrolling (default click behavior)
      window.location.hash = hash;
    });
  } // End if
});
});



</script>

</body>
</html>

<?php

session_start();
if(isset($_POST['submit']))
{
$username=$_POST['uname'];
$password=$_POST['psw'];
$status="Active";

$sql="SELECT * FROM user where username='$username' AND password='$password' ";
$result=mysqli_query($conn,$sql);
$resultCheck=mysqli_num_rows($result);
  if($resultCheck<1){
    echo "<script>$('#error_login').show();</script>";
  }

  else{
    $_SESSION['username']=$username;
    header("Location: index.php");
  }
}

?>

<script type="text/javascript">
$('#username').keypress(function (e) {
  var regex = new RegExp("^[a-zA-Z0-9_]+$");
  var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
  if (regex.test(str)) {
      return true;
  }

  e.preventDefault();
  return false;
});

</script>

