<?php

// This script marks annual harvests
include 'connect.php';
$mark_success = '';
if (isset($_POST['harvest_id'])) {
	$harvest_id = $_POST['harvest_id'];

	//Check if harvest is marked already
	$check_harvest = $conn->query("SELECT * FROM annual_harvest WHERE id = '$harvest_id'") or die(mysqli_error($conn));
	$row = mysqli_fetch_assoc($check_harvest);
	$check_marked = $conn->query("SELECT * FROM annual_harvest WHERE id != '$harvest_id' AND status = 1") or die(mysqli_error($conn));
	$check_row = mysqli_fetch_assoc($check_marked);
	$check_year = $check_row['harvest_year'];
	if ($row['status'] == 0) {
		//Mark item if status = 0
		if (mysqli_num_rows($check_marked) > 0) {
			echo $check_year." Annual Harvest has already been marked active. Only one harvest can be marked active at a time";
		}else{
			$mark_harvest = $conn->query("UPDATE annual_harvest SET status = 1 WHERE id = '$harvest_id'");
		if ($mark_harvest) {
			echo "Harvest marked successfully";
			$mark_success = "Harvest marked successfully";
		}
		}
	}else{
		//Unmark item on else statement
		$unmark_harvest = $conn->query("UPDATE annual_harvest SET status = 0 WHERE id = '$harvest_id'");
		if ($unmark_harvest) {
			echo "Harvest unmarked successfully";
		}
	}
}
?>
