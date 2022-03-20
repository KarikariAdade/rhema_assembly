<?php
session_start();
include 'includes/connect.php';
include 'includes/sermon_counter.php';
include 'includes/edit-theme-validation.php';
?>
<?php if (!isset($_SESSION['id'])):?>
	<?php  echo "<script>window.location = 'sign-in.php';</script>"; ?>
<?php else:?>
	<?php
	if (!isset($_GET['year']) || !isset($_GET['id'])) {
		echo "<script>window.location = 'theme.php';</script>";
	}
	$year = $_GET['year'];
	$theme_id = $_GET['id'];
	$fetch_theme = $conn->query("SELECT * FROM themes WHERE theme_year = '$year' AND id = '$theme_id'");
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Rhema Assembly | Admin Dashboard</title>
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
		<link rel="stylesheet" type="text/css" href="../css/style.css">


		<!-- Google Font -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	</head>
	<body class="hold-transition skin-blue sidebar-mini">
		<div class="wrapper">
			<?php include 'includes/sidebar.php'; ?>

			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1>
						Dashboard
						<small>Control panel</small>
					</h1>
					<ol class="breadcrumb">
						<li><a href="#"><i class="fa fa-home"></i> Home</a></li>
						<li class="active">Dashboard</li>
					</ol>
				</section>
				<!-- Main content -->
				<section class="content">
					<div class="container">
						<div class="row">
							<?php 
							while ($row = mysqli_fetch_assoc($fetch_theme))
							{
								$theme_pic = explode('/', $row['theme_picture']);
								$theme_pic = $theme_pic[5].'/'.$theme_pic[6].'/'.$theme_pic[7].'/'.$theme_pic[8];
								?>
								<div class="col-md-10">
									<div class="current_series_desc">
										<h2 style="padding-bottom: 3%;"><?= $row['theme_title'] .' ('. $row['bible_verse']. ')' ;?></h2>
										<figure id="sermon_view_img">
											<img src="../<?= $theme_pic;?>" class="img-fluid">
										</figure>
										<div class="current_series_video">
											<?= $row['theme_description'];?>
										</div>
									</div>
								</div>
								<?php
							}
							?>
						</div>
					</div>
				</section>
			</div>
			<?php include 'includes/aside.php';?>
		</div>

		<!-- jQuery 3 -->
		<script src="../assets/bower_components/jquery/dist/jquery.min.js"></script>
		<!-- jQuery UI 1.11.4 -->
		<script src="../assets/bower_components/jquery-ui/jquery-ui.min.js"></script>
		<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
		<script>
			$.widget.bridge('uibutton', $.ui.button);
		</script>
		<!-- Bootstrap 3.3.7 -->
		<script src="../assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

		<!-- Sparkline -->
		<script src="../assets/dist/js/all.js"></script>

		<!-- AdminLTE App -->
		<script src="../assets/dist/js/adminlte.min.js"></script>
		<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
		<script src="../assets/dist/js/pages/dashboard.js"></script>
		<!-- AdminLTE for demo purposes -->
		<script src="../assets/dist/js/demo.js"></script>
	</body>
	</html>
<?php endif;?>