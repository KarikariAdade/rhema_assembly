<?php
include 'includes/connect.php';
 $check_event = $conn->query("SELECT * FROM events ORDER BY id DESC LIMIT 6");
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
  <link rel="stylesheet" type="text/css" href="css/pogo-slider.css">
  <link rel="stylesheet" type="text/css" href="css/responsive.css">
  <link rel="stylesheet" type="text/css" href="css/swiper.min.css">
  <title>The Church of Pentecost | Rhema Assembly - Agona,Ashanti</title>
</head>
<body>

  <!-- NAVIGATION BAR BEGINS -->
  <?php include 'includes/navbar.php'; ?>
  <!-- NAVIGATION BAR ENDS -->


  <!-- POGOSLIDER BEGINS -->
  <?php include 'includes/pogoslider.php'; ?>
  <!-- POGOSLIDER ENDS -->

  <!-- HERO SECTION BEGINS-->
<div class="container-fluid annual-harvest-container">
  <?php
  $fetch_harvest = $conn->query("SELECT * FROM annual_harvest WHERE status = 1 ORDER BY id DESC LIMIT 1");
  if (mysqli_num_rows($fetch_harvest) > 0) {
   while($row = mysqli_fetch_assoc($fetch_harvest)){
    $harvest_date = date('l F d, Y', strtotime($row['date']));
    $counter = $row['date'].' '.$row['time'];
  ?>
<div class="row">
  <div class="col-md-5" style="">
    <div style="">
  <h1 style=""><?= $row['harvest_year']; ?> Annual Harvest</h1>
  <p style=""><?= $harvest_date.' at '.$row['venue'];?></p>
</div>
</div>
  <div class="col-md-7" style="">
<div class="counter-class" data-date="<?= $counter; ?>"><!-- Date Formate Input yyyy-mm-dd hh:mm:ss -->
  <div><span class="counter-days"></span> Days</div>
  <div><span class="counter-hours"></span> Hours</div>
  <div><span class="counter-minutes"></span> Minutes</div>
  <div><span class="counter-seconds"></span> Seconds</div>
  <div id="counter-left"><span>LEFT</span> To Annual Harvest</div>
</div>
</div>
</div>
<?php
}
}
?>
</div>
  <div class="container">
    <div class="row hero_section">
      <div class="col-md-4">
        <div class="hero_div">
          <span class="fa fa-2x fa-church"></span>
          <h3>Plan a visit</h3>
          <p id="line"></p>
          <p id='hero_desc'>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.</p>
          <p><a href="new-members">Visit Us</a></p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="hero_div">
          <span class="fa fa-2x fa-bible"></span>
          <h3>Our Missons</h3>
          <p id="line"></p>
          <p id='hero_desc'>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.</p>
          <p><a href="mission">Read More</a></p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="hero_div">
          <span class="fa fa-2x fa-calendar-alt"></span>
          <h3>Events</h3>
          <p id="line"></p>
          <p id='hero_desc'>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.</p>
          <p><a href="news">See More</a></p>
        </div>
      </div>
    </div>
  </div>

  <!-- HERO SECTION ENDS -->

  <!-- WORSHIP WITH US SECTION ENDS-->
<!-- <br> -->
  <div class="worship" id="worship">
    <div class="container">
      <div class="row">
        <div class="col-md-6 worship_text">
          <h3>Worship with us!</h3>
          <h4>Every Sunday: 6 AM to 9 AM</h4><br>
          <h3 id="serviceStart">Service Ongoing!</h3>
          <div id="countholder">
            <div><span class="days" id="days"></span><div class="smalltext">Days</div></div>
            <div><span class="hours" id="hours"></span><div class="smalltext">Hours</div></div>
            <div><span class="minutes" id="minutes"></span><div class="smalltext">Minutes</div></div>
            <div><span class="seconds" id="seconds"></span><div class="smalltext">Seconds</div></div>
            <div><span class="seconds" id="seconds">left</span><div class="smalltext">for next service</div></div>
          </div>
          <p><button class="btn"><a href="new-members #our_location">Get Location</a></button></p>
        </div>
        <div class="col-md-6">
          <div class="worship_img">
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
  </div>
</div>
<div class="worship_skew"></div>

<!-- WORSHIP WITH US SECTION ENDS -->

<!-- EVENTS SECTION BEGINS -->
<div class="container events_section">
  <h1>NEWS & EVENTS</h1>
  <p id="line"></p>
  <div class="row plug_in">
    <div class="col-md-8">
      <h5><span>GET PLUGGED IN: </span> Upcoming Events at Rhema Assembly</h5>
    </div>
    <div class="col-md-4">
      <p><button class="btn"><a href="calendar">See Calendar</a></button></p>
    </div>
  </div>
  <div class="event_cards">
    <div class="row">
      <?php
      if (mysqli_num_rows($check_event) > 0) {
      ?>
      <div class="col-md-8">
        <div class="swiper-container">
          <div class="swiper-wrapper" style="padding:1% 0;">
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
      <?php
    }else{
      echo "<h2>There are no events at the moment</h2>";
    }
      ?>
      <div class="col-md-4">
        <?php 
        $announcement_sql = "SELECT * FROM announcement ORDER BY id DESC LIMIT 1";
        $announcement_query = mysqli_query($conn, $announcement_sql);
        if (mysqli_num_rows($announcement_query) > 0) {
          while ($row = mysqli_fetch_assoc($announcement_query)) {
            $announcement_id = $row['id'];
            $announcement_title = $row['announcement_title'];
            $announcement_slug = $row['announcement_slug'];
            $announcement_desc = $row['description'];
            if (strlen($announcement_desc) > 200){
                      $announcement_desc = wordwrap($announcement_desc,200);
                      $announcement_desc =explode("\n", $announcement_desc);
                      $announcement_desc = $announcement_desc[0]."...";
                    }
        ?>
        <h2>ANNOUNCEMENT</h2>
        <p id="announcement_header"><?php echo $announcement_title; ?> </p>
        <p><?php echo $announcement_desc; ?></p>
        <button class="btn"><a href='<?php echo urlencode($announcement_id.$announcement_slug); ?>'>View More</a></button>
        <?php
        }
        }
        ?>
      </div>
    </div>
  </div>
