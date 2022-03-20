<?php
include 'includes/connect.php';
session_start();
?>
<?php if (!isset($_SESSION['id'])):?>
    <?php  echo "<script>window.location = 'sign-in.php';</script>"; ?>
    <?php else:?>
      <?php
      $admin_id = $_SESSION['id'];
?>  
      
<!DOCTYPE html>
<html>
<head>

  <script type="text/javascript">
       function on() { 
          $('#overlay').css('display', 'block');
    }

function off() {
  $('#overlay').css('display','none');
  }
</script>
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
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">
      <div id="overlay" onclick="off()"><div id="text"><?= $first_name;?>, please complete your profile set up <a href="add-profile.php">here</a>.</div></div>
     <?php include 'includes/dashboard-stats.php'; ?>
     
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable">
<?php include 'includes/todo_list.php'; ?>
<?php include 'includes/quick_email_widget.php'; ?>
 <?php
                    $counter_sql = "SELECT * FROM admin_profile";
                    $counter_query = mysqli_query($conn, $counter_sql);
                    ?>
               <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Church Staff</h3>

                  <div class="box-tools pull-right">
                    <span class="label label-danger"><?php echo mysqli_num_rows($counter_query); ?> Member (s)</span>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                  <ul class="users-list clearfix">
                    <?php
                    $sql = "SELECT * FROM admin_profile ORDER BY id DESC LIMIT 8";
                    $query = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($query) > 0) {
                      while ($row = mysqli_fetch_assoc($query)) {
                        $id = $row['id'];
                        $first_name = $row['first_name'];
                        $last_name = $row['last_name'];
                        $admin_image = $row['admin_image'];
                        $position = $row['position'];
                    ?>
                    <li>
                      <img src="<?php echo $admin_image; ?>" alt="User Image" style="height: 120px;width: 100%;">
                      <a class="users-list-name" href="staff-detail.php?staff=<?php echo urlencode($id);?>&slug=<?php echo urlencode($last_name);?>&user=<?php echo urlencode($first_name); ?>"><?php echo $last_name; ?></a>
                      <span class="users-list-date"><?php echo $position; ?></span>
                    </li>
                    <?php
                      }
                    }
                    ?>
                  </ul>
                  <!-- /.users-list -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                  <a href="view-staff.php" class="uppercase">View All Staff</a>
                </div>
                <!-- /.box-footer -->
              </div>

        </section>
        <div class="col-lg-4">
          <?php
          $admin_sql = "SELECT * FROM admin_profile WHERE id ='$admin_id'";
          $admin_query = mysqli_query($conn, $admin_sql);
          while ($row = mysqli_fetch_assoc($admin_query)) {
            $first_name = $row['first_name'];
            $last_name = $row['last_name'];
            $position = $row['position'];
            $address = $row['address'];
            $occupation =$row['occupation'];
            $admin_image = $row['admin_image'];
            $biography = $row['description'];
            if (strlen($biography) > 350){
        $biography = wordwrap($biography, 350);
        $biography =explode("\n", $biography);
        $biography = $biography[0]."...";
      }
          }
          ?>
            <div class="box box-primary">
            <div class="box-body box-profile">
           <?php if(isset($admin_image)):?>
              <img class="profile-user-img img-responsive img-circle" src="<?= $admin_image;?>" alt="User profile picture">
           <?php endif;?>

              <h3 class="profile-username text-center"><?php echo $first_name." ".$last_name; ?></h3>

              <p class="text-muted text-center"><?php echo $position; ?></p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Tasks</b> <a class="pull-right"><?php echo $tasklist_count; ?></a>
                </li>
                <li class="list-group-item">
                  <b>Messages</b> <a class="pull-right"><?php echo $inbox_counter; ?></a>
                </li>
                <li class="list-group-item">
                  <b>Staff</b> <a class="pull-right"><?php echo $staff_count; ?></a>
                </li>
              </ul>

              <a href="view-profile.php" class="btn btn-primary btn-block"><b>View Profile</b></a>
            </div>
            <!-- /.box-body -->
          </div>
         <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">About Me</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-address-card margin-r-5"></i> Staff Position</strong>

              <p class="text-muted">
                <?php if (isset($position)){ echo $position; }?>
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Address</strong>

              <p class="text-muted"><?php if (isset($address)){ echo $address; }?></p>

              <hr>

              <strong><i class="fa fa-user-tie margin-r-5"></i>Other Occupation</strong>

              <p>
                <span class="label label-danger"><?php if (isset($occupation)){ echo $occupation; }?></span>
              </p>

              <hr>

              <strong><i class="fa fa-clipboard margin-r-5"></i> Biography</strong>

              <p><?php echo $biography; ?></p>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
      </div>
      <!-- /.row (main row) -->
    </section>
    <!-- /.content -->
  </div>
  <div class="task_function">
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
<?php include 'includes/aside.php'; ?>
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
<script src="../assets/dist/js/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../assets/dist/js/demo.js"></script>
<script type="text/javascript" src="assets/js/sweetalert.min.js"></script>
<?php if(empty($security_question)):?>
 <script>
  $(document).ready(function(){
    on();
  }
)
</script>
<?php endif;?>
<script type="text/javascript">
 $('.task_function').load('includes/task_function.php');
</script>
</body>
</html>

<?php endif; ?>