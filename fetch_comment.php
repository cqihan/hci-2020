<?php

session_start();
 include "includes/dbh.inc.php";

 $place_id=$_POST["place_id"];

 $query = "SELECT * FROM comment WHERE place_id='$place_id' ORDER BY comment_date DESC LIMIT ".$_POST["start"].", ".$_POST["limit"]."";
 $result = mysqli_query($conn, $query);
 $output = "";
 
 if(mysqli_num_rows($result) > 0)
 {
  while($row = mysqli_fetch_array($result))
  {
    $username=$row['username'];
    $displayUsername = " SELECT * FROM user WHERE username='$username'"; 
    $resultUsername = mysqli_query($conn,$displayUsername);
    $rowUsername=mysqli_fetch_array($resultUsername);
   $output .= '

      <p><img src="'.$rowUsername["image"].'" alt="User avatar" style="width: 30px; height: 30px;"/>  <b>'.$rowUsername["fullname"].'</b>    '.$row["comment_date"].'</p>
      <p>'.$row["comment_content"].'</p> 

   ';
  }
 }
echo $output;
?>