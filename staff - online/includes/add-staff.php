<?php
include 'connect.php';
if (isset($_POST['add_staff_btn'])) {
	$first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
	$last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$generated_password = mysqli_real_escape_string($conn, $_POST['generated_password']);
	$phone = mysqli_real_escape_string($conn, $_POST['phone']);
	$number = preg_match('@[0-9]@', $phone);
	$gender = mysqli_real_escape_string($conn, $_POST['gender']);
	$position = mysqli_real_escape_string($conn, $_POST['position']);
	$staff_description = mysqli_real_escape_string($conn, $_POST['staff_description']);
	$errorForm = false;
	$check_staff = "SELECT * FROM admin_profile WHERE email = '$email'";
	$check_staff_query = mysqli_query($conn, $check_staff);

	$check_staff_request = $conn->query("SELECT * FROM staff_request WHERE email = '$email'");
	$check_staff_request_counter = mysqli_num_rows($check_staff_request);

	if (!empty($first_name) && !empty($last_name) && !empty($email) && !empty($_POST['generated_password']) && !empty($staff_description) && !empty($gender) && !empty($position)) {
		if (strlen($first_name) < 3) {
			$errorForm = true;
			echo "First Name too short";
		}elseif (strlen($last_name) < 3) {
			$errorForm = true;
			echo "Last Name too short";
		}elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$errorForm = true;
			echo "Invalid Email Address";
		}elseif (mysqli_num_rows($check_staff_query) > 0) {
			$errorForm = true;
			echo "Staff account already exists";
		}elseif(!$number){
			$errorForm = true;
			echo "Phone field should contain only Numbers";
		}elseif (strlen($phone) < 10) {
			$errorForm = true;
			echo "Phone Number too short.";
		}elseif (strlen($phone) > 20) {
			$errorForm = true;
			echo "Phone Number too long";
		}elseif (empty($gender)) {
			echo "Select staff gender";
		}elseif (empty($position)) {
			echo "Select staff position";
		}elseif ($check_staff_request_counter > 0) {
			$errorForm = true;
			echo "Request has already been made by staff and pending approval/verification";
		}else{
			$verify_staff_sql = "INSERT INTO staff_request(first_name, last_name, phone, email,status,date,password,gender,position,description) VALUES ('$first_name', '$last_name', '$phone', '$email', 'pending', now(), '$generated_password','$gender','$position','$staff_description')";
			$verify_staff_query = mysqli_query($conn, $verify_staff_sql);
			if ($verify_staff_query) {
				$errorForm = false;
				echo "Staff accound added and verification Email has been sent.";
			}else{
				$errorForm = true;
				echo "Staff account could not be added".mysqli_error($conn);
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
	if (errorForm == false) {
		$('#formError').css("color", "green");
		function redirect(){
			window.location = 'add-staff.php';
		}
		setInterval(redirect, 2000);
	}
</script>