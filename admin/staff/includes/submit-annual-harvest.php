<?php
include 'connect.php';
if (isset($_POST['submit_annual_harvest_btn'])) {
	$harvest_date = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['harvest_date']));
	$harvest_time = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['harvest_time']));
	$harvest_venue = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['harvest_venue']));
	if (!empty($harvest_date) && !empty($harvest_time) && !empty($harvest_venue)) {
		$harvest_year = date('Y',strtotime($harvest_date));
		$check_harvest = $conn->query("SELECT * FROM annual_harvest WHERE harvest_year = '$harvest_year'") or die(mysqli_error($conn));
		if (mysqli_num_rows($check_harvest) > 0) {
			echo "Annual Harvest for ".$harvest_year." already exists. You can only create one harvest per year";
		}else{
			$add_harvest = $conn->query("INSERT INTO annual_harvest (date, time, venue, harvest_year) VALUES ('$harvest_date', '$harvest_time', '$harvest_venue', '$harvest_year')") or die(mysqli_error($conn));
			if ($add_harvest) {
				echo "Annual Harvest has been added successfully.";
			}
		}
	}else{
		echo "Fill all fields before submitting";
	}
}
?>