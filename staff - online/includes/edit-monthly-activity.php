<?php
include 'connect.php';
if (isset($_POST['monthly_activity_update_btn'])) {
	$errorForm = false;
	$month = mysqli_real_escape_string($conn, $_POST['month']);
	$user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
	$activity = $user_name." updated a monthly activity";
	$conductor = mysqli_real_escape_string($conn, $_POST['conductor']);
	$year = mysqli_real_escape_string($conn, $_POST['year']);
	$month_name = mysqli_real_escape_string($conn, $_POST['month_name']);
	$week_number = mysqli_real_escape_string($conn, $_POST['week_number']);
	$week_activity_name = mysqli_real_escape_string($conn, $_POST['week_activity_name']);
	$week_day = mysqli_real_escape_string($conn, $_POST['week_day']);
	$opening_prayer = mysqli_real_escape_string($conn, $_POST['opening_prayer']);
	$worship = mysqli_real_escape_string($conn, $_POST['worship']);
	$intensive_prayer = mysqli_real_escape_string($conn, $_POST['intensive_prayer']);
	$sermon = mysqli_real_escape_string($conn, $_POST['sermon']);
	$offering = mysqli_real_escape_string($conn, $_POST['offering']);
	$benediction = mysqli_real_escape_string($conn, $_POST['benediction']);

	if (!empty($month_name) && !empty($week_number) && !empty($week_day) && !empty($week_activity_name) && !empty($opening_prayer) && !empty($worship) && !empty($intensive_prayer) && !empty($sermon) && !empty($offering) && !empty($benediction)) {
		$insert_activity = "UPDATE monthly_activities SET 
		month_name = '$month_name',
		year = '$year',
		week_number = '$week_number',
		week_activity_name = '$week_activity_name',
		week_day = '$week_day',
		opening_prayer = '$opening_prayer',
		worship = '$worship',
		intensive_prayer = '$intensive_prayer',
		sermon = '$sermon',
		offering = '$offering',
		conductor = '$conductor',
		benediction = '$benediction' WHERE month_id = '$month'";
		$insert_activity_query = mysqli_query($conn, $insert_activity);
		$insert_notification = "INSERT INTO notification (category, message, date, status) VALUES ('Monthly Activity', '$activity', now(), 0)";
		$insert_notification_query = mysqli_query($conn, $insert_notification);
		if ($insert_activity_query && $insert_notification_query) {
			$errorForm = false;
			echo "An activity (".$week_activity_name.") under ".$month_name." has been updated";
		}else{
			$errorForm = true;
			echo "Activity could not be updated successfully".mysqli_error($conn);
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
		$('#formError').css('color', 'green');
	}
</script>