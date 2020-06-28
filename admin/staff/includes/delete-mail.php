<?php
include 'connect.php';
if (isset($_POST['mail-delete-btn'])) {
	$delete_id = $_POST['delete_id'];
	$sql = "DELETE FROM messages WHERE id='$delete_id'";
	$query = mysqli_query($conn, $sql);
	if ($query) {
		echo "<script>window.location = '../trashed-mail.php';</script>";
	}else{
		echo "<script>window.location = '../trashed-mail.php';</script>";
	}
}
?>