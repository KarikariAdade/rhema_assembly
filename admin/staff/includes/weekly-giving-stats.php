<?php
include 'connect.php';
include 'money-function.php';
$current_year = date('Y');
$output = '';
$fetch_week_tithe = $conn->query("SELECT SUM(tithe) as total_week_tithe FROM giving WHERE year = '$current_year'") or die(mysqli_error($conn));
if (mysqli_num_rows($fetch_week_tithe) > 0) {
	$row = mysqli_fetch_assoc($fetch_week_tithe);
	$output .='<div class="info-box bg-aqua">
            <span class="info-box-icon"><i class="fa fa-donate"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Tithes (Total Amount)</span>
              <span class="info-box-number">'.money($row['total_week_tithe']).'</span>
            </div>
          </div>';
}
$fetch_week_offering = $conn->query("SELECT SUM(offering) as total_week_offering FROM giving WHERE year = '$current_year'");
if (mysqli_num_rows($fetch_week_offering) > 0) {
	$row = mysqli_fetch_assoc($fetch_week_offering);
	$output .= '<div class="info-box bg-maroon">
            <span class="info-box-icon"><i class="fa fa-donate"></i></span>
            <div class="info-box-content bg-maroon">
              <span class="info-box-text">Offering (Total Amount)</span>
              <span class="info-box-number">'.money($row['total_week_offering']).'</span>
            </div>
          </div>';
}
$fetch_week_donation = $conn->query("SELECT SUM(donation) as total_week_donation FROM giving WHERE year = '$current_year'") or die(mysqli_error($conn));
if (mysqli_num_rows($fetch_week_donation) > 0) {
	$row = mysqli_fetch_assoc($fetch_week_donation);
	$output .= '<div class="info-box bg-navy">
            <span class="info-box-icon"><i class="fa fa-donate"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Donation (Total Amount)</span>
              <span class="info-box-number">'.money($row['total_week_donation']).'</span>
            </div>
          </div>';
}
$fetch_week_welfare = $conn->query("SELECT SUM(welfare) as total_week_welfare FROM giving WHERE year = '$current_year'") or die(mysqli_error($conn));
if (mysqli_num_rows($fetch_week_welfare) > 0) {
  $row = mysqli_fetch_assoc($fetch_week_welfare);
  $output .= '<div class="info-box bg-orange">
            <span class="info-box-icon"><i class="fa fa-donate"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Welfare (Total Amount)</span>
              <span class="info-box-number">'.money($row['total_week_welfare']).'</span>
            </div>
          </div>';
}
echo $output;
?>