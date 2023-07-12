<?php
session_start();
include "includes/dbh.inc.php";

$event_id=$_POST['event_id'];
$username=$_SESSION['username'];

$sqlDelete="DELETE FROM participant WHERE username='$username' AND event_id='$event_id';";
$resultDelete=mysqli_query($conn,$sqlDelete);
if($resultDelete){
	echo "ok";
}
else{
	echo "fail";
}
?>