<?php
session_start();
include 'includes/connect.php';
include 'includes/money-function.php';
$errorMsg = '';
$current_year = date('Y');
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
		<script src="../assets/bower_components/jquery/dist/jquery.min.js"></script>
		<script type="text/javascript" src="../assets/js/sweetalert.min.js"></script>
		<script type="text/javascript">
			function delete_expense(expense_id){
				alert(expense_id);
				swal({
					title: "Are you sure?",
					text: "Are you sure you want to delete expense?. This may affect financial statistics",
					type: "warning",
					showCancelButton: true,
					confirmButtonClass: "btn-danger",
					confirmButtonText: "Yes, delete it",
					closeOnConfirm: false
				},
				function(){
					$.ajax({
						url: 'includes/delete-expense.php',
						method: 'POST',
						data:{
							expense_id: expense_id
						},
						success:function(data){
							swal("Deleted!", ""+data, "success");
						}
					})

				});

			}

		</script>

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
						<li class="active"><a href="#add_expense" data-toggle="tab" aria-expanded="false">Add Church Expense</a></li>
						<li class=""><a href="#view_daily_expense" data-toggle="tab" aria-expanded="false">View Church Expenses (Daily)</a></li>
						<li class=""><a href="#view_weekly_expense" data-toggle="tab" aria-expanded="false">View Church Expenses (Weekly)</a></li>
						<li class=""><a href="#view_monthly_expense" data-toggle="tab" aria-expanded="false">View Church Expenses (Monthly)</a></li>
						<li class=""><a href="#view_yearly_expense" data-toggle="tab" aria-expanded="false">View Yearly Expenses</a></li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="add_expense">
							<div class="container" style="width:98%; margin-top: 5%;">
								<div class="row">
									<div class="col-md-7">
										<form class="row expense_form" method="POST" style="margin-top: 5%;">
											<div class="col-md-6">
												<input type="hidden" name="" id="user" value="<?= $id;?>">
												<label>Expense Purpose</label>
												<div class="input-group credential_form">
													<div class="input-group-addon credential_form">
														<i class="fa fa-clipboard"></i>
													</div>
													<input type="text" class="form-control" id="expense_purpose">
												</div>
											</div>
											<div class="col-md-6">
												<label>Amount Used</label>
												<div class="input-group credential_form">
													<div class="input-group-addon credential_form">
														<span>Gh&cent</span>
													</div>
													<input type="number" placeholder="0.00" class="form-control" id="amount_used">
												</div>
											</div>
											<div class="col-md-12" align="center">
												<button class="btn btn-primary submit_expense_btn" type="submit">Submit Expense</button>
											</div>
										</form>
									</div>
									<div class="col-md-5">
										<!-- FETCH TOTAL AMOUNT -->
										<?php
										$member_query = $conn->query("SELECT SUM(amount) AS total_amount FROM finance WHERE status = 1 ORDER BY id DESC") or die(mysqli_error($conn));
										$fetch_monthly_giving = $conn->query("SELECT SUM(offering) AS offering, SUM(tithe) AS tithe, SUM(donation) AS donation, SUM(welfare) AS welfare FROM giving ORDER BY month_number ASC ") or die(mysqli_error($conn));
										$fetch_expenses = $conn->query("SELECT SUM(amount_used) AS total_expenses FROM church_expenses WHERE year = '$current_year'") or die(mysqli_error($conn));
										if (mysqli_num_rows($member_query) > 0 && mysqli_num_rows($fetch_monthly_giving) > 0 || mysqli_num_rows($fetch_expenses) > 0) {
											$row1 = mysqli_fetch_assoc($member_query);
											$row2 = mysqli_fetch_assoc($fetch_monthly_giving);
											$row3 = mysqli_fetch_assoc($fetch_expenses);

											$total = $row2['offering'] + $row2['tithe'] + $row2['donation'] + $row2['welfare'];
											$overall_total = $total + $row1['total_amount'] - $row3['total_expenses'];
										}
										?>
										<div class="info-box bg-aqua">
											<span class="info-box-icon"><i class="fa fa-piggy-bank"></i></span>
											<span id="overall_total"><?= $overall_total.'.00'; ?></span>
											<div class="info-box-content">
												<span class="info-box-text">Total Amount Left</span><small>(Expense Subtracted)</small>
												<span class="info-box-number"><?= money($overall_total); ?></span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="view_daily_expense">
							<?php include 'includes/daily-expenses.php';?>
						</div>
						<div class="tab-pane" id="view_weekly_expense">
							<?php include 'includes/weekly-expenses.php';?>
						</div>
						<div class="tab-pane" id="view_monthly_expense">
							<?php include 'includes/monthly-expenses.php'; ?>
						</div>
						<div class="tab-pane" id="view_yearly_expense">
							<?php include 'includes/yearly-expenses.php'; ?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php include 'includes/aside.php';?>
	</div>
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
	<script type="text/javascript" src="../assets/js/feature.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#amount_used').keyup(function(e){
				var total_amount = '<?= money($overall_total);?>';
				var striped_total_amount = total_amount.slice(8);
				striped_total_amount = striped_total_amount.replace(',','');
				var amount_used = $('#amount_used').val();
				var amount_remain = parseInt(striped_total_amount) - parseInt(amount_used);
				$('.info-box-number').html('Gh¢ '+amount_remain+'.00');
				if (amount_remain < 1) {
					swal('Alert', 'You have insufficient amount in the Church Account. Please spend within the Church balance', 'error');
					return false;
				}
				if($('.info-box-number').html() == "Gh¢ NaN.00"){
					$('.info-box-number').html('<?= money($overall_total); ?>');
				}
			})
		})
</script>
</body>
</html>
<?php endif;?>