<?php
session_start();
include 'includes/connect.php';
include 'includes/sermon_counter.php';
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
   if (isset($_POST['sermon_submit_btn'])) {
    $sermon_title = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['sermon_title']));
    $preacher = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['sermon_author']));
    $bible_verse = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['bible_verse']));
    $sermon_link = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['sermon_link']));
    $sermon_category = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['sermon_category']));
    $sermon_description = mysqli_real_escape_string($conn, $_POST['sermon_description']);
    $sermon_slug = slug($sermon_title);

    if (!empty($sermon_title) && !empty($preacher) && !empty($bible_verse) && !empty($sermon_link) && !empty($sermon_category) && !empty($sermon_description)) {
  								// $errorMsg = "All fields filled";
     $file_name = $_FILES['sermon_image']['name'];
     $file_size = $_FILES['sermon_image']['size'];
     $file_tmp_name = $_FILES['sermon_image']['tmp_name'];
     $file_type = $_FILES['sermon_image']['type'];
     $target_dir = "../assets/uploads/sermon/";
     $target_file = $target_dir.basename($file_name);
     $uploadOk = 1;
     $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


     $sermon_file_name = $_FILES['sermon_file']['name'];
     $sermon_file_size = $_FILES['sermon_file']['size'];
     $sermon_file_tmp_name = $_FILES['sermon_file']['tmp_name'];
     $sermon_file_type = $_FILES['sermon_file']['type'];
     $sermon_target_dir = "../assets/uploads/sermon_file/";
     $sermon_target_file = $sermon_target_dir.basename($sermon_file_name);
     $sermon_uploadOk = 1;
     $sermon_FileType = strtolower(pathinfo($sermon_target_file,PATHINFO_EXTENSION));


     if ($file_size > 5000000) {
      $errorMsg = "Image should not be more than 5mb";
      $uploadOk = 0;
    }elseif ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
      $errorMsg = "Sorry, only image files are allowed";
      $uploadOk = 0;
    }elseif ($uploadOk == 0) {
      $errorMsg = "Sorry, your file could not be uploaded. Try again.";
    }elseif ($sermon_file_size > 5000000) {
      $errorMsg = "Sermon File should not be more than 5mb";
      $sermon_uploadOk = 0;
    }elseif ($sermon_FileType != "pdf" && $sermon_FileType != "docx" && $sermon_FileType != 'doc') {
      $errorMsg = "Only pdf and .docx documents are allowed";
      $sermon_uploadOk = 0;
    }elseif ($sermon_uploadOk == 0) {
      $errorMsg = "Sermon File could not be uploaded";
    }else{
      if (move_uploaded_file($file_tmp_name, $target_file) && move_uploaded_file($sermon_file_tmp_name, $sermon_target_file)) {
        $image_url = $_SERVER['HTTP_REFERER'];
        $seg = explode("/", $image_url);
        $path = $seg[0]."/".$seg[1]."/".$seg[2]."/".$seg[3];
        
        $full_image_path = $path."/"."assets/uploads/sermon/".$file_name;
        echo $full_image_path;
        $sermon_file_url = $_SERVER['HTTP_REFERER'];
        $sermon_seg = explode("/", $sermon_file_url);
        $sermon_path = $sermon_seg[0]."/".$sermon_seg[1]."/".$sermon_seg[2]."/".$sermon_seg[3];
        $sermon_full_image_path = $sermon_path."/"."assets/uploads/sermon_file/".$sermon_file_name;
        $sql = "INSERT INTO sermon (publisher_id, title, sermon_slug, author, bible_verses, sermon_link, sermon_notes, date, service_type, sermon_image, sermon_file) VALUES('$id', '$sermon_title', '$sermon_slug', '$preacher', '$bible_verse','$sermon_link', '$sermon_description', now(), '$sermon_category','$full_image_path','$sermon_full_image_path')";
        $query = mysqli_query($conn, $sql);
        if ($query) {
                    $errorMsg = "Sermon successfully uploaded";
       }else{
         $errorMsg = "Sermon could not be uploaded".mysqli_error($conn);
       }
     }else{
      $errorMsg = "Sermon could not be uploaded".mysqli_error($conn);
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
        <script type="text/javascript">
        var errorMsg = "<?= $errorMsg;?>";
        if(errorMsg == "Sermon successfully uploaded"){
        window.location = 'view-sermons.php';
        }
        </script>
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
         <form class="row" method="POST" action="add-sermon.php" enctype="multipart/form-data">
          <?php if(isset($_POST['sermon_submit_btn'])): ?>
           <p id="formError" style="margin-top: -40px !important;"><?php echo $errorMsg; ?></p>
           <?php endif?><br>
           <div class="col-md-6">
            <input type="hidden" name="publisher_id" value="<?php echo $id; ?>">
            <label>Sermon Title</label>
            <div class="input-group credential_form">
             <div class="input-group-addon credential_form">
              <i class="fa fa-book-open"></i>
            </div>
            <input type="text" class="form-control" name="sermon_title" />
          </div>
        </div>
        <div class="col-md-6">
          <label>Preacher</label>
          <div class="input-group credential_form">
           <div class="input-group-addon credential_form">
            <i class="fa fa-user-tie"></i>
          </div>
          <input type="text" class="form-control" name="sermon_author" />
        </div>
      </div>
      <div class="col-md-6">
        <label>Bible Verse(s)</label>
        <div class="input-group credential_form">
         <div class="input-group-addon credential_form">
          <i class="fa fa-bible"></i>
        </div>
        <input type="text" class="form-control" name="bible_verse" />
      </div>
    </div>
    <div class="col-md-6">
      <label>Sermon Link</label>
      <div class="input-group credential_form">
       <div class="input-group-addon credential_form">
        <i class="fa fa-link"></i>
      </div>
      <input type="text" class="form-control" name="sermon_link" />
    </div>
  </div>
  <div class="col-md-6">
    <label>Sermon Category</label>
    <div class="form-group credential_form">
     <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="sermon_category">
      <option selected="selected">Youth Ministry</option>
      <option>Evangelism Ministry</option>
      <option>Women Ministry</option>
      <option>Men Ministry</option>
      <option>Children Ministry</option>
      <option>Sunday Service</option>
      <option>Bible Studies</option>
      <option>Home Cells</option>
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
   <textarea class="summernote form-control no-resize" type="text" name="sermon_description" id="sermon_description" placeholder="Type your blog script here" style="resize: none !important;">
   </textarea>
 </div>
</div>
<div class="col-md-12" align="center">
  <button class="btn btn-success" type="submit" name="sermon_submit_btn">Add Sermon</button>
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