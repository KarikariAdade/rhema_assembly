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
	<div class="container-fluid board_intro_pic_3">
		<img src="img/contact-Us.jpg" style="width: 100%;">
		<div class="board_intro_desc">
		</div>
	</div>
	<div class="container contact_form_overall">
		<div class="row">
			<div class="col-md-7 contact_form">
				<p id="formError"></p>
				<form class="row" method="POST" action="" id="contact_form">
					<div class="col-md-6">
						<div class="form-group">
							<div class="input-group credential_form">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fa fa-user-plus"></i></span>
								</div>
								<input class="form-control" placeholder="Full Name" id="contact_name" name="contact_name" type="text">
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<div class="input-group credential_form">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fa fa-phone"></i></span>
								</div>
								<input class="form-control" placeholder="Phone" name="contact_phone" id="contact_phone" type="tel">
							</div>
						</div>

					</div>
					<div class="col-md-6">
						<div class="form-group">
							<div class="input-group credential_form">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fa fa-building"></i></span>
								</div>
								<input class="form-control" placeholder="Company" id="contact_company" name="contact_company" type="text">
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<div class="input-group credential_form">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fa fa-envelope"></i></span>
								</div>
								<input id="contact_email" name="contact_email" class="form-control" placeholder="Email" type="email">
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group textarea" align="center">
							<div class="input-group credential_form">
								<textarea type="text" name="comment_description" id="comment_description" rows="10" cols="300" placeholder="Write a Comment"></textarea>
							</div>
						</div>

					</div>
					<p id="contact_form_submit"><button class="btn" type="submit" name="contact_form_submit" id="contact_form_submit">Submit</button></p>
				</form>
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3076.192113908008!2d-1.4970544876558554!3d6.935070005085908!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x9b5ed9a299478f89!2sCOP%2C+Rhema-Assembly!5e0!3m2!1sen!2sgh!4v1564007047031!5m2!1sen!2sgh" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
			</div>
			<div class="col-md-1">
			</div>
			<div class="col-md-4">
				<div class="other_contact_info">
					<div class="contact_location">
						<span class="fa fa-2x fa-map-marker-alt"></span>
						<p>Hospital Road</p>
						<p>Plt 234, Block K</p>
						<p>Agona, Ashanti</p>
					</div>
					<div class="contact_location">
						<span class="fa fa-2x fa-phone"></span>
						<p>+233548876922</p>
						<p>+233548876922</p>
					</div>
					<div class="contact_location">
						<span class="fa fa-2x fa-envelope"></span>
						<p>juniorlecrae@gmail.com</p>
					</div>
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
		$(document).ready(function(){
			$('#contact_form').submit(function (e){
				e.preventDefault();
				var contact_name = $('#contact_name').val();
				var contact_email = $('#contact_email').val();
				var contact_phone = $('#contact_phone').val();
				var contact_company = $('#contact_company').val();
				var comment_description = $('#comment_description').val();
				var contact_form_submit = $('#contact_form_submit').val();
				$('#formError').load('includes/contact-form.php',{
					contact_name: contact_name,
					contact_email: contact_email,
					contact_phone: contact_phone,
					contact_company: contact_company,
					comment_description: comment_description,
					contact_form_submit: contact_form_submit
				})
			})
		})
	</script>
</body>
</html>