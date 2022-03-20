<?php
include 'connect.php';
if (isset($_POST['transaction_id'])) {
	$transaction_id = $_POST['transaction_id'];
	$delete_transaction = $conn->query("DELETE FROM finance WHERE transaction_id = '$transaction_id'") or die(mysqli_error($conn));
	if ($delete_transaction) {
		echo "Transaction deleted successfully";
	}
}
?>