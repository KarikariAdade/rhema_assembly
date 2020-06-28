<?php

// Membership validation form page 3
include 'connect.php';
if (isset($_POST['next3'])) {
	$already_added = false;
	$first_name = htmlspecialchars(mysqli_real_escape_string($conn,$_POST['first_name']));
	$last_name = htmlspecialchars(mysqli_real_escape_string($conn,$_POST['last_name']));
	$birthdate = htmlspecialchars(mysqli_real_escape_string($conn,$_POST['birthdate']));
	$address = htmlspecialchars(mysqli_real_escape_string($conn,$_POST['address']));
	$email = htmlspecialchars(mysqli_real_escape_string($conn,$_POST['email']));
	$phone = htmlspecialchars(mysqli_real_escape_string($conn,$_POST['phone']));
	$marital_status = htmlspecialchars(mysqli_real_escape_string($conn,$_POST['marital_status']));
	$ministry = htmlspecialchars(mysqli_real_escape_string($conn,$_POST['ministry']));
	$gender = htmlspecialchars(mysqli_real_escape_string($conn,$_POST['gender']));
	$duration = htmlspecialchars(mysqli_real_escape_string($conn,$_POST['duration']));
	$baptism = htmlspecialchars(mysqli_real_escape_string($conn,$_POST['baptism']));
	$career_field = htmlspecialchars(mysqli_real_escape_string($conn,$_POST['career_field']));
	$occupation = htmlspecialchars(mysqli_real_escape_string($conn,$_POST['occupation']));
	$user_comment = htmlspecialchars(mysqli_real_escape_string($conn,$_POST['user_comment']));
		$add_member =$conn->query("INSERT INTO members(first_name, last_name, gender, birthday, address, ministry, phone, email, year_duration, marital_status, occupation, baptism, description, career_field) VALUES('$first_name', '$last_name', '$gender', '$birthdate', '$address', '$ministry', '$phone', '$email', '$duration', '$marital_status','$occupation', '$baptism', '$user_comment', '$career_field')") or die(mysqli_error());
	if ($add_member) {
		echo "You are almost done!.Please proceed to image upload";
	}else{
		echo "There was an error while submitting credentials. Please contact the church staff";
	}
}
?>