<?php
include 'connect.php';
if (isset($_POST['group_submit_btn'])) {
	$group_name = mysqli_real_escape_string($conn, $_POST['group_name']);
	$group_coordinator = mysqli_real_escape_string($conn, $_POST['group_coordinator']);
	$group_category = mysqli_real_escape_string($conn, $_POST['group_category']);
	$errorForm = true;
	if (!empty($group_name) && !empty($group_coordinator) && !empty($group_category) && $group_coordinator != "Select Coordinator" && $group_category != "Select Group Category") {
		$seg = explode(" ", $group_coordinator);
		$first_name = $seg[0];
		$last_name = $seg[1];
		$fetch_member_sql = "SELECT * FROM admin_profile WHERE first_name = '$first_name' AND last_name = '$last_name'";
		$fetch_member_query = mysqli_query($conn, $fetch_member_sql);
		if (mysqli_num_rows($fetch_member_query) > 0) {
			while ($row = mysqli_fetch_assoc($fetch_member_query)) {
				$coordinator_email = $row['email'];
				$coordinator_phone = $row['phone'];
				$coordinator_address = $row['address'];
				$coordinator_picture = $row['admin_image'];
				$coordinator_id = $row['id'];

				$group_checker = "SELECT * FROM study_groups WHERE group_name = '$group_name'";
				$group_checker_query = mysqli_query($conn, $group_checker);
				$coordinator_checker = "SELECT * FROM study_groups WHERE group_coordinator = '$group_coordinator'";
				$coordinator_checker_query = mysqli_query($conn, $coordinator_checker);
				if (mysqli_num_rows($group_checker_query) > 0) {
					$errorForm = true;
					echo "Group already Exists";
				}elseif (mysqli_num_rows($coordinator_checker_query) > 0) {
					while ($row = mysqli_fetch_assoc($coordinator_checker_query)) {
						$errorForm = true;
						$coordinator_group_name = $row['group_name'];
						echo $group_coordinator." already assigned to ".$coordinator_group_name;
					}
				}else{
					$sql = "INSERT INTO study_groups(group_name, group_category, group_coordinator, coordinator_id, coordinator_email, coordinator_phone, coordinator_address, coordinator_picture, date_created) VALUES ('$group_name', '$group_category', '$group_coordinator', '$coordinator_id', '$coordinator_email', '$coordinator_phone', '$coordinator_address', '$coordinator_picture', now())";
					$query = mysqli_query($conn, $sql);
					if ($query) {
						$errorForm = false;
						echo "Group created successfully <br> Please wait while being redirected";
					}else{
						$errorForm = true;
						echo "Group could not be created";
					}
				}
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
			window.location = 'view-groups.php';
		}
		setInterval(redirect, 3000);
	}
</script>