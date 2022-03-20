<?php
include 'includes/connect.php';
if (!isset($_GET['sermon'])) {
  echo "<script>window.location = 'home';</script>";
}else{
	$sermon = $_GET['sermon'];
}
?>
 <?php
        $news_sql = "SELECT * FROM sermon WHERE sermon_slug = '$sermon' ORDER BY id";
        $news_query = mysqli_query($conn, $news_sql);
        if (mysqli_num_rows($news_query) > 0) {
          while ($row = mysqli_fetch_assoc($news_query)) {
            $sermon_id = $row['id'];
        $title = $row['title'];
        $bible_verse = $row['bible_verses'];
        $sermon_link = $row['sermon_link'];
        $sermon_notes = $row['sermon_notes'];
        $author = $row['author'];
        $sermon_image = $row['sermon_image'];
        $sermon_date = $row['date'];
        $sermon_slug = $row['sermon_slug'];
        $sermon_file = $row['sermon_file'];
        $service_type = $row['service_type'];
        $timestamp = strtotime($sermon_date);
            $day = date("M d Y", $timestamp);
            $time = date("h:ia", $timestamp);
            $sermon_audio = explode('.', $sermon_file);
        $sermon_audio_array = array('mp3','aac','m4a');
        if (in_array($sermon_audio[1], $sermon_audio_array)) {
          $audio_file = $row['sermon_file'];
        }
        }
    }

            ?>
           <!DOCTYPE html>
           <html>
           <head>
            <style type="text/css">
    .news_intro_pic{
      background:url('<?php echo $sermon_image; ?>') !important;background-repeat: no-repeat !important;
      background-size: cover !important;
      background-position: center !important;
      background-attachment: fixed !important;
      height: 37vh;
    }
   .news_intro_pic .board_intro_desc h2{
  font-weight: lighter;
  font-size: 20px;
}

  </style>
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
  <link rel="stylesheet" type="text/css" href="css/mediaelementplayer.css">
           	<title><?php echo $title; ?></title>
           </head>
           <body>
           	  <div id="fb-root"></div>
  <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.3&appId=924612231210758&autoLogAppEvents=1"></script>
  <?php include 'includes/navbar.php'; ?>

    <div class="container-fluid news_intro_pic">
    <div class="board_intro_desc">
      <h2><?php echo $title.' ('.$bible_verse.')'; ?></h2>
      <h2>By: Karikari Adade</h2>
    </div>
  </div>
           <div class="container super-news-detail">
           	<div class="row">
           		<div class="col-md-12">
           			<div class="news_detail_image">
           				<img class="img-fluid" src="<?php echo $sermon_image;?>">
           			</div>
           			<div class="news_detail_desc">
           				<h1><?php echo $title; ?> (<?php echo $bible_verse; ?>)</h1>
           				<div class="news_detail_stats">
           					<ul class="horizontal">
           						<li><span class="fa fa-user-tie" id="icon"></span> By: <?php echo $author; ?></li>
           						<li><span class="fa fa-clock" id="icon"></span> <?php echo $day." at ".$time; ?></li>
           						<li><span class="fa fa-tag" id="icon"></span>  <?php echo $service_type; ?></li>
           					</ul>
           				</div>
           				<p style="font-weight: lighter;"><?php echo $sermon_notes;?></p>
                  <p><span style="font-weight: bold; color: #1d2cb7;">Bible Verses:</span> <?php echo $bible_verse;?></p>
                  <?php if(isset($audio_file)):?>
          <br><br><strong><span>Listen to audio below</span></strong>
           <div class="media-wrapper">
                <audio id="player2" controls autoplay style="width: auto;" src="<?= $audio_file; ?>" preload="auto">
                </audio>
            </div>
          <?php endif;?>
                  <div class="nextPrevBtns">
                    <?php
                      $previous_sql = "SELECT * FROM sermon WHERE id < '$sermon_id' ORDER BY id DESC LIMIT 1";   
                      $previous_result = mysqli_query($conn, $previous_sql);
                      if (mysqli_num_rows($previous_result) > 0) {
                        while ($row = mysqli_fetch_assoc($previous_result)) {
                          $previous_post_id =$row['id'];
                          $previous_post_hash = $row['sermon_slug'];
                          $previous_post = $row['title'];
                          ?>
                    <button class="btn"><a href="service?sermon=<?php echo urlencode($previous_post_hash); ?>">Previous Sermon</a></button>
                    <?php
                  }
                }
                    ?>
                     <?php
                      $next_sql = "SELECT * FROM sermon WHERE id > '$sermon_id' ORDER BY id ASC LIMIT 1";   
                      $next_result = mysqli_query($conn, $next_sql);
                      if (mysqli_num_rows($next_result) > 0) {
                        while ($row = mysqli_fetch_assoc($next_result)) {
                          $next_post_id =$row['id'];
                          $next_post_hash = $row['sermon_slug'];
                          $next_post = $row['title'];
                          ?>
                    <button class="btn" style="float: right;"><a href="service?sermon=<?php echo urlencode($next_post_hash) ?>">Next Sermon</a></button>
                    <?php
                  }
                }
                    ?>
                  </div>
           			</div>
                <br>
                <p align="center" id="download_sermon_file"><button class="btn btn-sm"><a href="download.php?downloads=<?php echo urlencode($sermon_slug); ?>"><span class="fa fa-download"></span> Download Sermon File</a></button></p>
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
<script type="text/javascript" src="js/mediaelement-and-player.js"></script>
<script type="text/javascript">
  $('#player2').mediaelementplayer();
</script>
</body>
</html>