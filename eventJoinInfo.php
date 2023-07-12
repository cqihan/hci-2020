<!DOCTYPE html>
<html lang="en">
<head>
<?php   
  include "includes/dbh.inc.php";

  session_start();
  $username=$_SESSION['username'];
  ?>
  
  <title>Joined Event</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.10.2/dist/sweetalert2.all.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.43/css/bootstrap-datetimepicker.min.css"> 
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.43/css/bootstrap-datetimepicker-standalone.css"> 
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.43/js/bootstrap-datetimepicker.min.js"></script>
</head>
  
<body>

<?php
  include "navigation.php";
?>
<!------------------Promotion section----------------->
<section id="banner">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <p class="promo-title">Joined Events</p>
          <p>View all the events you had joined here. <br>
          You are able to view the events or cancel joining an event if you are unable to attend.
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
  <br>
  <?php

    $displayEvent = "SELECT a.id As id, a.event_name, a.location, a.event_date, a.event_time, a.contact_no, a.picture, a.deadline FROM event a, participant b WHERE a.id=b.event_id AND b.username='$username'"; 
    $resultEvent = mysqli_query($conn,$displayEvent);
    while($rowEvent=mysqli_fetch_array($resultEvent)){
      
  ?>
  <div id="refresh_join_event" style="margin-bottom:50px;">
    <div class="row">
      <div class="col-sm-12" style="background-image: linear-gradient(to bottom right, #00cc99 0%, #00cc99 100%); border-style: none; padding: 5px;">
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
          <div class="row text-center" >
            <button onclick="location.href='eventInfo.php?id=<?php echo $rowEvent['id'] ?>'" class="btn btn-primary" style="position: absolute;right: 10px;bottom: 10px;">View More Information</button>
            <p></p>
            <?php 
              $queryCheckJoinEvent="SELECT count(*) As join_event from participant WHERE username='$username' AND event_id='".$rowEvent['id']."'";
              $checkJoinEvent=mysqli_query($conn, $queryCheckJoinEvent);
              $resultCheckJoinEvent=mysqli_fetch_assoc($checkJoinEvent);
              if($resultCheckJoinEvent['join_event'] > 0){
            ?>
            <div class="<?php echo $rowEvent['id']; ?>" style="position: absolute;right: 200px;bottom: 10px;">
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
    <br>
  </div>



<?php
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
          $("#refresh_join_event").load("refreshJoinEvent.php");
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
              $("#refresh_join_event").load("refreshJoinEvent.php");
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