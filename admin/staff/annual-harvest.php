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
						<li class="active"><a href="#add_harvest" data-toggle="tab" aria-expanded="false">Add Annual Harvest</a></li>
						<li><a href="#view_harvest" data-toggle="tab" aria-expanded="false">View Annual Harvests</a></li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="add_harvest">
							<small id="no-print">NB: <strong>Annual Harvest can be added only once for every year and will be displayed on the site once it's marked active</strong></small>
							<div class="row">
								<div class="col-md-8">
									<form class="row add_harvest_form" method="POST">
										<div class="box-body col-md-6">
											<label>Harvest Date</label>
											<div class="input-group credential_form">
												<div class="input-group-addon credential_form">
													<i class="fa fa-calendar"></i>
												</div>
												<input type="date" class="form-control" name="harvest_date" id="harvest_date">
											</div>
										</div>
										<div class="box-body col-md-6">
											<label>Harvest Time</label>
											<div class="input-group credential_form">
												<div class="input-group-addon credential_form">
													<i class="fa fa-clock"></i>
												</div>
												<input type="time" class="form-control" name="harvest_time" id="harvest_time">
											</div>
										</div>
										<div class="box-body col-md-6">
											<label>Harvest Venue</label>
											<div class="input-group credential_form">
												<div class="input-group-addon credential_form">
													<i class="fa fa-map-marker-alt"></i>
												</div>
												<input type="text" class="form-control" name="harvest_venue" id="harvest_venue">
											</div>
										</div>
										<div class="col-md-12">
											<p align="center">
												<button type="submit" class="btn btn-primary" id="submit_annual_harvest_btn">Create Annual Harvest</button>
											</p>
										</div>
									</form>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="view_harvest">
							<small id="no-print">NB: Only one harvest can be marked active. Harvests marked active will be displayed on the main website</small>
							<div class="row">
								<div class="col-lg-12">
									<h3 align="center">Rhema Assembly Annual Harvests</h3>
									<div class="card">
										<div class="body">
											<div class="table-responsive">
												<table class="table table-bordered table-striped table-hover" style="margin-top: 2%!important;">
													<thead>
														<tr>
															<th>Harvest Name</th>
															<th>Date</th>
															<th>Time</th>
															<th>Venue</th>
															<th id="no-print">Mark Status</th>
															<th>Amount Made</th>
															<th id="no-print">Action</th>
														</tr>
													</thead>
													<tbody class="load_harvest">
														
														

														<div id="harvestModal" class="modal">
															<div class="modal-content">
																<span class="close">&times;</span>
																<div class="modal_content">
																</div>
															</div>
														</div>
													</tbody>
												</table>
											</div>
										</div>
									</div>
									<p align="right"><button id="print" class="btn btn-primary">Print <span class="fa fa-print"></span></button></p>
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
	<script type="text/javascript" src="../assets/js/sweetalert.min.js"></script>
	<script type="text/javascript" src="../assets/js/feature.js"></script>
	<script type="text/javascript">
		//Load annual harvest with AJAX
		setInterval(function(){
			$('.load_harvest').load('includes/load-harvest.php')}, 1000);

		// $('.load_harvest').load('includes/load-harvest.php');


		// CODE TO DISPLAY HARVEST EDIT MODAL
		var modal = $('#harvestModal');
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

		// FUNCTION TO LOAD EDIT HARVEST FORM 
		function edit_harvest (harvest_id){
			$('.modal_content').load('includes/load-harvest-edit.php', {
				harvest_id:harvest_id
			})
			modal.css('display','block');
		}


		// FUNCTION TO DELETE ANNUAL HARVEST
		function delete_harvest(harvest_id){
			swal({
				title: "Are you sure?",
				text: "Deleting an Annual Harvest may affect Financial Statistics. Continue Deletion?",
				type: "warning",
				showCancelButton: true,
				confirmButtonClass: "btn-danger",
				confirmButtonText: "Yes, Delete",
				cancelButtonText: "No, Cancel",
				closeOnConfirm: false,
				closeOnCancel: true
			},
			function(isConfirm) {
				if (isConfirm) {
					$.ajax({
						url: 'includes/delete-harvest.php',
						method: 'POST',
						data: {harvest_id: harvest_id},
						success:function(data){
							swal("Deleted!", ""+data, "success");
						}
					})
					
				}
			});
		}


		// FUNCTION TO MARK HARVEST ACTIVE 
		function mark_harvest(harvest_id){
			var mark_harvest_btn = $('.mark_harvest_btn_'+harvest_id);
			$.ajax({
				url: 'includes/mark-harvest.php',
				method: 'POST',
				data:{harvest_id:harvest_id},
				beforeSend:function(){
					mark_harvest_btn.html('Processing...');
				},
				success:function(data){
					if (data == "Harvest marked successfully") {
						mark_harvest_btn.attr('title','Unmark Harvest');
					}

					if (data == "Harvest unmarked successfully") {
						mark_harvest_btn.attr('title', 'Mark Harvest');
					}
					swal('Info', ''+data, 'info');
				}
			})
		}
	</script>
</body>
</html>
<?php endif;?>