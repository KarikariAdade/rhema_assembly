<?php
$message = '';
if (isset($_POST['volunteer_del_button'])) {
	$volunteer_id = $_POST['volunteer_id'];
	$del = $conn->query("DELETE FROM volunteers WHERE id = '$volunteer_id'");
	if ($del) {
		$message = "Volunteer deleted!";
	}else{
		$message = "Volunteer could not be deleted";
	}
}
?>