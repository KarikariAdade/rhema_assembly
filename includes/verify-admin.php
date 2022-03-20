<?php
include 'connect.php';
if (isset($_POST['verify_admin_btn'])) {
	$token = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['token']));
	$admin_email = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['admin_email']));
	$admin_password = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['admin_password']));
	$uppercase = preg_match('@[A-Z]@', $admin_password);
	$lowercase = preg_match('@[a-z]@', $admin_password);
	$number = preg_match('@[0-9]@', $admin_password);
	$fetch_credentials = $conn->query("SELECT * FROM staff_request WHERE password = '$token'");
	$row = mysqli_fetch_assoc($fetch_credentials);
	$first_name = $row['first_name'];
	$last_name = $row['last_name'];
	$phone = $row['phone'];
	$gender = $row['gender'];
	$description = $row['description'];
	$position = $row['position'];
	if (!empty($admin_email) && !empty($admin_password)) {
		if ($row['email'] != $admin_email) {
			echo "Emails do not match.";
		}else if (!filter_var($admin_email, FILTER_VALIDATE_EMAIL)) {
			echo "Invalid Email Address";
		}elseif (!$uppercase) {
			echo "Password should contain uppercase letters";
		}elseif (!$lowercase) {
			echo "Password should contain lowercase letters";
		}elseif (!$number) {
			echo "Password should contain at least a number";
		}elseif(strlen($admin_password) < 8){
			echo "Password too short";
		}else{
			$admin_password = md5($admin_password);
			$change_status = $conn->query("UPDATE staff_request SET status = 'verified', password = NULL WHERE password = '$token'") or die(mysqli_error($conn));
			$add_admin = $conn->query("INSERT INTO admin_profile (first_name, last_name, gender, email, password, phone, description,position) VALUES ('$first_name', '$last_name', '$gender', '$admin_email', '$admin_password', '$phone', '$description', '$position')") or die(mysqli_error($conn));
			if ($change_status && $add_admin) {
				echo "You have been verified";
			}else{
				echo "Verification was not successfull. Please <a href='contact'>contact</a> the church staff";
			}
		}
	}else{
		echo "Fill all fields before submitting.";
	}
}
?>