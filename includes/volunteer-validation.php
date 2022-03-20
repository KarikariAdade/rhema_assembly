<?php
include 'connect.php';
if (isset($_POST['volunteer_submit_btn'])) {
	$full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
	$phone = mysqli_real_escape_string($conn, $_POST['phone']);
	$company = mysqli_real_escape_string($conn, $_POST['company']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$event = mysqli_real_escape_string($conn, $_POST['event']);
	$comment = mysqli_real_escape_string($conn, $_POST['comment']);
	$errorForm = false;
	$notification_message = $full_name." has requested to be a volunteer";
	$phone_number = preg_match('@[0-9]@', $phone);
	if (!empty($full_name) && !empty($phone) && !empty($company) && !empty($email) && !empty($event) && !empty($comment)) {
		if (strlen($full_name) < 10) {
			$errorForm = true;
			echo "Full name too short";
		}elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$errorForm = true;
			echo "Invalid Email";
		}elseif ($event == "Volunteer Events") {
			$errorForm = true;
			echo "Please select a Volunteer category";
		}elseif (!$phone_number) {
			$errorForm = true;
			echo "Phone field should contain only numbers";
		}elseif (strlen($phone) > 20) {
			$errorForm = true;
			echo "Phone number too long";
		}else{
			$sql = "INSERT INTO volunteers (full_name, email, event, phone, company, comment) VALUES ('$full_name', '$email', '$event', '$phone', '$company', '$comment')";
			$query = mysqli_query($conn, $sql);
			$notification_sql = "INSERT INTO notification(category, message, date, status) VALUES('Volunteer', '$notification_message', now(), 0)";
			$notification_query = mysqli_query($conn, $notification_sql);
			if ($query && $notification_query) {
				$errorForm = false;
				echo "Thanks for volunteering. The church staff will contact you soon";
			}else{
				$errorForm = true;
				echo "Sorry, the form could not be sent. Please try again later".mysqli_error($conn);
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
	if (errorForm == true) {
		$('#modal_error').css("color", "red");
	}else{
		$('#modal_error').css("color","green");
		function redirect(){
			window.location = 'serve.php';
		}
		setInterval(redirect, 3000);
	}
</script>