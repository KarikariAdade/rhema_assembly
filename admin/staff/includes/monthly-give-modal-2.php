<?php
include 'connect.php';
include 'money-function.php';
$output = '';
if (isset($_POST['month_number'])) {
	$month_number = $_POST['month_number'];
	$month_name = date('F', mktime(0,0,0,$month_number, 10));
	$fetch_monthly_giving = $conn->query("SELECT * FROM finance WHERE month_number = '$month_number' AND status = 1") or die(mysqli_error($conn));
	$output .= '
	<h3 align="center">Members Monthly Giving Detail ('.$month_name.')</h3>
	<table class="table table-bordered table-striped table-hover">
	<thead>
	<tr>
	<th>Week Number</th>
	<th>Full Name</th>
	<th>Transaction ID</th>
	<th>Email</th>
	<th>Phone</th>
	<th>Amount Paid</th>
	<th>Giving Type</th>
	</tr>
	</thead>
	<tbody>';
	while ($row = mysqli_fetch_assoc($fetch_monthly_giving)) {
		$output .= '
		
		<tr>
		<td>'.$row["week_number"].'</td>
		<td>'.$row["full_name"].'</td>
		<td>'.$row["transaction_id"].'</td>
		<td>'.$row["email"].'</td>
		<td>'.$row["phone"].'</td>
		<td>'.money($row["amount"]).'</td>
		<td>'.$row["type"].'</td>
		</tr>

		';
	}
	$output .= '</tbody>
	</table>';
	echo $output;
}
?>