<?php
include 'connect.php';
if (isset($_POST['edit_task_btn'])) {
	$task_id = mysqli_real_escape_string($conn, $_POST['task_id']);
	$user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
	$task_title = mysqli_real_escape_string($conn, $_POST['task_title']);
	$task_schedule_date = mysqli_real_escape_string($conn, $_POST['task_schedule_date']);
	$task_schedule_time = mysqli_real_escape_string($conn, $_POST['task_schedule_time']);
	$task_status = mysqli_real_escape_string($conn, $_POST['task_status']);
	$task_description = mysqli_real_escape_string($conn, $_POST['task_description']);
	$task_marker = mysqli_real_escape_string($conn, $_POST['task_marker']);

	$errorMsg = false;
	if (!empty($task_title) && !empty($task_schedule_date) && !empty($task_schedule_time) && !empty($task_status) && !empty($task_description)) {
		$sql = "UPDATE tasklist SET
		id = '$task_id',
		task_title = '$task_title',
		task_schedule_date = '$task_schedule_date',
		task_schedule_time = '$task_schedule_time',
		task_status = '$task_status',
		task_description = '$task_description',
		task_marker = '$task_marker' WHERE id= '$task_id'";
		$query = mysqli_query($conn, $sql);
		if ($query) {
			$errorMsg = false;
			echo "Task has been updated successfully. Please wait while being redirected to the task page";
		}else{
			$errorMsg = true;
			echo "Task was not successfully updated".mysqli_error($conn);
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
		function redirect(){
			window.location = 'view-tasks.php';
		}
		setInterval(redirect, 3000);
	}
</script>