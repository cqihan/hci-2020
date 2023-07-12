<!DOCTYPE html>
<html lang="en">
<head>

  <?php   
  include "includes/dbh.inc.php";

  session_start();
  date_default_timezone_set('Asia/Kuala_Lumpur');
  $current_date=date("Y-m-d");

  ?>

  <title> Event </title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.10.2/dist/sweetalert2.all.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.43/css/bootstrap-datetimepicker.min.css"> 
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.43/css/bootstrap-datetimepicker-standalone.css"> 
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.43/js/bootstrap-datetimepicker.min.js"></script>

  <style>@import url('https://fonts.googleapis.com/css2?family=Londrina+Solid:wght@300&display=swap');</style>

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
          <p class="promo-title">Events</p>
          <p>View all the events offered by other parties here. You are able to join any desired events that you may be interested!
            </p>
        </div>
        <div class="col-md-6 text-center">
          <!--<img src="img/CHIA.png" class="img-fluid">-->
          <img src="img/event1.png" class="img-fluid" width="300px" height="300px">
        </div>
      </div>
    </div>
  </section>

  <div class="container">

    <?php
      if(empty($_SESSION['username'])){
    ?>
      <p></p>
      <p style="text-align: center; font-size: 25px; font-family: 'Londrina Solid', cursive; text-transform: uppercase;" ><b><span>Please login to join our events</span></b></p>
    <?php
      }
    ?>
    
      <div class="col-sm-4" style="display:inline-block; margin-top: 20px;">
        <label>Search by Event Name:</label>
        <input type="text" class="form-control" placeholder="Enter event name" id="event_name" value="<?php if(!empty($_GET['name'])){ echo $_GET['name'];}?>">
        
      </div>
      <div class="col-sm-4" for="date" style="display:inline-block;">
        <label>Event Date</label>
        <div class='input-group date' id='datetimepicker1'>
          <input type='date' class="form-control" id="event_date" value="<?php if(!empty($_GET['date'])){ echo $_GET['date'];}?>">
          <span class="input-group-addon">
              <!--<span class="glyphicon glyphicon-calendar"></span>-->
          </span>
        </div>
      </div>
      <div class="col-sm-4" style="display:inline;">
        <button onclick="searchEvent()" class="btn btn-info">Search</button>
      </div>
      <div class="col-sm-4" style="display:inline;">
        <?php // View upcoming event button
        if(!empty($_SESSION['username'])){
          $queryCountJoinEvent="SELECT count(*) As join_event from participant WHERE username='".$_SESSION['username']."'";
          $countJoinEvent=mysqli_query($conn, $queryCountJoinEvent);
          $resultCountJoinEvent=mysqli_fetch_assoc($countJoinEvent);

          if($resultCountJoinEvent['join_event'] > 0){
          ?>
          <div id="refresh_upcoming_join_button">
            <button style="float: right; margin-top: -35px;" onclick="location.href='eventJoinInfo.php'" class="btn btn-primary">View Upcoming Joined Events</button>
            <br>
          </div>
          <?php
          }
          else{
          ?>
          <div id="refresh_upcoming_join_button">
          </div>
          <?php
          }
        }
        ?>
      </div>
      
      <div class="col-sm-12" style="display: none; background:transparent;" id="error_result">
        <p><b>No result found.</b></p>
      </div>
      <br><br><br>

      
    <?php

    if(empty($_GET['name']) && empty($_GET['date'])){
      $displayEvent = "SELECT * FROM event WHERE deadline>='$current_date'"; 
    }
    else if(empty($_GET['name'])){
      $displayEvent = "SELECT * FROM event WHERE deadline>='$current_date' AND event_date<='".$_GET['date']."'"; 
    }
    else if(empty($_GET['date'])){
      $displayEvent = "SELECT * FROM event WHERE deadline>='$current_date' AND LOWER(event_name) LIKE LOWER('%".$_GET['name']."%')"; 
    }
    else{
      $displayEvent = "SELECT * FROM event WHERE deadline>='$current_date' AND event_date<='".$_GET['name']."' AND LOWER(event_name) LIKE LOWER('%".$_GET['name']."%')"; 
    }
    $resultEvent = mysqli_query($conn,$displayEvent);
    $countResultEvent=mysqli_num_rows($resultEvent);
    if($countResultEvent<1){
      echo "<script>$('#error_result').show();</script>";
    }

    while($rowEvent=mysqli_fetch_array($resultEvent)){
      
  ?>


  <div class="row">
    <div class="col-sm-12" style="background-image: linear-gradient(to bottom right, #00cc99 0%, #00cc99 100%); padding: 15px; margin-bottom:50px;">
      <div class="col-sm-8">
        <h2><?php echo $rowEvent['event_name'] ?></h2>
        <p>Event Date & Time: <?php echo $rowEvent['event_date']; ?> <?php echo $rowEvent['event_time']; ?></p>
        <p>Location: <?php echo $rowEvent['location'] ?></p>
        <p>Contact No: <?php echo $rowEvent['contact_no'] ?></p>
        <p>Registration Deadline: <?php echo $rowEvent['deadline'] ?></p>
      </div>
      <div class="p_image">
        <img src="<?php echo $rowEvent['picture'] ?>" style="width: 300px; height: 200px; padding: 5px; position:absolute; top:10px; right:8px;">
        <br>
        <div class="row text-center">
          <button onclick="location.href='eventInfo.php?id=<?php echo $rowEvent['id'] ?>'" class="btn btn-primary" style="position: absolute;right: 10px;bottom: 10px;">View More Information</button><br>
          <p></p>
          <?php 
            if(!empty($_SESSION['username'])){
            $queryCheckJoinEvent="SELECT count(*) As join_event from participant WHERE username='".$_SESSION['username']."' AND event_id='".$rowEvent['id']."'";
            $checkJoinEvent=mysqli_query($conn, $queryCheckJoinEvent);
            $resultCheckJoinEvent=mysqli_fetch_assoc($checkJoinEvent);
            if($resultCheckJoinEvent['join_event'] > 0){
          ?>
          <div class="<?php echo $rowEvent['id']; ?> " style="position: absolute;right: 200px;bottom: 10px;">
            <button id="<?php echo $rowEvent['id']; ?>" onclick="cancelJoinEvent(this.id)" class="btn btn-danger">Cancel Joining</button>
          </div>
          <?php
            }
            else{
          ?>
          <div class="<?php echo $rowEvent['id']; ?>" style="position: absolute;right: 200px;bottom: 10px;">
            <button id="<?php echo $rowEvent['id']; ?>" onclick="joinEvent(this.id)" class="btn btn-success">Join Event</button>
          </div>
        </div>
      </div>
    </div>
  </div>


<?php
      }
    }
  }
