<?php
include 'connect.php';
if (isset($_POST['monthly_activity_btn'])) {
	$errorForm = false;
	$user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
	$activity = $user_name." added a monthly activity";
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
		$insert_activity = "INSERT INTO monthly_activities (month_name, year, week_number, week_activity_name, week_day, opening_prayer, worship, intensive_prayer, sermon, offering, conductor, benediction) VALUES ('$month_name', '$year', '$week_number', '$week_activity_name', '$week_day', '$opening_prayer', '$worship', '$intensive_prayer', '$sermon', '$offering', '$conductor', '$benediction')";
		$insert_activity_query = mysqli_query($conn, $insert_activity);
		$insert_notification = "INSERT INTO notification (category, message, date, status) VALUES ('Monthly Activity', '$activity', now(), 0)";
		$insert_notification_query = mysqli_query($conn, $insert_notification);
		if ($insert_activity_query && $insert_notification_query) {
			$errorForm = false;
			echo "An activity has been added to ".$month_name."<br>";
		}else{
			$errorForm = true;
			echo "Activity could not be added successfully";
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