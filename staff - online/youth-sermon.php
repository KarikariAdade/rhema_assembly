<?php
session_start();
include 'includes/connect.php';
include 'includes/sermon_counter.php';
?>
<?php if (!isset($_SESSION['id'])):?>
    <?php  echo "<script>window.location = 'sign-in.php';</script>"; ?>
    <?php else:?>
       <?php
      $id = $_SESSION['id'];
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
      <div class="container" style="margin-bottom: 5%;">
  <div class="row">
     <div class="col-md-8" style="padding-right: 5%;">
      <div class="current_series">
        <?php
         $current_sql = "SELECT * FROM sermon WHERE service_type = 'Youth Ministry' ORDER BY id DESC LIMIT 1";
    $current_query = mysqli_query($conn, $current_sql);
        ?>
        <?php if (mysqli_fetch_assoc($current_query) <= 0): ?>
          <h2>There are no sermons under Youth Ministry yet.....<br></h2>
      <?php else:?>
         <h2 style="padding-bottom: 5%;">Current Teaching Series</h2>
      <p id="line"></p>
      <?php
       $current_sql = "SELECT * FROM sermon WHERE service_type = 'Youth Ministry' ORDER BY id DESC LIMIT 1";
    $current_query = mysqli_query($conn, $current_sql);
    if (mysqli_num_rows($current_query) > 0) {
      while ($row = mysqli_fetch_assoc($current_query)) {
        $title = $row['title'];
        $bible_verse = $row['bible_verses'];
        $sermon_link = $row['sermon_link'];
        $sermon_notes = $row['sermon_notes'];
        $author = $row['author'];
        $sermon_slug = $row['sermon_slug'];
    ?>
    <div class="current_series_desc">
        <h2><a href="view-sermon.php?sermon=<?php echo urlencode($sermon_slug); ?>">Title: <?php echo $title; ?> (<?php echo $bible_verse; ?>)</a></h2><br />
        <span><strong>By: <?php echo $author; ?></strong></span>
      </div>
      <div class="current_series_video">
        <?php echo $sermon_notes; ?>
      </div>
      <?php
      }
    }
    ?>
    </div>
    <div class="recent_series_cards">
    <h2>Recent Series</h2>
    <?php
       $record_per_page = 15;
          $page = '';
          if (isset($_GET['page'])) {
            $page = $_GET['page'];
          }else{
            $page = 1;
          }
          $start_from = ($page - 1)*$record_per_page;
    $current_sql = "SELECT * FROM sermon WHERE service_type='Youth Ministry' ORDER BY id DESC LIMIT $start_from, $record_per_page";
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
        $sermon_slug = $row['sermon_slug'];
    ?>
    <div class="row sermon_cards">
        <div class="col-md-5">
          <img src="<?php echo $sermon_image; ?>" class="img-responsive">
        </div>
        <div class="col-md-7">
          <p><span class="fa fa-clock"></span> <?php echo time_ago($sermon_date); ?></p>
          <h3>Don't Compromise (<?php echo $bible_verse; ?>)</h3>
          <p><?php echo $sermon_notes; ?></p>
        <div class="sermon_card_btn">
          <p>
              <button class="btn btn-sm"><a href="view-sermon.php?sermon=<?php echo urlencode($sermon_slug); ?>">Read More</a></button>
            </p>
            <p>
              <button class="btn btn-sm"><a href="download.php?id=<?php echo urlencode($sermon_id); ?>" target="_blank">Download Sermon File</a></button>
            </p>
            <!-- <p>
              <button class="btn btn-sm"><a href="view-sermon.php?sermon=<?php echo urlencode($sermon_slug); ?>">Watch Here</a></button>
            </p>
            <p>
              <button class="btn btn-sm"><a href="//<?php echo $sermon_link; ?>" target="_blank">View on Youtube</a></button>
            </p> -->
            <?php if($position == "Presiding Elder" || $position == "Secretary" || $position == "Elder"):?>
            <p>
              <button class="btn btn-sm"><a href="update-sermon.php?sermon=<?php echo urlencode($sermon_slug); ?>"><span class="fa fa-edit"></span></a></button>
            </p>
             <p>
              <form method="POST" action="includes/delete-sermon.php">
                <input type="hidden" name="sermon_id" value="<?php echo $sermon_id; ?>">
              <button class="btn btn-sm" id="sermon_btn" onclick="return confirm('Are you sure you want to delete this Sermon? There is no turning back after this!')" style="padding: 4px 20px;"><span class="fa fa-trash"></span></button>
            </form>
            </p>
          <?php endif;?>
          </div>
        </div>
      </div>
      <?php
      }
    }
    ?>

<div style="margin-top: 5%;">
      <p align="center">
         <?php
      $page_query = "SELECT * FROM sermon WHERE service_type='Youth Ministry' ORDER BY id DESC";
                $page_query_sql = mysqli_query($conn, $page_query);
                $total_records = mysqli_num_rows($page_query_sql);
                $total_pages = ceil($total_records / $record_per_page);

                for ($i=1; $i<=$total_pages; $i++) { 
                  echo "<a class='pagination' href='youth-sermon.php?page=".$i."'>".$i."</a>";
                }
                ?>
      </p>
    </div>
  </div>
<div class="past_sermon">
 <!--  <h2>Past Sermons</h2>
  <button class="btn"><a href="#" style="text-decoration: none;">View Sermon Archives</a></button> -->
  <?php endif;?>
</div>
    </div>
    <div class="col-md-3">
      <div class="box box-primary" style="margin-top: 35%;">
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
                      <li class="active"><a href="youth-sermon.php"><i class="fa fa-user"></i> Youth Ministry <span class="label label-primary pull-right"><?php echo $youth_counter; ?></span></a></li>
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