 <?php
 session_start();
 include 'includes/connect.php';
 include 'includes/announcement-counter.php';
 $id = $_SESSION['id'];

 // Announcement slug
 function slug($text){
  $text = str_replace(' ', '-', $text);
  $text = preg_replace('/[^A-Za-z\-]/', '', $text);
  $text = preg_replace('/-+/', '-', $text);
  $text = strtolower($text);
  return $text;
}

// Fetch announcement publisher using session id
$fetch_publisher = $conn->query("SELECT * FROM admin_profile WHERE id = '$id'");
$row = mysqli_fetch_assoc($fetch_publisher);
$publisher_name = $row['first_name'].' '.$row['last_name'];
$errorMsg ='';
?>
<?php if (!isset($_SESSION['id'])):?>
  <?php  echo "<script>window.location = 'sign-in.php';</script>"; ?>
<?php else:?>

  <?php

  // ANNOUNCEMENT VALIDATION
  $errorMsg = '';
  if (isset($_POST['announcement_submit_btn'])) {
    $publisher_id = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['publisher_id']));
    $announcement_title = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['announcement_title']));
    $announcement_category = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['announcement_category']));
    $announcement_description = mysqli_real_escape_string($conn, $_POST['announcement_description']);
    $announcement_slug = slug($announcement_title);

    if (!empty($announcement_title) && !empty($announcement_category) && !empty($announcement_description)) {
      $file_name = $_FILES['announcement_image']['name'];
      $file_size = $_FILES['announcement_image']['size'];
      $file_tmp_name = $_FILES['announcement_image']['tmp_name'];
      $file_type = $_FILES['announcement_image']['type'];
      $target_dir = "../assets/uploads/announcement/";
      $target_file = $target_dir.basename($file_name);
      $uploadOk = 1;
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // $errorMsg = $target_file;
      if ($file_size > 5000000) {
        $errorMsg = "Image should not be more than 5mb";
        $uploadOk = 0;
      }elseif ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        $errorMsg = "Sorry, only image files are allowed";
        $uploadOk = 0;
      }elseif ($uploadOk == 0) {
        $errorMsg = "Sorry, your file could not be uploaded. Try again.";
      }else{
        if (move_uploaded_file($file_tmp_name, $target_file)) {
          $image_url = $_SERVER['HTTP_REFERER'];
          $seg = explode("/", $image_url);
          $path = $seg[0]."/".$seg[1]."/".$seg[2]."/".$seg[3]."/".$seg[4];
          $full_image_path = $path."/"."assets/uploads/announcement/".$file_name;
          $sql = "INSERT INTO announcement (publisher_id, publisher_name, announcement_slug, announcement_title, category, description, date, image) VALUES ('$publisher_id', '$publisher_name', '$announcement_slug', '$announcement_title', '$announcement_category', '$announcement_description', now(), '$full_image_path')";
          $query = mysqli_query($conn, $sql);
          if ($query) {
            $errorMsg = "Announcement made successfully";
          }else{
            $errorMsg = "Announcement could not be added".mysqli_error($conn);
          }
        }
      }
    }else{
      $errorMsg = "Fill all fields before submitting";
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
  			<div class="container sermon_add_section">
  				<div class="row">
  					<div class="col-md-3">
  						<div class="box box-primary">
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

            <div class="col-md-9">
             <form class="row" method="POST" action="add-announcement.php" enctype="multipart/form-data">
              <?php if(isset($_POST['announcement_submit_btn'])): ?>
               <p id="formError" style="margin-top: -40px !important;"><?php echo $errorMsg; ?></p>
             <?php endif?><br>
             <div class="col-md-6">
              <input type="hidden" name="publisher_id" value="<?php echo $id; ?>">
              <label>Announcement Title</label>
              <div class="input-group credential_form">
               <div class="input-group-addon credential_form">
                <i class="fa fa-book-open"></i>
              </div>
              <input type="text" class="form-control" name="announcement_title" />
            </div>
          </div>
          <div class="col-md-6">
            <label>Announcement Category</label>
            <div class="form-group credential_form">
             <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="announcement_category">
              <option selected="selected">General Announcement</option>
              <option>Evangelism Ministry</option>
              <option>Women Ministry</option>
              <option>Men Ministry</option>
              <option>Children Ministry</option>
              <option>Youth Ministry</option>
            </select>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
           <label for="exampleInputFile">Announcement Thumbnail</label>
           <input type="file" id="exampleInputFile" name="announcement_image">

           <p class="help-block">Image should not be more than 5mb</p>
         </div>
       </div>
       <div class="col-lg-12 col-sm-12">
        <div class="body" align="left">
         <textarea class="summernote form-control no-resize" type="text" name="announcement_description" id="announcement_description" placeholder="Type your blog script here" style="resize: none !important;">
         </textarea>
       </div>
     </div>
     <div class="col-md-12" align="center">
      <button class="btn btn-success" type="submit" name="announcement_submit_btn">Add Announcement</button>
    </div>
  </form>

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
<script type="text/javascript" src="../assets/js/lightbox.min.js"></script>
<script type="text/javascript" src="../assets/js/summernote/dist/summernote.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
   $('#summernote').summernote({
    placeholder: "Type your blog script here",
    height: 200
  });
   var formError = "<?= $errorMsg;?>";
   if (formError == "Announcement made successfully") {
    $('#formError').css('color','green');
   }else{
    $('#formError').css('color','red');
   }
 });

</script>
</html>
<?php endif;?>