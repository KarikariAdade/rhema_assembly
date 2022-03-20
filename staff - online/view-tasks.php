<?php
session_start();
include 'includes/connect.php';
include 'includes/news-counter.php';
$session_id = $_SESSION['id'];
?>
 <?php if (!isset($_SESSION['id'])):?>
 	<?php  echo "<script>window.location = 'sign-in.php';</script>"; ?>
 	<?php else:?>
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
  			<div class="container" style="margin-top: 3%;width: 98%;">
  				<div class="row">
  					<div class="col-md-12">
  			          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#all_tasks" data-toggle="tab" aria-expanded="false">All Tasks</a></li>
              <li class=""><a href="#private_tasks" data-toggle="tab" aria-expanded="true">Private Tasks</a></li>
              <li class=""><a href="#public_tasks" data-toggle="tab" aria-expanded="true">Public Tasks</a></li>
              <li class=""><a href="#halted_tasks" data-toggle="tab" aria-expanded="false">Halted Tasks</a></li>
              <li class=""><a href="#ongoing_tasks" data-toggle="tab" aria-expanded="false">Ongoing Tasks</a></li>
              <li class=""><a href="#completed_tasks" data-toggle="tab" aria-expanded="false">Completed Tasks</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="all_tasks">
              	<!-- /.row -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">All Tasks</h3>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
              	<?php
              	$task_sql = "SELECT * FROM tasklist ORDER BY id DESC";
              	$task_query = mysqli_query($conn, $task_sql);
              	if (mysqli_num_rows($task_query) > 0) {
              		while ($row = mysqli_fetch_assoc($task_query)) {
              			$user_id = $row['user_id'];
              		}
              	}
              	?>
                <tr>
                  <th>User ID</th>
                  <th>Creator</th>
                  <th>Scheduled Date</th>
                  <th>Scheduled Time</th>
                  <th>Status</th>
                  <th>Activity</th>
                  <th>Marker</th>
                   <?php if (isset($user_id) == $_SESSION['id']): ?>
                  <th>Option</th>
              <?php endif;?>
                </tr>
                <?php
              	$task_sql = "SELECT * FROM tasklist ORDER BY id DESC";
              	$task_query = mysqli_query($conn, $task_sql);
              	if (mysqli_num_rows($task_query) > 0) {
              		while ($row = mysqli_fetch_assoc($task_query)) {
              			$id = $row['id'];
              			$user_id = $row['user_id'];
              			$user_name = $row['user_name'];
              			$user_position = $row['user_position'];
              			$task_title = $row['task_title'];
              			$task_schedule_date = $row['task_schedule_date'];
              			$task_schedule_time = $row['task_schedule_time'];
              			$task_status = $row['task_status'];
              			$task_marker = $row['task_marker'];
              			$full_date = $task_schedule_date." ".$task_schedule_time;
              			$timestamp = strtotime($full_date);
              			$day = date("l M d Y",$timestamp);
              			$time = date("h:ia");
              	?>
                <tr>
                  <td><?php echo $id; ?></td>
                  <td><?php echo $user_name; ?></td>
                  <td><?php echo $day; ?></td>
                  <th><?php echo $time;?></th>
                  <td><span class="label label-success"><?php echo $task_status; ?></span></td>
                  <td><?php echo $task_title;?></td>
                  <?php if ($task_marker == "In Progress"): ?>
                   <td><span class="label label-warning"><?php echo $task_marker;?></span></td>
                   <?php elseif ($task_marker == "Completed"):?>
                   	<td><span class="label label-success"><?php echo $task_marker;?></span></td>
                   	<?php elseif($task_marker == "On Hold"):?>
                   		<td><span class="label label-danger"><?php echo $task_marker;?></span></td>
                   	<?php endif;?>
                   <?php if ($user_id == $_SESSION['id']): ?>
                   <td>  
                   	<div class="tools" style="display: inline-flex;margin-top: 3px;">
                    <a href="edit-task.php?task=<?php echo urlencode($task_title); ?>"><i class="fa fa-edit"></i></a>
                    <span><form method="POST" action="includes/delete-task.php">
                      <input type="hidden" name="task_id" value="<?php echo $id; ?>">
                    <button class="btn btn-xs" type="submit" style="background-color: transparent;" name="delete_task_btn"><i class="fa fa-trash"></i></button>
                  </form>
                </span>
                  </div></td>
              <?php endif;?>
                </tr>
                <?php
                	}
              	}
                ?>
              </table>
          </div>
      </div>
  </div>
