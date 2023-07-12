<!DOCTYPE html>
<html lang="en">
<head>

  <?php   
  include "includes/dbh.inc.php";

  session_start();
  $event_id=$_GET['id'];
  ?>

  <title> Event </title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/wholeindexstyle.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" ></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.10.2/dist/sweetalert2.all.min.js"></script>

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
          <img src="img/event1.png" class="img-fluid" width="300px" height="300px">
        </div>
      </div>
    </div>
  </section>

  <?php
  //include "navigation.php";
?>

<div class="container">
  <?php
    if(empty($_SESSION['username'])){
  ?>
    <p></p>
    <p style="text-align: center; font-size: 25px; font-family: 'Londrina Solid', cursive; text-transform: uppercase;" ><b><span>Please login to join our events</span></b></p>
  <?php
    }
  ?>

  <?php
    $displayEvent = "SELECT id, event_name, location, event_date, event_time, contact_no, description, picture, deadline FROM event WHERE id='$event_id'"; 
    $resultEvent = mysqli_query($conn,$displayEvent);
    while($rowEvent=mysqli_fetch_array($resultEvent)){
      
  ?>

  
  <div class="row">
    <div class="col-sm-12" style="background-image: linear-gradient(to bottom right, #00cc99 0%, #00cc99 100%); border-style: none; padding: 20px; margin-bottom:50px;">
      <div class="col-sm-8">
        <h2><?php echo $rowEvent['event_name'] ?></h2>
        <p><b>Event Date & Time: </b><?php echo $rowEvent['event_date']; ?> <?php echo $rowEvent['event_time']; ?></p>
        <p><b>Location: </b><?php echo $rowEvent['location'] ?></p>
        <p><b>Contact No: </b><?php echo $rowEvent['contact_no'] ?></p>
        <p><b>Registration Deadline: </b><?php echo $rowEvent['deadline'] ?></p>
        <br>
        <br>
        <p style="font-size: 20px;"><b>Description:</b></p>
        <p><?php echo $rowEvent['description'] ?></p>
      </div>
      <div class="p_image">
        <img src="<?php echo $rowEvent['picture'] ?>" style="width: 300px; height: 200px; position:absolute; top:10px; right:5px;">
        <br>
        <div class="row text-center">
          <?php 
            if(!empty($_SESSION['username'])){
              $queryCheckJoinEvent="SELECT count(*) As join_event from participant WHERE username='".$_SESSION['username']."' AND event_id='$event_id'";
              $checkJoinEvent=mysqli_query($conn, $queryCheckJoinEvent);
              $resultCheckJoinEvent=mysqli_fetch_assoc($checkJoinEvent);
              if($resultCheckJoinEvent['join_event'] > 0){
            ?>
            <div class="refresh_button" style="font-color: white; position: absolute;right: 20px;bottom: 20px;">
              <button id="<?php echo $rowEvent['id']; ?>" onclick="cancelJoinEvent(this.id)" class="btn btn-danger">Cancel Joining</button>
            </div>
            <?php
              }
              else{
            ?>
            <div class="refresh_button" style="color: white; position: absolute;right: 20px;bottom:20px;">
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
          $('.refresh_button').html("<button id='"+event_id+"' onclick='cancelJoinEvent(this.id)' class='btn btn-danger'>Cancel Joining</button>");
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
              $('.refresh_button').html("<button id='"+event_id+"' onclick='joinEvent(this.id)' class='btn btn-success'>Join Event</button>");
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
</script>

</body>
</html>