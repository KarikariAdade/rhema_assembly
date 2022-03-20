<?php
include 'connect.php';
if (isset($_POST['delete-member-btn'])) {
	$delete_id = $_POST['delete_id'];
	$sql = "DELETE FROM members WHERE id='$delete_id'";
	$query = mysqli_query($conn, $sql);
	if ($query) {
		header("Location: ../edit-member.php");
	}else{
		echo "<script>window.location = edit-member.php;</script>";
	}
}
?>