</div>
</div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="private_tasks">
              	            	<!-- /.row -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Private Tasks</h3>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
              	<?php
              	$task_sql = "SELECT * FROM tasklist WHERE user_id='$session_id' AND task_status='Private' ORDER BY id DESC";
              	$task_query = mysqli_query($conn, $task_sql);
              	if (mysqli_num_rows($task_query) > 0) {
              		while ($row = mysqli_fetch_assoc($task_query)) {
              			$user_id = $row['user_id'];
              		}
              	}
              	?>
                <tr>
                  <th>User ID</th>
                  <th>Creator</th>
                  <th>Scheduled Date</th>
                  <th>Scheduled Time</th>
                  <th>Status</th>
                  <th>Activity</th>
                  <th>Marker</th>
                   <?php if (isset($user_id) == $_SESSION['id']): ?>
                  <th>Option</th>
              <?php endif;?>
                </tr>
                <?php
              	$task_sql = "SELECT * FROM tasklist WHERE user_id ='$session_id' AND task_status='Private' ORDER BY id DESC";
              	$task_query = mysqli_query($conn, $task_sql);
              	if (mysqli_num_rows($task_query) > 0) {
              		while ($row = mysqli_fetch_assoc($task_query)) {
              			$id = $row['id'];
              			$user_id = $row['user_id'];
              			$user_name = $row['user_name'];
              			$user_position = $row['user_position'];
              			$task_title = $row['task_title'];
              			$task_schedule_date = $row['task_schedule_date'];
              			$task_schedule_time = $row['task_schedule_time'];
              			$task_status = $row['task_status'];
              			$task_marker = $row['task_marker'];
              			$full_date = $task_schedule_date." ".$task_schedule_time;
              			$timestamp = strtotime($full_date);
              			$day = date("l M d Y",$timestamp);
              			$time = date("h:ia");
              	?>
                <tr>
                  <td><?php echo $id; ?></td>
                  <td><?php echo $user_name; ?></td>
                  <td><?php echo $day; ?></td>
                  <th><?php echo $time;?></th>
                  <td><span class="label label-success"><?php echo $task_status; ?></span></td>
                  <td><?php echo $task_title;?></td>
                  <?php if ($task_marker == "In Progress"): ?>
                   <td><span class="label label-warning"><?php echo $task_marker;?></span></td>
                   <?php elseif ($task_marker == "Completed"):?>
                   	<td><span class="label label-success"><?php echo $task_marker;?></span></td>
                   	<?php elseif($task_marker == "On Hold"):?>
                   		<td><span class="label label-danger"><?php echo $task_marker;?></span></td>
                   	<?php endif;?>
                   <?php if ($user_id == $_SESSION['id']): ?>
                   <td>  
                   	  <div class="tools" style="display: inline-flex;margin-top: 3px;">
                    <a href="edit-task.php?task=<?php echo urlencode($task_title); ?>"><i class="fa fa-edit"></i></a>
                    <span><form method="POST" action="includes/delete-task.php">
                      <input type="hidden" name="task_id" value="<?php echo $id; ?>">
                    <button class="btn btn-xs" type="submit" style="background-color: transparent;" name="delete_task_btn"><i class="fa fa-trash"></i></button>
                  </form>
                </span>
                  </div></td>
              <?php endif;?>
                </tr>
                <?php
                	}
              	}
                ?>
              </table>
          </div>
      </div>
  </div>
</div>
               </div>
