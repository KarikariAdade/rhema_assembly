<?php
include 'connect.php';
if (isset($_POST['transaction_id'])) {
	$transaction_id = mysqli_real_escape_string($conn, $_POST['transaction_id']);
	$approve_transaction = $conn->query("UPDATE finance SET status = 1 WHERE transaction_id = '$transaction_id'") or die(mysqli_error($conn));
	if ($approve_transaction) {
		//EMAIL MESSAGING GOES HERE
		echo "Transaction successfully Approved. Page will refresh";
	}
}
?>