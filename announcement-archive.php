<?php
 include 'includes/connect.php';
 $month = $_GET['month'];
    $monthName = date("F", mktime(0, 0, 0, $month, 10));
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="The Church of Pentecost, Rhema Assembly-Agona Ashanti. Come worship with us and be Blessed">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/all.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="icon" href="img/pentecost.png" type="image/x-icon">
  <link rel="stylesheet" type="text/css" href="css/responsive.css">
  <link rel="stylesheet" type="text/css" href="css/swiper.min.css">
  <title>The Church of Pentecost | Rhema Assembly - Agona,Ashanti</title>
</head>
<body>
  <div id="fb-root"></div>
  <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.3&appId=924612231210758&autoLogAppEvents=1"></script>
  <?php include 'includes/navbar.php'; ?>
  <div class="container-fluid news_intro_pic">
    <div class="board_intro_desc">
      <h1><?php echo $monthName; ?> Announcements Archive</h1>
      <p>The God-chosen men and women running the His church. The God-chosen men and women running the His church. The God-chosen men and women running the His church</p>
    </div>
  </div>
  <div class="container blog_section">
    <div class="row">
     <div class="col-md-8">
      <div class="row">
         <?php
        $month = $_GET['month'];
  $year = $_GET['year'];
          //set from and to dates
  $from = date('Y-m-01 00:00:00', strtotime("$year-$month"));
      // echo $from;

  $to = date('Y-m-31 23:59:59', strtotime("$year-$month"));
  $monthName = date("F", mktime(0, 0, 0, $month, 10));
      // echo $to;
  $sql = "SELECT * FROM announcement WHERE date >= '$from' AND date <= '$to'";
  $query = mysqli_query($conn, $sql);
  $archive_counter = mysqli_num_rows($query);

  echo "<h3 id='archive_results'>Showing <strong>" .$archive_counter. " announcements</strong> under <strong>" .$monthName. "</strong> archive</h3><br>";
        ?>
        <?php 
        $announcement_sql = "SELECT * FROM announcement WHERE date >= '$from' AND date <= '$to' ORDER BY id DESC";
        $announcement_query = mysqli_query($conn, $announcement_sql);
        if (mysqli_num_rows($announcement_query) > 0) {
          while ($row = mysqli_fetch_assoc($announcement_query)) {
            $announcement_id = $row['id'];
            $announcement_title = $row['announcement_title'];
            $announcement_slug = $row['announcement_slug'];
            $announcement_desc = $row['description'];
            $announcement_category = $row['category'];
            $announcement_image = $row['image'];
            $announcement_date = $row['date'];
            $timestamp = strtotime($announcement_date);
            $day = date("M d Y", $timestamp);
            if (strlen($announcement_desc) > 400){
                      $announcement_desc = wordwrap($announcement_desc,400);
                      $announcement_desc =explode("\n", $announcement_desc);
                      $announcement_desc = $announcement_desc[0]."...";
                    }
         
        ?>
       <div class="col-md-6 news-grid">
        <div class="grid">
          <div class="entry-media">
            <img src="<?php echo $announcement_image; ?>" class="img-fluid" alt="" style="width: 100%; height: 250px;">
          </div>
          <div class="entry-details">
            <div class="entry-meta">
              <ul>
                <li><i class="fa fa-clock icon"></i> <?php echo $day; ?></li>
                <li><i class="fa fa-tag icon"></i> <?php echo $announcement_category; ?></li>
              </ul>
            </div>
            <div class="entry-body">
              <h3 style="font-size: 20px;padding-bottom: 8%;"><a href="<?php echo urlencode($announcement_id.$announcement_slug); ?>"><?php echo $announcement_title; ?></a></h3>
              <!-- <p><?php echo $announcement_desc; ?></p> -->
            </div>
          </div>
        </div>
      </div>
      <?php
          }
        }
      ?>
    </div>
  </div>
  <?php include 'includes/announcement_sidebar.php'; ?>
</div>
<style type="text/css">
  .blog-sidebar{
    padding: 0 10px;
  }
</style>
</div>


<?php include 'includes/footer.php'; ?>
<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="js/popper.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/all.js"></script>
<script type="text/javascript" src="js/functions.js"></script>
<script type="text/javascript" src="js/swiper.min.js"></script>s
</body>
</html>