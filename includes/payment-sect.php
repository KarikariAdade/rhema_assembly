<?php
include 'connect.php';
if (isset($_POST['proceed_btn'])) {
	$amount_number = $_POST['amount_number'];
	$give_full_name = $_POST['give_full_name'];
	$give_email = $_POST['give_email'];
	$give_type = $_POST['give_type'];
	if (!empty($amount_number) && !empty($give_full_name) && !empty($give_email) && $give_type != "Select Giving Type") {
		if (strlen($give_full_name) < 5) {
			echo "Full name too short";
		}elseif (!filter_var($give_email, FILTER_VALIDATE_EMAIL)) {
			echo "Invalid Email Address";
		}else{
			echo "Proceed to next page";
		}
	}else{
		echo "Add amount and fill all remaining fields before submitting";
	}
}
if (isset($_POST['payment_form_submit_btn'])) {
	$amount_number = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['amount_number']));
	$give_full_name = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['give_full_name']));
	$give_email = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['give_email']));
	$give_type = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['give_type']));
	$phone_number = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['phone_number']));
	if (!empty($phone_number) && !empty($give_full_name) && !empty($give_email) && $give_type != "Select Giving Type" && $amount_number != 0.00) {
		$string = "ABCDEFGHIJKLMNPQRSTUVWXYZ123456789";
		$transaction_id = substr(str_shuffle($string), 0,5);
		$url = 'https://devapi.fayasms.com/send/';
		$current_week = date('W');
		$current_month = date('m');
		$query = $conn->query("INSERT INTO finance (transaction_id, full_name, email, phone,amount, type,week_number, month_number) VALUES ('$transaction_id', '$give_full_name', '$give_email', '$phone_number', '$amount_number', '$give_type', '$current_week', '$current_month')") or die(mysqli_error($conn));
		if ($query) {
			$AppKey = '52072706';
		$AppSecret = 'Ckv9ft6hwsraZtWwBVfAdaqDfwj5kLSq';
		$To = $phone_number;
		$From = 'RHEMA_ASSEM';
		$Message = 'Thank you for your generosity. Please deposit GHC'.$amount_number.' as '.$give_type.' to the momo number 0548876922. Use transaction code '.$transaction_id.' as reference';

		$params = array(
			'AppKey' => $AppKey,
			'AppSecret' => $AppSecret,
			'From' => $From,
			'To' => $To,
			'Message' => $Message
		);
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		if ($result) {
			echo "Thanks for your generosity. Please donate GHC".$amount_number." and use ".$transaction_id." as reference.";
		}else{
			echo "SMS could not be sent. Please try again";
		}
		curl_close($ch);
		}
		
	}else{
		echo "Fill all form fields to receive confirmation code";
	}
}
?>