<div class="tab-pane" id="public_tasks">
	            	<!-- /.row -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Public Tasks</h3>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
              	<?php
              	$task_sql = "SELECT * FROM tasklist WHERE task_status ='Public' ORDER BY id DESC";
              	$task_query = mysqli_query($conn, $task_sql);
              	if (mysqli_num_rows($task_query) > 0) {
              		while ($row = mysqli_fetch_assoc($task_query)) {
              			$user_id = $row['user_id'];
              		}
              	}
              	?>
                <tr>
                  <th>User ID</th>
                  <th>Creator</th>
                  <th>Scheduled Date</th>
                  <th>Scheduled Time</th>
                  <th>Status</th>
                  <th>Activity</th>
                  <th>Marker</th>
                   <?php if (isset($user_id) == $_SESSION['id']): ?>
                  <th>Option</th>
              <?php endif;?>
                </tr>
                <?php
              	$task_sql = "SELECT * FROM tasklist WHERE task_status = 'Public' ORDER BY id DESC";
              	$task_query = mysqli_query($conn, $task_sql);
              	if (mysqli_num_rows($task_query) > 0) {
              		while ($row = mysqli_fetch_assoc($task_query)) {
              			$id = $row['id'];
              			$user_id = $row['user_id'];
              			$user_name = $row['user_name'];
              			$user_position = $row['user_position'];
              			$task_title = $row['task_title'];
              			$task_schedule_date = $row['task_schedule_date'];
              			$task_schedule_time = $row['task_schedule_time'];
              			$task_status = $row['task_status'];
              			$task_marker = $row['task_marker'];
              			$full_date = $task_schedule_date." ".$task_schedule_time;
              			$timestamp = strtotime($full_date);
              			$day = date("l M d Y",$timestamp);
              			$time = date("h:ia");
              	?>
                <tr>
                  <td><?php echo $id; ?></td>
                  <td><?php echo $user_name; ?></td>
                  <td><?php echo $day; ?></td>
                  <th><?php echo $time;?></th>
                  <td><span class="label label-success"><?php echo $task_status; ?></span></td>
                  <td><?php echo $task_title;?></td>
                  <?php if ($task_marker == "In Progress"): ?>
                   <td><span class="label label-warning"><?php echo $task_marker;?></span></td>
                   <?php elseif ($task_marker == "Completed"):?>
                   	<td><span class="label label-success"><?php echo $task_marker;?></span></td>
                   	<?php elseif($task_marker == "On Hold"):?>
                   		<td><span class="label label-danger"><?php echo $task_marker;?></span></td>
                   	<?php endif;?>
                   <?php if ($user_id == $_SESSION['id']): ?>
                   <td>  
                   	  <div class="tools" style="display: inline-flex;margin-top: 3px;">
                    <a href="edit-task.php?task=<?php echo urlencode($task_title); ?>"><i class="fa fa-edit"></i></a>
                    <span><form method="POST" action="includes/delete-task.php">
                      <input type="hidden" name="task_id" value="<?php echo $id; ?>">
                    <button class="btn btn-xs" type="submit" style="background-color: transparent;" name="delete_task_btn"><i class="fa fa-trash"></i></button>
                  </form>
                </span>
                  </div>
                </td>
              <?php endif;?>
                </tr>
                <?php
                	}
              	}
                ?>
              </table>
          </div>
      </div>
  </div>
</div>
      </div>
              <div class="tab-pane" id="halted_tasks">
              	            	<!-- /.row -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Halted Tasks</h3>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
              	<?php
              	$task_sql = "SELECT * FROM tasklist WHERE user_id = '$session_id' AND task_marker ='On Hold' ORDER BY id DESC";
              	$task_query = mysqli_query($conn, $task_sql);
              	if (mysqli_num_rows($task_query) > 0) {
              		while ($row = mysqli_fetch_assoc($task_query)) {
              			$user_id = $row['user_id'];
              		}
              	}
              	?>
                <tr>
                  <th>User ID</th>
                  <th>Creator</th>
                  <th>Scheduled Date</th>
                  <th>Scheduled Time</th>
                  <th>Status</th>
                  <th>Activity</th>
                  <th>Marker</th>
                   <?php if (isset($user_id) == $_SESSION['id']): ?>
                  <th>Option</th>
              <?php endif;?>
                </tr>
                <?php
              	$task_sql = "SELECT * FROM tasklist WHERE user_id = '$session_id' AND task_marker ='On Hold' ORDER BY id DESC";
              	$task_query = mysqli_query($conn, $task_sql);
              	if (mysqli_num_rows($task_query) > 0) {
              		while ($row = mysqli_fetch_assoc($task_query)) {
              			$id = $row['id'];
              			$user_id = $row['user_id'];
              			$user_name = $row['user_name'];
              			$user_position = $row['user_position'];
              			$task_title = $row['task_title'];
              			$task_schedule_date = $row['task_schedule_date'];
              			$task_schedule_time = $row['task_schedule_time'];
              			$task_status = $row['task_status'];
              			$task_marker = $row['task_marker'];
              			$full_date = $task_schedule_date." ".$task_schedule_time;
              			$timestamp = strtotime($full_date);
              			$day = date("l M d Y",$timestamp);
              			$time = date("h:ia");
              	?>
                <tr>
                  <td><?php echo $id; ?></td>
                  <td><?php echo $user_name; ?></td>
                  <td><?php echo $day; ?></td>
                  <th><?php echo $time;?></th>
                  <td><span class="label label-success"><?php echo $task_status; ?></span></td>
                  <td><?php echo $task_title;?></td>
                  <?php if ($task_marker == "In Progress"): ?>
                   <td><span class="label label-warning"><?php echo $task_marker;?></span></td>
                   <?php elseif ($task_marker == "Completed"):?>
                   	<td><span class="label label-success"><?php echo $task_marker;?></span></td>
                   	<?php elseif($task_marker == "On Hold"):?>
                   		<td><span class="label label-danger"><?php echo $task_marker;?></span></td>
                   	<?php endif;?>
                   <?php if ($user_id == $_SESSION['id']): ?>
                   <td>  
                    <div class="tools" style="display: inline-flex;margin-top: 3px;">
                    <a href="edit-task.php?task=<?php echo urlencode($task_title); ?>"><i class="fa fa-edit"></i></a>
                    <span><form method="POST" action="includes/delete-task.php">
                      <input type="hidden" name="task_id" value="<?php echo $id; ?>">
                    <button class="btn btn-xs" type="submit" style="background-color: transparent;" name="delete_task_btn"><i class="fa fa-trash"></i></button>
                  </form>
                </span>
                  </div>
                </td>
              <?php endif;?>
                </tr>
                <?php
                	}
              	}
                ?>
              </table>
          </div>
      </div>
  </div>
