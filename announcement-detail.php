<?php
include 'includes/connect.php';
// if (isset($_GET['u'])) {
// 	echo "wow";
// }
?>
<?php
$announcement_slug = $_GET['u'];
$fetch_announcement = "SELECT * FROM announcement WHERE id = '$announcement_slug'";
$fetch_announcement_query = mysqli_query($conn, $fetch_announcement);
if (mysqli_num_rows($fetch_announcement_query) > 0) {
	while ($row = mysqli_fetch_assoc($fetch_announcement_query)) {
		$announcement_id = $row['id'];
		$announcement_slug = $row['announcement_slug'];
		$announcement_title = $row['announcement_title'];
		$announcement_category = $row['category'];
		$description = $row['description'];
		$image = $row['image'];
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
  <title>Rhema Assembly | <?php echo $announcement_title; ?></title>
</head>
<body>
  <div id="fb-root"></div>
  <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.3&appId=924612231210758&autoLogAppEvents=1"></script>
  <?php include 'includes/navbar.php'; ?>
  <style type="text/css">
    .news_intro_pic{
      background:url('<?php echo $image; ?>') !important;background-repeat: no-repeat !important;
      background-size: cover !important;
      background-position: center !important;
    }
        .news_intro_pic .board_intro_desc h1{
  font-weight: lighter;
  font-size: 25px;
  text-align: center;
}
    @media(width: 1000px){
      .news_intro_pic .board_intro_desc h1{
  font-weight: lighter;
  /*font-size: 50px !important;*/
}
    }
  </style>
  <div class="container-fluid news_intro_pic">
    <div class="board_intro_desc" style="left: -30px;">
      <h1 style="padding-top: 3%;"><?php echo $announcement_title; ?></h1>
    </div>
  </div>
  <div class="container event_detail_section">
  <div class="row">
    <div class="col-md-6">
      <h3><?php echo $announcement_title; ?></h3>
      <h5><?php echo $announcement_category; ?></h5>
    </div>
    <div class="col-md-6 event_picture">
        <img src="<?php echo $image; ?>" class="img-fluid" style="height: 50vh; width: 100%;">
    </div>
  </div>
  <div class="row event_detail">
    <div class="col-md-7">
      <h1>About <?php echo $announcement_title; ?></h1>
      <p><?php echo $description; ?></p>
    </div>
  </div>
  <p align="center"><button class="btn event_calender_btn"><a href="announcements">View Church Announcements</a></button></p>
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