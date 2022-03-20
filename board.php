<?php include 'includes/staff-request-modal.php';
include 'includes/connect.php';
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
  <title>The Church of Pentecost | Rhema Assembly - Agona,Ashanti</title>
</head>
<body>
	<?php include 'includes/navbar.php'; ?>
	<div class="container-fluid board_intro_pic">
		<div class="board_intro_desc">
		<h1>Rhema Board Members</h1>
		<p>The God-chosen men and women running the His church. The God-chosen men and women running the His church. The God-chosen men and women running the His church</p>
		<button class="btn" data-toggle="modal" data-target="#staff_request_form">Staff Request Form</button>
	</div>
	</div>
	<?php include 'includes/church_board/elders.php'; ?>
	<?php include 'includes/church_board/deacons.php'; ?>
	<?php include 'includes/church_board/deaconesses.php'; ?>
	<?php #include 'includes/church_board/men.php'; ?>
	<?php #include 'includes/church_board/women.php'; ?>
	<?php #include 'includes/church_board/youth.php'; ?>
	<?php #include 'includes/church_board/evangelism.php'; ?>
<?php include 'includes/footer.php'; ?>
<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="js/popper.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/all.js"></script>
<script type="text/javascript" src="js/functions.js"></script>
<script type="text/javascript">
	$(document).ready(function (){
		$('#staff_request_form').submit(function (e){
			e.preventDefault();
			var first_name = $('#first_name').val();
			var last_name = $('#last_name').val();
			var phone_number = $('#phone_number').val();
			var user_email = $('#user_email').val();
			var user_gender = $('#user_gender').val();
			var staff_description = $('#staff_description').val();
			var staff_submit_btn = $('#staff_submit_btn').val();
			$('#service_error').load('includes/staff-request-validation.php',{
				first_name: first_name,
				last_name: last_name,
				phone_number: phone_number,
				user_email: user_email,
				user_gender: user_gender,
				staff_description: staff_description,
				staff_submit_btn: staff_submit_btn
			})
		})
	})
</script>
</body>
</html>