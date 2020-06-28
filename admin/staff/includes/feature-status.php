<?php
include 'connect.php';
if (isset($_POST['id'])) {
	$id = $_POST['id'];
	$check_marker = $conn->query("SELECT * FROM featured WHERE id = '$id'");
	$row = mysqli_fetch_assoc($check_marker);
	if ($row['status'] == 0) {
		$mark_item = $conn->query("UPDATE featured SET status = 1 WHERE id = '$id'");
		if ($mark_item) {
			echo "Item successfully marked";
		}
	}else{
		$unmark_item = $conn->query("UPDATE featured SET status = 0 WHERE id = '$id'");
		if ($unmark_item) {
			echo "Item successfully unmarked";
		}
	}
}
?>