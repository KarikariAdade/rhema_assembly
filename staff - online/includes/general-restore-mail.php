<?php
include 'connect.php';
if (isset($_POST['general-mail-restore-btn'])) {
	$restore_id = $_POST['restore_id'];
	$sql = "UPDATE mailbox SET trash = 'No' WHERE id='$restore_id'";
	$query = mysqli_query($conn, $sql);
	if ($query) {
		echo "<script>window.location = '../general-trashed-mail.php';</script>";
	}else{
		echo "<script>window.location = '../general-trashed-mail.php';</script>";
	}
}
?>