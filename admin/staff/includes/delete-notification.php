<?php
include 'connect.php';
if (isset($_POST['delete-notification-btn'])) {
	$notification_id = $_POST['notification_id'];
	$sql = "DELETE FROM notification WHERE id='$notification_id'";
	$query = mysqli_query($conn, $sql);
	if ($query) {
		echo "<script>window.location = '../all-notifications.php';</script>";
	}else{
		echo "<script>window.location = '../all-notifications.php';</script>";
	}
}
?>