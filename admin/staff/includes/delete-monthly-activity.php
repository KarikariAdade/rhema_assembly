<?php
include 'connect.php';
if (isset($_POST['delete-activity-btn'])) {
	$month_id = mysqli_real_escape_string($conn, $_POST['month_id']);
	$sql = "DELETE FROM monthly_activities WHERE month_id = '$month_id'";
	$query = mysqli_query($conn, $sql);
	if ($query) {
		echo "<script>window.location = '../edit-monthly-activity.php';</script>";
	}else{
		echo mysqli_error($conn);
	}
}
?>