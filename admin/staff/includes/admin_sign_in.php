<?php
session_start();
include 'connect.php';
if (isset($_POST['sign_in_btn'])) {
	$email = $_POST['email'];
	$password = $_POST['password'];

	$password = md5($password);
	// echo $password;

	$errorForm = false;
	$emptyForm = false;

	if (!empty($email) && !empty($password)) {
		$sql = "SELECT * FROM admin_profile WHERE email='$email' AND password='$password'";
		$query = mysqli_query($conn, $sql);

		if (mysqli_num_rows($query) > 0) {
			while ($row = mysqli_fetch_assoc($query)) {
				$id = $row['id'];
				$email = $row['email'];
				$password = $row['password'];

				$_SESSION['id'] = $id;
				$_SESSION['email'] = $email;
				$_SESSION['password'] = $password;


				// echo "<script>window.location = '../index.php';</script>";
				$errorForm = false;
			}
		}
		else{
			$errorForm = true;
			echo "Incorrect Email Address or Password";
		}

	}else{
		$emptyForm = true;
		echo "Fill all fields before submitting";
	}
}
?>
<script type="text/javascript">
	var errorForm = "<?php echo $errorForm; ?>";
	var emptyForm = "<?php echo $emptyForm; ?>";

	if (errorForm == false && emptyForm == false) {
		$('#email, #password').val('');
		window.location = "../staff/index.php";
	}
</script>