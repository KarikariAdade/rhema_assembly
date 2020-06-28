<?php
if (!isset($_GET['p'])) {
  echo "<script>window.location = 'index.php';</script>";
}
?>
<?php 
include 'includes/connect.php';
$event_slug = $_GET['p'];
$fetch_event = "SELECT * FROM events WHERE activity_slug = '$event_slug'";
$fetch_event_query = mysqli_query($conn, $fetch_event);
if (mysqli_num_rows($fetch_event_query) > 0) {
  while ($row = mysqli_fetch_assoc($fetch_event_query)) {
  $activity = $row['activity'];
  $start_time = $row['start_time'];
  $start_date = $row['start_date'];
  $end_date = $row['end_date'];
  $event_category = $row['event_category'];
  $event_desc = $row['event_desc'];
  $event_picture = $row['event_picture'];
  $venue = $row['venue'];
  $remarks = $row['remarks'];
  $day = date("l M d Y", strtotime($start_date));
  $time = date("h:i A", strtotime($start_time));
  $end_date = date("l M d Y", strtotime($end_date));
}
}else{
  echo "<script>window.location = 'events';</script>";
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
  <title>Rhema Assembly | <?php echo $activity; ?></title>
</head>
<body>
  <div id="fb-root"></div>
  <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.3&appId=924612231210758&autoLogAppEvents=1"></script>
  <?php include 'includes/navbar.php'; ?>
  <style type="text/css">
    .news_intro_pic{
      background:url('<?php echo $event_picture; ?>') !important;background-repeat: no-repeat !important;
      background-size: cover !important;
      background-position: center !important;
      background-attachment: fixed !important;
    }
  </style>
  <div class="container-fluid news_intro_pic">
    <div class="board_intro_desc">
      <h1><?php echo $activity; ?></h1>
      <p>The God-chosen men and women running the His church. The God-chosen men and women running the His church. The God-chosen men and women running the His church</p>
    </div>
  </div>

<div class="container event_detail_section">
  <div class="row">
    <div class="col-md-6">
      <h3><?php echo $activity; ?></h3>
      <h5><?php echo $day; ?></h5>
    </div>
    <div class="col-md-6 event_picture">
        <img src="<?php echo $event_picture ?>" class="img-fluid">
    </div>
  </div>
  <div class="row event_detail">
    <div class="col-md-7">
      <h1>About <?php echo $activity; ?></h1>
      <p><?php echo $event_desc; ?></p>
    </div>
    <div class="col-md-5 event_stats">
      <p id="start_date"><span>Start Date:</span> <?php echo $day; ?></p>
      <p id="start_time"><span>Start Time:</span> <?php echo $time; ?></p>
      <p id="end_date"><span>End Date:</span> <?php echo $end_date; ?></p>
      <h4>Venue</h4>
      <p><?php echo $venue; ?></p>
      <h4>Remarks</h4>
      <p><?php echo $remarks; ?></p>
    </div>
  </div>
  <p align="center"><button class="btn event_calender_btn"><a href="calendar">See Full Calendar</a></button></p>
</div>
<style type="text/css">
  .event_calender_btn{
    background: transparent;
    transition: .4s;
    border-radius: 50px;
    border:1px solid #1d2cb7;
  }
  .event_calender_btn a{
    color: #1d2cb7;
    text-decoration: none;
    font-weight: bold;
  }
  .event_calender_btn:hover{
    border: 1px solid #fdc900;
    background-color: #fdc900;
    box-shadow: 0px 10px 30px 0px rgba(0,0,0,.5);
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