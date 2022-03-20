<?php
include 'connect.php';
if (isset($_POST['group_update_btn'])) {
	$group_id = mysqli_real_escape_string($conn, $_POST['group_id']);
	$group_name = mysqli_real_escape_string($conn, $_POST['group_name']);
	$group_coordinator = mysqli_real_escape_string($conn, $_POST['group_coordinator']);
	$group_category = mysqli_real_escape_string($conn, $_POST['group_category']);
	if (!empty($group_name) && !empty($group_coordinator) && !empty($group_category) ) {
				$coordinator_checker = "SELECT * FROM study_groups WHERE group_coordinator = '$group_coordinator'";
				$coordinator_checker_query = mysqli_query($conn, $coordinator_checker);
				if (mysqli_num_rows($coordinator_checker_query) > 0) {
					$errorForm = false;
					echo "Selected coordinator has already been assigned to a group";
				}else{
					$sql = "UPDATE study_groups SET
		group_name = '$group_name',
		group_coordinator = '$group_coordinator',
		group_category = '$group_category' WHERE id='$group_id'";
		$query = mysqli_query($conn, $sql);
		if ($query) {
			$errorForm = false;
			echo "Group has been updated successfully. <br>You are being redirected";
		}else{
			$errorForm = true;
			echo "Group was not updated. Please try again";
		}
				}
		
	}else{
		$errorForm = true;
		echo "Fill all fields before submitting";
	}
}
?>
<script type="text/javascript">
	var errorForm = "<?php echo $errorForm; ?>";
	if (errorForm == false) {
		$('#formError').css('color','green');
		function redirect(){
			window.location = 'edit-group.php';
		}
		setInterval(redirect, 3000);
	}
</script>