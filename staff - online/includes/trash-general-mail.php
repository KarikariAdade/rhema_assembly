<?php
include 'connect.php';
if (isset($_POST['general-mail-trash-btn'])) {
	$trash_id = $_POST['trash_id'];
	$sql = "UPDATE mailbox SET trash = 'Yes' WHERE id='$trash_id'";
	$query = mysqli_query($conn, $sql);
	if ($query) {
		echo "<script>window.location = '../general-mailbox.php';</script>";
	}else{
		echo "<script>window.location = '../general-mailbox.php';</script>";
	}
}
?>