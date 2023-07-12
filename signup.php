<!DOCTYPE html>
<html lang="en">
<head>

  <title>Visitor Sign Up</title>
  
  <link rel="stylesheet" href="css/forms.css">
  <!--<link rel="stylesheet" href="css/wholeindexpage.css"> -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" ></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


</head>

<body>

  <?php
   include "includes/dbh.inc.php";

  ?>

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <!-- temporary deleting
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>-->
      <a class="navbar-brand" href="index.php"><img src="img/planet-earth2.png" width="70px" height="70px" id="webIcon" ></a>
    </div>
    <div class="navigate" id="myNavbar" >
      <ul class="nav navbar-nav ml-auto" >
        <li><a href="index.php" class="nav-link" style="color: white;">
          <span>
            <i class="fa fa-arrow-left" aria-hidden="true"></i>
          </span>  BACK TO HOME PAGE</a></li>
        <li><a href="login.php" class="nav-link" style="color: white;">
          <span>
            <i class="fa fa-sign-in" aria-hidden="true"></i>
          </span>LOGIN</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

  <div class="wrap-container"> 

    <h1 style="text-align: center;">Sign Up Here</h1>

    <form class="form-horizontal" method="POST" enctype="multipart/form-data">

          
          <label class="control-label col-sm-2 " for="name" ><b>Full Name:</b></label>
          <div class="col-sm-9">
            <input type="text" class="form-control" placeholder="Enter Full Name" id="fullname" name="fullname" maxlength="30">
          <label id="error_fullname" style="color: red; display: none">Please enter fullname.</label>
          <label id="error_invalid_fullname" style="color: red; display: none">Symbols are not allowed. Please enter valid fullname.</label><br>
          </div>

        <label class="control-label col-sm-2" for="uname" ><b>Username:</b></label>
          <div class="col-sm-9">
          <input type="text" class="form-control" placeholder="Enter Username" name="uname" id="username">
          <label id="error_username" style="color: red; display: none">Please enter username.</label>
          <label id="error_invalid_username" style="color: red; display: none;">Symbols are not allowed except understroke(_). Please enter new username.</label>
          <label id="error_username_exist" style="color: red; display: none;">Username has exist. Please enter new username.</label><br>
          </div>

      
          <label class="control-label col-sm-2 " for="email" ><b>Email Address:</b></label>
          <div class="col-sm-9">
            <input type="email" class="form-control" placeholder="Enter Email" name="email" id="email">
          <label id="error_email" style="color: red; display: none;">Enter email.</label>
          <label id="error_invalid_email" style="color: red; display: none;">This is not an email. Please enter new email.</label>
          <label id="error_email_exist" style="color: red; display: none;">Email has exist. Please enter new email.</label><br>
          </div>
        
        
        
          <label class="control-label col-sm-2" for="psw" ><b>Password:</b></label>
          <div class="col-sm-9">          
            <input type="password" class="form-control" placeholder="Enter Password" name="psw" id="password">
          <label id="error_password_count" style="color: red; display: none; ">Please enter your password at least 5 characters.</label><br>
          </div>
        

          <label class="control-label col-sm-2" for="con_psw"p><b>Confirm Password:</b></label>
          <div class="col-sm-9">          
            <input type="password" class="form-control" placeholder="Enter Confirm Password" name="con_psw" id="confirm_password">
            <label id="error_confirm_password" style="color: red; display: none;">Incorrect confirm password.Please re-enter confirm password.</label>
          </div>
          <br>

          <label class="control-label col-sm-6" ><b>Profile Image:</b> Only jpg, png & jpeg image are allowed</label>
          <div class="col-sm-9">   
            <a><img class="img-circle" style="width:250px; height:250px; display: none" id="addimg" src="" alt="your image" /></a>
            <input onchange="readURL(this)" type="file" id="file" name="file" />
            <label id="error_image" style="color: red; display: none;">Please upload your profile picture.</label> 
            <label id="error_image_format" style="color: red; display: none;">Invalid picture. Please upload new image.</label>
          </div>
        
          <div class="col-sm-offset-2 col-sm-9">
              <button type="button" id="formBtn" class="btn btn-success btn-lg btn-block" onclick="checkBtn()" >SIGN UP</button>
        </div>
        <br>

    </form>
  </div>

