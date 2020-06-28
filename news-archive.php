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
      <h1><?php echo $monthName; ?> News Archive</h1>
    </div>
  </div>
  <div class="container blog_section">
    <div class="row">
     <div class="col-md-8">
      <div class="row">
        <?php
           $month = $_GET['month'];
  $year = $_GET['year'];
  $from = date('Y-m-01 00:00:00', strtotime("$year-$month"));
  $to = date('Y-m-31 23:59:59', strtotime("$year-$month"));
  $monthName = date("F", mktime(0, 0, 0, $month, 10));
  $sql = "SELECT * FROM news WHERE news_date >= '$from' AND news_date <= '$to'";
  $query = mysqli_query($conn, $sql);
  $archive_counter = mysqli_num_rows($query);
  echo "<h3 id='archive_results'>Showing <strong>" .$archive_counter. " News Posts</strong> under <strong>" .$monthName. "</strong> archive</h3><br>";
        ?>
        <?php
        $news_sql = "SELECT * FROM news WHERE news_date >= '$from' AND news_date <= '$to' ORDER BY id DESC";
        $news_query = mysqli_query($conn, $news_sql);
        if (mysqli_num_rows($news_query) > 0) {
          while ($row = mysqli_fetch_assoc($news_query)) {
            $news_id = $row['id'];
            $news_author = $row['news_author'];
            $news_title = $row['news_title'];
            $news_slug = $row['news_slug'];
            $news_category = $row['news_category'];
            $news_description = $row['news_description'];
            $news_date = $row['news_date'];
            $news_image = $row['news_image'];
            $timestamp = strtotime($news_date);
            $day = date("M d Y", $timestamp);

              if (strlen($news_description) > 150){
                  $news_description = wordwrap($news_description,150);
                  $news_description =explode("\n", $news_description);
                  $news_description = $news_description[0]."...";
              }
        ?>
       <div class="col-md-6 news-grid">
        <div class="grid">
          <div class="entry-media">
            <img src="<?php echo $news_image; ?>" class="img-fluid" alt="">
          </div>
          <div class="entry-details">
            <div class="entry-meta">
              <ul>
                <li><i class="fa fa-clock icon"></i> <?php echo $day; ?></li>
                <li><i class="fa fa-tag icon"></i> <?php echo $news_category; ?></li>
              </ul>
            </div>
            <div class="entry-body">
              <h3><a href="church?news=<?php echo $news_slug; ?>"><?php echo $news_title; ?></a></h3>
              <p><?php echo $news_description; ?></p>
            </div>
          </div>
        </div>
      </div>
    </div>
      <?php
          }
        }
      ?>
    </div>
    <?php include 'includes/news_sidebar.php'; ?>
    </div>

  </div>

</div>
</div>
</div>
<style type="text/css">
  .blog-sidebar{
    padding: 0 10px;
  }
</style>
<?php include 'includes/footer.php'; ?>
<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="js/popper.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/all.js"></script>
<script type="text/javascript" src="js/functions.js"></script>
<script type="text/javascript" src="js/swiper.min.js"></script>
</body>
</html>