<?php
session_start();
include 'includes/connect.php';
include 'includes/money-function.php';
$errorMsg = '';
$id = $_SESSION['id'];
?>
<?php if (!isset($_SESSION['id'])):?>
	<?php  echo "<script>window.location = 'sign-in.php';</script>"; ?>
<?php else:?>
	<!DOCTYPE html>
	<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Rhema Assembly | Monthly Giving</title>
		<!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<!-- Bootstrap 3.3.7 -->
		<link rel="stylesheet" href="../assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="../assets/dist/css/all.css">
		<!-- Ionicons -->
		<link rel="stylesheet" href="../assets/bower_components/Ionicons/css/ionicons.min.css">
		<!-- Theme style -->
		<link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css">
		<link rel="stylesheet" href="../assets/dist/css/skins/_all-skins.min.css">
		<link rel="stylesheet" type="text/css" href="../assets/css/admin.css">
		<link rel="stylesheet" href="../assets/js/datatable/dataTables.bootstrap4.min.css">
		<link rel="stylesheet" type="text/css" href="../assets/css/sweetalert.css">

		<!-- Google Font -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
		<style type="text/css">
		form .col-md-6{
			padding-bottom: 4%;
		}
		@media print{
			title{
				display: none;
			}
			::-webkit-scrollbar{display: none;}
			#no-print{
				display: none;
			}
		}
	</style>

	<!-- Google Font -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
		<?php include 'includes/sidebar.php'; ?>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<section class="content-header">
				<h1>
					<?php
					$remove = chop(basename($_SERVER['PHP_SELF']),'.php');
					$remove = strtoupper($remove);
					$remove = str_replace("-", " ", $remove);
					echo $remove;
					?>
				</h1>
				<ol class="breadcrumb">
					<li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
					<li class="active">
						<?php
						$remove = chop(basename($_SERVER['PHP_SELF']),'.php');
						$remove = strtoupper($remove);
						$remove = str_replace("-", " ", $remove);
						echo $remove;
						?>
					</li>
				</ol>
			</section>
		
		<div class="container" style="width:98%; margin-top: 5%;">
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs" id="no-print">
						<li class="active"><a href="#staff_monthly_giving" data-toggle="tab" aria-expanded="false">View Monthly Givings (Staff)</a></li>
						<li class=""><a href="#member_monthly_giving" data-toggle="tab" aria-expanded="false">View Monthly Givings (Members)</a></li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="staff_monthly_giving">
							<h3 align="center">Rhema Assembly Monthly Giving (Staff) for <?= date('Y'); ?></h3>
							<div class="row">
								<div class="col-lg-12">
									<div class="card">
										<div class="body">
											<div class="table-responsive">
												<table class="table table-bordered table-striped table-hover" style="margin-top: 2%!important;">
													<thead>
														<tr>
															<th>Month Number</th>
															<th>Month Name & Year</th>
															<th>Tithes (GH&cent)</th>
															<th>Offering (GH&cent)</th>
															<th>Donations (GH&cent)</th>
															<th>Welfare (GH&cent)</th>
															<th>Total</th>
															<th id="no-print">Action</th>
														</tr>
													</thead>
													<tbody>
														<?php
														$current_year = date('Y');
														$fetch_monthly_giving = $conn->query("SELECT month_number, SUM(offering) AS offering, SUM(tithe) AS tithe, SUM(donation) AS donation, SUM(welfare) AS welfare, year FROM giving WHERE year = '$current_year' GROUP BY month_number ORDER BY month_number ASC ") or die(mysqli_error($conn));

														if (mysqli_num_rows($fetch_monthly_giving) > 0) {
															while ($row = mysqli_fetch_array($fetch_monthly_giving)) {
																$month_name = date('F', mktime(0,0,0,$row['month_number'], 10));
																$total = $row['welfare']+$row['tithe']+$row['offering']+$row['donation'];
																?>
																<tr>
																	<td><?= $row['month_number']; ?></td>
																	 <td><?= $month_name.' '.date('Y'); ?></td>
																	<td><?= money($row['tithe']); ?></td>
																	<td><?= money($row['offering']); ?></td>
																	<td><?= money($row['donation']); ?></td>
																	<td><?= money($row['welfare']); ?></td>
																	<td><?= money($total); ?></td>
																	<td id="no-print"><button onclick="return openModalFunction(<?= $row['month_number']; ?>)" class="btn btn-sm btn-primary">View Details</button></td>
																</tr>
																<?php
															}
														}
														?>
													</tbody>
														<div id="myModal" class="modal">
											<div class="modal-content">
												<span class="close">&times;</span>
												<div class="modal_content">
											</div>
											</div>
										</div>
												</table>
												<p align="right"><button class="btn btn-primary" id="print">Print <span class="fa fa-sm fa-print"></span></button></p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="member_monthly_giving">
							<h3 align="center">Rhema Assembly Monthly Giving (Members) for <?= date('Y'); ?></h3>
							<div class="row">
								<div class="col-lg-12">
									<div class="card">
										<div class="body">
											<div class="table-responsive">
												<table class="table table-bordered table-striped table-hover" style="margin-top: 2%!important;">
													<thead>
														<tr>
															<tr>
															<th>Month Number</th>
															<th>Month Name & Year</th>
															<th>Number of Givings</th>
															<th>Total Amount Given(GH&cent)</th>
															<th>Year</th>
															<th id="no-print">Action</th>
														</tr>
														</tr>
													</thead>
													<tbody>
														<?php
														$member_query = $conn->query("SELECT month_number, date, phone, amount, SUM(amount) AS total_amount, COUNT(full_name) AS member_number FROM finance WHERE status = 1 GROUP BY month_number ORDER BY id DESC") or die(mysqli_error($conn));
														while ($row = mysqli_fetch_assoc($member_query)) {
															$month_name = date('F', mktime(0,0,0,$row['month_number'], 10));
															$month_number = $row['month_number'];
															$year = strtotime($row['date']);
															$year = date('Y', $year);
															?>
															<tr>
																<td><?= $row['month_number']; ?></td>
																<td><?= $month_name.' '.date('Y'); ?></td>
																<td><?= $row['member_number']; ?></td>
																<td><?= money($row['total_amount']); ?></td>
																<td><?= $year; ?></td>
																<td id="no-print"><button class="btn btn-primary btn-sm" id="myBtn2" onclick='return monthlyModalFunction(<?= $month_number; ?>)'>View Detail</button></td>
															</tr>
															<?php
														}
														?>
													</tbody>
													<div id="myModal2" class="modal">
											<div class="modal-content">
												<span class="close2">&times;</span>
												<div class="modal_content">
											</div>
											</div>
										</div>
												</table>
												<p align="right"><button class="btn btn-primary" id="print1">Print <span class="fa fa-sm fa-print"></span></button></p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
			<?php include 'includes/aside.php';?>
	</div>
	<script src="../assets/bower_components/jquery/dist/jquery.min.js"></script>
	<script src="../assets/bower_components/jquery-ui/jquery-ui.min.js"></script>
	<script src="../assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="../assets/dist/js/all.js"></script>
	<script src="../assets/dist/js/adminlte.min.js"></script>
	<script src="../assets/dist/js/pages/dashboard.js"></script>
	<script src="../assets/dist/js/demo.js"></script>
	<script src="../assets/js/datatablescripts.bundle.js"></script>
	<script src="../assets/js/datatable/buttons/dataTables.buttons.min.js"></script>
	<script src="../assets/js/datatable/buttons/buttons.bootstrap4.min.js"></script>
	<script src="../assets/js/datatable/buttons/buttons.colVis.min.js"></script>
	<script src="../assets/js/datatable/buttons/buttons.flash.min.js"></script>
	<script src="../assets/js/datatable/buttons/buttons.html5.min.js"></script>
	<script src="../assets/js/datatable/buttons/buttons.print.min.js"></script>
	<script src="../assets/js/datatable/buttons/jquery-datatable.js"></script>
	<script type="text/javascript" src="../assets/js/sweetalert.min.js"></script>
	<script type="text/javascript" src="../assets/js/feature.js"></script>
	<script type="text/javascript">

		//First Modal
		var modal = $('#myModal');
			var btn = $("#myBtn");
			var span = $(".close")[0];
			span.onclick = function() {
				modal.css('display','none');
			}
			window.onclick = function(event) {
				if (event.target == modal) {
					modal.css('display','none');
				}
			}
			function openModalFunction (month_number){
				modal.css('display','block');
				$.ajax({
					url: 'includes/monthly-give-modal.php',
					method: 'POST',
					data:{
						month_number: month_number
					},
					success:function(data){
						$('.modal_content').html(data);
					}
				})
			}

			// 2nd Modal
			var modal2 = $('#myModal2');
			var btn2 = $("#myBtn2");
			var span2 = $(".close2")[0];
			span2.onclick = function() {
				modal2.css('display','none');
			}
			window.onclick = function(event) {
				if (event.target == modal) {
					modal2.css('display','none');
				}
			}
			function monthlyModalFunction (month_number){
				modal2.css('display','block');
				$.ajax({
					url: 'includes/monthly-give-modal-2.php',
					method: 'POST',
					data:{
						month_number: month_number
					},
					success:function(data){
						$('.modal_content').html(data);
					}
				})
			}
	</script>
</body>
</html>
<?php endif;?>