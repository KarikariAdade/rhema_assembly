<?php

// Membership form email validation
include 'connect.php';
if (isset($_POST['email'])) {
	$email = $_POST['email'];
	$check_email = $conn->query("SELECT * FROM members WHERE email = '$email'");
	$row = mysqli_fetch_assoc($check_email);
	if (mysqli_num_rows($check_email) > 0) {
		echo "You have already been added to the Church's database. You will be redirected";
	}
}

?>
