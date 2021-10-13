<?php

	require('config.php');

	if(isset($_POST) && !empty($_POST)){
		if($_POST['action'] == 'add'){
			$sql = "INSERT INTO event (title, start_date, end_date, recurrence_type) VALUES ('".$_POST['title']."', '".$_POST['start_date']."', '".$_POST['end_date']."', '".$_POST['recurrence_type']."')";
			if($_POST['recurrence_type'] == 1){
				$_POST['day'] = null;
			}
			if ($conn->query($sql) === TRUE) {
				$last_id = $conn->insert_id;

				$sql2 = "INSERT INTO recurrence (sel1, sel2, day, event_id) VALUES ('".$_POST['sel1']."', '".$_POST['sel2']."', '".$_POST['day']."', '".$last_id."')";

				if ($conn->query($sql2) === TRUE) {
					header('location: events.php');
				}else{
					echo "Error deleting record: " . $conn->error;
				}
			} else {
				echo "Error deleting record: " . $conn->error;
			}
		}
		if($_POST['action'] == 'edit' && isset($_POST['id'])){
			$sql = "UPDATE event SET title='".$_POST['title']."', start_date='".$_POST['start_date']."', end_date='".$_POST['end_date']."', recurrence_type='".$_POST['recurrence_type']."' WHERE id=".$_POST['id'];
			if($_POST['recurrence_type'] == 1){
				$_POST['day'] = null;
			}
			$sql2 = "UPDATE recurrence SET sel1='".$_POST['sel1']."', sel2='".$_POST['sel2']."', day='".$_POST['day']."' WHERE event_id=".$_POST['id'];

			if ($conn->query($sql) === TRUE && $conn->query($sql2) === TRUE) {
				header('location: events.php');
			} else {
				echo "Error deleting record: " . $conn->error;
			}
		}
	}
	if(isset($_GET) && isset($_GET['id'])){
		$sql = "DELETE FROM event WHERE id=".$_GET['id'];
		$sql1 = "DELETE FROM recurrence WHERE event_id=".$_GET['id'];

		if ($conn->query($sql) === TRUE && $conn->query($sql1) === TRUE) {
		  	header('location: events.php');
		} else {
		  	echo "Error deleting record: " . $conn->error;
		}
	}
?>