<?php
include 'connect.php';
if (isset($_POST['delete_task_btn'])) {
	$task_id = $_POST['task_id'];
	$sql = "DELETE FROM tasklist WHERE id='$task_id'";
	$query = mysqli_query($conn, $sql);
	if ($query) {
		echo "<script>window.location = '../view-tasks.php';</script>";
	}else{
		echo "Task could not be deleted";
	}
}
?>