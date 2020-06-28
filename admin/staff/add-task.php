<?php
session_start();
include 'includes/connect.php';
include 'includes/news-counter.php';
include 'includes/task_function.php';
$id = $_SESSION['id'];
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
<?php
$sql = "SELECT * FROM admin_profile WHERE id='$id'";
$query = mysqli_query($conn, $sql);
if (mysqli_num_rows($query) > 0) {
  while ($row = mysqli_fetch_assoc($query)) {
    $admin_id = $row['id'];
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $position = $row['position'];

    $full_name = $first_name." ".$last_name;
  }
}
?>
        <div class="container" style="margin-top: 5%;">
          <div class="row">
            <div class="col-md-7">

              <div class="add_profile_container" style="background-color: #fff; padding:20px !important;">
                <p id="formError" style="padding-bottom: 2%;"></p>
                <form role="form" class="row add_task_form" method="POST" action="add-task.php" enctype="multipart/form-data">
            <input type="hidden" name="full_name" id="full_name" value="<?php echo $full_name;?>">
            <input type="hidden" name="admin_id" id="admin_id" value="<?php echo $admin_id ?>">
            <input type="hidden" name="position" id="position" value="<?php echo $position; ?>">
              <div class="box-body col-md-6">
                <label>Task Title</label>
                <div class="input-group credential_form">
                  <div class="input-group-addon credential_form">
                    <i class="fa fa-id-badge"></i>
                  </div>
                  <input type="text" class="form-control" name="task_title" id="task_title">
                </div>
              </div>
              <div class="box-body col-md-6">
                <label>Task Schedule Date</label>
                <div class="input-group credential_form">
                  <div class="input-group-addon credential_form">
                    <i class="fa fa-id-badge"></i>
                  </div>
                  <input type="date" class="form-control" name="task_title" id="task_schedule_date">
                </div>
              </div>
               <div class="box-body col-md-6">
                <label>Task Schedule Time</label>
                <div class="input-group credential_form">
                  <div class="input-group-addon credential_form">
                    <i class="fa fa-id-badge"></i>
                  </div>
                  <input type="time" class="form-control" name="task_title" id="task_schedule_time">
                </div>
              </div>
              <div class="box-body col-md-6">
                <label>Task Status</label>
                <div class="form-group credential_form">
                  <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" id="task_status" name="task_status">
                    <option selected="selected">Private</option>
                    <option>Public</option>
                  </select>
                </div>
              </div>
              
              <div class="box-body col-md-12">
                <div class="form-group credential_form">
                  <label style="padding: 10px 10px;">Task Description</label>
                  <textarea class="form-control" rows="10" placeholder="Please write something about the task" name="task_description" id="task_description" style="width:100% !important;"></textarea>
                </div>
              </div>

              <!-- /.box-body -->

              <div class="col-md-4" style="padding-bottom: 3%;">
                <button type="submit" class="btn btn-primary" name="add_task_btn" id="add_task_btn">Submit</button>
              </div>
            </form>
            </div>
          </div>
            <div class="col-md-4">
             
          <!-- TO DO List -->
          <div class="box box-primary" style="margin-top: 5%;">
            <div class="box-header">
              <i class="ion ion-clipboard"></i>

              <h3 class="box-title">Your Tasks</h3>

              <div class="box-tools pull-right">
                <button class="btn btn-xs btn-primary"><a href="view-tasks.php" style="color: #fff;">View All Tasks</a></button>
                

              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            
              <ul class="todo-list">
                <?php
                $task_sql = "SELECT * FROM tasklist WHERE user_id='$id'";
                $task_query = mysqli_query($conn, $task_sql);
                if (mysqli_num_rows($task_query) > 0) {
                  while ($row = mysqli_fetch_assoc($task_query)) {
                    $user_id = $row['user_id'];
                    $task_id = $row['id'];
                    $task_title = $row['task_title'];
                    $task_date = $row['task_schedule_date'];
                    $task_time = $row['task_schedule_time'];
                    $task_status = $row['task_status'];
                    $full_time = $task_date." ".$task_time;

                ?>
                <li style="padding-bottom: 8%;">
               
                  <!-- todo text -->
                  <span class="text"><?php echo $task_title; ?></span>
                  <!-- Emphasis label -->
                  <small class="label label-danger"><i class="fa fa-clock"></i> <?php echo time_ago($full_time); ?></small>
                  <?php if($task_status == 'Private'): ?>
                  <small class="label label-primary"><i class="fa fa-user-tie"></i> Private</small>
                <?php endif;?>
                <?php if ($task_status == 'Public'): ?>
                  <small class="label label-danger"><i class="fa fa-users"></i> Public</small>
                <?php endif;?>
                  <!-- General tools such as edit or delete-->
                  <div class="tools" style="display: inline-flex;margin-top: 3px;">
                    <a href="edit-task.php?task=<?php echo urlencode($task_title); ?>"><i class="fa fa-edit"></i></a>
                    <span><form method="POST" action="includes/delete-task.php">
                      <input type="hidden" name="task_id" value="<?php echo $task_id; ?>">
                    <button class="btn btn-xs" type="submit" style="background-color: transparent;" name="delete_task_btn"><i class="fa fa-trash"></i></button>
                  </form>
                </span>
                  </div>
                </li>
                <?php
         }
                }
                ?>
              </ul>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix no-border">
              <button type="button" class="btn btn-default pull-right"><a href="add-task.php"><i class="fa fa-plus"></i> Add Task</a></button>
            </div>
          </div>
          <!-- /.box -->
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
  <script type="text/javascript">
    $(document).ready(function (){
      $('.add_task_form').submit(function (event){
        event.preventDefault();
        var full_name = $('#full_name').val();
        var admin_id = $('#admin_id').val();
        var position = $('#position').val();
        var task_title = $('#task_title').val();
        var task_schedule_date = $('#task_schedule_date').val();
        var task_schedule_time = $('#task_schedule_time').val();
        var task_status = $('#task_status').val();
        var task_description = $('#task_description').val();
        var add_task_btn = $('#add_task_btn').val();
        $('#formError').load('includes/add-task.php',{
          full_name: full_name,
          admin_id: admin_id,
          position: position,
          task_title: task_title,
          task_schedule_time: task_schedule_time,
          task_status: task_status,
          task_schedule_date: task_schedule_date,
          task_description: task_description,
          add_task_btn: add_task_btn
        });
      });
    });
  </script>
  </html>
  <?php endif;?>