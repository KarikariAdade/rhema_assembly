<?php include 'includes/connect.php'; ?>
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
  <style type="text/css">
  .news_intro_pic .board_intro_desc h1{
    font-size: 46px;
    font-weight: lighter;
    text-align: center;
  }
  @media(min-width: 1000px){
    .news_intro_pic .board_intro_desc h1{
      font-size: 70px !important;
    }
  }
</style>
</head>
<body>
  <div id="fb-root"></div>
  <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.3&appId=924612231210758&autoLogAppEvents=1"></script>
  <?php include 'includes/navbar.php'; ?>
  <div class="container-fluid news_intro_pic">
    <div class="board_intro_desc">
      <h1>Church Events</h1>
    </div>
  </div>
  <div class="container blog_section">
    <div class="row">
     <div class="col-md-8">
      <div class="row">
       <?php
       $event_sql = "SELECT * FROM events ORDER BY id DESC";
       $event_query = mysqli_query($conn, $event_sql);
       if (mysqli_num_rows($event_query) > 0) {
        while ($row = mysqli_fetch_assoc($event_query)) {
          $event_id = $row['id'];
          $start_date = $row['start_date'];
          $activity = $row['activity'];
          $end_date = $row['end_date'];
          $venue = $row['venue'];
          $start_time = $row['start_time'];
          $event_category = $row['event_category'];
          $event_picture = $row['event_picture'];
          $remarks = $row['remarks'];
          $timestamp = strtotime($start_date);
          $date = date("M d Y", $timestamp);
          $time = date("h:ia", $timestamp);
          $activity_slug = $row['activity_slug'];
          ?>
          <div class="col-md-6 news-grid">
            <div class="grid">
              <div class="entry-media">
                <img src="<?php echo $event_picture; ?>" class="img-fluid" alt="" style="height: 250px;width: 100%;">
              </div>
              <div class="entry-details">
                <div class="entry-meta">
                  <ul>
                    <li><i class="fa fa-clock icon"></i> <?php echo $date; ?></li>
                    <li><i class="fa fa-tag icon"></i> <?php echo $event_category; ?></li>
                  </ul>
                </div>
                <div class="entry-body">
                  <h3><a href="<?php echo urlencode($activity_slug); ?>"><?php echo $activity; ?></a></h3>
                  <p id="card_event_detail"><?php echo $activity; ?> - <strong><?php echo date("l M m Y", strtotime($start_date))." @ ".date("ha", strtotime($start_time))." to ". date("l M m Y", strtotime($end_date));  ?></strong></p>
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
  <?php include 'includes/news_sidebar.php'; ?>
</div>
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