<?php
include 'connect.php';
include 'money-function.php';
$output = '';
$fetch_harvest = $conn->query("SELECT * FROM annual_harvest ORDER BY id DESC") or die(mysqli_error($conn));
if (mysqli_num_rows($fetch_harvest) > 0) {
	while ($row = mysqli_fetch_assoc($fetch_harvest)) {
		$day = date('l M Y', strtotime($row['date']));
		$time = date('h:ia', strtotime($row['time']));
		if ($row['status'] == 0) {
			$status = "Marked Inactive";
		}else{
			$status = "Marked Active";
		}
		$harvest_id = $row['id'];
		$output = '
		<tr>
		<td>'.$row['harvest_year'].' Annual Harvest</td>
		<td>'.$day.'</td>
		<td>'.$time.'</td>
		<td>'.$row['venue'].'</td>
		<td id="no-print">'.$status.' <button class="btn btn-xs mark_harvest_btn_'.$harvest_id.'" id="no-print" onclick="return mark_harvest('.$harvest_id.')"> <span class="fa fa-marker"></span></button></td>
		<td>'.money($row['target_amount']).'</td>
		<td id="no-print"><button class="btn btn-xs shit btn-primary" id="myBtn" onclick="return edit_harvest('.$harvest_id.')"><span class="fa fa-edit"></span></button>
		<button class="btn btn-xs shit btn-danger" id="myBtn" onclick="return delete_harvest('.$harvest_id.')"><span class="fa fa-trash"></span></button>
		</td>
		</tr>';
		echo $output;
	}
}else{
	echo "No Harvest available at the moment.";
}
?>
