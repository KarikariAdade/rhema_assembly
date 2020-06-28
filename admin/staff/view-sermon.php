<?php
session_start();
include 'includes/connect.php';
include 'includes/sermon_counter.php';
?>
<?php if (!isset($_SESSION['id'])):?>
    <?php  echo "<script>window.location = 'sign-in.php';</script>"; ?>
    <?php else:?>
 <?php
 if (isset($_GET['sermon'])) {
  $sermon = $_GET['sermon'];
      $current_sql = "SELECT * FROM sermon WHERE sermon_slug = '$sermon'";
    $current_query = mysqli_query($conn, $current_sql);
    if (mysqli_num_rows($current_query) > 0) {
      while ($row = mysqli_fetch_assoc($current_query)) {
        $sermon_id = $row['id'];
        $title = $row['title'];
        $bible_verse = $row['bible_verses'];
        $sermon_link = $row['sermon_link'];
        $sermon_notes = $row['sermon_notes'];
        $author = $row['author'];
        $sermon_image = $row['sermon_image'];
        $sermon_date = $row['date'];
        $service_type = $row['service_type'];
        $sermon_slug = $row['sermon_slug'];
        $sermon_file = $row['sermon_file'];
 }
}
}else{
  echo "<script>window.location = 'view-sermons.php';</script>";
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
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
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
    			<div class="col-md-8">

    				<div class="current_series_desc">
				<h2><a href="view-sermon.php?sermon=<?php echo urlencode($sermon_slug); ?>">Title: <?php echo $title; ?> (<?php echo $bible_verse; ?>)</a></h2><br />
				<div class="row" style="padding: 20px 0; font-size: 15px; font-weight: lighter;">
          <figure id="sermon_view_img">
            <img src="<?php echo $sermon_image; ?>" class="img-responsive">
          </figure>
					<div class="col-md-4">
						<p><strong><i class="fa fa-lg fa-user-tie"></i> <?php echo $author; ?></strong></p>
					</div>
					<div class="col-md-4">
						<p><strong><i class="fa fa-lg fa-bible"></i> <?php echo $service_type; ?></strong></p>
					</div>
					<div class="col-md-4">
						<p><strong><i class="fa fa-lg fa-clock"></i> <?php echo time_ago($sermon_date); ?></strong></p>
					</div>
				</div>
			</div>
			<div class="current_series_video">
				<?php echo $sermon_notes; ?>
        <p><button class="btn btn-primary btn-sm"><a style="color: #fff;" href="download.php?id=<?php echo urlencode($sermon_id); ?>">Download Sermon File</a></button></p>
			</div>
    			</div>
    			<div class="col-md-3">
    				<div class="box box-solid">
  							<div class="box-header with-border">
  								<h3 class="box-title">Sermon Categories</h3>

  								<div class="box-tools">
  									<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
  									</button>
  								</div>
  							</div>
  							<div class="box-body no-padding">
                  <ul class="nav nav-pills nav-stacked">
                    <li><a href="sunday-sermon.php"><i class="fa fa-church"></i> Sunday Service
                      <span class="label label-primary pull-right"><?php echo $sunday_counter; ?></span></a></li>
                      <li><a href="youth-sermon.php"><i class="fa fa-user"></i> Youth Ministry <span class="label label-primary pull-right"><?php echo $youth_counter; ?></span></a></li>
                      <li><a href="evangelism-sermon.php"><i class="fa fa-bible"></i> Evangelism Ministry <span class="label label-primary pull-right"><?php echo $evangelism_counter; ?></span></a></li>
                      <li><a href="women-sermon.php"><i class="fa fa-female"></i> Women's Ministry <span class="label label-primary pull-right"><?php echo $women_counter; ?></span></a>
                      </li>
                      <li><a href="men-sermon.php"><i class="fa fa-male"></i> Men's Ministry <span class="label label-primary pull-right"><?php echo $men_counter; ?></span></a></li>
                      <li><a href="children-sermon.php"><i class="fa fa-child"></i> Children's Ministry <span class="label label-primary pull-right"><?php echo $children_counter; ?></span></a></li>
                    </ul>
                  </div>
  								<!-- /.box-body -->
  							</div>
  							<div class="box box-primary">
  								<div class="box-header with-border">
  									<h3 class="box-title">Recent Sermons</h3>

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
                      $sermon_sql = "SELECT * FROM sermon ORDER BY id DESC LIMIT 5";
                      $sermon_query = mysqli_query($conn, $sermon_sql);
                      if (mysqli_num_rows($sermon_query) > 0) {
                        while ($row = mysqli_fetch_assoc($sermon_query)) {
                          $title = $row['title'];
                          $author = $row['author'];
                          $sermon_date = $row['date'];
                          $sermon_slug = $row['sermon_slug'];
                      ?>
                      <li class="item">
                        <p><a href="view-sermon.php?sermon=<?php echo urlencode($sermon_slug); ?>"><?php echo $title; ?></a></p>
                        <small style="float: right;">By: <?php echo $author; ?></small><small><i class="fa fa-clock"></i> <?php echo time_ago($sermon_date); ?></small>
                      </li>
                      <?php
                    }
                  }
                      ?>
                    </ul>
                  </div>
  								<!-- /.box-body -->
  								<div class="box-footer text-center">
  									<a href="javascript:void(0)" class="uppercase">View All Sermons</a>
  								</div>
  								<!-- /.box-footer -->
  							</div>
    			</div>
    		</div>
    	</div>
   </section>
 <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
<?php include 'includes/aside.php'; ?>
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

<?php endif; ?>