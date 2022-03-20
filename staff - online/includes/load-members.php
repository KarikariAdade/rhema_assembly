<?php
include 'connect.php';
include 'time_function.php';
$output = '';
if (isset($_POST['career_category']) && isset($_POST['member_status']) && isset($_POST['member_gender'])) {
	$career_category = $_POST['career_category'];
	$member_status = $_POST['member_status'];
	$member_gender = $_POST['member_gender'];
	if ($career_category != '' || $member_status != '' || $member_gender != '') {
		$sql = "SELECT * FROM members WHERE career_field = '$career_category' OR marital_status = '$member_status' OR gender = '$member_gender' ORDER BY id ASC";
	}else{
		echo 'NOTHING TO DISPLAY';
	}
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			$member_id = $row['id'];
                      $first_name = $row['first_name'];
                      $last_name = $row['last_name'];
                      $gender = $row['gender'];
                      $email = $row['email'];
                      $birthdate = $row['birthday'];
                      $occupation = $row['occupation'];
                      $address = $row['address'];
                      $marital_status = $row['marital_status'];
                      $phone = $row['phone'];
                      $year_duration = $row['year_duration'];
                      $baptism = $row['baptism'];
                      $home_cell_group = $row['home_cell_group'];
                      $bible_study_group = $row['bible_study_group'];

                      $output .= '
                      <tr>
                      <td><a href="member-detail.php?member='.urlencode($member_id).'&slug='.urlencode($last_name).'&user='.urlencode($first_name).'">'.$first_name.'</a></td>
                      <td><a href="member-detail.php?member='.urlencode($member_id).'&slug='.urlencode($last_name).'&user='.urlencode($first_name).'">'.$last_name.'</a></td>
                      <td><a href="member-detail.php?member='.urlencode($member_id).'&slug='.urlencode($last_name).'&user='.urlencode($first_name).'">'.$gender.'</a></td>
                      <td><a href="member-detail.php?member='.urlencode($member_id).'&slug='.urlencode($last_name).'&user='.urlencode($first_name).'">'.$email.'</a></td>
                      <td><a href="member-detail.php?member='.urlencode($member_id).'&slug='.urlencode($last_name).'&user='.urlencode($first_name).'">'.$birthdate.'</a></td>
                      <td><a href="member-detail.php?member='.urlencode($member_id).'&slug='.urlencode($last_name).'&user='.urlencode($first_name).'">'.$occupation.'</a></td>
                      <td><a href="member-detail.php?member='.urlencode($member_id).'&slug='.urlencode($last_name).'&user='.urlencode($first_name).'">'.$address.'</a></td>
                      <td><a href="member-detail.php?member='.urlencode($member_id).'&slug='.urlencode($last_name).'&user='.urlencode($first_name).'">'.$marital_status.'</a></td>
                      <td><a href="member-detail.php?member='.urlencode($member_id).'&slug='.urlencode($last_name).'&user='.urlencode($first_name).'">'.$phone.'</a></td>
                      <td><a href="member-detail.php?member='.urlencode($member_id).'&slug='.urlencode($last_name).'&user='.urlencode($first_name).'">'.time_ago($year_duration).'</a></td>
                      <td><a href="member-detail.php?member='.urlencode($member_id).'&slug='.urlencode($last_name).'&user='.urlencode($first_name).'">'.$baptism.'</a></td>
                      <td><a href="member-detail.php?member='.urlencode($member_id).'&slug='.urlencode($last_name).'&user='.urlencode($first_name).'">'.$home_cell_group.'</a></td><td><a href="member-detail.php?member='.urlencode($member_id).'&slug='.urlencode($last_name).'&user='.urlencode($first_name).'">'.$bible_study_group.'</a></td>
                      </tr>';
		}
	}else{
		$output .= '<p align="center">There is no data to display under the selected categories.</p>';
	}
	echo $output;
}
?>