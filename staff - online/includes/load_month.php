<?php
include 'connect.php';
$output ='';
if (isset($_POST['month_name']) && isset($_POST['year'])) {
	if ($_POST['month_name'] != '' && $_POST['year'] != '') {
		$month_name = $_POST['month_name'];
		$year = $_POST['year'];
		$sql = "SELECT * FROM monthly_activities WHERE month_name = '$month_name' AND year ='$year' ORDER BY week_number ASC";
	}else{
		$sql = "SELECT * FROM monthly_activities";
	}
	$result = mysqli_query($conn, $sql);
	if(mysqli_num_rows($result) > 0){
	while ($row = mysqli_fetch_array($result)) {
		$month_id = $row['month_id'];
                        $month_name = $row['month_name'];
                        $year = $row['year'];
                        $week_number = $row['week_number'];
                        $week_activity_name = $row['week_activity_name'];
                        $week_day = $row['week_day'];
                        $opening_prayer = $row['opening_prayer'];
                        $worship = $row['worship'];
                        $intensive_prayer = $row['intensive_prayer'];
                        $sermon = $row['sermon'];
                        $offering = $row['offering'];
                        $conductor = $row['conductor'];
                        $benediction = $row['benediction'];
                        $timestamp = strtotime($week_day);
                        $day = date("D M d Y", $timestamp);
		$output .='
                   <tr>
                   <td>'.$week_number.'</td>
                   <td>'.$day.'</td>
                   <td>'.$week_activity_name.'</td>
                   <td>'.$opening_prayer.'</td>
                   <td>'.$worship.'</td>
                   <td>'.$sermon.'</td>
                   <td>'.$intensive_prayer.'</td>
                   <td>'.$offering.'</td>
                   <td>'.$conductor.'</td>
                   <td>'.$benediction.'</td>
                  </tr>
                          
		';
	}
}else{
	$output .= '<p align="center">There are no data to display under '.$_POST['month_name'].'</p>';
}
	echo $output;

}
?>