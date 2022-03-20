<?php
include 'connect.php';
if (isset($_POST['reset_password_btn'])) {
	$security_question = mysqli_real_escape_string($conn, $_POST['security_question']);
	$security_answer = mysqli_real_escape_string($conn, $_POST['security_answer']);
	$new_password = mysqli_real_escape_string($conn, $_POST['new_password']);
	$confirm_new_password = mysqli_real_escape_string($conn, $_POST['confirm_new_password']);
	$user_account_id = mysqli_real_escape_string($conn, $_POST['user_account_id']);
	$security_answer = md5($security_answer);
	$uppercase = preg_match('@[A-Z]@', $new_password);
		$lowercase = preg_match('@[a-z]@', $new_password);
		$number = preg_match('@[0-9]@', $new_password);
	$errorMessage = false;
	$sql = "SELECT * FROM admin_profile WHERE id = '$user_account_id' AND security_answer = '$security_answer'";
	$query = mysqli_query($conn, $sql);
	if (mysqli_num_rows($query) > 0) {
		if (!$uppercase) {
			$errorMessage = true;
			echo "New Password should contain Uppercase Letters";
		}elseif (!$lowercase) {
			$errorMessage = true;
			echo "New Password should contain Lowercase Letters";
		}elseif (strlen($confirm_new_password) < 10) {
			$errorMessage = true;
			echo "Password too short";
		}elseif ($new_password != $confirm_new_password) {
			$errorMessage = true;
			echo "New Passwords do not match";
		}elseif (!$number) {
			$errorMessage = true;
			echo "New Password should contain at least a number";
		}else{
			$confirm_new_password = md5($confirm_new_password);
			$recover_sql = "UPDATE admin_profile SET password = '$confirm_new_password' WHERE id = '$user_account_id'";
			$recover_query = mysqli_query($conn, $recover_sql);
			if ($recover_query) {
				$errorMessage = false;
				echo "<script>swal('Success', 'Your Password has been reset successfully. You are being redirected to the sign-in page', 'success');</script>";
			}else{
				echo "Password was not successfully set. Please try again";
			}
		}
	}else{
		$errorMessage = true;
		echo "Invalid Answer to Security Question";
	}
}
?>
<script type="text/javascript">
	var errorMessage = "<?php echo $errorMessage; ?>";
	if (errorMessage == false) {
		function redirect(){
			window.location = 'sign-in.php';
		}
		setInterval(redirect, 5000);
	}
</script>