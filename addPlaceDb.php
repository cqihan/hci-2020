<?php

include "includes/dbh.inc.php";

$place_name=$_POST['place_name'];
$address=$_POST['address'];
$state=$_POST['state'];
$working_hours=$_POST['working_hours'];
$contact_no=$_POST['contact_no'];
$description=$_POST['description'];
$image=$_POST['image'];


$sqlInsert="INSERT INTO place(place_name, place_address, state, working_hours, contact_no, description, picture) VALUES ('$place_name', '$address', '$state', '$working_hours', '$contact_no','$description', '$image');";
$resultInsert=mysqli_query($conn,$sqlInsert);
if($resultInsert){
	echo "ok";
}
else{
	echo "fail";
}
?>