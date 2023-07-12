<?php

include "includes/dbh.inc.php";

$event_name=$_POST['event_name'];
$location=$_POST['location'];
$event_date=$_POST['event_date'];
$event_time=$_POST['event_time'];
$contact_no=$_POST['contact_no'];
$description=$_POST['description'];
$deadline=$_POST['deadline'];
$image=$_POST['image'];


$sqlInsert="INSERT INTO event(event_name, location, event_date, event_time, contact_no, description, deadline, picture) VALUES ('$event_name', '$location', '$event_date', '$event_time', '$contact_no','$description', '$deadline', '$image');";
$resultInsert=mysqli_query($conn,$sqlInsert);
if($resultInsert){
	echo "ok";
}
else{
	echo "fail";
}
?>