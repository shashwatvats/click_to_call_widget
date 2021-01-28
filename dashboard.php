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
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css">
  <script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
</head>
<body>

	<div class="container"><br>
  <h2 style="text-align: center;"><u>Dashboard For Requested Calls</u></h2><br><br>
  <p id="msg"></p>          
  <table id="my_table" class="table table-hover">
    <thead>
      <tr>
      	<th>S.No.</th>
        <th>Name</th>
        <th>Email</th>
        <th>Contact Number</th>
        <th>Time Difference</th>
        <th></th>
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
			       <td><?php echo $timediff->format('%d days %h hour %i minute %s second ago'); ?></td>
             <td><button type="button" id="<?php echo $row['s_no']; ?>" class="btn btn-danger btn-sm delete_btn"><i class="fa fa-trash"></i> Delete</button></td>
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
    $('#my_table').DataTable();

    $(".delete_btn").click(function(){
      var delete_id=$(this).attr("id");
      $.ajax({
      url:"delete_data.php",
      method:'POST',
      data:{
        delete_id:delete_id
      },
      success:function(data)
      { 
        if (data) {
          location.reload(true);
         }
      }
    });


    });

});
</script>
</html>