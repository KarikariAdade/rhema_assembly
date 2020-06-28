<?php
session_start();
include 'includes/connect.php';
if (!isset($_GET['token']) || !isset($_GET['id'])) {
	echo "<script>window.location = 'home';</script>";
}
$token = $_GET['token'];
$staff_id = $_GET['id'];
$check_admin = $conn->query("SELECT * FROM staff_request WHERE password = '$token'") or die(mysqli_error($conn));
$row = mysqli_fetch_assoc($check_admin);
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
	<link rel="stylesheet" type="text/css" href="css/sweetalert.css">
	<link rel="stylesheet" type="text/css" href="css/responsive.css">
	<title>The Church of Pentecost | Admin Confirmation</title>
</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-md-3">
		</div>
		<div class="col-md-5">
			<div class="card admin_verify_card">
				<div>
					<img src="img/pentecost.png" class="img-fluid">
					<h3>Admin Verification</h3>
					<div class="card-body">
						<p id="verify_intro">Hello <?= $row['first_name']; ?><br />Please <strong>confirm email</strong> and enter a <strong>password</strong> to complete registration</p>
						<form method="POST" class="verify_admin_form">
							<div class="loader"></div><p id="formError"></p>
							<input type="hidden" name="token" id="token" value="<?= $token; ?>">
							<div class="form-group">
								<div class="input-group credential_form">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fa fa-envelope"></i></span>
									</div>
									<input class="form-control" placeholder="Email Address *" type="email" name="admin_email" id="admin_email">
								</div>
							</div>
							<div class="form-group">
								<div class="input-group credential_form">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fa fa-lock"></i></span>
									</div>
									<input class="form-control" placeholder="Preferred Password *" type="password" name="password" id="admin_password">
									<div class="input-group-append" onclick="return HOS()">
										<span class="input-group-text"><span class="fa fa-eye show_hide_btn"></span></span>
									</div>
								</div>
							</div>
							<p><button type="submit" class="btn btn-primary verify_admin_btn">Confirm Registration</button></p>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-3">
		</div>
	</div>
</div>
</body>
<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="js/popper.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/all.js"></script>
<script type="text/javascript" src="js/functions.js"></script>
<script type="text/javascript" src="js/sweetalert.min.js"></script>
<script type="text/javascript">
  $(document).ajaxStart(function(){
  	$('.loader').css('display','none');
    });
</script>
</html>