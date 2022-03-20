<?php
include 'connect.php';
include 'money-function.php';
$output = '';
if (isset($_POST['month_number'])) {
	$month_number = $_POST['month_number'];
	$current_year = date('Y');
	$fetch = $conn->query("SELECT * FROM giving WHERE year = '$current_year' AND month_number = '$month_number' ORDER BY week_number ASC") or die(mysqli_error($conn));
	$output = '<table class="table table-bordered table-striped table-hover">
	<thead>
	<tr>
	<th>Week Number</th>
	<th>Week Name</th>
	<th>Tithes (Gh&cent)</th>
	<th>Offering (GH&cent)</th>
	<th>Donations (GH&cent)</th>
	<th>Welfare (GH&cent)</th>
	<th>Total<th>
	</tr>
	</thead>
	<tbody>';
	while ($row = mysqli_fetch_assoc($fetch)) {
		$total = $row['welfare']+$row['tithe']+$row['offering']+$row['donation'];
		$output .= '
		<tr>
		<td>'.$row["week_number"].'</td>
		<td>'.$row["week_name"].'</td>
		<td>'.$row["tithe"].'</td>
		<td>'.money($row["offering"]).'</td>
		<td>'.money($row["donation"]).'</td>
		<td>'.money($row["welfare"]).'</td>
		<td>'.money($total).'</td>
		</tr>
		';
	}
	$output .= '</tbody>
	</table>';
	echo $output;
}
?>