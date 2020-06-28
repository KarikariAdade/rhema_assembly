<?php
include 'includes/volunteer-modal.php';
include 'includes/service-modal.php';
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
		<h1>John 12:26</h1>
		<p style="font-size: 20px;">If any man serve me, let him follow me; and where I am, there shallow also my servant be: If any man serve me, him will my Father honour</p>
	</div>
	</div>

  <!-- HERO SECTION BEGINS-->

  <div class="container">
    <div class="row hero_section">
      <div class="col-md-4">
        <div class="hero_div">
          <span class="fa fa-2x fa-bible"></span>
          <h3>1 Conrinthians 9:19</h3>
          <p id="line"></p>
          <p id='hero_desc' style="font-size: 16px;">For though I be free from all men, yet I have made myself servant</p>
          <!-- <p><a href="#">Join Us</a></p> -->
        </div>
      </div>
      <div class="col-md-4">
        <div class="hero_div">
          <span class="fa fa-2x fa-bible"></span>
          <h3>Psalm 100:2</h3>
          <p id="line"></p>
          <p id='hero_desc' style="font-size: 16px;">Serve the Lord with gladness; Come before Him with joyful singing</p>
          <!-- <p><a href="#">Join Us</a></p> -->
        </div>
      </div>
      <div class="col-md-4">
        <div class="hero_div">
          <span class="fa fa-2x fa-bible"></span>
          <h3>Psalm 2:11</h3>
          <p id="line"></p>
          <p id='hero_desc' style="font-size: 16px;">Serve the Lord with fear, and rejoice with trembling</p>
          <!-- <p><a href="#">Join Us</a></p> -->
        </div>
      </div>
    </div>
  </div>


  <!-- HERO SECTION ENDS -->
  <div class="container why_serve">
  	<h1>Why We Serve</h1>
  	<p>God calls us to serve Him by serving one another. We are each uniquely created and shaped by God for that purpose. Part of belonging to a church family is learning to joyfully serve by helping each other grow in faith, supporting each other in our daily lives and meeting each others needs, and guiding people to lives of Gospel transformation. Below are forms you can fill to get involved serving/volunteering at Rhema Assembly. Just click on which area you would like to serve in, and send us your contact information and a staff member will contact you!</p>
  </div>
  <div class="container-fluid serve_container">
  	<div class="container serve_options">
  	<div class="row">
  		<div class="col-md-6">
  			<div class="volunteering">
  			<h2>Become a Volunteer</h2>
  			<p>
  				There are a variety of events occuring in and around New Vision every week that give you the opportunity to participate in several different ways. Take a look at our event calendar to see where you can get involved!
  			</p>
  			<button class="btn" data-toggle="modal" data-target="#volunteerModal">Volunteer</button>
  		</div>
  	</div>
  		<div class="col-md-6">
  			<div class="volunteering">
  			<h2>Become a Servant</h2>
  			<p>
  				There are a variety of events occuring in and around New Vision every week that give you the opportunity to participate in several different ways. Take a look at our event calendar to see where you can get involved!
  			</p>
  			<button class="btn" data-toggle="modal" data-target="#serviceModal">Serve</button>
  		</div>
  	</div>
  	</div>
  </div>
  </div>
  <div class="container serve_analysis">
  	<h2>What if I'm not sure where to serve?</h2>
  	<p>To learn how God hard-wired you to serve and discover more about your spiritual gifts, let's help you with Spiritual Gift Analysis. If you would like to talk with someone or have questions, <a href="contact">click here.</a></p>
  </div>

	<?php include 'includes/footer.php'; ?>
	<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="js/popper.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/all.js"></script>
	<script type="text/javascript" src="js/functions.js"></script>
   <script type="text/javascript">
        $(document).ready(function (){
          $('#volunteer_form').submit(function (event) {
            event.preventDefault();
            var full_name = $('#full_name').val();
            var phone = $('#phone').val();
            var company = $('#company').val();
            var email = $('#email').val();
            var event = $('#event').val();
            var comment = $('#comment').val();
            var volunteer_submit_btn = $('#volunteer_submit_btn').val();
            $('#modal_error').load('includes/volunteer-validation.php',{
              full_name: full_name,
              phone: phone,
              company: company,
              email: email,
              event: event,
              comment: event,
              volunteer_submit_btn: volunteer_submit_btn
            });
          });
       });
      </script>
         <script type="text/javascript">
        $(document).ready(function (){
          $('#service_form').submit(function (event) {
            // alert("fuck")
            event.preventDefault();
            var user_name = $('#user_name').val();
            var phone_number = $('#phone_number').val();
            var company_name = $('#company_name').val();
            var user_email = $('#user_email').val();
            var user_service = $('#user_service').val();
            var user_comment = $('#user_comment').val();
            var service_submit_btn = $('#service_submit_btn').val();
            $('#service_error').load('includes/service_volunteer_validation.php',{
              user_name: user_name,
              phone_number: phone_number,
              company_name: company_name,
              user_email: user_email,
              user_service: user_service,
              user_comment: user_comment,
              service_submit_btn: service_submit_btn
            });
          });
       });
      </script>
    
</body>
</html>