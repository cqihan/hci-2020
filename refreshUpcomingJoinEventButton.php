<?php

include "includes/dbh.inc.php";

session_start();
$username=$_SESSION['username'];

$queryCountJoinEvent="SELECT count(*) As join_event from participant WHERE username='$username'";
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
?>
