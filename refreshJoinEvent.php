  <?php

    include "includes/dbh.inc.php";

    session_start();
    $username=$_SESSION['username'];

    $queryCountJoinEvent="SELECT count(*) As join_event from participant WHERE username='$username'";
    $countJoinEvent=mysqli_query($conn, $queryCountJoinEvent);
    $resultCountJoinEvent=mysqli_fetch_assoc($countJoinEvent);

    if($resultCountJoinEvent['join_event'] > 0){
  ?>

    <?php
    $displayEvent = "SELECT a.id As id, a.event_name, a.location, a.event_date, a.event_time, a.contact_no, a.picture, a.deadline FROM event a, participant b WHERE a.id=b.event_id AND b.username='$username'"; 
    $resultEvent = mysqli_query($conn,$displayEvent);
    while($rowEvent=mysqli_fetch_array($resultEvent)){
      
  ?>
  <div id="refresh_join_event">
    <div class="row">
      <div class="col-sm-12" style="background-color: white; border-style: solid; padding: 5px;">
        <div class="col-sm-8">
          <h2><?php echo $rowEvent['event_name'] ?></h2>
          <p>Event Date & Time: <?php echo $rowEvent['event_date']; ?> <?php echo $rowEvent['event_time']; ?></p>
          <p>Location: <?php echo $rowEvent['location'] ?></p>
          <p>Contact No: <?php echo $rowEvent['contact_no'] ?></p>
          <p>Registration Deadline: <?php echo $rowEvent['deadline'] ?></p>
        </div>
        <div class="col-sm-4">
          <img src="<?php echo $rowEvent['picture'] ?>" style="width: 300px; height: 200px; padding: 5px;">
          <br>
          <div class="row text-center">
            <button onclick="location.href='eventInfo.php?id=<?php echo $rowEvent['id'] ?>'" class="btn btn-primary">View More Information</button>
            <p></p>
            <?php 
              $queryCheckJoinEvent="SELECT count(*) As join_event from participant WHERE username='$username' AND event_id='".$rowEvent['id']."'";
              $checkJoinEvent=mysqli_query($conn, $queryCheckJoinEvent);
              $resultCheckJoinEvent=mysqli_fetch_assoc($checkJoinEvent);
              if($resultCheckJoinEvent['join_event'] > 0){
            ?>
            <div class="<?php echo $rowEvent['id']; ?>">
              <button id="<?php echo $rowEvent['id']; ?>" onclick="cancelJoinEvent(this.id)" class="btn btn-danger">Cancel Joining</button>
            </div>
            <?php
              }
              else{
            ?>
            <div class="<?php echo $rowEvent['id']; ?>">
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

  }
  else{

        ?>
        <div id="refresh_join_event">
          <div class="row">
            <div class="col-sm-12">
              <h2>You have no upcoming events.</h2>
            </div>
          </div>
        </div>
        <?php
          }

?>