</div>
              </div>
                <!-- /.tab-pane -->
              <div class="tab-pane" id="ongoing_tasks">
              	              	            	<!-- /.row -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Ongoing Tasks</h3>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
              	<?php
              	$task_sql = "SELECT * FROM tasklist WHERE task_marker ='In Progress' ORDER BY id DESC";
              	$task_query = mysqli_query($conn, $task_sql);
              	if (mysqli_num_rows($task_query) > 0) {
              		while ($row = mysqli_fetch_assoc($task_query)) {
              			$user_id = $row['user_id'];
              		}
              	}
              	?>
                <tr>
                  <th>User ID</th>
                  <th>Creator</th>
                  <th>Scheduled Date</th>
                  <th>Scheduled Time</th>
                  <th>Status</th>
                  <th>Activity</th>
                  <th>Marker</th>
                   <?php if (isset($user_id) == $_SESSION['id']): ?>
                  <th>Option</th>
              <?php endif;?>
                </tr>
                <?php
              	$task_sql = "SELECT * FROM tasklist WHERE task_marker ='In Progress' ORDER BY id DESC";
              	$task_query = mysqli_query($conn, $task_sql);
              	if (mysqli_num_rows($task_query) > 0) {
              		while ($row = mysqli_fetch_assoc($task_query)) {
              			$id = $row['id'];
              			$user_id = $row['user_id'];
              			$user_name = $row['user_name'];
              			$user_position = $row['user_position'];
              			$task_title = $row['task_title'];
              			$task_schedule_date = $row['task_schedule_date'];
              			$task_schedule_time = $row['task_schedule_time'];
              			$task_status = $row['task_status'];
              			$task_marker = $row['task_marker'];
              			$full_date = $task_schedule_date." ".$task_schedule_time;
              			$timestamp = strtotime($full_date);
              			$day = date("l M d Y",$timestamp);
              			$time = date("h:ia");
              	?>
                <tr>
                  <td><?php echo $id; ?></td>
                  <td><?php echo $user_name; ?></td>
                  <td><?php echo $day; ?></td>
                  <th><?php echo $time;?></th>
                  <td><span class="label label-success"><?php echo $task_status; ?></span></td>
                  <td><?php echo $task_title;?></td>
                  <?php if ($task_marker == "In Progress"): ?>
                   <td><span class="label label-warning"><?php echo $task_marker;?></span></td>
                   <?php elseif ($task_marker == "Completed"):?>
                   	<td><span class="label label-success"><?php echo $task_marker;?></span></td>
                   	<?php elseif($task_marker == "On Hold"):?>
                   		<td><span class="label label-danger"><?php echo $task_marker;?></span></td>
                   	<?php endif;?>
                   <?php if ($user_id == $_SESSION['id']): ?>
                   <td>  
                   	  <div class="tools" style="display: inline-flex;margin-top: 3px;">
                    <a href="edit-task.php?task=<?php echo urlencode($task_title); ?>"><i class="fa fa-edit"></i></a>
                    <span><form method="POST" action="includes/delete-task.php">
                      <input type="hidden" name="task_id" value="<?php echo $id; ?>">
                    <button class="btn btn-xs" type="submit" style="background-color: transparent;" name="delete_task_btn"><i class="fa fa-trash"></i></button>
                  </form>
                </span>
                  </div>
                </td>
              <?php endif;?>
                </tr>
                <?php
                	}
              	}
                ?>
              </table>
          </div>
      </div>
  </div>
