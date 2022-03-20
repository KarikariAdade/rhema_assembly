       <?php
  include 'includes/connect.php';
  session_start();
  $id = $_SESSION['id'];
  $request_error ='';
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
  <!-- AdminLTE Skins. Choose a skin from the css/skins
  	folder instead of downloading all of them to reduce the load. -->
  	<link rel="stylesheet" href="../assets/dist/css/skins/_all-skins.min.css">
  	<link rel="stylesheet" type="text/css" href="../assets/css/admin.css">

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
        <div class="row" style="margin-top: 5%;">
          <?php 
          $elder_sql = "SELECT * FROM admin_profile WHERE position LIKE '%evang%'";
          $elder_query = mysqli_query($conn, $elder_sql);
          if (mysqli_num_rows($elder_query) > 0) {
            while ($row = mysqli_fetch_assoc($elder_query)) {
               $admin_id = $row['id'];
               $first_name = $row['first_name'];
               $last_name = $row['last_name'];
            $full_name = $row['first_name']." ".$row['last_name'];
            $email = $row['email'];
            $position = $row['position'];
            $occupation = $row['occupation'];
            $address = $row['address'];
            $status = $row['status'];
            $description = $row['description'];
            $admin_image = $row['admin_image'];
            $phone = $row['phone'];
           ?>
              <div class="col-md-4">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-blue">
              <div class="widget-user-image">
                <img class="img-circle" src="<?php echo $admin_image;?>" alt="User Avatar" style="height: 65px; width: 65px;">
              </div>
              <!-- /.widget-user-image -->
              <h3 class="widget-user-username"><a href="staff-detail.php?staff=<?php echo urlencode($admin_id);?>&slug=<?php echo urlencode($last_name);?>&user=<?php echo urlencode($first_name); ?>" style="color: #fff;"><?php echo $full_name; ?></a></h3>
              <h5 class="widget-user-desc"><?php echo $occupation; ?></h5>
            </div>
            <div class="box-footer no-padding">
              <ul class="nav nav-stacked">
                <li><a href="#">Email <span class="pull-right"><?php echo $email; ?></span></a></li>
                <li><a href="#">Address <span class="pull-right"><?php echo $address; ?></span></a></li>
                <li><a href="#">Phone <span class="pull-right"><?php echo $phone; ?></span></a></li>
                <li><a href="#">Position <span class="pull-right badge bg-aqua"><?php echo $position; ?></span></a></li>
              </ul>
            </div>
          </div>
          <!-- /.widget-user -->
            </div>
            <?php
          }
        }else{
          echo "<h3>There are no data for Ministry Leaders yet.</h3>";
        }
            ?>
            
          </div>
         </div>
        <?php include 'includes/aside.php'; ?>
      </div>


    </div>
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
  </body>
  </html>
  <?php endif;?>