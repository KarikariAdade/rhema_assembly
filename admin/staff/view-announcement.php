<?php
session_start();
include 'includes/connect.php';
include 'includes/announcement-counter.php';
?>
<?php if (!isset($_SESSION['id'])):?>
    <?php  echo "<script>window.location = 'sign-in.php';</script>"; ?>
    <?php else:?>
    	<?php
    	$announcement_slug = $_GET['announcement'];
    	if (!isset($announcement_slug)) {
    		echo "<script>window.location = 'view-announcements.php';</script>";
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
     <!-- Main content -->
    <section class="content">
    	<div class="container" style="margin-top: 5%;">
    		<div class="row">
    			<div class="col-md-8" style="background-color: #fff; padding: 10px;padding-top: 4%;">
    				<?php
    				$sql = "SELECT * FROM announcement WHERE announcement_slug = '$announcement_slug'";
    				$query = mysqli_query($conn, $sql);
    				if (mysqli_num_rows($query) > 0) {
    					while ($row = mysqli_fetch_assoc($query)) {
    						$id = $row['id'];
  									$publisher_id = $row['publisher_id'];
  									$publisher_name = $row['publisher_name'];
  									$announcement_slug = $row['announcement_slug'];
  									$announcement_title = $row['announcement_title'];
  									$category = $row['category'];
  									$description = $row['description'];
  									$date = $row['date'];
  									$image = $row['image'];
  									$timestamp = strtotime($date);
  									$day = date("l d M, Y", $timestamp);
                    $time = date("h:ia", $timestamp);
    					}
    				}
    				?>
    			<div class="full_news">
                <span id="full_news_span"><?php echo $category; ?></span>
                <div class="full_news_header">
                  <h2><?php echo $announcement_title; ?></h2>
                  <div class="news_header_stats">
                    <p><span class="fa fa-user-tie"></span> <?php echo $publisher_name; ?></p>
                    <p><span class="fa fa-calendar-alt"></span> <?php echo $day; ?></p>
                    <p><span class="fa fa-clock"></span> <?php echo $time; ?></p>
                  </div>
                </div>
                <img src="<?php echo $image; ?>" class="img-responsive">
                <div class="news_desc">
                  <?php echo $description; ?>
                </div>
              </div>
            <div class="row prevNext" align="center">
              <?php
              $previous_sql = "SELECT * FROM announcement WHERE id < '$id' ORDER BY id DESC LIMIT 1";   
         $previous_result = mysqli_query($conn, $previous_sql);
         $shit = mysqli_num_rows($previous_result);
         if ($shit > 0) {
             while ($row = mysqli_fetch_assoc($previous_result)) {
                $previous_announcement_id =$row['id'];
                $previous_announcement_slug = $row['announcement_slug'];
                // $previous_announcement = $row['post_title'];
                ?>
              <div class="col-md-6">
                <button class="btn btn-primary"><a href="view-announcement.php?announcement=<?php echo urlencode($previous_announcement_slug); ?>" style="color: #fff;"><span class="fa fa-arrow-alt-circle-left icon"></span> Previous Announcement</a></button>
              </div>
              <?php
            }
          }
              ?>
                                 <?php
     $sql = "SELECT * FROM announcement WHERE id > '$id' ORDER BY id  ASC LIMIT 1";    
     $sql_result = mysqli_query($conn, $sql);
     $shit = mysqli_num_rows($sql_result);
     if ($shit > 0) {
         while ($row = mysqli_fetch_assoc($sql_result)) {
            $next_announcement_id = $row['id'];
            $next_announcement_slug = $row['announcement_slug'];
            // $next_announcement = $row['post_title'];

            ?>
              <div class="col-md-6">
                 <button class="btn btn-primary"><a href="view-announcement.php?announcement=<?php echo urlencode($next_announcement_slug); ?>" style="color: #fff;">Next Announcement <span class="fa fa-arrow-alt-circle-right icon"></span></a></button>
              </div>
              <?php
            }
          }
              ?>
            </div>
    			</div>
    			<div class="col-md-3">
    					<div class="box box-solid">
  							<div class="box-header with-border">
  								<h3 class="box-title">Announcement Categories</h3>

  								<div class="box-tools">
  									<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
  									</button>
  								</div>
  							</div>
  							<div class="box-body no-padding">
                  <ul class="nav nav-pills nav-stacked">
                    <li><a href="general-announcement.php"><i class="fa fa-church"></i> General
                      <span class="label label-primary pull-right"><?php echo $sunday_counter; ?></span></a></li>
                      <li><a href="youth-announcement.php"><i class="fa fa-user"></i> Youth Ministry <span class="label label-primary pull-right"><?php echo $youth_counter; ?></span></a></li>
                      <li><a href="evangelism-announcement.php"><i class="fa fa-bible"></i> Evangelism Ministry <span class="label label-primary pull-right"><?php echo $evangelism_counter; ?></span></a></li>
                      <li><a href="women-announcement.php"><i class="fa fa-female"></i> Women's Ministry <span class="label label-primary pull-right"><?php echo $women_counter; ?></span></a>
                      </li>
                      <li><a href="men-announcement.php"><i class="fa fa-male"></i> Men's Ministry <span class="label label-primary pull-right"><?php echo $men_counter; ?></span></a></li>
                      <li><a href="children-announcement.php"><i class="fa fa-child"></i> Children's Ministry <span class="label label-primary pull-right"><?php echo $children_counter; ?></span></a></li>
                    </ul>
                  </div>
  								<!-- /.box-body -->
  							</div>
  							<div class="box box-primary">
  								<div class="box-header with-border">
  									<h3 class="box-title">Recent Announcements</h3>

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
  										$sermon_sql = "SELECT * FROM announcement ORDER BY id DESC LIMIT 5";
  										$sermon_query = mysqli_query($conn, $sermon_sql);
  										if (mysqli_num_rows($sermon_query) > 0) {
  											while ($row = mysqli_fetch_assoc($sermon_query)) {
  												$publisher_name = $row['publisher_name'];
  									$announcement_slug = $row['announcement_slug'];
  									$announcement_title = $row['announcement_title'];
  									$category = $row['category'];
  									$description = $row['description'];
  									$date = $row['date'];
  										?>
  										<li class="item">
  											<p><a href="view-announcement.php?announcement=<?php echo urlencode($announcement_slug); ?>"><?php echo $announcement_title; ?></a></p>
  											<small style="float: right;">By: <?php echo $publisher_name; ?></small><small><i class="fa fa-clock"></i> <?php echo time_ago($date); ?></small>
  										</li>
  										<?php
  									}
  								}
  										?>
  									</ul>
  								</div>
  								<!-- /.box-body -->
  								<div class="box-footer text-center">
  									<a href="view-announcements.php" class="uppercase">View All Announcements</a>
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