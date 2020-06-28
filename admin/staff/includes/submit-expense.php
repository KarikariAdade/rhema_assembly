<?php

//Church expense submission validation

include 'connect.php';
$current_year = date('Y');

if (isset($_POST['submit_expense_btn'])) {
	$expense_purpose = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['expense_purpose']));
	$amount_used = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['amount_used']));
	$user = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['user']));
	$overall_total = $_POST['overall_total'];

	if (!empty($expense_purpose) && !empty($amount_used)) {

		//Fetch user
		$fetch_user = $conn->query("SELECT * FROM admin_profile WHERE id = '$user'");
		$row = mysqli_fetch_assoc($fetch_user);
		$user_name = $row['first_name'].' '.$row['last_name'];
		$user_position = $row['position'];
		$admin_user = $user_name.' ('.$user_position.')';
		if ($amount_used > $overall_total) {
			echo "You have insufficient amount in the Church Account. Please spend within the Church balance";
		}else{
			$week_number = date('W');
			$month_number = date('m');
			$add_expense = $conn->query("INSERT INTO church_expenses (purpose, amount_used, user, year, week_number, month_number) VALUES ('$expense_purpose', '$amount_used', '$admin_user', '$current_year', '$week_number', '$month_number')") or die(mysqli_error($conn));
			if ($add_expense) {
				if ($user_position == 'Secretary') {
					$fetch_presiding_elder = $conn->query("SELECT * FROM admin_profile WHERE position = 'Presiding Elder'");
					if (mysqli_num_rows($fetch_presiding_elder) > 0) {
						$row = mysqli_fetch_assoc($fetch_presiding_elder);
						$presiding_elder = $row['phone'];
						$To = $presiding_elder;
						$From = 'RHEMA_ASSEM';
						$Message = $admin_user.' has deducted Ghc'.$amount_used. ' from the Church account to be used for '.$expense_purpose.' Please contact him/her for more information';
						$url = 'https://devapi.fayasms.com/send/';
						$AppKey = '52072706';
						$AppSecret = 'Ckv9ft6hwsraZtWwBVfAdaqDfwj5kLSq';
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
							echo "An Expense has been made successfully";
						}else{
							echo "SMS could not be sent. Please try again";
						}
						curl_close($ch);
					}else{
						echo "No presiding Elder has access to the system";
					}
				}else{
					$fetch_secretary = $conn->query("SELECT * FROM admin_profile WHERE position = 'Secretary'") or die(mysqli_error($conn));
					if (mysqli_num_rows($fetch_secretary) > 0) {
						$row = mysqli_fetch_assoc($fetch_secretary);
						$secretary = $row['phone'];
						$url = 'https://devapi.fayasms.com/send/';
						$AppKey = '52072706';
						$AppSecret = 'Ckv9ft6hwsraZtWwBVfAdaqDfwj5kLSq';
						$To = $secretary;
						$From = 'RHEMA_ASSEM';
						$Message = $admin_user.' has deducted Ghc'.$amount_used. ' from the Church account to be used for '.$expense_purpose.'. Please contact him/her for more information';

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
							echo "An Expense has been made successfully";
						}else{
							echo "SMS could not be sent. Please try again";
						}
						curl_close($ch);
					}else{
						echo "No secretary has access to the system";
					}
				}
			}
		}
	}else{
		echo "Fill all fields before submitting";
	}

	
}
?>