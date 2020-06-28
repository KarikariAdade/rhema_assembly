<?php
include 'connect.php';
if (isset($_POST['member_update_btn'])) {
	$member_id = mysqli_real_escape_string($conn, $_POST['member_id']);
	$address =mysqli_real_escape_string($conn, $_POST['address']);
	$email =mysqli_real_escape_string($conn, $_POST['email']);
	$phone =mysqli_real_escape_string($conn, $_POST['phone']);
	$occupation =mysqli_real_escape_string($conn, $_POST['occupation']);
	$ministry = mysqli_real_escape_string($conn,$_POST['ministry']);
	$marital_status = mysqli_real_escape_string($conn, $_POST['marital_status']);
	$baptism = mysqli_real_escape_string($conn, $_POST['baptism']);
	$home_cell_group = mysqli_real_escape_string($conn, $_POST['home_cell_group']);
	$bible_study_group = mysqli_real_escape_string($conn, $_POST['bible_study_group']);
	$number = preg_match('@[0-9]@', $phone);
	$errorForm = false;
	if (!empty($address) && !empty($email) && !empty($phone) && !empty($occupation) && !empty($ministry) && !empty($marital_status) && !empty($baptism)) {
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
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
			$sql = "UPDATE members SET
			address = '$address',
			ministry = '$ministry',
			phone = '$phone',
			email = '$email',
			marital_status = '$marital_status',
			occupation = '$occupation',
			baptism = '$baptism',
			home_cell_group = '$home_cell_group',
			bible_study_group = '$bible_study_group' WHERE id = '$member_id'";
			$query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
			if ($query) {
				$errorForm = false;
				echo "Member has been updated successfully";
			}else{
				$errorForm = true;
				echo "Member could not be updated. Please try again".mysqli_error($conn);
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