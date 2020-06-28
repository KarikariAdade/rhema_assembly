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
		<title>Rhema Assembly | Weekly Giving</title>
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
						<li class="active"><a href="#add_weekly_giving" data-toggle="tab" aria-expanded="false">Add Weekly Givings (Staff)</a></li>
						<li class=""><a href="#weekly_giving_staff" data-toggle="tab" aria-expanded="false">View Weekly Givings (Staff)</a></li>
						<li class=""><a href="#weekly_giving_member" data-toggle="tab" aria-expanded="false">View Weekly Givings (Members)</a></li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="add_weekly_giving">
							<small>NB: <strong>Information added is automatically added to overall church income and should be added once every week.<br>Weekly Givings cannot be added twice or more within the same week. Please beware not to forge values</strong></small>
							<div class="row"><br> 
								<div class="col-md-7">
									<h4 align="center" style="font-weight: bold;padding-bottom: 5%;">Week Number: <?= date("W"); ?></h4>
									<form method="POST" class="row weekly-give-form">
										<div class="col-md-6 form-group">
											<label>Week Name *</label>
											<div class="credential_form">
												<input type="text" class="form-control" name="" placeholder="Week Name" id="week_name">
											</div>
										</div>
										<div class="col-md-6 form-group">
											<label>Giving Type *</label>
											<div class="credential_form">
												<select class="form-control" id="giving_type">
													<option>Select Giving Type</option>
													<option>Tithe</option>
													<option>Offering</option>
													<option>Donation</option>
													<option>Welfare</option>
												</select>
											</div>
										</div>
										<div class="col-md-6 form-group">
											<label>Amount Made</label>
											<div class="credential_form">
												<input type="number" name="" placeholder="0.00" min="0" step="0.1" class="form-control" id="amount_made" value="0.00">
											</div>
										</div>
										<div class="col-md-12">
											<p align="center"><button type="submit" class="btn btn-primary" id="weekly_give_form_btn">Submit Offering</button></p>
										</div>
									</form>
								</div>
								<div class="col-md-1"></div>
								<div class="col-md-4 weekly-giving-stats">
								</div>
							</div>
						</div>
						<div class="tab-pane" id="weekly_giving_staff">

							<div class="row">
								<div class="col-lg-12">
									<div class="card">
										<div class="body">
											<div class="table-responsive">
												<table class="table table-bordered table-striped table-hover dataTable js-exportable" style="margin-top: 2%!important;">
													<thead>
														<tr>
															<th>Week Number</th>
															<th>Week Name</th>
															<th>Tithes (GH&cent)</th>
															<th>Offering (GH&cent)</th>
															<th>Donations (GH&cent)</th>
															<th>Welfare (GH&cent)</th>
															<th>Total</th>
														</tr>
													</thead>
													<tbody>
														<?php
														$current_year = date('Y');
														$fetch_weekly_tithes = $conn->query("SELECT * FROM giving WHERE year = '$current_year' ORDER BY week_number ASC") or die(mysqli_error($conn));

														if (mysqli_num_rows($fetch_weekly_tithes) > 0) {
															while ($row = mysqli_fetch_array($fetch_weekly_tithes)) {
																$total = $row['welfare']+$row['tithe']+$row['offering']+$row['donation'];
																?>
																<tr>
																	<td><?= $row['week_number']; ?></td>
																	<td><?= $row['week_name']; ?></td>
																	<td><?= money($row['tithe']); ?></td>
																	<td><?= money($row['offering']); ?></td>
																	<td><?= money($row['donation']); ?></td>
																	<td><?= money($row['welfare']); ?></td>
																	<td><?= money($total); ?></td>
																</tr>
																<?php
															}
														}
														?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="weekly_giving_member">
							<div class="row">
								<div class="col-lg-12">
									<div class="card">
										<div class="body">
											<div class="table-responsive">
												<table class="table table-bordered table-striped table-hover dataTable js-exportable" style="margin-top: 2%!important;">
													<thead id="no-print">
														<tr>
															<th>Week Number</th>
															<th>Number of Givings</th>
															<th>Total Amount Given(GH&cent)</th>
															<th>Year</th>
															<th>Action</th>
														</tr>
													</thead>
													
													<tbody>
														<?php
														$member_query = $conn->query("SELECT week_number, date, phone, amount, SUM(amount) AS total_amount, COUNT(full_name) AS member_number FROM finance WHERE status = 1 GROUP BY week_number ORDER BY id DESC") or die(mysqli_error($conn));
														while ($row = mysqli_fetch_assoc($member_query)) {
															$week_number = $row['week_number'];
															$year = strtotime($row['date']);
															$year = date('Y', $year);
															?>
															<tr id="no-print">
																<td><?= $row['week_number']; ?></td>
																<td><?= $row['member_number']; ?></td>
																<td><?= money($row['total_amount']); ?></td>
																<td><?= $year; ?></td>
																<td><button class="btn btn-primary btn-sm" id="myBtn" onclick='return openModalFunction(<?= $week_number; ?>)'>View Detail</button></td>
															</tr>
															<?php
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
		$('#print').click(function (){
			window.print();
		});
		setInterval(function(){
			$('.weekly-giving-stats').load('includes/weekly-giving-stats.php');
		},1000);
		
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
			function openModalFunction (week_number){
				modal.css('display','block');
				$.ajax({
					url: 'includes/weekly-give-modal.php',
					method: 'POST',
					data:{
						week_number: week_number
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