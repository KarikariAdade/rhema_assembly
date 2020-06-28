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
	<div class="container-fluid board_intro_pic_2">
		<div class="board_intro_desc">
		<h1>Rhema Choir</h1>
		<p>The God-chosen men and women running the His church. The God-chosen men and women running the His church. The God-chosen men and women running the His church</p>
	</div>
	</div>

  <!-- HERO SECTION BEGINS-->

  <div class="container">
    <div class="row hero_section">
      <div class="col-md-4">
        <div class="hero_div">
          <span class="fa fa-2x fa-church"></span>
          <h3>Committed</h3>
          <p id="line"></p>
          <p id='hero_desc'>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.</p>
          <p><a href="contact">Join Us</a></p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="hero_div">
          <span class="fa fa-2x fa-bible"></span>
          <h3>Attentive</h3>
          <p id="line"></p>
          <p id='hero_desc'>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.</p>
          <p><a href="contact">Join Us</a></p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="hero_div">
          <span class="fa fa-2x fa-calendar-alt"></span>
          <h3>Creative</h3>
          <p id="line"></p>
          <p id='hero_desc'>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.</p>
          <p><a href="contact">Join Us</a></p>
        </div>
      </div>
    </div>
  </div>

  <!-- HERO SECTION ENDS -->

<div class="container choir_hero">
	<div class="row">
		<div class="col-md-6">
			<h3>Our Creative Choir</h3>
			<p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart
			A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heartA wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart</p>
		</div>
		<div class="col-md-6">
			<div>
				<img src="img/service/service_2.jpg" class="img-fluid">
			</div>
		</div>
	</div>
</div>

<div class="container choir_members">
  <?php
  $choir_sql = "SELECT * FROM admin_profile WHERE position LIKE '%Choir%' OR position LIKE '%Sing%'";
  $choir_query = mysqli_query($conn, $choir_sql);
  $choir_counter = mysqli_num_rows($choir_query);
  ?>
  <?php if($choir_counter > 0):?>
	<h2>Choir Members</h2>
	<div class="event_cards">
    <div class="row">
      <div class="col-md-8">
        <div class="swiper-container">
          <div class="swiper-wrapper" style="padding-bottom: 5%;">
            <?php
              while ($row = mysqli_fetch_assoc($choir_query)) {
                $full_name = $row['first_name']." ".$row['last_name'];
                    $position = $row['position'];
                    $admin_image = $row['admin_image'];
              }
            ?>
            <div class="swiper-slide">
              <div class="card choir_slider">
                <figure class="card_img">
                  <img class="card-img-top" src="<?php echo $admin_image; ?>">
                </figure>
                <div class="card-body">
                  <h5 style="color: #1d2cb7;"><?php echo $full_name; ?></h5>
                  <p style="font-size: 15px;text-align: center;padding: 0; color: #f1e200;" id="card_event_detail"><?php echo $position; ?></p>
                  <!-- <p><span><a href="#">Read More</a></span></p> -->
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- <div class="swiper-pagination"></div> -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
      </div>
      <?php endif;?>
      <div class="col-md-4" style="margin-top: -10%;">
       <div class="vc_column-inner"><div class="wpb_wrapper"><h4 class="vc_custom_heading vc_custom_1518864283429">PENTECOST SONGS</h4>
	<div class="wpb_raw_code wpb_content_element wpb_raw_html">
		<div class="wpb_wrapper">
			<iframe width="100%" height="350" scrolling="no" frameborder="no" allow="autoplay" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/users/403952418&amp;color=%233a54a4&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false&amp;show_teaser=true&amp;visual=true"></iframe>
		</div>
	</div>
</div></div>
      </div>
    </div>
  </div>
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