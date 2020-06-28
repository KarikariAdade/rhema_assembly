<?php
include 'connect.php';
if (isset($_POST['update_profile'])) {
	$first_name = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['first_name']));
	$last_name = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['last_name']));
	$email = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['email']));
	$phone = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['phone']));
	$security_question = mysqli_real_escape_string($conn, $_POST['security_question']);
	$security_answer = mysqli_real_escape_string($conn, $_POST['security_answer']);
	$security_answer = md5($security_answer);
	$biography = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['biography']));
	$user_id = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['user_id']));
	$number = preg_match('@[0-9]@', $phone);
	$emptyForm = false;
	$errorForm = false;

	if (!empty($first_name) && !empty($last_name) && !empty($phone) && !empty($biography) && !empty($email) && !empty($security_answer)) {
		if (strlen($first_name) < 3) {
			$errorForm = true;
			echo "First Name too short";
		}elseif (strlen($last_name) < 3) {
			$errorForm = true;
			echo "Last Name too short";
		}elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$errorForm = true;
			echo "Invalid Email";
		}elseif (strlen($biography) < 30) {
			$errorForm = true;
			echo "Biography should not be less than 30 characters";
		}elseif (!$number) {
			$errorForm = true;
			echo "Phone field should contain only Numbers";
		}elseif ($security_question == "Select Your Security Question") {
			$errorForm = true;
			echo "Please select a Security Question";
		}
		else{
			$sql = "UPDATE admin_profile SET
			first_name = '$first_name',
			last_name = '$last_name',
			email = '$email',
			phone = '$phone',
			security_question = '$security_question',
			security_answer = '$security_answer',
			description = '$biography' WHERE id='$user_id'";
			$query = mysqli_query($conn, $sql);
			if ($query) {
				$errorForm = false;
				echo "Profile has been successfully updated";
			}else{
				$errorForm = true;
				echo "Profile could not be successfully updated";
			}
		}
	}else{
		$emptyForm = true;
		echo "Fill all fields before submitting";
	}
}
?>
<script type="text/javascript">
	var errorForm = "<?php echo $errorForm; ?>";
	if (errorForm == false) {
		$('#formError').addClass("fuck");
		$('.fuck').css("color", "green");
	}
</script>