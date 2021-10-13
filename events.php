<?php require('header.php'); ?>

<?php
	
	$sql = "SELECT * FROM event";
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
	    	$data[] = array_merge($event, $recurrence);
	    }
	}
?>

<div class="container">
	<h2>Event</h2>
	<a href="event-handle.php">Creat New Event</a>
  	<table class="table table-hover">
	    <thead>
	      <tr>
	      	<th>#</th>
	        <th>Title</th>
	        <th>Dates</th>
	        <th>Occurrence</th>
	        <th>Actions</th>
	      </tr>
	    </thead>
	    <tbody>
	    	<?php foreach ($data as $key => $value) { ?>
			    <tr>
			        <td><?php echo $value['id']; ?></td>
			        <td><?php echo $value['title']; ?></td>
			        <td><?php echo $value['start_date']." to ".$value['end_date']; ?></td>
			        <td>
			        	<?php 
			        		if($value['recurrence_type'] == 1){
			        			$sel1 = '';
			        			$sel2 = '';
			        			switch ($value['sel1']) {
			        				case '1':
			        					$sel1 = 'Every';
			        					break;
			        				case '2':
			        					$sel1 = 'Every Other';
			        					break;
			        				case '3':
			        					$sel1 = 'Every Third';
			        					break;
			        				case '4':
			        					$sel1 = 'Every Fourth';
			        					break;
			        			}
			        			switch ($value['sel2']) {
			        				case '1':
			        					$sel2 = 'Day';	
			        					break;
			        				case '2':
			        					$sel2 = 'Week';	
			        					break;
			        				case '3':
			        					$sel2 = 'Month';	
			        					break;
			        				case '4':
			        					$sel2 = 'Year';	
			        					break;
			        			}
			        			echo $sel1.' '.$sel2;
			        		}
			        		if($value['recurrence_type'] == 2){
			        			$sel1 = '';
			        			$sel2 = '';
			        			$day = '';
			        			switch ($value['sel1']) {
			        				case '1':
			        					$sel1 = 'First';
			        					break;
			        				case '2':
			        					$sel1 = 'Second';
			        					break;
			        				case '3':
			        					$sel1 = 'Third';
			        					break;
			        				case '4':
			        					$sel1 = 'Fourth';
			        					break;
			        			}
			        			switch ($value['sel2']) {
			        				case '1':
			        					$sel2 = 'Month';	
			        					break;
			        				case '2':
			        					$sel2 = '3 Months';	
			        					break;
			        				case '3':
			        					$sel2 = '4 Months';	
			        					break;
			        				case '4':
			        					$sel2 = '6 Months';	
			        					break;
			        				case '5':
			        					$sel2 = 'Year';	
			        					break;
			        			}
			        			switch ($value['day']) {
			        				case '1':
			        					$day = 'Sunday';	
			        					break;
			        				case '2':
			        					$day = 'Monday';	
			        					break;
			        				case '3':
			        					$day = 'Tuesday';	
			        					break;
			        				case '4':
			        					$day = 'Wednesday';	
			        					break;
			        				case '5':
			        					$day = 'Thursday';	
			        					break;
			        				case '6':
			        					$day = 'Friday';	
			        					break;
			        				case '7':
			        					$day = 'Saturday';	
			        					break;

			        			}
			        			echo 'Every '.$sel1.' '.$day.' of the '.$sel2;
			        		}
			        	?>			        	
			        </td>
			        <td>
						<a href="event-view.php?id=<?php echo $value['id']; ?>" class="btn btn-default">View</a>
						<a href="event-handle.php?id=<?php echo $value['id']; ?>" class="btn btn-success">Edit</a>
						<a href="event-model.php?id=<?php echo $value['id']; ?>" onclick="return confirm('Are you sure？')" class="btn btn-danger">Delete</a>
			        </td>
			    </tr>
	    	<?php } ?>
	    </tbody>
	  </table>
</div>

<?php require('footer.php'); ?>