</div>

<!-- EVENTS SECTION ENDS -->

<!-- SERMONS AND STUFF  BEGINS-->
<div class="container services">
  <div class="events_section">
    <h1>BE PART OF OUR:</h1>
    <p id="line"></p>
  </div>
  <div class="row">
    <div class="col-md-4">
      <h4><span class="fa fa-lg fa-headphones-alt"></span><a href="sermon">Sermons</a></h4>
    </div>
    <div class="col-md-4">
      <h4><span class="fa fa-lg fa-bible"></span><a href="sermon">Bible Studies</a></h4>
    </div>
    <div class="col-md-4">
      <h4><span class="fa fa-lg fa-comment-dots"></span><a href="contact">Our Community</a></h4>
    </div>
  </div>
</div>
<!-- SERMONS AND STUFF ENDS -->

<!-- OTHER STUFF BEGINS-->
<div class="container" style="margin-top: 8%;">
  <div class="row">
    <div class="col-md-3 other_stuff_card">
      <div class="card">
        <div class="card-img">
          <img src="img/service/choir_sing.jpg" class="card-img-top">
        </div>
        <div class="other_stuff_desc">
        <h4>Rhema Choir</h4>
        <p id="line"></p>
        <p>The best way to serve God through praises is to join the Rhema Choir</p>
        <p><a href="rhema-choir">Read More <span class="fa fa-sm fa-arrow-alt-circle-right"></span></a></p>
      </div>
      </div>
    </div>
    <div class="col-md-3 other_stuff_card">
      <div class="card">
        <div class="card-img">
          <img src="img/rhema_project_2.jpg" class="card-img-top">
        </div>
        <div class="other_stuff_desc">
        <h4>Projects</h4>
        <p id="line"></p>
        <p>The best way to serve God through praises is to join the Rhema Choir</p>
        <p><a href="projects">Read More <span class="fa fa-sm fa-arrow-alt-circle-right"></span></a></p>
      </div>
      </div>
    </div>
    <div class="col-md-3 other_stuff_card">
      <div class="card">
        <div class="card-img">
          <img src="img/slider/slider_1.jpg" class="card-img-top">
        </div>
        <div class="other_stuff_desc">
        <h4>Evangelism</h4>
        <p id="line"></p>
        <p>The best way to serve God through praises is to join the Rhema Choir</p>
        <p><a href="evangelism-ministry">Read More <span class="fa fa-sm fa-arrow-alt-circle-right"></span></a></p>
      </div>
      </div>
    </div>
    <div class="col-md-3 other_stuff_card">
      <div class="card">
        <div class="card-img">
          <img src="img/slider/slider_4.jpg" class="card-img-top">
        </div>
        <div class="other_stuff_desc">
        <h4>Youth Ministry</h4>
        <p id="line"></p>
        <p>The best way to serve God through praises is to join the Rhema Choir</p>
        <p><a href="youth-ministry">Read More <span class="fa fa-sm fa-arrow-alt-circle-right"></span></a></p>
      </div>
      </div>
    </div>
  </div>
</div>
<!-- OTHER STUFF ENDS -->

<!-- FOOTER BEGINS -->
<?php include 'includes/footer.php' ?>
<!-- FOOTER ENDS -->
<!-- <div id="div1">
  <p>div 1</p>
  </div>

  <div id="div2" style="display: none;">
  <p>div2 </p>
  </div> -->
<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="js/popper.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/all.js"></script>
<script type="text/javascript" src="js/functions.js"></script>
<script type="text/javascript" src="js/jquery.pogo-slider.js"></script>
<script type="text/javascript" src="js/swiper.min.js"></script>
<script type="text/javascript" src="js/time.js"></script>
<script type="text/javascript" src="js/loopcounter.js"></script>
<script type="text/javascript">
  $('.pogoSlider').pogoSlider({
    autoplay: true,
    autoplayTimeout: 5000,
    displayProgess: true,
    // preserveTargetSize: true,
    // responsive: true,
    pauseOnHover: true,
    generateNav: true
  }).data('plugin_pogoSlider');
  $(document).ready(function(){
    loopcounter('counter-class');
  });
</script>
<script type="text/javascript">

  var swiper = new Swiper('.swiper-container', {
    spaceBetween: 20,
    slidesPerView: 2,
    speed: 1000,
    loop: true,
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