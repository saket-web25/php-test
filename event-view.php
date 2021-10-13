<?php require('header.php'); ?>

<?php
	
	$sql = "SELECT * FROM event where id=".$_REQUEST['id'];
	$result = $conn->query($sql);

	$data = [];
	if ($result->num_rows > 0) {
	  	// output data of each row
	  	while($row = $result->fetch_assoc()) {
	    	$event = $row;
	  		$sql1 = "SELECT * FROM recurrence WHERE event_id=".$row['id'];
	  		$result = $conn->query($sql1);

	  		$recurrence = [];
	  		if ($result->num_rows > 0) {
	  			// output data of each row
	  			while($row = $result->fetch_assoc()) {
	  				$recurrence = $row;
	  			}
	  		}
	    	$data = array_merge($event, $recurrence);
	    }
	}
?>

<div class="container">
	<?php if(!empty($data)){ ?>
	<h2><?php echo $data['title']; ?></h2>
	<a href="events.php">Back to Event List</a>
  	
  	<div class="event-dates">
  		<table class="table table-hover">
			<?php
				if($data['recurrence_type'] == 1){
					$period = new DatePeriod(
				     	new DateTime($data['start_date']),
				     	new DateInterval('P1D'),
				     	new DateTime($data['end_date'])
					);
					foreach ($period as $key => $value) {
					    echo '<tr><td>'.$value->format('Y-m-d').'</td><td>'.$value->format('D').'</td></tr>';       
					}
				}
			?>
		</table>
  	</div>
  	<?php }else{ ?>
  		<p>No event found.</p>
  	<?php } ?>
</div>

<?php require('footer.php'); ?>