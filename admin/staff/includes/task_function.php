<?php
include 'connect.php';
$today = date('Y-m-d');
$current_time = date('H:i');
$current_time2 = date('h:i');
$fetch_task = $conn->query("SELECT * FROM tasklist");
$fetch_task_counter = mysqli_num_rows($fetch_task);
if ($fetch_task_counter > 0) {
	while ($row = mysqli_fetch_assoc($fetch_task)) {
		if ($row['task_status'] == 'Public' AND $row['task_marker'] == 'In Progress') {
			echo "<script>alert('The task titled ".$row['task_title']." has started');</script>";
		}
		if ($row['task_status'] == 'Private' && $row['task_marker'] == 'In Progress') {
			echo "<script>alert('".$row['task_title']." is a private task')</script>";
		}
	}
}
?>