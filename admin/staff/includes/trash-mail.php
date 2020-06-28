<?php
include 'connect.php';
if (isset($_POST['mail-trash-btn'])) {
	$trash_id = $_POST['trash_id'];
	$sql = "UPDATE messages SET trash_status = 'Yes' WHERE id='$trash_id'";
	$query = mysqli_query($conn, $sql);
	if ($query) {
		echo "<script>window.location = '../mailbox.php';</script>";
	}else{
		echo "<script>window.location = '../mailbox.php';</script>";
	}
}
?>