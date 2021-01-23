<?php
$connect=mysqli_connect("localhost","root","","click_to_call_widget");
if (!$connect) {
	# code...
	die("Connection failed:".mysqli_error());
}
	
$query="SELECT * FROM requested_call";
$result = mysqli_query($connect,$query);
date_default_timezone_set("Asia/Kolkata");
$time1=date_create(date("Y-m-d H:i:s"));
///echo $time1;
?>

<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css">
  <script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
</head>
<body>

	<div class="container"><br>
  <h2 style="text-align: center;"><u>Dashboard For Requested Calls</u></h2><br><br>           
  <table id="my_table" class="table table-hover">
    <thead>
      <tr>
      	<th>S.No.</th>
        <th>Name</th>
        <th>Email</th>
        <th>Contact Number</th>
        <th>Time Difference</th>
      </tr>
    </thead>
    <tbody>
      	<?php
      		$i=1;
      		while ($row = mysqli_fetch_array($result)) {
      			$time2=date_create(date('Y-m-d H:i:s',strtotime($row['time'])));
      			$timediff = date_diff($time1,$time2);
      			?>
      			<tr>
      			   <td><?php echo $i ?></td>		
			       <td><?php echo $row['name']; ?></td>
			       <td><?php echo $row['email']; ?></td>
			       <td><?php echo $row['contact_number']; ?></td>
			       <td><?php echo $timediff->format('%h hour %i minute %s second ago');  ?></td>
			    </tr>
      		
      		<?php
      		$i++;	
      		}

      	?>
    </tbody>
  </table>
</div>

</body>

<script>
$(document).ready(function(){
    $('#my_table').dataTable();
});
</script>
</html>