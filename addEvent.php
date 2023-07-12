<!DOCTYPE html>
<html lang="en">
<head>

 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/wholeindexpage.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.10.2/dist/sweetalert2.all.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.43/css/bootstrap-datetimepicker.min.css"> 
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.43/css/bootstrap-datetimepicker-standalone.css"> 
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.43/js/bootstrap-datetimepicker.min.js"></script>
-->
  <title>Add Event</title>

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
      <!-- temporary deleting
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>-->
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

  <h1 style="text-align: center;">Add Event</h1>

 <form class="form-horizontal " method="POST" enctype="multipart/form-data">


      <label class="control-label col-sm-2 "><b>Event Name</b></label>
      <div class="col-sm-9">
        <input type="text" class="form-control" placeholder="Enter Event Name" id="event_name"><br>
      </div>

      <label class="control-label col-sm-2"><b>Location</b></label>
      <div class="col-sm-9">
       <textarea rows="2" class="form-control" placeholder="Enter Location" id="location"></textarea><br>
      </div>

      <label class="control-label col-sm-2" for="date">Event Date</label>
      <div class="col-sm-9">
        <div class='input-group date' id='datetimepicker1'>
          <input type='text' class="form-control" id="event_date">
          <span class="input-group-addon">
              <span class="glyphicon glyphicon-calendar"></span>
          </span>
        </div>
        <br>
      </div>
   
      <label class="control-label col-sm-2 "><b>Event Time</b></label>
      <div class="col-sm-9">
        <input type="text" class="form-control" placeholder="Enter Event Time" id="event_time"><br>
      </div>
    
    
    
      <label class="control-label col-sm-2"><b>Contact No</b></label>
      <div class="col-sm-9">          
        <input type="text" class="form-control" placeholder="0123456789" id="contact_no"><br>
      </div>
    

       <label class="control-label col-sm-2">Description</p></label>
      <div class="col-sm-9">          
         <textarea rows="5" class="form-control" placeholder="Enter Description" name="description" id="description"></textarea><br>
      </div>
      <br>

      <label class="control-label col-sm-2" for="date">Deadline</label>
      <div class="col-sm-9">
        <div class='input-group date' id='datetimepicker2'>
          <input type='text' class="form-control" id="deadline">
          <span class="input-group-addon">
              <span class="glyphicon glyphicon-calendar"></span>
          </span>
        </div>
        <br>
      </div>

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

      var event_name=$.trim($('#event_name').val());
      var location=$.trim($('#location').val());
      var event_date=$.trim($('#event_date').val());
      var event_time=$.trim($('#event_time').val());
      var contact_no=$.trim($('#contact_no').val());
      var description=$.trim($('#description').val());
      var deadline=$.trim($('#deadline').val());
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
                                     url: "addEventDb.php",
                                     method: "POST",
                                     data: {
                                          event_name : event_name,
                                          location : location,
                                          event_date : event_date,
                                          event_time : event_time,
                                          contact_no : contact_no,
                                          description : description,
                                          deadline : deadline,
                                          image: imagePath
                                     },
                                     success: function(data) {
                                         if (data == "ok") {
                                            Swal.fire({
                                               type: 'success',
                                               title: 'Add Event Successful',
                                               text: 'You have add new event successfully',
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

        $(function () {
                      $('#datetimepicker1').datetimepicker({
                          format: 'YYYY-MM-DD',
                          minDate: new Date(),
                      });
                      $('#datetimepicker2').datetimepicker({
                          format: 'YYYY-MM-DD',
                          minDate: new Date(),
                      });
                  });

  
</script>

</body>
</html>