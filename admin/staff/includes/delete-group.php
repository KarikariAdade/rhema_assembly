<?php
include 'connect.php';
if (isset($_POST['delete-group-btn'])) {
	$delete_id = $_POST['delete_id'];
	$sql = "DELETE FROM study_groups WHERE id = '$delete_id'";
	$query = mysqli_query($conn, $sql);
	if ($query) {
		echo "<script>window.location = '../edit-group.php';</script>";
	}else{
		echo "<script>window.location = '../edit-group.php';</script>";
	}
}
?>