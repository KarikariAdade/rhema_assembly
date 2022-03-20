 <?php
 session_start();
 include 'includes/connect.php';
 include 'includes/news-counter.php';
 $id = $_SESSION['id'];

 // Fetch News Author
 $fetch_author = $conn->query("SELECT * FROM admin_profile WHERE id = '$id'");
 $row = mysqli_fetch_assoc($fetch_author);
 $news_author = $row['first_name'].' '.$row['last_name'];

 //Error Message variable to print errors
 $errorMsg ='';

 // News slug function
 function slug($text){
  $text = str_replace(' ', '-', $text);
  $text = preg_replace('/[^A-Za-z\-]/', '', $text);
  $text = preg_replace('/-+/', '-', $text);
  $text = strtolower($text);
  return $text;
}
?>
<!-- Session checker and redirection -->
<?php if (!isset($_SESSION['id'])):?>
  <?php  echo "<script>window.location = 'sign-in.php';</script>"; ?>
<?php else:?> 	
  <?php

//News form validation

  if (isset($_POST['news_submit_btn'])) {
    $news_title = mysqli_real_escape_string($conn, $_POST['news_title']);
    $news_category = mysqli_real_escape_string($conn, $_POST['news_category']);
    $news_description =mysqli_real_escape_string($conn, $_POST['news_description']);
    $news_slug = slug($news_title);

    if (!empty($news_title) && !empty($news_category) && !empty($news_description)) {
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
         $sql = "INSERT INTO news (news_author, news_title, news_slug, news_category, news_description, news_date, news_image) VALUES('$news_author', '$news_title', '$news_slug', '$news_category', '$news_description', now(), '$full_image_path')";
         $query = mysqli_query($conn, $sql);
         if ($query) {
          echo "<script>window.location = 'view-news.php';</script>";
        }else{
          $errorMsg = "News could not be uploaded";
        }
      }else{
        $errorMsg = "News Thumbnail could not be uploaded";
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
              // Display page name
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


                <!-- NEWS COUNTER -->

  							<div class="box-body no-padding">
                  <ul class="nav nav-pills nav-stacked">
                    <li><a href="general-news.php"><i class="fa fa-church"></i> General News
                      <span class="label label-primary pull-right"><?php echo $general_news_counter; ?></span></a></li>
                      <li><a href="news-article.php"><i class="fa fa-bible"></i> Article <span class="label label-primary pull-right"><?php echo $news_article_counter; ?></span></a></li>
                      <li><a href="church-news.php"><i class="fa fa-female"></i> Church News <span class="label label-primary pull-right"><?php echo $church_news_counter; ?></span></a>
                      </li>
                      <li><a href="other-news.php"><i class="fa fa-male"></i> Other News <span class="label label-primary pull-right"><?php echo $other_news_counter; ?></span></a></li>
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
                      // FETCH NEWS ON THE SIDEBAR
                      $sermon_sql = "SELECT * FROM news ORDER BY id DESC LIMIT 5";
                      $sermon_query = mysqli_query($conn, $sermon_sql);
                      if (mysqli_num_rows($sermon_query) > 0) {
                        while ($row = mysqli_fetch_assoc($sermon_query)) {
                          $news_author = $row['news_author'];
                          $news_slug = $row['news_slug'];
                          $news_title = $row['news_title'];
                          $news_category = $row['news_category'];
                          $news_description = $row['news_description'];
                          $news_date = $row['news_date'];
                          ?>
                          <li class="item">
                            <p><a href="news-detail.php?news=<?php echo urlencode($news_slug); ?>"><?php echo $news_title; ?></a></p>
                            <small style="float: right;">By: <?php echo $news_author; ?></small><small><i class="fa fa-clock"></i> <?php echo time_ago($news_date); ?></small>
                          </li>
                          <?php
                        }
                      }
                      ?>
                    </ul>
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer text-center">
                    <a href="view-news.php" class="uppercase">View All News</a>
                  </div>
                  <!-- /.box-footer -->
                </div>
              </div>

              <div class="col-md-9">
               <form class="row" method="POST" action="add-news.php" enctype="multipart/form-data">
                <!-- DISPLAY FORM ERROR -->
                <?php if(isset($_POST['news_submit_btn'])): ?>
                 <p id="formError" style="margin-top: -40px !important;"><?php echo $errorMsg; ?></p>
               <?php endif?><br>
               <div class="col-md-6">
                <label>News Title</label>
                <div class="input-group credential_form">
                 <div class="input-group-addon credential_form">
                  <i class="fa fa-book-open"></i>
                </div>
                <input type="text" class="form-control" name="news_title" />
              </div>
            </div>
            <div class="col-md-6">
              <label>News Category</label>
              <div class="form-group credential_form">
               <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="news_category">
                <option selected="selected">General News</option>
                <option>Articles</option>
                <option>Church News</option>
                <option>Other News</option>
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
             <label for="exampleInputFile">News Thumbnail</label>
             <input type="file" id="exampleInputFile" name="news_image">

             <p class="help-block">Image should not be more than 5mb</p>
           </div>
         </div>
         <div class="col-lg-12 col-sm-12">
          <div class="body" align="left">
           <textarea class="summernote form-control no-resize" type="text" name="news_description" id="announcement_description" placeholder="Type your blog script here" style="resize: none !important;">
           </textarea>
         </div>
       </div>
       <div class="col-md-12" align="center">
        <button class="btn btn-success" type="submit" name="news_submit_btn">Add News</button>
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
</html>
<?php endif;?>