?>
</div>

<script type="text/javascript">


  function searchEvent(){
    var event_name=$.trim($('#event_name').val());
    var event_date=$.trim($('#event_date').val());
    if(event_name!="" && event_date!=""){
      window.location.href = 'event.php?name='+event_name+'&date='+event_date;
    }
    else if(event_date!=""){
      window.location.href = 'event.php?date='+event_date;
    }
    else if(event_name!=""){
      window.location.href = 'event.php?name='+event_name;
    }
    else{
      window.location.href = 'event.php';
    }
  }

  function joinEvent(id){
    var event_id=id;
    $.ajax({
     url: "joinEvent.php",
     method: "POST",
     data: {
          event_id : event_id
     },
     success: function(data) {

         if (data == "ok") {
          $('.' + event_id).html("<button id='"+event_id+"' onclick='cancelJoinEvent(this.id)' class='btn btn-danger'>Cancel Joining</button>");
          $("#refresh_upcoming_join_button").load("refreshUpcomingJoinEventButton.php");
            Swal.fire({
               type: 'success',
               title: 'Join Event Successful',
               text: 'You have joined the event successfully',
               showConfirmButton: true,
               timer:6000,
           })
         }
         else{
          alert(data);
         }
     }
    });
  }

  function cancelJoinEvent(id){
    var event_id=id;

    Swal.fire({
        title: 'Are you sure to cancel joining the event?',
        text: "You won't be able to revert this!",
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.value) {
          $.ajax({
          url:"cancelJoinEvent.php",
          type:'POST',
          data: {
            event_id : event_id
          },

          success:function(data,status){
            if(data=="ok"){
              $('.' + event_id).html("<button id='"+event_id+"' onclick='joinEvent(this.id)' class='btn btn-success'>Join Event</button>");
              $("#refresh_upcoming_join_button").load("refreshUpcomingJoinEventButton.php");
              Swal.fire({
              type: 'success',
              title: 'Cancel Joined',
              text: 'You have cancel joined the event successfully',
              showConfirmButton: true,
              })
            }
            else{
              alert(data);
            }
          }


        });
        }
      })
  }

  $(function () {
    $('#datetimepicker1').datetimepicker({
        format: 'YYYY-MM-DD',
        minDate: new Date(),
    });
  });

</script>


</body>
</html>