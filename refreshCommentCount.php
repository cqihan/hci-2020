<?php

	include "includes/dbh.inc.php";
	$place_id=$_GET['id'];
     $checkComment = "SELECT * FROM comment where place_id='$place_id'"; 
     $commentResult = mysqli_query($conn,$checkComment);
     $commentCount=mysqli_num_rows($commentResult)
?>

    <div class="form-group" style="display: none;">
       <input type="text" name="comment_count" id="comment_count" class="form-control" placeholder="Enter Title" value="<?php echo $commentCount; ?>" />
    </div>