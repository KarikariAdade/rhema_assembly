<?php
include 'includes/connect.php';
session_start();
$id = $_SESSION['id'];
$errorMsg ='';
?>
<?php if (!isset($_SESSION['id'])):?>
    <?php  echo "<script>window.location = 'sign-in.php';</script>"; ?>
    <?php elseif(!isset($_GET['staff']) && !isset($_GET['slug']) && !isset($_GET['user'])):?>
    <?php echo "<script>window.location = 'view-staff.php';</script>"; ?>
    <?php else:?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Rhema Assembly | Admin Dashboard</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="../assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/dist/css/all.css">
  <link rel="stylesheet" href="../assets/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css">
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
      $staff = $_GET['staff'];
      $slug = $_GET['slug'];
      $user = $_GET['user'];

      $leader_sql = "SELECT * FROM study_groups WHERE coordinator_id='$staff'";
      $leader_query = mysqli_query($conn, $leader_sql);
      while ($row = mysqli_fetch_assoc($leader_query)) {
        $group_name = $row['group_name'];
      }
      ?>
      <div class="row" style="margin-top: 5%;">
        <?php 
        $profile_sql = "SELECT * FROM admin_profile WHERE id='$staff' AND last_name='$slug' AND first_name = '$user'";
        $profile_query = mysqli_query($conn, $profile_sql);
        if (mysqli_num_rows($profile_query) > 0) {
          while ($row = mysqli_fetch_assoc($profile_query)) {
            $admin_id = $row['id'];
            $full_name = $row['first_name']." ".$row['last_name'];
            $email = $row['email'];
            $position = $row['position'];
            $occupation = $row['occupation'];
            $address = $row['address'];
            $status = $row['status'];
            $description = $row['description'];
            $admin_image = $row['admin_image'];
            $phone = $row['phone'];
          }
        }
        ?>
        <div class="col-md-3">
           <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="<?php echo $admin_image; ?>" alt="User profile picture">

              <h3 class="profile-username text-center"><?php echo $full_name;?></h3>

              <p class="text-muted text-center"><?php echo $position; ?></p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Email</b> <a class="pull-right"><?php echo $email; ?></a>
                </li>
                <li class="list-group-item">
                  <b>Phone</b> <a class="pull-right"><?php echo $phone; ?></a>
                </li>
                <li class="list-group-item">
                  <b>Occupation</b> <a class="pull-right"><?php echo $occupation; ?></a>
                </li>
                <?php if(!empty($group_name)):?>
                <li class="list-group-item">
                  <b>Leader of Group</b> <a class="pull-right"><?php echo $group_name; ?></a>
                </li>
              <?php endif;?>
                 <li class="list-group-item" style="padding-bottom: 15%;">
                  <b>Address</b> <a class="pull-right"><?php echo $address; ?></a>
                </li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <div class="col-md-8">
          <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#description" data-toggle="tab" aria-expanded="false">More Details</a></li>
                  <li class=""><a href="#gallery" data-toggle="tab" aria-expanded="true">Gallery</a></li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="description">
                    <div class="row">
                      <div class="col-md-10">
                        <h4>Biography</h4>
                        <p><?php echo $description; ?></p>
                      </div>
                    </div>
                  </div>
                  <!-- <div class="tab-content"> -->
                  <div class="tab-pane" id="gallery">
                    <div class="row">

                      <?php
                      $pictures_sql = "SELECT * FROM profile_pictures WHERE user_id='$staff'";
                      $picture_query = mysqli_query($conn, $pictures_sql);
                      if (mysqli_num_rows($picture_query) > 0) {
                        while ($row = mysqli_fetch_assoc($picture_query)) {
                          $user_id = $row['user_id'];
                          $picture = $row['picture'];
                          $date = $row['date_added'];
                        }
                      }
                      ?>
                      <div class="col-md-4">
                        <div>
                        <span id="staff_uploaded_pic">Uploaded <?php echo time_ago($date); ?></span>
                      <a href="<?php echo $picture; ?>" data-lightbox="gallery_image" id="shit">
                <img src="<?php echo $picture; ?>" class="img-responsive" id="staff_pic"></a>
              </div>
                      </div>

                    </div>
                  </div>
                <!-- </div> -->
                </div>
                
              </div>
        </div>
      </div>
      </div>
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
<script src="../assets/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../assets/dist/js/demo.js"></script>
<script type="text/javascript" src="../assets/js/lightbox.min.js"></script>
</body>
</html>
<?php endif;?>