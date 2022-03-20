 <?php
 include 'includes/connect.php';
 include 'includes/sermon_counter.php';
 session_start();
 $id = $_SESSION['id'];
 $errorMsg ='';
$sermon_slug = $_GET['sermon'];

 $sql = "SELECT * FROM sermon WHERE sermon_slug = '$sermon_slug'";
 $query = mysqli_query($conn, $sql);
 if (mysqli_num_rows($query) > 0) {
   while ($row = mysqli_fetch_assoc($query)) {
    $sermon_id = $row['id'];
     $title = $row['title'];
        $bible_verse = $row['bible_verses'];
        $sermon_link = $row['sermon_link'];
        $sermon_notes = $row['sermon_notes'];
        $author = $row['author'];
        $sermon_image = $row['sermon_image'];
        $sermon_date = $row['date'];
        $sermon_slug = $row['sermon_slug'];
        $service_type = $row['service_type'];
   }
 }
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
  			<div class="container sermon_add_section">
  				<div class="row">
  					<div class="col-md-3">
  						<div class="box box-primary">
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
                  <div class="box box-primary" style="margin-top: 35%;">
                <div class="box-header with-border">
                  <h3 class="box-title">Sermon Archive</h3>

                  <div class="box-tools">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="box-body no-padding">
                  <ul class="nav nav-pills nav-stacked">
                         <?php
           $sql = "SELECT Month(date) as Month, Year(date) as Year FROM sermon GROUP BY Month(date), Year(date) ORDER BY date ASC";
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
                $sqsl = "SELECT * FROM sermon WHERE date >= '$from' AND date <= '$to' ORDER BY id DESC";
                $shit = mysqli_query($conn, $sqsl);
                $archive_counter = mysqli_num_rows($shit);
                ?>
                <?php
                echo "<li><a id='archive' href='sermon-archive.php?month=$month&year=$year'>".$monthName." <span class='label label-primary pull-right' id='archive_counter'>".$archive_counter."</span></a></li>";
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

  						<div class="col-md-9">
                <h3 align="center" style="padding-bottom: 2%;">SERMON UPDATE</h3>
  							<form class="row" method="POST" action="includes/update-sermon.php" enctype="multipart/form-data">
  								<?php if(isset($_POST['sermon_submit_btn'])): ?>
  									<p id="formError" style="margin-top: -40px !important;"><?php echo $errorMsg; ?></p>
  									<?php endif?><br>
  									<div class="col-md-6">
                      <input type="hidden" name="publisher_id" value="<?php echo $id;?>">
  										<input type="hidden" name="sermon_slug" value="<?php echo $sermon_slug; ?>">
                      <input type="hidden" name="sermon_id" value="<?php echo $sermon_id; ?>">
                      <input type="hidden" name="sermon_del_img" value="<?php echo $sermon_image; ?>">
  										<label>Sermon Title</label>
  										<div class="input-group credential_form">
  											<div class="input-group-addon credential_form">
  												<i class="fa fa-book-open"></i>
  											</div>
  											<input type="text" class="form-control" name="sermon_title" value="<?php echo $title; ?>" />
  										</div>
  									</div>
  									<div class="col-md-6">
  										<label>Preacher</label>
  										<div class="input-group credential_form">
  											<div class="input-group-addon credential_form">
  												<i class="fa fa-user-tie"></i>
  											</div>
  											<input type="text" class="form-control" name="sermon_author" value="<?php echo $author; ?>" />
  										</div>
  									</div>
  									<div class="col-md-6">
  										<label>Bible Verse(s)</label>
  										<div class="input-group credential_form">
  											<div class="input-group-addon credential_form">
  												<i class="fa fa-bible"></i>
  											</div>
  											<input type="text" class="form-control" name="bible_verse" value="<?php echo $bible_verse; ?>" />
  										</div>
  									</div>
  									<div class="col-md-6">
  										<label>Sermon Link</label>
  										<div class="input-group credential_form">
  											<div class="input-group-addon credential_form">
  												<i class="fa fa-link"></i>
  											</div>
  											<input type="text" class="form-control" name="sermon_link" value="<?php echo $sermon_link; ?>" />
  										</div>
  									</div>
  									<div class="col-md-6">
  										<label>Sermon Category</label>
  										<div class="form-group credential_form">
  											<select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="sermon_category">
  												<option selected="selected"><?php echo $service_type; ?></option>
  												<option>Evangelism Ministry</option>
  												<option>Women Ministry</option>
  												<option>Men Ministry</option>
  												<option>Children Ministry</option>
  												<option>Sunday Service</option>
  											</select>
  										</div>
  									</div>
  									<div class="col-md-6">
  										<div class="form-group">
  											<label for="exampleInputFile">Sermon Thumbnail</label>
  											<input type="file" id="exampleInputFile" name="sermon_image">

  											<p class="help-block">Image should not be more than 5mb</p>
  										</div>
  									</div>
                    <div class="col-md-6">
  <div class="form-group">
    <label for="exampleInputFile">Sermon File</label>
    <input type="file" id="exampleInputFile2" name="sermon_file">

    <p class="help-block">File should not be more than 5mb</p>
  </div>
</div>
  									<div class="col-lg-12 col-sm-12">
  										<div class="body" align="left">
  											<textarea class="summernote form-control no-resize" type="text" name="sermon_description" id="sermon_description" style="resize: none !important;"><?php echo $sermon_notes; ?>
  											</textarea>
  										</div>
  									</div>
  									<div class="col-md-12" align="center">
  										<button class="btn btn-success" type="submit" name="sermon_update_btn">Add Sermon</button>
  									</div>
  								</form>

  							</div>
  						</div>
  					</div>
  				</div>
  			</div>

  			<?php include 'includes/aside.php'; ?>
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
  	<script type="text/javascript" src="../assets/js/lightbox.min.js"></script>
  	<script type="text/javascript" src="../assets/js/summernote/dist/summernote.js"></script>
  	<script type="text/javascript">
  		$(document).ready(function() {
  			$('#summernote').summernote({
  				placeholder: "Type your blog script here",
  				height: 200
  			});
  		});

  	</script>
  	</html>
  	<?php endif;?>