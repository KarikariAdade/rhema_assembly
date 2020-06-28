<?php
include 'includes/connect.php';
session_start();
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
  	<link rel="stylesheet" type="text/css" href="../assets/css/style.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/sweetalert.css">
    <style type="text/css">
      form .col-md-6{
        padding-bottom: 4%;
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
  			<!-- Content Header (Page header) -->
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
        <div class="container" style="margin-top: 5%;width:98%;">
           <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#committee_pictures" data-toggle="tab" aria-expanded="false">Committee Pictures</a></li>
                  <li class=""><a href="#service_pictures" data-toggle="tab" aria-expanded="true">Service Pictures</a></li>
                  <li class=""><a href="#event_pictures" data-toggle="tab" aria-expanded="true">Events Pictures</a></li>
                  <li class=""><a href="#ministry_pictures" data-toggle="tab" aria-expanded="true">Ministries Pictures</a></li>
                </ul>
                <div class="tab-content" style="margin-top: 5%; padding-bottom: 5%;">
                  <div class="tab-pane active" id="committee_pictures">
          <div class="row">
              <div class="col-md-6">
                <span id="fuck"></span>
                <div class="file_drag_area">
                  Drop Committee Pictures here
                </div>
              </div>
              <?php include 'includes/picture_counters.php'; ?>
            </div>
        </div>
        <div class="tab-pane" id="service_pictures">
           <div class="row">
              <div class="col-md-6">
                <span id="fuck"></span>
                <div class="file_drag_area2">
                  Drop Service Pictures here
                </div>
              </div>
              <?php include 'includes/picture_counters.php'; ?>
            </div>
        </div>
        <div class="tab-pane" id="event_pictures">
            <div class="row">
              <div class="col-md-6">
                <span id="fuck"></span>
                <div class="file_drag_area3">
                  Drop Events Pictures here
                </div>
              </div>
              <?php include 'includes/picture_counters.php'; ?>
            </div>
        </div>
        <div class="tab-pane" id="ministry_pictures">
           <div class="row">
              <div class="col-md-6">
                <span id="fuck"></span>
                <div class="file_drag_area4">
                  Drop Ministries Pictures here
                </div>
              </div>
              <?php include 'includes/picture_counters.php'; ?>
            </div>
        </div>
      </div>
    </div>
        </div>
         </div>
      <?php include 'includes/aside.php'; ?>
    </div>
<style type="text/css">
  
</style>

  </div>
  <!-- ./wrapper -->

  <!-- jQuery 3 -->
  <script type="text/javascript" src="../assets/js/jquery-3.3.1.min.js"></script>
  <!-- <script src="../assets/bower_components/jquery/dist/jquery.min.js"></script> -->
  <!-- jQuery UI 1.11.4 -->
  <!-- <script src="../assets/bower_components/jquery-ui/jquery-ui.min.js"></script> -->
  <!-- Bootstrap 3.3.7 -->
  <script type="text/javascript" src="../assets/js/jquery-ui.min.js"></script>
  <script src="../assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

  <!-- Sparkline -->
  <script src="../assets/dist/js/all.js"></script>

  <!-- AdminLTE App -->
  <script src="../assets/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="../assets/dist/js/pages/dashboard.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../assets/dist/js/demo.js"></script>
  <script type="text/javascript" src="../assets/js/sweetalert.min.js"></script>
  <script type="text/javascript" src="includes/gallery.js"></script>
</body>
</html>
<?php endif;?>