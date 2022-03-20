       <?php
       include 'includes/connect.php';
       session_start();
       $id = $_SESSION['id'];
       ?>
     <?php if (!isset($_SESSION['id'])):?>
    <?php  echo "<script>window.location = 'sign-in.php';</script>"; ?>
    <?php elseif(!isset($_GET['member']) && !isset($_GET['slug']) && !isset($_GET['user'])):?>
    <?php echo "<script>window.location = 'edit-member.php';</script>"; ?>
    <?php else:?>
      <?php
       $staff = $_GET['member'];
      $slug = $_GET['slug'];
      $user = $_GET['user'];
      $member_sql = "SELECT * FROM members WHERE id='$staff' AND last_name='$slug' AND first_name = '$user'";
      $member_query = mysqli_query($conn, $member_sql);
      if (mysqli_num_rows($member_query) > 0) {
                    while ($row = mysqli_fetch_assoc($member_query)) {
                      $member_id = $row['id'];
                      $first_name = $row['first_name'];
                      $last_name = $row['last_name'];
                      $gender = $row['gender'];
                      $email = $row['email'];
                      $birthdate = $row['birthday'];
                      $occupation = $row['occupation'];
                      $address = $row['address'];
                      $marital_status = $row['marital_status'];
                      $phone = $row['phone'];
                      $year_duration = $row['year_duration'];
                      $baptism = $row['baptism'];
                      $user_comment = $row['description'];
                      $ministry = $row['ministry'];
                    }
                  }
      ?>
       		<!DOCTYPE html>
       		<html>
       		<head>
       			<meta charset="utf-8">
       			<meta http-equiv="X-UA-Compatible" content="IE=edge">
       			<title>Rhema Assembly | Admin Dashboard</title>
       			<!-- Tell the browser to be responsive to screen width -->
       			<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
       			<!-- Bootstrap 3.3.7 -->
       			<link rel="stylesheet" href="../assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
       			<!-- Font Awesome -->
       			<link rel="stylesheet" href="../assets/dist/css/all.css">
       			<!-- Ionicons -->
       			<link rel="stylesheet" href="../assets/bower_components/Ionicons/css/ionicons.min.css">
       			<!-- Theme style -->
       			<link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
  	folder instead of downloading all of them to reduce the load. -->
  	<link rel="stylesheet" href="../assets/dist/css/skins/_all-skins.min.css">
  	<link rel="stylesheet" type="text/css" href="../assets/css/admin.css">
  	<link rel="stylesheet" type="text/css" href="../assets/css/style.min.css">


  	<!-- Google Font -->
  	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
  	<div class="wrapper">
  		<?php include 'includes/sidebar.php'; ?>

  		<!-- Content Wrapper. Contains page content -->
  		<div class="content-wrapper">
  			<!-- Content Header (Page header) -->
  			<section class="content-header">
  				<h1>
  					<?php
  					$remove = chop(basename($_SERVER['PHP_SELF']),'.php');
  					$remove = strtoupper($remove);
  					$remove = str_replace("-", " ", $remove);
  					echo $remove;
  					?>
  					<!-- <small>Control panel</small> -->
  				</h1>
  				<ol class="breadcrumb">
  					<li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
  					<li class="active">
  						<?php
  						$remove = chop(basename($_SERVER['PHP_SELF']),'.php');
  						$remove = strtoupper($remove);
  						$remove = str_replace("-", " ", $remove);
  						echo $remove;
  						?>
  					</li>
  				</ol>
  			</section>
  			<div class="container add-member-container" style="width: 98%; margin-top: 5%;">
  				<div class="box box-primary" style="padding: 10px;">
  					<div class="box-header with-border">
  						<p id="formError" style="margin-bottom: -1%;"></p>
  						<form class="row" method="POST" action="" style="padding-top: 4%;" id="membership_form">
                <input type="hidden" name="member_id" id="member_id" value="<?php echo $member_id; ?>">
  							<div class="col-md-6">
  								<label>First Name *</label>
  								<div class="input-group credential_form">
  									<div class="input-group-addon credential_form">
  										<i class="fa fa-user-tie"></i>
  									</div>
  									<input type="text" class="form-control" name="first_name" id="first_name" value="<?php echo $first_name; ?>" />
  								</div>
  							</div>
  							<div class="col-md-6">
  								<label>Last Name *</label>
  								<div class="input-group credential_form">
  									<div class="input-group-addon credential_form">
  										<i class="fa fa-user-tie"></i>
  									</div>
  									<input type="text" class="form-control" name="last_name" id="last_name" value="<?php echo $last_name; ?>" />
  								</div>
  							</div>
  							<div class="col-md-6">
  								<label>Date of Birth *</label>
  								<div class="input-group credential_form">
  									<div class="input-group-addon credential_form">
  										<i class="fa fa-calendar-alt"></i>
  									</div>
  									<input type="date" class="form-control" name="birthdate" id="birthdate" value="<?php echo $birthdate; ?>" />
  								</div>
  							</div>
  							<div class="col-md-6">
  								<label>Address *</label>
  								<div class="input-group credential_form">
  									<div class="input-group-addon credential_form">
  										<i class="fa fa-address-card"></i>
  									</div>
  									<input type="text" class="form-control" name="address" id="address" value="<?php echo $address; ?>" />
  								</div>
  							</div>
  							<div class="col-md-6">
  								<label>Email Address *</label>
  								<div class="input-group credential_form">
  									<div class="input-group-addon credential_form">
  										<i class="fa fa-envelope"></i>
  									</div>
  									<input type="email" class="form-control" name="email" id="email" value="<?php echo $email; ?>" />
  								</div>
  							</div>
  							<div class="col-md-6">
  								<label>Phone *</label>
  								<div class="input-group credential_form">
  									<div class="input-group-addon credential_form">
  										<i class="fa fa-phone"></i>
  									</div>
  									<input type="tel" class="form-control" name="phone" id="phone" value="<?php echo $phone; ?>" />
  								</div>
  							</div>
  							<div class="col-md-6">
  								<label>Occupation *</label>
  								<div class="input-group credential_form">
  									<div class="input-group-addon credential_form">
  										<i class="fa fa-book-open"></i>
  									</div>
  									<input type="text" class="form-control" name="occupation" id="occupation" value="<?php echo $occupation; ?>" />
  								</div>
  							</div>
  							<div class="col-md-6">
  								<label>Gender *</label>
  								<div class="form-group credential_form">
  									<select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="gender" id="gender">
                      <option><?php echo $gender; ?></option>
  										<option>Male</option>
  										<option>Female</option>
  									</select>
  								</div>
  							</div>
                <div class="col-md-6">
                  <label>Baptised? *</label>
                  <div class="form-group credential_form">
                    <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="baptism" id="baptism">
                      <option><?php echo $baptism; ?></option>
                      <option>Yes</option>
                      <option>No</option>
                    </select>
                  </div>
                </div>
  							<div class="col-md-6">
  								<label>Member of what Ministry? *</label>
  								<div class="form-group credential_form">
  									<select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="ministry" id="ministry">
                      <option><?php echo $ministry; ?></option>
  										<option>None</option>
  										<option>Evangelism Ministry</option>
  										<option>Men Ministry</option>
  										<option>Women Ministry</option>
  										<option>Children Ministry</option>
  										<option>Youth Ministry</option>
  									</select>
  								</div>
  							</div>
  							<div class="col-md-6">
                  <label>Date of Birth *</label>
                  <div class="input-group credential_form">
                    <div class="input-group-addon credential_form">
                      <i class="fa fa-calendar-alt"></i>
                    </div>
                    <input type="date" class="form-control" name="duration" id="duration" value="<?php echo $year_duration; ?>" />
                  </div>
                </div>
                <div class="col-md-6">
                  <label>Marital Status *</label>
                  <div class="form-group credential_form">
                    <select class="form-control select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="marital_status" id="marital_status">
                      <option><?php echo $marital_status; ?></option>
                      <option>In a Relationship</option>
                      <option>Single</option>
                      <option>Married</option>
                      <option>Divorced</option>
                      <option>Complicated</option>
                    </select>
                  </div>
                </div>
  							
  							<div class="col-md-12">
  							<div class="form-group credential_form">
  								<label style="padding: 10px 10px;">Comments/Feedback/Contribution</label>
  								<textarea class="form-control" rows="10" id="user_comment" name="user_comment"><?php echo $user_comment; ?></textarea>
  							</div>
                <p align="center"><button class="btn btn-primary" type="submit" id="member_update_btn">Update Member</button></p>
  						</div>
  						</form>
  					</div>
  				</div>
  			</div>
  		</div>
  		<?php include 'includes/aside.php'; ?>
  	</div>


  </div>
  <!-- ./wrapper -->

  <!-- jQuery 3 -->
  <script src="../assets/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="../assets/bower_components/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
  	$.widget.bridge('uibutton', $.ui.button);
  </script>
  <!-- Bootstrap 3.3.7 -->
  <script src="../assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

  <!-- Sparkline -->
  <script src="../assets/dist/js/all.js"></script>

  <!-- AdminLTE App -->
  <script src="../assets/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="../assets/dist/js/pages/dashboard.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../assets/dist/js/demo.js"></script>
  <script type="text/javascript">
		$(document).ready(function (){
			$('#membership_form').submit(function (e){
				e.preventDefault();
        var member_id = $('#member_id').val();
				var first_name = $('#first_name').val();
				var last_name = $('#last_name').val();
				var birthdate = $('#birthdate').val();
				var address = $('#address').val();
				var email = $('#email').val();
				var phone = $('#phone').val();
				var occupation = $('#occupation').val();
				var gender = $('#gender').val();
				var ministry = $('#ministry').val();
				var duration = $('#duration').val();
				var marital_status = $('#marital_status').val();
				var baptism = $('#baptism').val();
				var user_comment = $('#user_comment').val();
				var member_update_btn = $('#member_update_btn').val();
				$('#formError').load('includes/membership-update.php',{
          member_id: member_id,
					first_name: first_name,
					last_name: last_name,
					birthdate: birthdate,
					address: address,
					email: email,
					phone: phone,
					occupation: occupation,
					gender: gender,
					ministry: ministry,
					duration: duration,
					marital_status: marital_status,
					baptism: baptism,
					user_comment: user_comment,
					member_update_btn: member_update_btn
				})
			})
		});
	</script>
</body>
</html>
<?php endif;?>