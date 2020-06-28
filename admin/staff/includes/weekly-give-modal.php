<?php
include 'connect.php';
include 'money-function.php';
$output = '';
if (isset($_POST['week_number'])) {
	$week_number = $_POST['week_number'];
	$fetch_giving = $conn->query("SELECT * FROM finance WHERE week_number = '$week_number' AND status = 1") or die(mysqli_error($conn));
	$output .= '
	<h3 align="center">Members Weekly Giving Detail (Week '.$week_number.')</h3>
	<table class="table table-bordered table-striped table-hover">
	<thead>
	<tr>
	<th>Full Name</th>
	<th>Transaction ID</th>
	<th>Email</th>
	<th>Phone</th>
	<th>Amount Paid</th>
	<th>Giving Type</th>
	</tr>
	</thead>
	<tbody>';
	while ($row = mysqli_fetch_assoc($fetch_giving)) {
		$output .= '
		
		<tr>
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