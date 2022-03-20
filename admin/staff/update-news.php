 <?php
 include 'includes/connect.php';
 include 'includes/announcement-counter.php';
 session_start();
 $id = $_SESSION['id'];
 $errorMsg ='';
   function slug($text){
  $text = str_replace(' ', '-', $text);
  $text = preg_replace('/[^A-Za-z\-]/', '', $text);
  $text = preg_replace('/-+/', '-', $text);
  $text = strtolower($text);
  return $text;
}
 ?>
 <?php if (!isset($_SESSION['id'])):?>
  <?php  echo "<script>window.location = 'sign-in.php';</script>"; ?>
  <?php else:?> 	
   <?php
$news_get = $_GET['news'];
if (!isset($_GET['news'])) {
  $errorMsg = "news get cannot be found";
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
  						<div class="box box-solid">
  							<div class="box-header with-border">
  								<h3 class="box-title">News Categories</h3>

  								<div class="box-tools">
  									<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
  									</button>
  								</div>
  							</div>
  							<div class="box-body no-padding">
                  <ul class="nav nav-pills nav-stacked">
                    <li><a href="general-news.php"><i class="fa fa-church"></i> General News
                      <span class="label label-primary pull-right"><?php echo $sunday_counter; ?></span></a></li>
                      <li><a href="pensa-news.php"><i class="fa fa-user"></i> PENSA <span class="label label-primary pull-right"><?php echo $youth_counter; ?></span></a></li>
                      <li><a href="news-article.php"><i class="fa fa-bible"></i> Article <span class="label label-primary pull-right"><?php echo $evangelism_counter; ?></span></a></li>
                      <li><a href="church-news.php"><i class="fa fa-female"></i> Church News <span class="label label-primary pull-right"><?php echo $women_counter; ?></span></a>
                      </li>
                      <li class="active"><a href="other-news.php"><i class="fa fa-male"></i> Other News <span class="label label-primary pull-right"><?php echo $men_counter; ?></span></a></li>
                    </ul>
                  </div>
  								<!-- /.box-body -->
  							</div>
  						  <div class="box box-primary">
                  <div class="box-header with-border">
                    <h3 class="box-title">Recent News</h3>

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
       
                      $sermon_sql = "SELECT * FROM news ORDER BY id DESC LIMIT 5";
                      $sermon_query = mysqli_query($conn, $sermon_sql);
                      if (mysqli_num_rows($sermon_query) > 0) {
                        while ($row = mysqli_fetch_assoc($sermon_query)) {
                          $recent_news_author = $row['news_author'];
                    $recent_news_slug = $row['news_slug'];
                    $recent_news_title = $row['news_title'];
                    $recent_news_category = $row['news_category'];
                    $recent_news_description = $row['news_description'];
                    $recent_news_date = $row['news_date'];
                      ?>
                      <li class="item">
                        <p><a href="news-detail.php?news=<?php echo urlencode($recent_news_slug); ?>"><?php echo $recent_news_title; ?></a></p>
                        <small style="float: right;">By: <?php echo $recent_news_author; ?></small><small><i class="fa fa-clock"></i> <?php echo time_ago($recent_news_date); ?></small>
                      </li>
                      <?php
                    }
                  }
                      ?>
                    </ul>
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer text-center">
                    <a href="view-announcements.php" class="uppercase">View All News</a>
                  </div>
                  <!-- /.box-footer -->
                </div>
                  <div class="box box-solid" style="margin-top: 35%;">
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
           $sql = "SELECT Month(news_date) as Month, Year(news_date) as Year FROM news GROUP BY Month(news_date), Year(news_date) ORDER BY news_date ASC";
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
                $sqsl = "SELECT * FROM news WHERE news_date >= '$from' AND news_date <= '$to' ORDER BY id DESC";
                $shit = mysqli_query($conn, $sqsl);
                $archive_counter = mysqli_num_rows($shit);
                ?>
                <?php
                echo "<li><a id='archive' href='news-archive.php?month=$month&year=$year'>".$monthName." <span class='label label-primary pull-right' id='archive_counter'>".$archive_counter."</span></a></li>";
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
<?php
   $sql = "SELECT * FROM news WHERE news_slug = '$news_get'";
   $query = mysqli_query($conn, $sql);
   if (mysqli_num_rows($query) > 0) {
     while ($row = mysqli_fetch_assoc($query)) {
       $news_get_id = $row['id'];
       $news_get_title = $row['news_title'];
       $news_get_slug = $row['news_slug'];
       $news_get_category = $row['news_category'];
       $news_get_description = $row['news_description'];
       $news_get_image = $row['news_image'];
       $news_get_author = $row['news_author'];
     }
   }
// include 'connect.php';
if (isset($_POST['news_update_btn'])) {
  $errorMsg = false;
  $news_id = mysqli_real_escape_string($conn, $_POST['news_id']);
  $image = mysqli_real_escape_string($conn, $_POST['image']);
  $news_title = mysqli_real_escape_string($conn, $_POST['news_title']);
  $news_slug = mysqli_real_escape_string($conn, $_POST['news_slug']);
  $news_author = mysqli_real_escape_string($conn, $_POST['news_author']);
  $news_category = mysqli_real_escape_string($conn, $_POST['news_category']);
  $news_description = mysqli_real_escape_string($conn, $_POST['news_description']);
   $news_slug = slug($news_title);

  if (!empty($news_title) && !empty($news_author) && !empty($news_category) && !empty($news_description)) {
    $del_seg = explode("/", $image);
    $img = $del_seg[8];
    $errorMsg = $img;
    unlink ("../assets/uploads/news/".$img);
     $file_name = $_FILES['news_image']['name'];
        $file_size = $_FILES['news_image']['size'];
        $file_tmp_name = $_FILES['news_image']['tmp_name'];
        $file_type = $_FILES['news_image']['type'];
        $target_dir = "../assets/uploads/news/";
        $target_file = $target_dir.basename($file_name);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $errorMsg = $target_file;
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
                        $full_image_path = $path."/"."assets/uploads/news/".$file_name;
                        $sql = "UPDATE news SET
                        news_title = '$news_title',
                        news_slug = '$news_slug',
                        news_author = '$news_author',
                        news_category = '$news_category',
                        news_description = '$news_description',
                        news_image = '$full_image_path' WHERE id='$news_id';
                        ";
                        $query = mysqli_query($conn, $sql);
                        if ($query) {
                          echo "<script>window.location = 'news-detail.php?news=".urlencode($news_slug)."';</script>";
                        }else{
                          $errorMsg = "News could not be updated".mysqli_error($conn);
                        }
                  }    
  }
}else{
    $errorMsg = "Fill all fields before submitting";
  }
}
?>
  						<div class="col-md-9">
  							<form class="row" method="POST" action="update-news.php?news=<?php echo urlencode($news_get_slug); ?>" enctype="multipart/form-data" id="update_form">
                  <p id="fuck"></p>
  								<?php if(isset($_POST['news_update_btn'])): ?>
                    <p id="formError" style="margin-top: -40px !important;"><?php echo $errorMsg; ?></p>
                    <?php endif?><br>
                    <input type="text" name="news_id" id="news_id" value="<?php echo $news_get_id; ?>">
                    <input type="text" name="news_slug" value="<?php echo $news_get_slug; ?>">
                    <input type="text" name="image" id="image" value="<?php echo $news_get_image; ?>">
  									<div class="col-md-6">
  										<label>News Title</label>
  										<div class="input-group credential_form">
  											<div class="input-group-addon credential_form">
  												<i class="fa fa-book-open"></i>
  											</div>
  											<input type="text" class="form-control" name="news_title" value="<?php echo $news_get_title; ?>" id="news_title" />
  										</div>
  									</div>
  									<div class="col-md-6">
  										<label>News Author</label>
  										<div class="input-group credential_form">
  											<div class="input-group-addon credential_form">
  												<i class="fa fa-user-tie"></i>
  											</div>
  											<input type="text" class="form-control" name="news_author" value="<?php echo $news_get_author; ?>" id="news_author" />
  										</div>
  									</div>
  									<div class="col-md-6">
  										<label>News Category</label>
  										<div class="form-group credential_form">
  											<select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="news_category" id="news_category">
  												<option selected="selected"><?php echo $news_get_category; ?></option>
  												<option>PENSA</option>
  												<option>Articles</option>
  												<option>Church News</option>
  												<option>Other News</option>
  											</select>
  										</div>
  									</div>
  									<div class="col-md-6">
  										<div class="form-group">
  											<label for="exampleInputFile">News Thumbnail</label>
  											<input type="file" id="news_image" name="news_image">

  											<p class="help-block">Image should not be more than 5mb</p>
  										</div>
  									</div>
  									<div class="col-lg-12 col-sm-12">
  										<div class="body" align="left">
  											<textarea class="summernote form-control no-resize" type="text" name="news_description" placeholder="Type your blog script here" style="resize: none !important;" id="news_description"><?php echo $news_get_description; ?>
  											</textarea>
  										</div>
  									</div>
  									<div class="col-md-12" align="center">
  										<button class="btn btn-success" type="submit" name="news_update_btn" id="news_update_btn">Update News</button>
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
  		});

  	</script>
    <script type="text/javascript">
      // $(document).ready(function(){
      //   var news_id = $('#news_id').val();
      //   var image = $('#image').val();
      //   var news_title = $('#news_title').val();
      //   var news_author = $('#news_author').val();
      //   var news_category = $('#news_category').val();
      //   var news_description = $('#news_description').val();
      //   var news_image = $('#news_image').val();
      //   var news_update_btn = $('#news_update_btn').val()
      //   $('#update_form').submit(function (e){
      //     e.preventDefault();
      //     $('#formError').load('includes/update-news.php', {
      //       news_id: news_id,
      //       image: image,
      //       news_title: news_title,
      //       news_author: news_author,
      //       news_category: news_category,
      //       news_description: news_description,
      //       news_update_btn: news_update_btn,
      //       news_image: news_image
      //     })
      //   })
      // })
    </script>
  	</html>
  	<?php endif;?>