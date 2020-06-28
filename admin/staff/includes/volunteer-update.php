<?php
include 'connect.php';
if (isset($_POST['e_volunteer_submit_btn'])) {
	$e_volunteer_id = $_POST['e_volunteer_id'];
	$e_full_name = mysqli_real_escape_string($conn, $_POST['e_full_name']);
	$e_phone = mysqli_real_escape_string($conn, $_POST['e_phone']);
	$e_company = mysqli_real_escape_string($conn, $_POST['e_company']);
	$e_email = mysqli_real_escape_string($conn, $_POST['e_email']);
	$e_event = mysqli_real_escape_string($conn, $_POST['e_event']);
	$e_ministry = mysqli_real_escape_string($conn, $_POST['e_ministry']);
	$e_house_address =mysqli_real_escape_string($conn, $_POST['e_house_address']);
	$e_user_comment = mysqli_real_escape_string($conn, $_POST['e_user_comment']);
	$errorForm = false;
	$phone_number = preg_match('@[0-9]@', $e_phone);
	if (!empty($e_full_name) && !empty($e_phone) && !empty($e_company) && !empty($e_email) && !empty($e_user_comment) && !empty($e_house_address)) {
		if (strlen($e_full_name) < 10) {
			$errorForm = true;
			echo "Full name too short";
		}elseif (!filter_var($e_email, FILTER_VALIDATE_EMAIL)) {
			$errorForm = true;
			echo "Invalid Email";
		}elseif (!$phone_number) {
			$errorForm = true;
			echo "Phone field should contain only numbers";
		}elseif (strlen($e_phone) > 20) {
			$errorForm = true;
			echo "Phone number too long";
		}else{
			$sql = "UPDATE volunteers SET
			full_name = '$e_full_name',
			email = '$e_email',
			phone = '$e_phone',
			company = '$e_company',
			event = '$e_event',
			ministry = '$e_ministry',
			address = '$e_house_address',
			comment = '$e_user_comment' WHERE id = '$e_volunteer_id'";
			$query = mysqli_query($conn, $sql);
			if ($query) {
				$errorForm = false;
				echo "Volunteer has successfully been updated";
			}else{
				$errorForm = true;
				echo "Sorry, volunteer could not be updated".mysqli_error($conn);
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
		$('#formError').css("color", "red");
	}else{
		$('#formError').css("color","green");
		function redirect(){
			window.location = 'view-volunteers.php';
		}
		setInterval(redirect, 3000);
	}
</script>