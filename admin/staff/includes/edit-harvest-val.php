<?php
include 'connect.php';
$success = FALSE;
if (isset($_POST['edit_harvest_btn'])) {
	$edit_harvest_id = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['edit_harvest_id']));
	$edit_harvest_venue = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['edit_harvest_venue']));
	$edit_harvest_date = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['edit_harvest_date']));
	$edit_harvest_time = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['edit_harvest_time']));
	$edit_target_amount = (isset($_POST['edit_amount_made'])?$_POST['edit_target_amount']:'');
	$edit_amount_made = (isset($_POST['edit_amount_made'])?$_POST['edit_amount_made']:'');
	$harvest_year = date('Y', strtotime($edit_harvest_date));

	if (!empty($edit_harvest_venue) && !empty($edit_harvest_date) && !empty($edit_harvest_time)) {
		$check_date = $conn->query("SELECT * FROM annual_harvest WHERE harvest_year = '$harvest_year' AND id != '$edit_harvest_id'") or die(mysqli_error($conn));
		if (mysqli_num_rows($check_date) > 0) {
			echo "Annual harvest for year ".$harvest_year." already exists. <br> Maintain the current year or choose a year that has not been used";
		}else{
			if ($edit_amount_made) {
			$update = $conn->query("UPDATE annual_harvest SET date = '$edit_harvest_date', time = '$edit_harvest_time', venue = '$edit_harvest_venue', target_amount = '$edit_target_amount', harvest_year = '$harvest_year' WHERE id = '$edit_harvest_id'") or die(mysqli_error($conn));
			if ($update) {
				$success = TRUE;
				echo $harvest_year." Annual harvest successfully update with Gh&cent".$edit_target_amount." as amount made";
			}
		}else{
			$update = $conn->query("UPDATE annual_harvest SET date = '$edit_harvest_date', time = '$edit_harvest_time', venue = '$edit_harvest_venue', harvest_year = '$harvest_year' WHERE id = '$edit_harvest_id'") or die(mysqli_error($conn));
			if ($update) {
				$success = TRUE;
				echo $harvest_year." successfully updated";
			}
		}
		}
	}else{
		echo "Fill all fields before submitting";
	}
}
?>
<script type="text/javascript">
	var success = '<?= $success; ?>';
	if (success == true) {
		$('#formError').css('color', 'green');
	}else{
		$('#formError').css('color', 'red');
	}
</script>