<?php
session_start();
include 'includes/connect.php';
$id = $_SESSION['id'];
 ?>
 <?php if (!isset($_SESSION['id'])):?>
 	<?php  echo "<script>window.location = 'sign-in.php';</script>"; ?>
 	<?php else:?>
<?php
 function slug($text){
  $text = str_replace(' ', '-', $text);
  $text = preg_replace('/[^A-Za-z\-]/', '', $text);
  $text = preg_replace('/-+/', '-', $text);
  $text = strtolower($text);
  return $text;
}
$fetch_admin = "SELECT * FROM admin_profile WHERE id='$id'";
$fetch_admin_query = mysqli_query($conn, $fetch_admin);
while ($admin_row = mysqli_fetch_assoc($fetch_admin_query)) {
  $full_name = $admin_row['first_name']." ".$admin_row['last_name']." added a new event";
}
$errorMsg = '';
if (isset($_POST['add_event_btn'])) {
  $activity = mysqli_real_escape_string($conn, $_POST['activity']);
  $start_date = mysqli_real_escape_string($conn, $_POST['start_date']);
  $end_date = mysqli_real_escape_string($conn, $_POST['end_date']); 
  $venue = mysqli_real_escape_string($conn, $_POST['venue']);
  $remarks = mysqli_real_escape_string($conn, $_POST['remarks']);
  $event_desc = mysqli_real_escape_string($conn, $_POST['event_desc']);
  $event_picture = $_FILES['event_picture'];
  $activity_slug = slug($activity);
  $start_time = mysqli_real_escape_string($conn, $_POST['start_time']);
  $event_category = mysqli_real_escape_string($conn, $_POST['event_category']);

  if (!empty($activity) && !empty($start_date) && !empty($end_date) && !empty($start_time) && !empty($venue) && !empty($event_desc) && !empty($event_category)) {
    $file_name = $_FILES['event_picture']['name'];
            $file_size = $_FILES['event_picture']['size'];
            $file_tmp_name = $_FILES['event_picture']['tmp_name'];
            $file_type = $_FILES['event_picture']['type'];
            $target_dir = "../assets/uploads/event/";
                    $target_file = $target_dir.basename($file_name);
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
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
                        $full_image_path = $path."/"."assets/uploads/event/".$file_name;
                        $sql = "INSERT INTO events(activity, activity_slug, start_date, start_time, end_date, event_category, event_desc, event_picture, venue, remarks) VALUES ('$activity', '$activity_slug', '$start_date', '$start_time', '$end_date', '$event_category', '$event_desc', '$full_image_path', '$venue', '$remarks')";
                        $query = mysqli_query($conn, $sql);
                        $notification = "INSERT INTO notification(category, message, date, status) VALUES('Event Add', '$full_name',now(),0)";
                        $notification_query = mysqli_query($conn,$notification);
                        if ($query && $notification_query) {
                          echo "<script>window.location = 'view-event.php';</script>";
                        }else{
                          $errorMsg = "Event could not be added successfully".mysqli_error($conn);
                        }
                      }
                    }
  }else{
    $errorMsg = "Fill all fields before submitting";
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
 			<link rel="stylesheet" type="text/css" href="../assets/js/summernote/dist/summernote.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
  	folder instead of downloading all of them to reduce the load. -->
  	<link rel="stylesheet" href="../assets/dist/css/skins/_all-skins.min.css">
  	<link rel="stylesheet" type="text/css" href="../assets/css/admin.css">
  	<link rel="stylesheet" type="text/css" href="../assets/css/lightbox.min.css">


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
  					Dashboard
  					<small>Control panel</small>
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
        <div class="row">
          <div class="col-md-7">
            
              <div class="add_profile_container" style="background-color: #fff; padding:20px !important;">
                <?php if(isset($_POST['add_event_btn'])): ?>
                <p id="formError" style="padding-bottom: 2%;">
                  <?php echo $errorMsg;?>
                </p>
              <?php endif;?>
                <form role="form" class="row add_task_form" method="POST" action="add-event.php" enctype="multipart/form-data">
              <div class="box-body col-md-6">
                <label>Event Title / Activity *</label>
                <div class="input-group credential_form">
                  <div class="input-group-addon credential_form">
                    <i class="fa fa-marker"></i>
                  </div>
                  <input type="text" class="form-control" name="activity" id="activity">
                </div>
              </div>
              <div class="box-body col-md-6">
                <label>Event Start Date</label>
                <div class="input-group credential_form">
                  <div class="input-group-addon credential_form">
                    <i class="fa fa-calendar-alt"></i>
                  </div>
                  <input type="date" class="form-control" name="start_date" id="start_date">
                </div>
              </div>
              <div class="box-body col-md-6">
                <label>Event Start Time</label>
                <div class="input-group credential_form">
                  <div class="input-group-addon credential_form">
                    <i class="fa fa-clock"></i>
                  </div>
                  <input type="time" class="form-control" name="start_time" id="start_time">
                </div>
              </div>
               <div class="box-body col-md-6">
                <label>Event End Date</label>
                <div class="input-group credential_form">
                  <div class="input-group-addon credential_form">
                    <i class="fa fa-calendar-alt"></i>
                  </div>
                  <input type="date" class="form-control" name="end_date" id="end_date">
                </div>
              </div>
              <div class="col-md-6">
                      <label>Event Category</label>
                      <div class="form-group credential_form">
                        <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="event_category">
                          <option selected="selected">General Event</option>
                         <option>Youth Ministry</option>
                          <option>Evangelism Ministry</option>
                          <option>Women Ministry</option>
                          <option>Men Ministry</option>
                          <option>Children Ministry</option>
                          <option>Sunday Service</option>
                        </select>
                      </div>
                    </div>
              <div class="box-body col-md-6">
                <label>Event Venue</label>
                <div class="input-group credential_form">
                  <div class="input-group-addon credential_form">
                    <i class="fa fa-city"></i>
                  </div>
                  <input type="text" class="form-control" name="venue" id="venue">
                </div>
              </div>
              <div class="box-body col-md-6">
                <label>Event Remarks</label>
                <div class="input-group credential_form">
                  <div class="input-group-addon credential_form">
                    <i class="fa fa-award"></i>
                  </div>
                  <input type="text" class="form-control" name="remarks" id="remarks">
                </div>
              </div>
              <div class="box-body col-md-6" style="margin-top: 12px;">
                <label>Event Thumbnail</label>
                  <input type="file" name="event_picture" id="event_picture">
              </div>
              
              <div class="box-body col-md-12">
                <div class="form-group credential_form">
                  <label style="padding: 10px 10px;">Event Description</label>
                  <textarea class="form-control" rows="10" placeholder="Please write something about the task" name="event_desc" id="event_desc" style="width:100% !important;"></textarea>
                </div>
              </div>

              <!-- /.box-body -->

              <div class="col-md-4" style="padding-bottom: 3%;">
                <button type="submit" class="btn btn-primary" name="add_event_btn" id="add_event_btn">Add Event</button>
              </div>
            </form>
            </div>
          </div>
          <div class="col-md-4">
             <div class="box box-primary">
                  <div class="box-header with-border">
                    <h3 class="box-title">Recent Events</h3>

                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <ul class="products-list product-list-in-box">
                      <?php
                      $event_sql = "SELECT * FROM events ORDER BY id DESC LIMIT 7";
                      $event_query = mysqli_query($conn, $event_sql);
                      if (mysqli_num_rows($event_query) > 0) {
                        while ($row = mysqli_fetch_assoc($event_query)) {
                          $event_id = $row['id'];
                          $activity = $row['activity'];
                          $start_date = $row['start_date'];
                          $end_date = $row['end_date'];
                          $venue = $row['venue'];
                          $timestamp = strtotime($start_date);
                          $day = date("l M d Y", $timestamp);
                      ?>
                      <li class="item">
                        <p><a href="event-detail.php?event=<?php echo urlencode($event_id); ?>&activity=<?php echo urlencode($activity); ?>"><?php echo $activity; ?></a></p>
                         <small style="width: 50%; float: right;"><span class="fa fa-city"></span> <?php echo $venue; ?></small>
                        <small><i class="fa fa-clock"></i> <?php echo $day; ?></small>
                      </li>
                      <?php
                    }
                  }
                      ?>
                    </ul>
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer text-center">
                    <a href="view-event.php" class="uppercase">View All Events</a>
                  </div>
                  <!-- /.box-footer -->
                </div>
          </div>
        </div>
         </div>
        <?php include 'includes/aside.php'; ?>
      </div>


    </div>
  </body>
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
  <script src="../assets/dist/js/dashboard.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../assets/dist/js/demo.js"></script>
  </html>
  <?php endif;?>