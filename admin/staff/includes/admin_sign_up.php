<?php
include 'connect.php';
if (isset($_POST['sign_up_btn'])) {
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$confirm_password = $_POST['confirm_password'];

	if (!empty($first_name) && !empty($last_name) && !empty($email) && !empty($password) && !empty('password_confirm')) {
		$formError = false;
		$formEmpty = false;

		$uppercase = preg_match('@[A-Z]@', $password);
		$lowercase = preg_match('@[a-z]@', $password);
		$number = preg_match('@[0-9]@', $password);

		$checker = "SELECT * FROM admin_profile WHERE email = '$email'";
		$checker_query = mysqli_query($conn, $checker);

		if (mysqli_num_rows($checker_query) > 0) {
			$formError = true;
			echo "Email already in Use";
		}else{

		if (strlen($first_name) < 5) {
			$formError = true;
			echo "First Name too Short";
		}elseif (strlen($last_name) < 5) {
			$formError = true;
			echo "Last Name too Short";
		}elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$formError = true;
			echo "Invalid Email";
		}elseif (!$uppercase) {
			$formError = true;
			echo "Password should have Uppercase Letters";
		}elseif (!$lowercase) {
			$formError = true;
			echo "Password should have Lowercase Letters";
		}elseif (!$number) {
			$formError = true;
			echo "Password should have Numbers";
		}elseif (strlen($password) < 10) {
			$formError = true;
			echo "Password too Short";
		}elseif ($confirm_password != $password) {
			$formError = true;
			echo "Passwords do not match";
		}else{
			$confirm_password = md5($confirm_password);
			$sql = "INSERT INTO admin_profile (first_name, last_name, email, password) VALUES ('$first_name', '$last_name', '$email', '$confirm_password')";
			$query = mysqli_query($conn, $sql);
			if ($query) {
				$formError = false;
				echo "<script> window.location = '../sign-in.php?account=success&username=".$first_name."'; </script>";
			}else{
				$formError = true;
				echo "Account could not be created. Please try again".mysqli_error($conn);
			}
		}
	}
	}else{
		$formEmpty = true;
		echo "Fill all fields before submitting";

	}
}
?>
<script type="text/javascript">
	var formEmpty = "<?php echo $formEmpty; ?>";
	var formError = "<?php echo $formError; ?>";

	if (formEmpty == false && formError == false) {
		$('#first_name, #last_name, #email, #password, #confirm_password').val('');
		window.location = "sign-in.php?account=success&username=<?php echo $first_name; ?>";
	}
</script>