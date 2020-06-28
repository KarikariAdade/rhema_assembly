<?php
include 'connect.php';
if (isset($_POST['reset_password_btn'])) {
	$password = mysqli_real_escape_string($conn, $_POST['password']);
	$confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);
	$user_id = mysqli_real_escape_string($conn, $_POST['user_id']);

	$errorForm = false;
	if (!empty($password) && !empty($confirm_password)) {
		$uppercase = preg_match('@[A-Z]@', $password);
		$lowercase = preg_match('@[a-z]@', $password);
		$number = preg_match('@[0-9]@', $password);
		$password = md5($password);
		$confirm_password = md5($confirm_password);

		if (!$uppercase) {
			$errorForm = true;
			echo "Password should have Uppercase letters";
		}elseif (!$lowercase) {
			$erorForm = true;
			echo "Password should have Lowercase letters";
		}elseif (!$number) {
			$errorForm = true;
			echo "Password should have numbers";
		}elseif (strlen($password) < 10) {
			$errorForm = true;
			echo "Password too short";
		}elseif ($password != $confirm_password) {
			$errorForm = true;
			echo "Passwords do not match";
		}else{
			$sql = "UPDATE admin_profile SET password = '$password' WHERE id ='$user_id'";
			$query = mysqli_query($conn, $sql);
			if ($query) {
				$errorForm = false;
				echo "Password has been reset successfully";
			}else{
				$errorForm = true;
				echo "Password reset was not successful";
			}
		}

	}else{
		$errorForm = true;
		echo "Please fill all fields before submitting";
	}
}
?>
<script type="text/javascript">
	var errorForm = "<?php echo $errorForm; ?>";
	if (errorForm == false) {
		$('#formErrorPwd').addClass("fuck");
		$('.fuck').css("color", "green");
	}
</script>