<?php
session_start();
include 'includes/connect.php';
$id = $_SESSION['id'];
$errorMsg ='';
?>
 <?php if (!isset($_SESSION['id'])):?>
 	<?php  echo "<script>window.location = 'sign-in.php';</script>"; ?>
 	<?php else:?>
     <?php
$sql = "SELECT * FROM admin_profile WHERE id='$id'";
$query = mysqli_query($conn, $sql);
if (mysqli_num_rows($query) > 0) {
  while ($row = mysqli_fetch_assoc($query)) {
    $position = $row['position'];
  }
}
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
 			<link rel="stylesheet" type="text/css" href="../assets/js/summernote/dist/summernote.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
  	folder instead of downloading all of them to reduce the load. -->
  	<link rel="stylesheet" href="../assets/dist/css/skins/_all-skins.min.css">
  	<link rel="stylesheet" type="text/css" href="../assets/css/admin.css">
  	<link rel="stylesheet" type="text/css" href="../assets/css/lightbox.min.css">


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
        <div class="container" style="margin-top: 5%; width: 100%;">
          <div class="row">
            <div class="col-md-8 add_sermon_section">
              <div class="row">
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
                    $date = date("l M d Y", $timestamp);
                    $time = date("h:ia", $timestamp);
                ?>
                        <div class="col-md-6">
                            <div class="trending_post"> 
                                <a href="event-detail.php?event=<?php echo urlencode($event_id); ?>&activity=<?php echo urlencode($activity); ?>" class="post_img">
                                    <img class="img-responsive" src="<?php echo $event_picture; ?>" alt="">
                                    <span class="tag_btn"><?php echo $event_category; ?></span>
                                </a>  
                                <div class="post_content"> 
                                    <a href="event-detail.php?event=<?php echo urlencode($event_id); ?>&activity=<?php echo urlencode($activity); ?>" class="t_heding"><?php echo $activity; ?></a>

                                    <h6>
                                      <span class="fa fa-calendar-alt fa-sm"></span><?php echo $date." at ".$time; ?><span> | </span>
                                      <a href="#"><span class="fa fa-sm fa-church"></span><?php echo $venue; ?> </a>
                                       <span> | </span>
                                       <a href="#"><span class="fa fa-sm fa-tag"></span><?php echo $event_category; ?></a></h6>
                                    <div class="news-buttons">
                                      <p><button class="btn btn-sm"><a href="event-detail.php?event=<?php echo urlencode($event_id); ?>&activity=<?php echo urlencode($activity); ?>">Read More</a></button></p>
                                      <?php if($position == "Presiding Elder" || $position == "Elder" || $position == "Secretary"):?>
                                      <p><button class="btn btn-sm"><a href="edit-event.php?event=<?php echo urlencode($event_id); ?>&activity=<?php echo urlencode($activity); ?>"><span class="fa fa-redo"></span></a></button></p>
                                      
                                        <form method="POST" action="includes/delete-event.php">
                                          <input type="hidden" name="event_picture" value="<?php echo $event_picture; ?>">
                                          <input type="hidden" name="event_id" value="<?php echo $event_id; ?>">
                                       <p> <button class="btn btn-sm" name="delete_event_btn" onclick="return confirm('Are you sure you want to delete this event?. Deleted events cannot be recovered')"><span class="fa fa-trash"></span></button></p>
                                      </form>
                                      <?php endif;?>
                                    </div> 
                                </div>
                            </div>
                        </div> 
                        <?php
                      }
                    }else{
                      echo "<h3>No Event has been created yet.</h3>";
                    }
                        ?>
                      
              </div>
            </div>
             <div class="col-md-4">
             <div class="box box-primary">
                  <div class="box-header with-border">
                    <h3 class="box-title">Recent Events</h3>

                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <ul class="products-list product-list-in-box">
                      <?php
                      $event_sql = "SELECT * FROM events ORDER BY id DESC LIMIT 7";
                      $event_query = mysqli_query($conn, $event_sql);
                      if (mysqli_num_rows($event_query) > 0) {
                        while ($row = mysqli_fetch_assoc($event_query)) {
                          $event_id = $row['id'];
                          $activity = $row['activity'];
                          $start_date = $row['start_date'];
                          $end_date = $row['end_date'];
                          $venue = $row['venue'];
                          $timestamp = strtotime($start_date);
                          $day = date("l M d Y", $timestamp);
                      ?>
                      <li class="item">
                        <p><a href="event-detail.php?event=<?php echo urlencode($event_id); ?>&activity=<?php echo urlencode($activity); ?>"><?php echo $activity; ?></a></p>
                       <small style="width: 50%; float: right;"><span class="fa fa-city"></span> <?php echo $venue; ?></small>
                        <small><i class="fa fa-clock"></i> <?php echo $day; ?></small>
                      </li>
                      <?php
                    }
                  }
                      ?>
                    </ul>
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer text-center">
                    <a href="view-event.php" class="uppercase">View All Events</a>
                  </div>
                  <!-- /.box-footer -->
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
  </html>
  <?php endif;?>