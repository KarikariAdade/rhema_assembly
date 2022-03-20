<?php
session_start();
include 'includes/connect.php';
// $errorMsg = '';
$id = $_SESSION['id'];
$sql = "SELECT * FROM admin_profile WHERE id='$id'";
$query = mysqli_query($conn, $sql);
if (mysqli_num_rows($query) > 0) {
  while ($row = mysqli_fetch_assoc($query)) {
    $id = $row['id'];
    $name = $row['first_name']." ".$row['last_name'];
    $user_email = $row['email'];
    $staff_position = $row['position'];
    }
  }
  $position_sql = "SELECT * FROM admin_profile WHERE position = 'Presiding Elder'";
  $position_sql_query = $conn->query($position_sql);
  $user_position_count = mysqli_num_rows($position_sql_query);
  // echo $user_position_count;
?>
<?php if (!isset($_SESSION['id'])):?>
	<?php  echo "<script>window.location = 'sign-in.php';</script>"; ?>
	<?php else:?>


		<?php
		$errorMsg = "";
		if (isset($_POST['add_profile_btn'])) {
     $id = mysqli_real_escape_string($conn, $_POST['user_id']);
			$status = mysqli_real_escape_string($conn, $_POST['status']);
			$gender = mysqli_real_escape_string($conn, $_POST['gender']);
			$address = mysqli_real_escape_string($conn, $_POST['address']);
			$occupation = mysqli_real_escape_string($conn, $_POST['occupation']);
			$admin_image = $_FILES['admin_image'];
			$biograghy = mysqli_real_escape_string($conn, $_POST['biograghy']);
      $security_question = mysqli_real_escape_string($conn, $_POST['security_question']);
      $security_answer = mysqli_real_escape_string($conn, $_POST['security_answer']);
      $security_answer = md5($security_answer);
      $phone = mysqli_real_escape_string($conn, $_POST['phone']);
      $number = preg_match('@[0-9]@', $phone);

			if (!empty($status) && !empty($gender) && !empty($address) && !empty($occupation) && !empty($admin_image) && !empty($biograghy)) {
				if (strlen($biograghy) < 40) {
					$errorMsg = "<strong>Biography field</strong> should contain more than 40 characters";
				}elseif ($security_question == "Select Your Security Question") {
          $errorMsg = "Please select a Security Question";
        }elseif (!$number) {
          $errorMsg = "Phone field should contain only Numbers";
        }
        else{
					$file_name = $_FILES['admin_image']['name'];
				    $file_size = $_FILES['admin_image']['size'];
				    $file_tmp_name = $_FILES['admin_image']['tmp_name'];
				    $file_type = $_FILES['admin_image']['type'];
				    $target_dir = "../assets/uploads/profile/";
                    $target_file = $target_dir.basename($file_name);
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                    // $errorMsg = $target_file;
                    if ($file_size > 5000000) {
                    	$errorMsg = "Image should not be more than 5mb";
                    	$uploadOk = 0;
                    }elseif ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif" ) {
                    	$errorMsg = "Sorry, only image files are allowed";
                    	$uploadOk = 0;
                    }elseif ($uploadOk == 0) {
                    	$errorMsg = "Sorry, your file could not be uploaded. Try again.";
                    }else{
                    	if (move_uploaded_file($file_tmp_name, $target_file)) {
                    		$image_url = $_SERVER['HTTP_REFERER'];
                    		$seg = explode("/", $image_url);
                    		$path = $seg[0]."/".$seg[1]."/".$seg[2]."/".$seg[3];
                    		$full_image_path = $path."/"."assets/uploads/profile/".$file_name;
                    		// print_r($seg);
                    		// $errorMsg = $full_image_path;
                    		$sql = "UPDATE admin_profile SET
                    		 occupation = '$occupation',
                    		 address = '$address',
                    		 status = '$status',
                    		 gender = '$gender',
                    		 description = '$biograghy',
                         phone = '$phone',
                         security_question = '$security_question',
                         security_answer = '$security_answer',
                    		 admin_image = '$full_image_path' WHERE id = '$id'
                    		";
                    		$query = mysqli_query($conn, $sql);

                        $profile_sql = "INSERT INTO profile_pictures(user_id, user_position, user_name, user_email, date_added,picture) VALUES('$id', '$position', '$name', '$user_email', now(), '$full_image_path')";
                        $profile_query = mysqli_query($conn,$profile_sql);
                    		if ($query && $profile_query) {
                    			$errorMsg = "Profile has been uploaded successfully";
                    			echo "<script>window.location = 'view-profile.php';</script>";
                    		}else{
                    			$errorMsg = "Profile was not successfully updated".mysqli_error($conn);

                    		}
                    	}
                    }
				}
			}else{
				$errorMsg = "Please fill all form fields before submitting";
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
  			<div class="container add_profile_container">
  				<div class="box box-primary">
  					<div class="box-header with-border">
  						<h3 class="box-title">Add Profile</h3>
  					</div>
  					<!-- /.box-header -->
  					<!-- form start -->

  					<form role="form" class="row" method="POST" action="add-profile.php" enctype="multipart/form-data">
  						<?php if(isset($_POST['add_profile_btn'])): ?>
  						<div class="col-md-10 errorMsg">
  							<p align="center"><?php echo $errorMsg; ?></p>
  						</div>
  					<?php endif;?>
  					<input type="hidden" name="user_id" value="<?php echo $id; ?>">
  					<input type="hidden" name="first_name" value="<?php echo $first_name;?>">
  						<div class="box-body col-md-5">
  							<label>House Address</label>
  							<div class="input-group credential_form">
  								<div class="input-group-addon credential_form">
  									<i class="fa fa-address-card"></i>
  								</div>
  								<input type="text" class="form-control" name="address" value="<?=(isset($_POST['address'])?$_POST['address']:'')?>" />
  							</div>
  						</div>
  						<div class="box-body col-md-5">
  							<label>Occupation</label>
  							<div class="input-group credential_form">
  								<div class="input-group-addon credential_form">
  									<i class="fa fa-user-tie"></i>
  								</div>
  								<input type="text" class="form-control" name="occupation" value="<?=(isset($_POST['occupation'])?$_POST['occupation']:'')?>"/>
  							</div>
  						</div>
              <div class="box-body col-md-5">
                <label>Phone</label>
                <div class="input-group credential_form">
                  <div class="input-group-addon credential_form">
                    <i class="fa fa-phone"></i>
                  </div>
                  <input type="tel" class="form-control" name="phone" value="<?=(isset($_POST['phone'])?$_POST['phone']:'')?>"/>
                </div>
              </div>
  						<div class="box-body col-md-5">
  							<label>Marital Status</label>
  							<div class="form-group credential_form">
  								<select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="status">
  									<option selected="selected">Single</option>
  									<option>Married</option>
  									<option>Divorced</option>
  									<option>In a Relationship</option>
  									<option>Widowed</option>
  									<option>It's complicated</option>
  								</select>
  							</div>
  						</div>
  						<div class="box-body col-md-5">
  							<label>Gender</label>
  							<div class="form-group credential_form">
  								<select class="form-control select3 select3-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="gender">
  									<option selected="selected">Male</option>
  									<option>Female</option>
  								</select>
  							</div>
  						</div>
              <div class="box-body col-md-5">
                <label>Security Question</label>
                <div class="form-group credential_form">
                  <select class="form-control select4 select3-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="security_question">
                    <option selected="selected">Select Your Security Question</option>
                    <option>What's your father's last name?</option>
                    <option>What is your mother's last name?</option>
                    <option>What is your favourite pentecostal song title?</option>
                    <option>What is your favourite bible verse?</option>
                    <option>What is your favourite bible version?</option>
                  </select>
                </div>
              </div>
              <div class="box-body col-md-5">
                <label>Security Question Answer</label>
                <div class="input-group credential_form">
                  <div class="input-group-addon credential_form">
                    <i class="fa fa-clipboard"></i>
                  </div>
                  <input type="text" class="form-control" name="security_answer" />
                </div>
              </div>
  						<div class="form-group col-md-5">
  							<label for="exampleInputFile">Upload Picture Here</label>
  							<input type="file" id="exampleInputFile" name="admin_image">

  							<p class="help-block">Picture size should not be more than 5mb</p>
  						</div>
  						<div class="box-body col-md-10">
  							<div class="form-group credential_form">
  								<label style="padding: 10px 10px;">Biography</label>
  								<textarea class="form-control" rows="10" placeholder="Please write something about yourself" name="biograghy"><?=(isset($_POST['biograghy'])?$_POST['biograghy']:'')?></textarea>
  							</div>
  						</div>

  						<!-- /.box-body -->

  						<div class="box-footer col-md-4">
  							<button type="submit" class="btn btn-primary" name="add_profile_btn">Submit</button>
  						</div>
  					</form>
  				</div>
  			</div>
  		</div>

  		<?php include 'includes/aside.php'; ?>
  	</div>
  <!-- </div> -->
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
  </body>
  </html>

  <?php endif; ?>