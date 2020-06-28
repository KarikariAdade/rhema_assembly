<?php
include 'connect.php';
if (isset($_POST['add_task_btn'])) {
	$full_name = $_POST['full_name'];
	$admin_id = $_POST['admin_id'];
	$position = $_POST['position'];
	$task_title = $_POST['task_title'];
	$task_schedule_time = $_POST['task_schedule_time'];
	$task_status = $_POST['task_status'];
	$task_schedule_date = $_POST['task_schedule_date'];
	$task_description = $_POST['task_description'];
	$errorMsg = false;

	if (!empty($task_title) && !empty($task_schedule_date) && !empty($task_schedule_time) && !empty($task_status) && !empty($task_description)) {
		$sql = "INSERT INTO tasklist(user_id, user_name, user_position, task_title, task_description, task_schedule_date, task_schedule_time, task_status, task_marker) VALUES ('$admin_id', '$full_name', '$position', '$task_title', '$task_description', '$task_schedule_date', '$task_schedule_time', '$task_status', 'In Progress')";
		$query = mysqli_query($conn, $sql);
		if ($query) {
			$errorMsg = false;
			echo "Task added successfully";
		}else{
			$errorMsg = true;
			echo "Task was not added successfully";
		}
	}else{
		$errorMsg = true;
		echo "Fill all fields before submitting";
	}
}
?>
<script type="text/javascript">
	var errorMsg = "<?php echo $errorMsg; ?>";
	if (errorMsg == false) {
		$('#formError').css("color", "green");
	}
</script>