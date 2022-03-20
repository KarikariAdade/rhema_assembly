<?php
include 'connect.php';
if (isset($_POST['service_submit_btn'])) {
	$user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
	$phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
	$company_name = mysqli_real_escape_string($conn, $_POST['company_name']);
	$user_email = mysqli_real_escape_string($conn, $_POST['user_email']);
	$user_service = mysqli_real_escape_string($conn, $_POST['user_service']);
	$user_comment = mysqli_real_escape_string($conn, $_POST['user_comment']);
	$errorForm = false;
	$notification_message = $user_name." has requested to be a volunteer";
	$phone = preg_match('@[0-9]@', $phone_number);
	if (!empty($user_name) && !empty($phone_number) && !empty($company_name) && !empty($user_email) && !empty($user_service) && !empty($user_comment)) {
		if (strlen($user_name) < 10) {
			$errorForm = true;
			echo "Full Name too short";
		}elseif (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
			$errorForm = true;
			echo "Invalid Email";
		}elseif ($user_service == "Serve God Through") {
			$errorForm = true;
			echo "Please select a Service category";
		}elseif (!$phone) {
			$errorForm = true;
			echo "Phone field should contain only numbers";
		}elseif (strlen($phone) > 20) {
			$errorForm = true;
			echo "Phone number too long";
		}else{
			$sql = "INSERT INTO volunteers (full_name, email, ministry, phone, company, comment) VALUES ('$user_name', '$user_email', '$user_service', '$phone', '$company_name', '$user_comment')";
			$query = mysqli_query($conn, $sql);
			$notification_sql = "INSERT INTO notification(category, message, date, status) VALUES('Volunteer', '$notification_message', now(), 0)";
			$notification_query = mysqli_query($conn, $notification_sql);
			if ($query) {
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
		$('#service_error').css("color", "red");
	}else{
		$('#service_error').css("color","green");
		function redirect(){
			window.location = 'serve.php';
		}
		setInterval(redirect, 3000);
	}
</script>