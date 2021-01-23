<?php

$connect=mysqli_connect("localhost","root","","click_to_call_widget");
if (!$connect) {
	# code...
	die("Connection failed:".mysqli_error());
}

$name=$_POST['name'];
$email=$_POST['email'];
$number=$_POST['number'];
$query="INSERT INTO requested_call(name,email,contact_number) VALUES('$name','$email','$number')";
if(mysqli_query($connect,$query)){
	echo "<div class='alert alert-success'>Requested Successfully</div>";
}
else{
	echo "<div class='alert alert-danger'>There was a error!Please Try Again.</div>";
}
?>