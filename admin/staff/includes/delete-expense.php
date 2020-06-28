<?php

//This script is used to delete daily expense
include 'connect.php';
if (isset($_POST['expense_id'])) {
	$expense_id = $_POST['expense_id'];
	$delete_expense = $conn->query("DELETE FROM church_expenses WHERE id = '$expense_id'");
	if ($delete_expense) {
		echo "Expense has been deleted.";
	}
}
?>