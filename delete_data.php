<?php
$connect=mysqli_connect("localhost","root","","click_to_call_widget");
if (!$connect) {
	# code...
	die("Connection failed:".mysqli_error());
}

if (isset($_POST['delete_id'])) {
	# code...
	$delete_id=$_POST['delete_id'];
	$query="DELETE FROM requested_call WHERE s_no='".$delete_id."'";
	if(mysqli_query($connect,$query)){

 		echo "<div class='alert alert-success'>Deleted Successfully</div>";
 	}
 	else{
 		echo "<div class='alert alert-danger'>There was a error in Deleting</div>";
 	}
}

?>	