<script type="text/javascript">

  $('#fullname').keypress(function (e) {
    var regex = new RegExp("^[a-zA-Z ]+$");
    var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (regex.test(str)) {
        return true;
    }

    e.preventDefault();
    return false;
});



    $('#username').keypress(function (e) {
    var regex = new RegExp("^[a-zA-Z0-9_]+$");
    var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (regex.test(str)) {
        return true;
    }

    e.preventDefault();
    return false;
});
   

    function checkBtn(){

      var fullname=$.trim($('#fullname').val());
      var email=$.trim($('#email').val());
      var username=$.trim($('#username').val());
      var password=$.trim($('#password').val());
      var imagePath = "";
      var image = "";
      var fd = new FormData();
      var files = $("#file")[0].files[0];
      fd.append("file", files);

      if(fullname==""){
        $('#error_fullname').show();
      }
      else{
        $('#error_fullname').hide();
        $('#error_invalid_fullname').hide();
      }
      if(username==""){
        $('#error_username').show();
      }
      else{
        $('#error_username').hide();
        $('#error_username_exist').hide();
        $('#error_invalid_username').hide();
      }
      if(email==""){
        $('#error_email').show();
      }
      else{
        $('#error_email').hide();
        $('#error_email_exist').hide();
        $('#error_invalid_email').hide();
      }
      if(password.length<5){
        $('#error_password_count').show();
      }
      else{
        $('#error_password_count').hide();
      }
      if(document.getElementById('password').value !== document.getElementById('confirm_password').value)
      {
        $('#error_confirm_password').show();
      }
      else{
        $('#error_confirm_password').hide();
      }
      if($('#file').val() != ""){
        $('#error_image').hide();
        $('#error_image_format').hide();
      }
      else{
        $('#error_image').show();
      }
      if(fullname=="" || email=="" || password.length<5 || document.getElementById('password').value !== document.getElementById('confirm_password').value){

      }
      else{
        if ($('#file').val() != "") {
                     $.ajax({
                         url: "upload.php",
                         type: "post",
                         data: fd,
                         contentType: false,
                         processData: false,
                         async: false,
                         success: function(response) {
                             if (response != 0) {
                                 image = response;
                                 var imagePath = image;
                                 $.ajax({
                                     url: "includes/signup.inc.php",
                                     method: "POST",
                                     data: {
                                          fullname : fullname,
                                          email : email,
                                          username : username,
                                          password : password,
                                          image: imagePath
                                     },
                                     success: function(data) {
                                         if (data == "ok") {
                                            $('#fullname').val('');
                                            $('#email').val('');
                                            $('#username').val('');
                                            $('#password').val('');
                                            $('#addimg').val('');
                                            $('#file').val('');
                                            $('#confirm_password').val('');
                                            $('#error_fullname').hide();
                                            $('#error_email').hide();
                                            $('#error_username').hide();
                                            $('#error_password_count').hide();
                                            $('#error_confirm_password').hide();
                                            $('#error_invalid_username').hide();
                                            $('#error_invalid_fullname').hide();
                                            $('#error_username_exist').hide();
                                            $('#error_email_exist').hide();
                                            $('#error_image').hide();
                                            $('#error_image_format').hide();
                                            $('#error_invalid_email').hide();
                                            $('#addimg').hide();
                                            Swal.fire({
                                               type: 'success',
                                               title: 'Sign Up Successful',
                                               text: 'You have sign up successfully. Please login.',
                                               showConfirmButton: true,
                                               timer:6000,
                                           })
                                         } else if(data=="Invalid username") {
                                           $('#error_invalid_username').show();
                                         }
                                         else if(data=="Invalid name") {
                                           $('#error_invalid_fullname').show();
                                         }
                                         else if(data=="Invalid email") {
                                           $('#error_invalid_email').show();
                                         }
                                         else if(data=="User exist") {
                                           $('#error_username_exist').show();
                                         }
                                         else if(data=="Email exist") {
                                           $('#error_email_exist').show();
                                         }
                                         else{
                                          $('#error_image').show();
                                         }
                                     }
                                 });
                             } else {
                                 $('#error_image_format').show();
                             }
                         }
                     });

                     

                 }
                 else{
                  $('#error_image').show();
                 }
      }
    }

  function loadfile(event){
    var output = document.getElementById("preimage");
    output.src = URL.createObjectURL(event.target.files[0]);
  };


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
})

function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
            $('#addimg').attr('src', e.target.result);
            };
            $('#addimg').css("display", "block");
            reader.readAsDataURL(input.files[0]);
            }
        }

  
</script>

</body>
</html>