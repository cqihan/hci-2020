<?php

session_start();
include "includes/dbh.inc.php";
$username=$_SESSION['username'];
date_default_timezone_set('Asia/Kuala_Lumpur');

$place_id=$_POST['place_id'];
$comment_content=$_POST['comment_content'];
$currenttime=date("Y-m-d H:i:s");

$sqlInsert="INSERT INTO comment(username, place_id, comment_content, comment_date) VALUES ('$username', '$place_id', '$comment_content', '$currenttime');";
$resultInsert=mysqli_query($conn,$sqlInsert);
if($resultInsert)
{
	echo "ok";
}
else{
	echo "fail";
}

?>