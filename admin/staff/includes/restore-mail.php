<?php
include 'connect.php';
if (isset($_POST['mail-restore-btn'])) {
	$restore_id = $_POST['restore_id'];
	$sql = "UPDATE messages SET trash_status = 'No' WHERE id='$restore_id'";
	$query = mysqli_query($conn, $sql);
	if ($query) {
		echo "<script>window.location = '../trashed-mail.php';</script>";
	}else{
		echo "<script>window.location = '../trashed-mail.php';</script>";
	}
}
?>