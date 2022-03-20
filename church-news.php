<?php
include 'includes/connect.php';
if (!isset($_GET['news'])) {
  echo "<script>window.location = 'index.php';</script>";
}else{
	$news = $_GET['news'];
}
?>
 <?php
        $news_sql = "SELECT * FROM news WHERE news_slug = '$news' ORDER BY id DESC";
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
            $time = date("h:ia", $timestamp);
        }
    }
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
           	<title><?php echo $news_title; ?></title>
           </head>
           <body>
           	  <div id="fb-root"></div>
  <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.3&appId=924612231210758&autoLogAppEvents=1"></script>
  <?php include 'includes/navbar.php'; ?>
    <style type="text/css">
    .news_intro_pic{
      background:url('<?php echo $news_image; ?>') !important;background-repeat: no-repeat !important;
      background-size: cover !important;
      background-position: center !important;
      background-attachment: fixed !important;
    }
     .news_intro_pic .board_intro_desc h1{
  font-weight: lighter;
  font-size: 35px;
  text-align: center;
}
    
  </style>
    <div class="container-fluid news_intro_pic">
    <div class="board_intro_desc" id="board_intro_desc_news">
      <h1><?php echo $news_title; ?></h1>
    </div>
  </div>
           <div class="container super-news-detail">
           	<div class="row">
           		<div class="col-md-12">
           			<div class="news_detail_image">
           				<img class="img-fluid" src="<?php echo $news_image;?>">
           			</div>
           			<div class="news_detail_desc">
           				<h1><?php echo $news_title; ?></h1>
           				<div class="news_detail_stats">
           					<ul class="horizontal">
           						<li><span class="fa fa-user-tie" id="icon"></span> By: <?php echo $news_author; ?></li>
           						<li><span class="fa fa-clock" id="icon"></span> <?php echo $day." at ".$time; ?></li>
           						<li><span class="fa fa-tag" id="icon"></span>  <?php echo $news_category; ?></li>
           					</ul>
           				</div>
           				<p style="font-weight: lighter;"><?php echo $news_description;?></p>
                  <div class="nextPrevBtns">
                    <?php
                      $previous_sql = "SELECT * FROM news WHERE id < '$news_id' ORDER BY id DESC LIMIT 1";   
                      $previous_result = mysqli_query($conn, $previous_sql);
                      if (mysqli_num_rows($previous_result) > 0) {
                        while ($row = mysqli_fetch_assoc($previous_result)) {
                          $previous_post_id =$row['id'];
                          $previous_post_hash = $row['news_slug'];
                          $previous_post = $row['news_title'];
                          ?>
                    <button class="btn"><a href="church?news=<?php echo urlencode($previous_post_hash); ?>">Previous News</a></button>
                    <?php
                  }
                }
                    ?>
                     <?php
                      $next_sql = "SELECT * FROM news WHERE id > '$news_id' ORDER BY id ASC LIMIT 1";   
                      $next_result = mysqli_query($conn, $next_sql);
                      if (mysqli_num_rows($next_result) > 0) {
                        while ($row = mysqli_fetch_assoc($next_result)) {
                          $next_post_id =$row['id'];
                          $next_post_hash = $row['news_slug'];
                          $next_post = $row['news_title'];
                          ?>
                    <button class="btn" style="float: right;"><a href="church?news=<?php echo urlencode($next_post_hash) ?>">Next News</a></button>
                    <?php
                  }
                }
                    ?>
                  </div>
                  
           			</div>
           			<div class="tags_section">
           				<ul>
           					<li><span>Tags:</span></li>
           					<li><a href="news-and-events">News</a></li>
           					<li><a href="events">Events</a></li>
           					<li><a href="announcements">Announcement</a></li>
                    <li><a href="sermon">Sermons</a></li>
           				</ul>
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