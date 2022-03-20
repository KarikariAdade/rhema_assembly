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
</head>
<body>
	<?php include 'includes/navbar.php'; ?>
	<div class="container-fluid mission_intro_pic">
		<div class="board_intro_desc">
		<h1>Our Missions</h1>
	</div>
	</div>

	<div class="container children_intro">
		<div class="row">
			<div class="col-md-6">
				<h1>House-to-House Evangelism</h1>
				<p>The God-chosen men and women running the His church. The God-chosen men and women running the His church. The God-chosen men and women running the His churchThe God-chosen men and women running the His church. The God-chosen men and women running the His church. The God-chosen men and women running the His churchThe God-chosen men and women running the His church. The God-chosen men and women running the His church. The God-chosen men and women running the His church</p>
			</div>
			<div class="col-md-6">
				<!-- <div class="">
					<img src="img/children_min.jpg" class="img-fluid">
				</div> -->
				<div id="slider" class="carousel slide carousel-fade" data-interval="4000" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#slider" data-slide-to="0" class="active"></li>
              <li data-target="#slider" data-slide-to="1"></li>
              <li data-target="#slider" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img class="d-block w-100 carouselImg" src="img/slider/slider_2.jpg" id="carouselImg">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="img/slider/slider_4.jpg" id="carouselImg">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="img/slider/slider_1.jpg" id="carouselImg">
              </div>
            </div>
          </div>
			</div>
		</div>
	</div>
	<div class="container children_intro">
		<div class="row">
			<div class="col-md-6 first_child">
				<div>
					<img class="img-fluid" src="img/service/service_congregation.jpg">
				</div>
			</div>
			<div class="col-md-6 second_child">
				<h1>Monthly Crusades</h1>
				<p>The God-chosen men and women running the His church. The God-chosen men and women running the His church. The God-chosen men and women running the His churchThe God-chosen men and women running the His church. The God-chosen men and women running the His church. The God-chosen men and women running the His churchThe God-chosen men and women running the His church. The God-chosen men and women running the His church. The God-chosen men and women running the His church</p>
			</div>
		</div>
	</div>
	<div class="container children_intro" style="margin-top: 10%;">
		<div class="row">
			<div class="col-md-6">
				<h1>Hospital Visits</h1>
				<p>The God-chosen men and women running the His church. The God-chosen men and women running the His church. The God-chosen men and women running the His churchThe God-chosen men and women running the His church. The God-chosen men and women running the His church. The God-chosen men and women running the His churchThe God-chosen men and women running the His church. The God-chosen men and women running the His church. The God-chosen men and women running the His church</p>
			</div>
			<div class="col-md-6">
				<div class="">
					<img src="img/service_1.jpg" class="img-fluid">
				</div>
			</div>
		</div>
	</div>
	<div class="container serve_opportunities">
		<h2>Incoming Opportunities to Serve</h2>
		<!-- <div class="row"> -->
			  <div class="event_cards">
    <div class="row">
      <div class="col-md-12">
        <div class="swiper-container">
          <div class="swiper-wrapper">
           <?php
              $event_sql = "SELECT * FROM events ORDER BY id DESC LIMIT 6";
              $event_query = mysqli_query($conn, $event_sql);
              if (mysqli_num_rows($event_query) > 0) {
                while ($row = mysqli_fetch_assoc($event_query)) {
                  $event_id = $row['id'];
                  $activity = $row['activity'];
                  $start_date = $row['start_date'];
                  $start_time = $row['start_time'];
                  $end_date = $row['end_date'];
                  $event_picture = $row['event_picture'];
                  $activity_slug = $row['activity_slug'];
               
              ?>
            <div class="swiper-slide">
              <div class="card" style="border-radius: 0;">
                <figure class="card_img">
                  <img class="card-img-top" src="<?php echo $event_picture; ?>">
                </figure>
                <div class="card-body" style="padding-bottom: 5%;">
                  <h5><?php echo $activity; ?> - <?php echo date("l M", strtotime($start_date))." @ ".date("ha", strtotime($start_time));  ?></h5>
                  <p id="card_event_detail"><?php echo $activity; ?> - <strong><?php echo date("l M m Y", strtotime($start_date))." @ ".date("ha", strtotime($start_time))." to ". date("l M m Y", strtotime($end_date));  ?></strong></p>
                  <p><span><a href="<?php echo urlencode($activity_slug); ?>">Read More</a></span></p>
                </div>
              </div>
            </div>
            <?php
             }
              }
            ?>
          </div>
        </div>
        <!-- <div class="swiper-pagination"></div> -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
      </div>
    </div>
    <div class="mission_calendar"><button class="btn"><a href="calendar">Full Calendar</a></button></div>
  </div>
		<!-- </div> -->
	</div>
<?php include 'includes/footer.php'; ?>
<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="js/popper.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/all.js"></script>
<script type="text/javascript" src="js/functions.js"></script>
<script type="text/javascript" src="js/swiper.min.js"></script>
<script type="text/javascript">

  var swiper = new Swiper('.swiper-container', {
    spaceBetween: 20,
    slidesPerView: 3,
    speed: 1000,
    // centeredSlides: true,
    loop: true,
    // freeMode: true,
    autoplay: {
      delay: 4500,
      disableOnInteraction: false,
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
    breakpoints:{
      1024:{
        slidesPerView: 2,
      },
      768: {
        slidesPerView: 2,
        spaceBetween: 30,
      },
      640: {
        slidesPerView: 1,
        spaceBetween: 20,
      },
      320: {
        slidesPerView: 1,
        spaceBetween: 10,
      }
    }
  });

</script>
</body>
</html>