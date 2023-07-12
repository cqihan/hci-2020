<!DOCTYPE html>
<html lang="en">
<head>

 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>


  
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/wholeindexpage.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.10.2/dist/sweetalert2.all.min.js"></script>
  -->
  
  <title>Add Place</title>

  <link rel="stylesheet" href="css/forms.css">
  <!--<link rel="stylesheet" href="css/wholeindexpage.css"> -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
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
      <a class="navbar-brand" href="index.php"><img src="img/planet-earth2.png" width="70px" height="70px" id="webIcon" ></a>
    </div>
    <div class="navigate" id="myNavbar">
      <ul class="nav navbar-nav ml-auto">
        <li><a href="index.php" class="nav-link">
          <span>
            <i class="fa fa-arrow-left" aria-hidden="true"></i>
          </span>  BACK TO HOME PAGE</a></li>
        <li><a href="login.php" class="nav-link">
          <span>
            <i class="fa fa-sign-in" aria-hidden="true"></i>
          </span>LOGIN</a>
        </li>
        <li><a href="signup.php" class="nav-link">
          <span>
            <i class="fa fa-user-plus" aria-hidden="true"></i>
          </span> SIGN UP</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

  <div class="wrap-container"> 

  <h1 style="text-align: center;">Add Place</h1>

 <form class="form-horizontal " method="POST" enctype="multipart/form-data">


      <label class="control-label col-sm-2 "><b>Place Name</b></label>
      <div class="col-sm-9">
        <input type="text" class="form-control" placeholder="Enter Place Name" id="place_name"><br>
      </div>

      <label class="control-label col-sm-2"><b>Address</b></label>
      <div class="col-sm-9">
       <textarea rows="4" class="form-control" placeholder="Enter Address" name="address" id="address"></textarea><br>
      </div>

      <label class="control-label col-sm-2"><b>State</b></label>
      <div class="col-sm-9">
       <select class="form-control" id="state">
          <option selected value="" disabled>All</option>
          <option value="Johor">Johor</option>
          <option value="Kuala Lumpur">Kuala Lumpur</option>
          <option value="Selangor">Selangor</option>
        </select>
        <br>
      </div>

   
      <label class="control-label col-sm-2 "><b>Working Hours</b></label>
      <div class="col-sm-9">
        <textarea rows="3" class="form-control" placeholder="Enter Working Hours" name="working_hours" id="working_hours"></textarea><br>
      </div>
    
    
    
      <label class="control-label col-sm-2"><b>Contact No</b></label>
      <div class="col-sm-9">          
        <input type="text" class="form-control" placeholder="0123456789" name="contact_no" id="contact_no"><br>
      </div>
    

       <label class="control-label col-sm-2">Description</p></label>
      <div class="col-sm-9">          
         <textarea rows="5" class="form-control" placeholder="Enter Description" name="description" id="description"></textarea><br>
      </div>
      <br>

      <label class="control-label col-sm-2" ><b>Image:</b></label>
      <div class="col-sm-9">   
        <a><img style="width:250px; height:250px; display: none" id="addimg" src="" alt="your image" /></a>
        <input onchange="readURL(this)" type="file" id="file" name="file" />
      </div>
    


      <div class="col-sm-offset-2 col-sm-9">
          <button type="button" class="btn btn-success btn-lg btn-block" style="border-radius: 30px; width: 100%;" onclick="checkBtn()" >Add Place</button>
    </div>
    <br>

</form>
</div>

<script type="text/javascript">
   

    function checkBtn(){

      var place_name=$.trim($('#place_name').val());
      var address=$.trim($('#address').val());
      var state=$.trim($('#state').val());
      var working_hours=$.trim($('#working_hours').val());
      var contact_no=$.trim($('#contact_no').val());
      var description=$.trim($('#description').val());
      var imagePath = "";
      var image = "";
      var fd = new FormData();
      var files = $("#file")[0].files[0];
      fd.append("file", files);
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
                                     url: "addPlaceDb.php",
                                     method: "POST",
                                     data: {
                                          place_name : place_name,
                                          address : address,
                                          state : state,
                                          working_hours : working_hours,
                                          contact_no : contact_no,
                                          description : description,
                                          image: imagePath
                                     },
                                     success: function(data) {
                                         if (data == "ok") {
                                            Swal.fire({
                                               type: 'success',
                                               title: 'Add Place Successful',
                                               text: 'You have add new place successfully',
                                               showConfirmButton: true,
                                               timer:6000,
                                           })
                                         }
                                         else{
                                          alert(data);
                                         }
                                     }
                                 });
                             } else {
                                 alert("Please add image");
                             }
                         }
                     });

                     

                 }
                 else{
                  $('#error_image').show();
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