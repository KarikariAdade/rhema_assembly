<?php
include 'connect.php';
if (isset($_POST['volunteer_submit_btn'])) {
	$full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
	$phone = mysqli_real_escape_string($conn, $_POST['phone']);
	$company = mysqli_real_escape_string($conn, $_POST['company']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$event = mysqli_real_escape_string($conn, $_POST['event']);
	$house_address = mysqli_real_escape_string($conn, $_POST['house_address']);
	$user_comment = mysqli_real_escape_string($conn, $_POST['user_comment']);
	$errorForm = false;
	$phone_number = preg_match('@[0-9]@', $phone);
	if (!empty($full_name) && !empty($phone) && !empty($company) && !empty($email) && !empty($event) && !empty($user_comment) && !empty($house_address)) {
		if (strlen($full_name) < 10) {
			$errorForm = true;
			echo "Full name too short";
		}elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$errorForm = true;
			echo "Invalid Email";
		}elseif (!$phone_number) {
			$errorForm = true;
			echo "Phone field should contain only numbers";
		}elseif (strlen($phone) > 20) {
			$errorForm = true;
			echo "Phone number too long";
		}else{
			$sql = "INSERT INTO volunteers (full_name, email, ministry, phone, company, address, comment) VALUES ('$full_name', '$email', '$event', '$phone', '$company', '$house_address', '$user_comment')";
			$query = mysqli_query($conn, $sql);
			if ($query) {
				$errorForm = false;
				echo "Volunteer has successfully been added";
			}else{
				$errorForm = true;
				echo "Sorry, volunteer could not be added".mysqli_error($conn);
			}
		}
	}
	else{
		$errorForm = true;
		echo "Fill all fields before submitting";
	}
}
?>
<script type="text/javascript">
	var errorForm = "<?php echo $errorForm; ?>";
	if (errorForm == true) {
		$('#formError2').css("color", "red");
	}else{
		$('#formError2').css("color","green");
		function redirect(){
			window.location = 'view-volunteers.php';
		}
		setInterval(redirect, 3000);
	}
</script>