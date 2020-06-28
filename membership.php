<?php
include 'includes/connect.php';
include 'includes/membership-modal.php';
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
	<?php include 'includes/navbar.php'; ?>
	<div class="container-fluid board_intro_pic_2">
		<div class="board_intro_desc">
		<h1>Join Rhema Assembly!</h1>
		<p>The God-chosen men and women running the His church. The God-chosen men and women running the His church. The God-chosen men and women running the His church</p>
	</div>
	</div>
		<div class="container children_intro">
		<div class="row">
			<div class="col-md-6">
				<!-- <h1>House-to-House Evangelism</h1> -->
				<p>Identifying with a local church is an expression of who Christ made us to be. The day we became Christians, we became part of the body of Christ and a member of God's family. When believers are not members of a local church, the body is incomplete and those believers are like estranged family members.</p>
				<p>God designed the church to be a place for believers to find community and encouragement as we serve each other, grow together in Christ, and guide others to faith in Christ. It will be difficult to thrive in our relationships with Christ if we have a casual relationship with His church.</p>
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
	<div class="container join_interest">
		<h1>Interested in Joining Rhema Assembly?</h1>
		<p>Stop by the Rhema Assembly Church after service and talk with a staff member, or <a href="contact">Contact Us Here</a>. You can also help us update our database by filling up this <a href="members-form">Membership form</a> if you are already a member</p>
	</div>
<div class="container service_times" id="service_times" style="margin-top: 13%;">
		<h1 style="color: #1d2cb7;">SERVICE TIMES</h1>
		<h3>We're One Church, One People</h3>
		<div class="row">
			<div class="col-md-4 service_address">
				<h2>Address</h2>
				<p>HOSPITAL ROAD</p>
				<p>PLT 234, BLOCK K</p>
				<p>AGONA, ASHANTI</p>
			</div>
			<div class="col-md-8 service_time_card">
				<div class="row">
					<div class="col-md-4">
						<h4>Sundays</h4>
						<h6>Main Church Service</h6>
						<p>6:00 AM TO 9:00 AM</p>
					</div>
					<div class="col-md-4">
						<h4>Mondays</h4>
						<h6>Dawn Prayers</h6>
						<p>4:00 AM TO 6:00 AM</p>
						
						<h6>Youth Meetings</h6>
						<p>7:00 PM TO 8:00 PM</p>
					</div>
					<div class="col-md-4">
						<h4>Wednesday</h4>
						<h6>Dawn Prayers</h6>
						<p>4:00 AM TO 6:00 AM</p>
					</div>
					<div class="col-md-4">
						<h4>Friday</h4>
						<h6>Dawn Prayers</h6>
						<p>4:00 AM TO 6:00 AM</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container our_location" align="left"><br><br>
			<!-- <h1>Our Location</h1> -->
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3076.192113908008!2d-1.4970544876558554!3d6.935070005085908!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x9b5ed9a299478f89!2sCOP%2C+Rhema-Assembly!5e0!3m2!1sen!2sgh!4v1564007047031!5m2!1sen!2sgh" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
		</div>
	<?php include 'includes/footer.php'; ?>
	<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="js/popper.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/all.js"></script>
	<script type="text/javascript" src="js/functions.js"></script>
</body>
</html>