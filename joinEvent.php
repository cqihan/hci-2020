<?php
session_start();
include "includes/dbh.inc.php";

$event_id=$_POST['event_id'];
$username=$_SESSION['username'];

$sqlInsert="INSERT INTO participant(event_id, username) VALUES ('$event_id', '$username');";
$resultInsert=mysqli_query($conn,$sqlInsert);
if($resultInsert){
	echo "ok";
}
else{
	echo "fail";
}
?>