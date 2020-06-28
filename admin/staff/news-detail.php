<?php
session_start();
include 'includes/connect.php';
include 'includes/news-counter.php';
$id = $_SESSION['id'];
$errorMsg ='';
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
        <div class="container" style="margin-top: 5%;">
          <div class="row">
            <div class="col-md-8" style="background-color: #fff; padding: 10px;padding-top: 4%;">
              <?php
              $news_slug = $_GET['news'];
              if (!isset($news_slug)) {
                echo "<script>window.location = 'view-news.php';</script>";
              }

              $sql = "SELECT * FROM news WHERE news_slug='$news_slug'";
              $query = mysqli_query($conn, $sql);
              if (mysqli_num_rows($query)) {
                while ($row = mysqli_fetch_assoc($query)) {
                  $id = $row['id'];
                  $news_author = $row['news_author'];
                  $news_title = $row['news_title'];
                  $news_slug = $row['news_slug'];
                  $news_category = $row['news_category'];
                  $news_description = $row['news_description'];
                  $news_date = $row['news_date'];
                  $news_image = $row['news_image'];
                  $timestamp = strtotime($news_date);
                  $date = date("l M d, Y", $timestamp);
                  $time = date("h:ia", $timestamp);
                }
              }
              ?>
              <div class="full_news">
                <span id="full_news_span"><?php echo $news_category; ?></span>
                <div class="full_news_header">
                  <h2><?php echo $news_title; ?></h2>
                  <div class="news_header_stats">
                    <p><span class="fa fa-user-tie"></span> <?php echo $news_author; ?></p>
                    <p><span class="fa fa-calendar-alt"></span> <?php echo $date; ?></p>
                    <p><span class="fa fa-clock"></span> <?php echo $time; ?></p>
                  </div>
                </div>
                <img src="<?php echo $news_image; ?>" class="img-responsive">
                <div class="news_desc">
                  <?php echo $news_description; ?>
                </div>
              </div>
            </div>
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
                      <span class="label label-primary pull-right"><?php echo $general_news_counter; ?></span></a></li>
                      <li class="active"><a href="news-article.php"><i class="fa fa-bible"></i> Article <span class="label label-primary pull-right"><?php echo $news_article_counter; ?></span></a></li>
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
</html>
<?php endif;?>