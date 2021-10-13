<?php require('header.php');

	if(isset($_REQUEST) && !empty($_REQUEST)){
		$id = $_REQUEST['id'];

		$sql = "SELECT * FROM event where id=".$id;
		$result = $conn->query($sql);

		$event = [];
		if ($result->num_rows > 0) {
		  	// output data of each row
		  	while($row = $result->fetch_assoc()) {
		    	$event = $row;
		    }
		}
	}
?>
<?php if(empty($event)){ ?>
	<div class="container">
		<h2>Add Event</h2>
		<a href="events.php">Back to listing</a>
	  	<form action="event-model.php" method="post">
		  <div class="form-group">
		    <label for="title">Title:</label>
		    <input type="text" class="form-control" name="title" placeholder="Title" required="required" id="title">
		  </div>
		  <div class="form-group">
		    <label for="startdate">Start Date:</label>
		    <input type="text" class="form-control datepicker" name="start_date" placeholder="Start Date" required="required" data-date-format="yyyy-mm-dd" id="startdate">
		  </div>
		  <div class="form-group">
		    <label for="enddate">End Date:</label>
		    <input type="text" class="form-control datepicker" name="end_date" placeholder="End Date" required="required" data-date-format="yyyy-mm-dd" id="enddate">
		  </div>
		  
		  <div class="form-group">
		    <label for="recurrence">Recurrence:</label>
		    <p class="recurrence-container">
		    	<label class="radio-inline"><input type="radio" value="1" name="recurrence_type">Repeat</label>
		    	<select class="form-control" disabled name="sel1">
				    <option value="1">Every</option>
				    <option value="2">Every Other</option>
				    <option value="3">Every Third</option>
				    <option value="4">Every Fourth</option>
			  	</select>

			  	<select class="form-control" disabled name="sel2">
				    <option value="1">Day</option>
				    <option value="2">Week</option>
				    <option value="3">Month</option>
				    <option value="4">Year</option>
			  	</select>
			</p>
		    <p class="recurrence-container">
		    	<label class="radio-inline"><input type="radio" value="2" name="recurrence_type">Repeat on the</label>
		    	<select class="form-control" disabled name="sel1">
				    <option value="1">First</option>
				    <option value="2">Second</option>
				    <option value="3">Third</option>
				    <option value="4">Fourth</option>
			  	</select>

			  	<select class="form-control" disabled name="day">
				    <option value="1">Sunday</option>
				    <option value="2">Monday</option>
				    <option value="3">Tuesday</option>
				    <option value="4">Wednesday</option>
				    <option value="5">Thursday</option>
				    <option value="6">Friday</option>
				    <option value="7">Saturday</option>
			  	</select>
			  	of the
			  	<select class="form-control" disabled name="sel2">
				    <option value="1">Month</option>
				    <option value="2">3 Months</option>
				    <option value="3">4 Months</option>
				    <option value="4">6 Months</option>
				    <option value="5">Year</option>
			  	</select>
			</p>
		  </div>

		  <input type="hidden" name="action" value="add">

		  <button type="submit" class="btn btn-default">Add</button>
		</form>
	</div>
<?php }else{
	$sql = "SELECT * FROM recurrence where event_id=".$event['id'];
	$result = $conn->query($sql);

	$recurrence = [];
	if ($result->num_rows > 0) {
	  	// output data of each row
	  	while($row = $result->fetch_assoc()) {
	    	$recurrence = $row;
	    }
	}
	
	?>
	<div class="container">
		<h2>Edit <?php echo $event['title']; ?></h2>
		<a href="events.php">Back to listing</a>
	  	<form action="event-model.php" method="post">
		  <div class="form-group">
		    <label for="title">Title:</label>
		    <input type="text" class="form-control" name="title" value="<?php echo $event['title']; ?>" required="required" id="title">
		  </div>
		  <div class="form-group">
		    <label for="startdate">Start Date:</label>
		    <input type="text" class="form-control datepicker" value="<?php echo $event['start_date']; ?>" name="start_date" required="required" data-date-format="yyyy-mm-dd" id="startdate">
		  </div>
		  <div class="form-group">
		    <label for="enddate">End Date:</label>
		    <input type="text" class="form-control datepicker" value="<?php echo $event['end_date']; ?>" name="end_date" required="required" data-date-format="yyyy-mm-dd" id="enddate">
		  </div>

		  <div class="form-group">
		    <label for="recurrence">Recurrence:</label>
		    <p class="recurrence-container">
		    	<label class="radio-inline"><input type="radio" value="1" <?php echo $event['recurrence_type'] == 1 ? 'checked' : ''; ?> name="recurrence_type">Repeat</label>
		    	<select class="form-control" <?php echo $event['recurrence_type'] == 1 ? '' : 'disabled'; ?> name="sel1">
				    <option <?php echo ($event['recurrence_type'] == 1 && $recurrence['sel1'] == 1) ? 'selected' : '' ?> value="1">Every</option>
				    <option <?php echo ($event['recurrence_type'] == 1 && $recurrence['sel1'] == 2) ? 'selected' : '' ?> value="2">Every Other</option>
				    <option <?php echo ($event['recurrence_type'] == 1 && $recurrence['sel1'] == 3) ? 'selected' : '' ?> value="3">Every Third</option>
				    <option <?php echo ($event['recurrence_type'] == 1 && $recurrence['sel1'] == 4) ? 'selected' : '' ?> value="4">Every Fourth</option>
			  	</select>

			  	<select class="form-control" <?php echo $event['recurrence_type'] == 1 ? '' : 'disabled'; ?> name="sel2">
				    <option <?php echo ($event['recurrence_type'] == 1 && $recurrence['sel2'] == 1) ? 'selected' : '' ?> value="1">Day</option>
				    <option <?php echo ($event['recurrence_type'] == 1 && $recurrence['sel2'] == 2) ? 'selected' : '' ?> value="2">Week</option>
				    <option <?php echo ($event['recurrence_type'] == 1 && $recurrence['sel2'] == 3) ? 'selected' : '' ?> value="3">Month</option>
				    <option <?php echo ($event['recurrence_type'] == 1 && $recurrence['sel2'] == 4) ? 'selected' : '' ?> value="4">Year</option>
			  	</select>
			</p>
		    <p class="recurrence-container">
		    	<label class="radio-inline"><input type="radio" value="2" <?php echo $event['recurrence_type'] == 2 ? 'checked' : ''; ?> name="recurrence_type">Repeat on the</label>
		    	<select class="form-control" <?php echo $event['recurrence_type'] == 2 ? '' : 'disabled'; ?> name="sel1">
				    <option <?php echo ($event['recurrence_type'] == 2 && $recurrence['sel1'] == 1) ? 'selected' : '' ?> value="1">First</option>
				    <option <?php echo ($event['recurrence_type'] == 2 && $recurrence['sel1'] == 2) ? 'selected' : '' ?> value="2">Second</option>
				    <option <?php echo ($event['recurrence_type'] == 2 && $recurrence['sel1'] == 3) ? 'selected' : '' ?> value="3">Third</option>
				    <option <?php echo ($event['recurrence_type'] == 2 && $recurrence['sel1'] == 4) ? 'selected' : '' ?> value="4">Fourth</option>
			  	</select>

			  	<select class="form-control" <?php echo $event['recurrence_type'] == 2 ? '' : 'disabled'; ?> name="day">
				    <option <?php echo ($event['recurrence_type'] == 2 && $recurrence['day'] == 1) ? 'selected' : '' ?> value="1">Sunday</option>
				    <option <?php echo ($event['recurrence_type'] == 2 && $recurrence['day'] == 2) ? 'selected' : '' ?> value="2">Monday</option>
				    <option <?php echo ($event['recurrence_type'] == 2 && $recurrence['day'] == 3) ? 'selected' : '' ?> value="3">Tuesday</option>
				    <option <?php echo ($event['recurrence_type'] == 2 && $recurrence['day'] == 4) ? 'selected' : '' ?> value="4">Wednesday</option>
				    <option <?php echo ($event['recurrence_type'] == 2 && $recurrence['day'] == 5) ? 'selected' : '' ?> value="5">Thursday</option>
				    <option <?php echo ($event['recurrence_type'] == 2 && $recurrence['day'] == 6) ? 'selected' : '' ?> value="6">Friday</option>
				    <option <?php echo ($event['recurrence_type'] == 2 && $recurrence['day'] == 7) ? 'selected' : '' ?> value="7">Saturday</option>
			  	</select>
			  	of the
			  	<select class="form-control" <?php echo $event['recurrence_type'] == 2 ? '' : 'disabled'; ?> name="sel2">
				    <option <?php echo ($event['recurrence_type'] == 2 && $recurrence['sel2'] == 1) ? 'selected' : '' ?> value="1">Month</option>
				    <option <?php echo ($event['recurrence_type'] == 2 && $recurrence['sel2'] == 2) ? 'selected' : '' ?> value="2">3 Months</option>
				    <option <?php echo ($event['recurrence_type'] == 2 && $recurrence['sel2'] == 3) ? 'selected' : '' ?> value="3">4 Months</option>
				    <option <?php echo ($event['recurrence_type'] == 2 && $recurrence['sel2'] == 4) ? 'selected' : '' ?> value="4">6 Months</option>
				    <option <?php echo ($event['recurrence_type'] == 2 && $recurrence['sel2'] == 4) ? 'selected' : '' ?> value="5">Year</option>
			  	</select>
			</p>
		  </div>
		  
		  <input type="hidden" name="action" value="edit">
		  <input type="hidden" name="id" value="<?php echo $event['id']; ?>">

		  <button type="submit" class="btn btn-default">Update</button>
		</form>
	</div>
<?php } ?>

<script type="text/javascript">
 	$(document).ready(function(){
 		$("#startdate").datepicker({
	        todayBtn:  1,
	        autoclose: true,
	    }).on('changeDate', function (selected) {
	        var minDate = new Date(selected.date.valueOf());
	        $('#enddate').datepicker('setStartDate', minDate);
	    });

	    $("#enddate").datepicker()
	    .on('changeDate', function (selected) {
	        var maxDate = new Date(selected.date.valueOf());
	        $('#startdate').datepicker('setEndDate', maxDate);
	    });
    	$("form").validate();

    	$('input[name="recurrence_type"]').on('change', function(){
    		console.log($(this));
    		$('select').attr('disabled', true);
    		$(this).parents('.recurrence-container').find('select').attr('disabled', false);
    	});

    	<?php if(!empty($event)){ ?>
	        $('#startdate').datepicker('setEndDate', new Date("<?php echo $event['end_date']; ?>"));

	        $('#enddate').datepicker('setStartDate', new Date("<?php echo $event['start_date']; ?>"));
    	<?php } ?>
 	});
</script>

<?php require('footer.php'); ?>