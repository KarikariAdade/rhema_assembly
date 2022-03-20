<?php
include 'connect.php';
if (isset($_POST['weekly_give_form_btn'])) {
	$current_week = date('W');
	$current_month = date('m');
	$current_year = date('Y');
	$week_name = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['week_name']));
	$giving_type = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['giving_type']));
	$amount_made = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['amount_made']));
	if (!empty($week_name) && $giving_type != 'Select Giving Type' && !empty($amount_made)) {
		$check_week = $conn->query("SELECT * FROM giving WHERE week_number = '$current_week' AND year = '$current_year'") or die(mysqli_error($conn));
		if (mysqli_num_rows($check_week) > 0) {
			if ($giving_type == "Offering") {
				$check_offering = $conn->query("SELECT offering AS offering FROM giving WHERE week_number = '$current_week' AND year = '$current_year'") or die(mysqli_error($conn));
				if (mysqli_num_rows($check_offering) > 0){
					while ($row = mysqli_fetch_assoc($check_offering)) {
						if (is_null($row['offering'])) {
							$update = $conn->query("UPDATE giving SET offering = '$amount_made' WHERE week_number = '$current_week' AND year = '$current_year'");
							if ($update) {
								echo 'Ghc'.$amount_made.' has been added to '.$giving_type.' for week '.$current_week;
							}
						}else{
							echo "Giving already made under ".$giving_type." for this week (week number ".$current_week."). Try again next week";						}
					}
				}
			}else if ($giving_type == "Welfare") {
				$check_welfare = $conn->query("SELECT welfare AS welfare FROM giving WHERE week_number = '$current_week' AND year = '$current_year'") or die(mysqli_error($conn));
				if (mysqli_num_rows($check_welfare) > 0){
					while ($row = mysqli_fetch_assoc($check_welfare)) {
						if (is_null($row['welfare'])) {
							$update = $conn->query("UPDATE giving SET welfare = '$amount_made' WHERE week_number = '$current_week' AND year = '$current_year'");
							if ($update) {
								echo 'Ghc'.$amount_made.' has been added to '.$giving_type.' for week '.$current_week;
							}
						}else{
							echo "Giving already made under ".$giving_type." for this week (week number ".$current_week."). Try again next week";
						}
					}
				}
			}else if ($giving_type == "Tithe") {
				$check_tithe = $conn->query("SELECT tithe AS tithe FROM giving WHERE week_number = '$current_week' AND year = '$current_year'") or die(mysqli_error($conn));
				if (mysqli_num_rows($check_tithe) > 0){
					while ($row = mysqli_fetch_assoc($check_tithe)) {
						if (is_null($row['tithe'])) {
							$update = $conn->query("UPDATE giving SET tithe = '$amount_made' WHERE week_number = '$current_week' AND year = '$current_year'");
							if ($update) {
								echo 'Ghc'.$amount_made.' has been added to '.$giving_type.' for week '.$current_week;
							}
						}else{
							echo "Giving already made under ".$giving_type." for this week (week number ".$current_week."). Try again next week";
						}
					}
				}
			}else {
				$check_donation = $conn->query("SELECT donation AS donation FROM giving WHERE week_number = '$current_week' AND year = '$current_year'") or die(mysqli_error($conn));
				if (mysqli_num_rows($check_donation) > 0){
					while ($row = mysqli_fetch_assoc($check_donation)) {
						if (is_null($row['donation'])) {
							$update = $conn->query("UPDATE giving SET donation = '$amount_made' WHERE week_number = '$current_week' AND year = '$current_year'");
							if ($update) {
								echo 'Ghc'.$amount_made.' has been added to '.$giving_type.' for week '.$current_week;
							}
						}else{
							echo "Giving already made under ".$giving_type." for this week (week number ".$current_week."). Try again next week";
						}
					}
				}
			}
		}else{
			if ($giving_type == "Offering") {
				$add_offering = $conn->query("INSERT INTO giving (week_number, month_number, week_name, offering, year) VALUES ('$current_week', '$current_month', '$week_name', '$amount_made', '$current_year')") or die(mysqli_error($conn));
				if ($add_offering) {
					echo 'Ghc'.$amount_made.' has been added to '.$giving_type.' for week '.$current_week;
				}
			}elseif ($giving_type == "Welfare") {
				$add_welfare = $conn->query("INSERT INTO giving (week_number, month_number, week_name, welfare, year) VALUES ('$current_week', '$current_month', '$week_name', '$amount_made', '$current_year')") or die(mysqli_error($conn));
				if ($add_welfare) {
					echo 'Ghc'.$amount_made.' has been added to '.$giving_type.' for week '.$current_week;
				}
			}elseif ($giving_type == "Tithe") {
				$add_tithe = $conn->query("INSERT INTO giving (week_number, month_number, week_name, tithe, year) VALUES ('$current_week', '$current_month', '$week_name', '$amount_made', '$current_year')") or die(mysqli_error($conn));
				if ($add_tithe) {
					echo 'Ghc'.$amount_made.' has been added to '.$giving_type.' for week '.$current_week;
				}
			}else{
				$add_donation = $conn->query("INSERT INTO giving (week_number, month_number, week_name, donation, year) VALUES ('$current_week', '$current_month', '$week_name', '$amount_made', '$current_year')") or die(mysqli_error($conn));
				if ($add_donation) {
					echo 'Ghc'.$amount_made.' has been added to '.$giving_type.' for week '.$current_week;
				}
			}
		}
	}else{
		echo "Fill all fields before submitting";
	}
}
?>