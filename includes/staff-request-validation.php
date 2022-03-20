<?php
include 'connect.php';
if (isset($_POST['staff_submit_btn'])) {
	$first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
	$last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
	$phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
	$user_email = mysqli_real_escape_string($conn, $_POST['user_email']);
	$user_gender = mysqli_real_escape_string($conn, $_POST['user_gender']);
	$staff_description = mysqli_real_escape_string($conn, $_POST['staff_description']);
	$notification_message = $first_name." ".$last_name." has made a staff request";
	$errorForm = false;
	$phone = preg_match('@[0-9]@', $phone_number);
	if (!empty($first_name) && !empty($last_name) && !empty($phone_number) && !empty($user_email) && !empty($user_gender) && !empty($staff_description)) {
		if (strlen($first_name) < 3) {
			$errorForm = true;
			echo "First Name is too short";
		}elseif (strlen($last_name) < 3) {
			$errorForm = true;
			echo "Last Name too short";
		}elseif (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
			$errorForm = true;
			echo "Invalid Email Address";
		}elseif ($user_gender == "Gender") {
			$errorForm = true;
			echo "Please select a Gender";
		}elseif (strlen($staff_description) < 30) {
			$errorForm = true;
			echo "Description too short";
		}elseif(!$phone){
			$errorForm = true;
			echo "Phone Field should contain only numbers";
		}elseif (strlen($phone_number) < 10) {
			$errorForm = true;
			echo "Invalid Phone number";
		}elseif (strlen($phone_number) > 20) {
			$errorForm = true;
			echo "Invalid Phone number";
		}
		else{
			$sql = "INSERT INTO staff_request(first_name, last_name, phone, email, gender, description, status, date) VALUES('$first_name', '$last_name', '$phone_number', '$user_email', '$user_gender', '$staff_description', 'not verified', now())";
			$query = mysqli_query($conn, $sql);
			$notification_sql = "INSERT INTO notification(category, message, date, status) VALUES ('Staff Request', '$notification_message', now(), 0)";
			$notification_query = mysqli_query($conn, $notification_sql);
			if ($query && $notification_query) {
				$errorForm = false;
				echo "Thanks for the request. You will receive verification soon";
			}else{
				$errorForm = true;
				echo "Request could not be sent. Please try again later".mysqli_error($conn);
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
			window.location = 'board.php';
		}
		setInterval(redirect, 3000);
	}
</script>