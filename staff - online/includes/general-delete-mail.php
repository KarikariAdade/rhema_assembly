<?php
include 'connect.php';
if (isset($_POST['general-mail-delete-btn'])) {
	$delete_id = $_POST['delete_id'];
	$sql = "DELETE FROM mailbox WHERE id='$delete_id'";
	$query = mysqli_query($conn, $sql);
	if ($query) {
		echo "<script>window.location = '../general-trashed-mail.php';</script>";
	}else{
		echo "<script>window.location = '../general-trashed-mail.php';</script>";
	}
}
?>