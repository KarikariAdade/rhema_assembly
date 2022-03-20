<?php
include 'connect.php';
if (isset($_POST['harvest_id'])) {
	$harvest_id = $_POST['harvest_id'];
	$del = $conn->query("DELETE FROM annual_harvest WHERE id = '$harvest_id'") or die(mysqli_error($conn));
	if ($del) {
		echo "Annual Harvest has been deleted successfully";
	}
}
?>