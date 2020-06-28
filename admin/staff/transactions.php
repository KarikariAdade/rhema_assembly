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
		<title>Rhema Assembly | Transactions</title>
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
  <!-- AdminLTE Skins. Choose a skin from the css/skins
  	folder instead of downloading all of them to reduce the load. -->
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
						<li class="active"><a href="#pending_transaction" data-toggle="tab" aria-expanded="false">Pending Transactions</a></li>
						<li class=""><a href="#approved_transaction" data-toggle="tab" aria-expanded="true">Approved Transactions</a></li>
						<li class=""><a href="#tithes" data-toggle="tab" aria-expanded="true">Tithes</a></li>
						<li class=""><a href="#donations" data-toggle="tab" aria-expanded="true">Donations</a></li>
						<li class=""><a href="#offering" data-toggle="tab" aria-expanded="true">Offering</a></li>
						<li class=""><a href="#welfare" data-toggle="tab" aria-expanded="true">Welfare</a></li>
						
					</ul>
					<div class="tab-content">
						<?php include 'includes/transaction-tabs.php';?>
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
	<script type="text/javascript">
		$('#print').click(function (){
			window.print();
		});

		function transaction_approval(transaction_id){
			swal({
				title: "Transaction ID!",
				text: "Enter transaction ID used given to member:",
				type: "input",
				showCancelButton: true,
				closeOnConfirm: false,
				inputPlaceholder: "Transaction ID"
			}, function (inputValue) {
				if (inputValue === false) return false;
				if (inputValue !== transaction_id) {
					swal.showInputError('Invalid Transaction id');
					return false;
				}else{
					$.ajax({
						url: 'includes/transaction-approval.php',
						method: 'POST',
						data: {transaction_id: transaction_id},
						success:function(data){
							if (data == "Transaction successfully Approved. Page will refresh"){
								swal("Success!", ""+data, 'success');
								setInterval(reload, 3000);
							}else{
								return false;
							}
						}
					});	
				}
			});
		}
		function reload(){
			window.location.reload();
		}
		function delete_transaction(transaction_id){
			swal({
				title: "Are you sure?",
				text: "Deleting a Pending Transaction may affect Financial Statistics. Continue Deletion?",
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
						url: 'includes/delete-pending-transaction.php',
						method: 'POST',
						data: {transaction_id: transaction_id},
						success:function(data){
							if (data == "Transaction deleted successfully"){
								swal("Deleted!", ""+data+". Page will refresh", "success");
								setInterval(reload,3000);
							}
							
						}
					})
					
				}
			});
		}
	</script>
</body>
</html>
<?php endif;?>