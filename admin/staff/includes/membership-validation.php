<?php
include 'connect.php';
if (isset($_POST['member_submit_btn'])) {
	$home_cell_group = mysqli_real_escape_string($conn, $_POST['home_cell_group']);
	$bible_study_group = mysqli_real_escape_string($conn, $_POST['bible_study_group']);
	$first_name =mysqli_real_escape_string($conn, $_POST['first_name']);
	$last_name =mysqli_real_escape_string($conn, $_POST['last_name']);
	$birthdate =mysqli_real_escape_string($conn, $_POST['birthdate']);
	$address =mysqli_real_escape_string($conn, $_POST['address']);
	$email =mysqli_real_escape_string($conn, $_POST['email']);
	$phone =mysqli_real_escape_string($conn, $_POST['phone']);
	$occupation =mysqli_real_escape_string($conn, $_POST['occupation']);
	$gender =mysqli_real_escape_string($conn, $_POST['gender']);
	$ministry = mysqli_real_escape_string($conn,$_POST['ministry']);
	$duration = mysqli_real_escape_string($conn, $_POST['duration']);
	$marital_status = mysqli_real_escape_string($conn, $_POST['marital_status']);
	$baptism = mysqli_real_escape_string($conn, $_POST['baptism']);
	$user_comment = mysqli_real_escape_string($conn, $_POST['user_comment']);
	$number = preg_match('@[0-9]@', $phone);
	$notification_message = $first_name." ".$last_name." has been added to members";
	$errorForm = false;
	if (!empty($first_name) && !empty($last_name) && !empty($birthdate) && !empty($address) && !empty($email) && !empty($phone) && !empty($occupation) && !empty($gender) && !empty($ministry) && !empty($duration) && !empty($marital_status) && !empty($baptism)) {
		if (strlen($first_name) < 3) {
			$errorForm = true;
			echo "First Name is too short";
		}elseif (strlen($last_name) < 3) {
			$errorForm = true;
			echo "Last Name is too short";
		}elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$errorForm = true;
			echo "Invalid Email Address";
		}elseif (!$number) {
			$errorForm = true;
			echo "Phone field should contain only numbers";
		}elseif (strlen($phone) < 10) {
			$errorForm = true;
			echo "Phone Number is too Short";
		}elseif (strlen($phone) > 20) {
			$errorForm = true;
			echo "Phone Number is too long";
		}else{
			$member_check_sql = "SELECT * FROM members WHERE email = '$email'";
			$member_check_query = mysqli_query($conn, $member_check_sql);
			if (mysqli_num_rows($member_check_query) > 0) {
				$errorForm = true;
				echo "Member already exists. Please check membership list";
			}else{
				$sql = "INSERT INTO members(first_name, last_name, gender, birthday, address, ministry, phone, email, year_duration, marital_status, occupation, baptism, description,home_cell_group,bible_study_group) VALUES('$first_name', '$last_name', '$gender', '$birthdate', '$address', '$ministry', '$phone', '$email', '$duration', '$marital_status','$occupation', '$baptism', '$user_comment','$home_cell_group', '$bible_study_group')";
				$query = mysqli_query($conn, $sql);

				$notification_sql = "INSERT INTO notification(category,message, date, status) VALUES ('Member Add','$notification_message', now(), 0)";
				$notification_query = mysqli_query($conn, $notification_sql);
				if ($query && $notification_query) {
					$errorForm = false;
					echo "Member has been added successfully";
				}else{
					$errorForm = true;
					echo "Member could not be added. Please try again".mysqli_error($conn);
				}
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
		$('#formError').css("color", "red");
	}else{
		$('#formError').css('color','green');
		function redirect(){
			window.location = 'view-members.php';
		}
		setInterval(redirect, 3000);
	}
</script>