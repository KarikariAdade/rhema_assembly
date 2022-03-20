<?php
include 'connect.php';
if (isset($_POST['delete_event_btn'])) {
	$event_picture = $_POST['event_picture'];
	$event_id = $_POST['event_id'];
	$seg = explode("/", $event_picture);
	$image = $seg[7];

	$sql = "DELETE FROM events WHERE id='$event_id'";
	$query = mysqli_query($conn, $sql);
	$unlink = unlink("../../assets/uploads/event/".$image);
	if ($query && $unlink) {
		echo "<script>window.location = '../view-event.php';</script>";
	}else{
		echo "<script>window.location = '../view-event.php';</script>";
	}
}
?>