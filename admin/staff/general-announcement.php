 <?php
 include 'includes/connect.php';
 include 'includes/announcement-counter.php';
 session_start();
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
  			<div class="container" style="margin-top: 5%;">
  				<div class="row">
  					<div class="col-md-8 add_sermon_section">
  						<div class="row">
  							<?php
                  $record_per_page = 14;
          $page = '';
          if (isset($_GET['page'])) {
            $page = $_GET['page'];
          }else{
            $page = 1;
          }
          $start_from = ($page - 1) * $record_per_page;
  							$sql = "SELECT * FROM announcement WHERE category = 'General Announcement' ORDER BY id DESC LIMIT $start_from, $record_per_page";
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
                    $date = date("l M d Y", $timestamp);
                    $time = date("h:ia", $timestamp);
      
                    ?>
                    <div class="col-md-6">
                        <div class="trending_post"> 
                                <a href="view-announcement.php?announcement=<?php echo urlencode($announcement_slug); ?>" class="post_img">
                                    <img class="img-responsive" src="<?php echo $image; ?>" alt="">
                                    <span class="tag_btn"><?php echo $category; ?></span>
                                </a>  
                                <div class="post_content"> 
                                    <a href="view-announcement.php?announcement=<?php echo urlencode($announcement_slug); ?>" class="t_heding"><?php echo $announcement_title; ?></a>
                                    <h6><span class="fa fa-calendar-alt fa-sm"></span><?php echo $date ." at ". $time; ?> <span> | </span><br><a href=""><span class="fa fa-sm fa-user"></span><?php echo $publisher_name; ?></a> <span> | </span><a href=""><span class="fa fa-sm fa-tag"></span><?php echo $category; ?></a></h6>
                                    <div class="news-buttons">
                                      <p><button class="btn btn-sm"><a href="view-announcement.php?announcement=<?php echo urlencode($announcement_slug); ?>">Read More</a></button></p>
                                      <?php if($position == "Presiding Elder" || $position == "Elder" || $position == "Secretary"):?>
                                      <p><button class="btn btn-sm"><a href="update-announcement.php?announcement=<?php echo urlencode($announcement_slug); ?>"><span class="fa fa-redo"></span></a></button></p>
                                      
                                        <form method="POST" action="includes/delete-announcement.php">
                                <input type="hidden" name="del_img" value="<?php echo $image; ?>">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                       <button class="btn btn-sm btn-danger" type="submit" name="del_announcement" onclick="return confirm('Are you sure you want to delete this announcement?. Deleted info cannot be retrieved.')"><span class="fa fa-trash"></span></button>
                                      </form>
                                      <?php endif;?>
                                    </div> 
                                </div>
                            </div>
                    </div>
  									<?php
  								}
  							}else{
                  echo "<h3>There are no <strong>General Announcements</strong> yet.</h3>";
                }
  							?>
                 <div style="margin-top: 5%;">
      <p align="center">
                 <?php if(mysqli_num_rows($query) > 1): ?>
      <?php
      $page_query = "SELECT * FROM announcement WHERE category = 'General' ORDER BY id DESC";
                $page_query_sql = mysqli_query($conn, $page_query);
                $total_records = mysqli_num_rows($page_query_sql);
                $total_pages = ceil($total_records / $record_per_page);

                for ($i=1; $i<=$total_pages; $i++) { 
                  echo "<a class='pagination' href='general-announcement.php?page=".$i."'>".$i."</a>";
                }
                ?>
              <?php endif;?>
            </p>
          </div>
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
                    <li class="active"><a href="general-announcement.php"><i class="fa fa-church"></i> General Announcements
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
                            $id = $row['id'];
                    $publisher_name = $row['publisher_name'];
                    $announcement_slug = $row['announcement_slug'];
                    $announcement_title = $row['announcement_title'];
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
                     <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Announcement Archive</h3>

                  <div class="box-tools">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="box-body no-padding">
                  <ul class="nav nav-pills nav-stacked">
                         <?php
           $sql = "SELECT Month(date) as Month, Year(date) as Year FROM announcement GROUP BY Month(date), Year(date) ORDER BY date ASC";
           $query = mysqli_query($conn, $sql);
           if (mysqli_num_rows($query) > 0) {
    // $archive_counter = mysqli_num_rows($query);
            while ($row = mysqli_fetch_assoc($query)) {
                $monthName = date("F", mktime(0, 0, 0, $row['Month'], 10));
                $month = $row['Month'];
                $year = $row['Year'];

  // FETCH NUMBER OF POSTS UNDER ARCHIVE
                $from = date('Y-m-01 00:00:00', strtotime("$year-$month"));
                $to = date('Y-m-31 23:59:59', strtotime("$year-$month"));
                $sqsl = "SELECT * FROM announcement WHERE date >= '$from' AND date <= '$to' ORDER BY id DESC";
                $shit = mysqli_query($conn, $sqsl);
                $archive_counter = mysqli_num_rows($shit);
                ?>
                <?php
                echo "<li><a id='archive' href='announcement-archive.php?month=$month&year=$year'>".$monthName." <span class='label label-primary pull-right' id='archive_counter'>".$archive_counter."</span></a></li>";
                ?>
                <?php
            }
        }
      ?>
                    </ul>
                  </div>
                  <!-- /.box-body -->
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