</div>
               </div>
                <div class="tab-pane" id="completed_tasks">
              	              	            	<!-- /.row -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Completed Tasks</h3>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
              	<?php
              	$task_sql = "SELECT * FROM tasklist WHERE task_marker ='Completed' AND user_id='$session_id' ORDER BY id DESC";
              	$task_query = mysqli_query($conn, $task_sql);
              	if (mysqli_num_rows($task_query) > 0) {
              		while ($row = mysqli_fetch_assoc($task_query)) {
              			$user_id = $row['user_id'];
              		}
              	}
              	?>
                <tr>
                  <th>User ID</th>
                  <th>Creator</th>
                  <th>Scheduled Date</th>
                  <th>Scheduled Time</th>
                  <th>Status</th>
                  <th>Activity</th>
                  <th>Marker</th>
                   <?php if (isset($user_id) == $_SESSION['id']): ?>
                  <th>Option</th>
              <?php endif;?>
                </tr>
                <?php
              	$task_sql = "SELECT * FROM tasklist WHERE task_marker ='Completed' AND task_status='Public' ORDER BY id DESC";
              	$task_query = mysqli_query($conn, $task_sql);
              	if (mysqli_num_rows($task_query) > 0) {
              		while ($row = mysqli_fetch_assoc($task_query)) {
              			$id = $row['id'];
              			$user_id = $row['user_id'];
              			$user_name = $row['user_name'];
              			$user_position = $row['user_position'];
              			$task_title = $row['task_title'];
              			$task_schedule_date = $row['task_schedule_date'];
              			$task_schedule_time = $row['task_schedule_time'];
              			$task_status = $row['task_status'];
              			$task_marker = $row['task_marker'];
              			$full_date = $task_schedule_date." ".$task_schedule_time;
              			$timestamp = strtotime($full_date);
              			$day = date("l M d Y",$timestamp);
              			$time = date("h:ia");
              	?>
                <tr>
                  <td><?php echo $id; ?></td>
                  <td><?php echo $user_name; ?></td>
                  <td><?php echo $day; ?></td>
                  <th><?php echo $time;?></th>
                  <td><span class="label label-success"><?php echo $task_status; ?></span></td>
                  <td><?php echo $task_title;?></td>
                  <?php if ($task_marker == "In Progress"): ?>
                   <td><span class="label label-warning"><?php echo $task_marker;?></span></td>
                   <?php elseif ($task_marker == "Completed"):?>
                   	<td><span class="label label-success"><?php echo $task_marker;?></span></td>
                   	<?php elseif($task_marker == "On Hold"):?>
                   		<td><span class="label label-danger"><?php echo $task_marker;?></span></td>
                   	<?php endif;?>
                   <?php if ($user_id == $_SESSION['id']): ?>
                   <td>  
                   	<div class="tools" style="display: inline-flex;margin-top: 3px;">
                    <a href="edit-task.php?task=<?php echo urlencode($task_title); ?>"><i class="fa fa-edit"></i></a>
                    <span><form method="POST" action="includes/delete-task.php">
                      <input type="hidden" name="task_id" value="<?php echo $task_id; ?>">
                    <button class="btn btn-xs" type="submit" style="background-color: transparent;" name="delete_task_btn"><i class="fa fa-trash"></i></button>
                  </form>
                </span>
                  </div></td>
              <?php endif;?>
                </tr>
                <?php
                	}
              	}
                ?>
              </table>
          </div>
      </div>
  </div>
</div>
               </div>
              <!-- /.tab-pane -->
        <!-- /.col -->
            </div>
            <!-- /.tab-content -->
          </div>
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
</body>
</html>
<?php endif;?>