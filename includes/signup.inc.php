<?php

include "dbh.inc.php";

$fullname=$_POST['fullname'];
$email=$_POST['email'];
$username=$_POST['username'];
$password=$_POST['password'];
$image=$_POST['image'];;


if(!preg_match("/^[a-zA-Z ]*$/",$fullname)){
	echo "Invalid name";
}

elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
	echo "Invalid email";
}

elseif(!preg_match("/^[a-zA-Z0-9]*$/",$username)){
	echo "Invalid username";
}

else{


	$sql="SELECT * FROM user WHERE username='$username' ";
	$result=mysqli_query($conn, $sql);
	$resultCheck=mysqli_num_rows($result);

	if ($resultCheck>0) {
		echo "User exist";
	}

	else{


			$sqlInsert="INSERT INTO user(username, fullname, email, password, image) VALUES ('$username', '$fullname', '$email', '$password','$image');";
			$resultInsert=mysqli_query($conn,$sqlInsert);
			if($resultInsert){
				echo "ok";
			}
			else{
				echo "fail";
			}
		}

	
}
?>