<?php
include 'includes/connect.php';
session_start();
$id = $_SESSION['id'];
$errorMsg ='';
?>
 <?php if (!isset($_SESSION['id'])):?>
 	<?php  echo "<script>window.location = 'sign-in.php';</script>"; ?>
 	<?php else:?>


 		<!DOCTYPE html>
 		<html>
 		<head>
 			<meta charset="utf-8">
 			<meta http-equiv="X-UA-Compatible" content="IE=edge">
 			<title>Rhema Assembly | Events Calendar</title>
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
 			<link rel="stylesheet" type="text/css" href="../assets/js/summernote/dist/summernote.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
  	folder instead of downloading all of them to reduce the load. -->
  	<link rel="stylesheet" href="../assets/dist/css/skins/_all-skins.min.css">
  	<link rel="stylesheet" type="text/css" href="../assets/css/admin.css">
    <link rel="stylesheet" href="../assets/js/datatable/dataTables.bootstrap4.min.css">


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
         <div class="container-fluid" style="margin-top: 5%;">
         <div class="row clearfix">
          <div class="col-lg-12" style="background-color: #fff;padding: 4% 10px;">
            <div class="card">
              <div class="body">
                <div class="table-responsive">
                  <table class="table table-bordered table-striped table-hover dataTable js-exportable" style="margin-top: 2%!important;">
                    <thead>
                      <tr>
                       <th>Date</th>
                       <!-- <th>End Date</th> -->
                       <th>Event / Activity</th>
                       <th>Event Category</th>
                       <th>Venue</th>
                       <th>Remarks</th>
                     </tr>
                   </thead>
                 <tbody>
                  <?php
                  $event_sql = "SELECT * FROM events ORDER BY id DESC";
                $event_query = mysqli_query($conn, $event_sql);
                if (mysqli_num_rows($event_query) > 0) {
                  while ($row = mysqli_fetch_assoc($event_query)) {
                    $event_id = $row['id'];
                    $start_date = $row['start_date'];
                    $activity = $row['activity'];
                    $end_date = $row['end_date'];
                    $venue = $row['venue'];
                    $event_category = $row['event_category'];
                    $event_picture = $row['event_picture'];
                    $remarks = $row['remarks'];
                    $timestamp = strtotime($start_date);
                    $date = date("M d Y", $timestamp);
                    $time = date("h:ia", $timestamp);
                  ?>
                  <tr>
                    <td><?php echo $date." - ".date("M d Y",strtotime($end_date));?></td>
                    <td><a href="event-detail.php?event=<?php echo urlencode($event_id); ?>&activity=<?php echo urlencode($activity); ?>"><?php echo $activity; ?></a></td>
                    <td><?php echo $event_category; ?></td>
                    <td><?php echo $venue; ?></td>
                    <td><?php echo $remarks; ?></td>
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
 </div>
        <?php include 'includes/aside.php'; ?>
      </div>


    </div>
  </body>
  <!-- ./wrapper -->

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
  <script src="../assets/js/datatablescripts.bundle.js"></script>
<script src="../assets/js/datatable/buttons/dataTables.buttons.min.js"></script>
<script src="../assets/js/datatable/buttons/buttons.bootstrap4.min.js"></script>
<script src="../assets/js/datatable/buttons/buttons.colVis.min.js"></script>
<script src="../assets/js/datatable/buttons/buttons.flash.min.js"></script>
<script src="../assets/js/datatable/buttons/buttons.html5.min.js"></script>
<script src="../assets/js/datatable/buttons/buttons.print.min.js"></script>

<script src="../assets/js/datatable/buttons/jquery-datatable.js"></script>
  </html>
  <?php endif;?>