<?php
include '../includes/connect.php';
$event_sql = "SELECT * FROM events WHERE event_category = 'Evangelism Ministry' ORDER BY id DESC LIMIT 6";
$event_query = mysqli_query($conn, $event_sql); 
$evangelism_event_counter = mysqli_num_rows($event_query);
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
	<?php include '../includes/navbar.php'; ?>
	<div class="container-fluid board_intro_pic_3">
		<img src="img/evang.jpg" style="width: 100%;">
		<div class="board_intro_desc">
		</div>
	</div>
	<div class="container themeDesc">
		<div class="row">
			<div class="col-md-8">
				<p>The Youth Ministry takes care of the youth of the Church. They meet on Mondays. The Ministry carries out evangelism, encourages the youth to participate fully in the programmes and activities of the Church and further exposes them to the various ministries within the Church <br>
				The Youth Ministry organises retreats, seminars etc in all aspects of life including enrichment, wives' responsibilities at home, child welfare and education ets.<br>
				It also carries out evangelism, counselling and sponsorship activities to help the needy in the church and in the society.
				
				</p>

				<h2>Vision</h2>
				<p>To become an effective and significant to passionately reach Youth for Christ in partnership with the Church</p>

				<h2>Mission</h2>
				<p>A total Christian youth who is committed, spirit-filled and strong in Christ character to positively impact the family, the Church and the community</p>
			</div>
			<div class="col-md-4">
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
	<div class="container children_events">
		<?php if($evangelism_event_counter > 0):?>
		<h3>Upcoming Events</h3>
		<div class="event_cards">
			<div class="row">
				<div class="col-md-8">
					<div class="swiper-container">
						<div class="swiper-wrapper">
				<?php
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
            ?>
						</div>
					</div>
					<!-- <div class="swiper-pagination"></div> -->
					<div class="swiper-button-next"></div>
					<div class="swiper-button-prev"></div>
				</div>
				<div class="col-md-4">
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
	<?php endif;?>
	</div>
	<div class="team-section">
		<div class="container">
			<div class="row plug_in" style="padding-bottom: 2%;">
				<div class="col-md-8">
					<h5>See our Staff: <span> EVANGELISM MINISTRY TEAM</span></h5>
				</div>
				<div class="col-md-4">
					<!-- <p><button class="btn">See Calendar</button></p> -->
				</div>
			</div>
			<div class="row">
				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="team-member">
						<div class="team-thumb">
							<img src="img/service.jpg" alt="" style="height: 40vh;" />
							<div class="team-overlay">
								<ul>
									<li><a href="#"><i class="fab fa-facebook"></i></a></li>
									<li><a href="#"><i class="fab fa-twitter"></i></a></li>
									<li><a href="#"><i class="fab fa-linkedin"></i></a></li>
									<li><a href="#"><i class="fab fa-google"></i></a></li>
									<li><a href="#"><i class="fab fa-skype"></i></a></li>
								</ul>
							</div>
						</div>
						<h2>Nardstrokes</h2>
						<h3>Head of Ministry</h3>
					</div>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="team-member">
						<div class="team-thumb">
							<img src="img/service.jpg" alt="" style="height: 40vh;" />
							<div class="team-overlay">
								<ul>
									<li><a href="#"><i class="fab fa-facebook"></i></a></li>
									<li><a href="#"><i class="fab fa-twitter"></i></a></li>
									<li><a href="#"><i class="fab fa-linkedin"></i></a></li>
									<li><a href="#"><i class="fab fa-google"></i></a></li>
									<li><a href="#"><i class="fab fa-skype"></i></a></li>
								</ul>
							</div>
						</div>
						<h2>Nardstrokes</h2>
						<h3>Head of Ministry</h3>
					</div>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="team-member">
						<div class="team-thumb">
							<img src="img/service.jpg" alt="" style="height: 40vh;" />
							<div class="team-overlay">
								<ul>
									<li><a href="#"><i class="fab fa-facebook"></i></a></li>
									<li><a href="#"><i class="fab fa-twitter"></i></a></li>
									<li><a href="#"><i class="fab fa-linkedin"></i></a></li>
									<li><a href="#"><i class="fab fa-google"></i></a></li>
									<li><a href="#"><i class="fab fa-skype"></i></a></li>
								</ul>
							</div>
						</div>
						<h2>Nardstrokes</h2>
						<h3>Head of Ministry</h3>
					</div>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="team-member">
						<div class="team-thumb">
							<img src="img/service.jpg" alt="" style="height: 40vh;" />
							<div class="team-overlay">
								<ul>
									<li><a href="#"><i class="fab fa-facebook"></i></a></li>
									<li><a href="#"><i class="fab fa-twitter"></i></a></li>
									<li><a href="#"><i class="fab fa-linkedin"></i></a></li>
									<li><a href="#"><i class="fab fa-google"></i></a></li>
									<li><a href="#"><i class="fab fa-skype"></i></a></li>
								</ul>
							</div>
						</div>
						<h2>Nardstrokes</h2>
						<h3>Head of Ministry</h3>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php include '../includes/footer.php'; ?>
	<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="js/popper.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/all.js"></script>
	<script type="text/javascript" src="js/functions.js"></script>
	<script type="text/javascript" src="js/swiper.min.js"></script>
	<script type="text/javascript">

		var swiper = new Swiper('.swiper-container', {
			spaceBetween: 20,
			slidesPerView: 2,
			speed: 1000,
    // centeredSlides: true,
    loop: false,
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