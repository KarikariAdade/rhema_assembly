<?php
include 'includes/connect.php';
session_start();
$id = $_SESSION['id'];
$errorMsg ='';
?>
<?php if (!isset($_SESSION['id'])):?>
    <?php  echo "<script>window.location = 'sign-in.php';</script>"; ?>
    <?php elseif(!isset($_GET['volunteer']) && !isset($_GET['slug']) && !isset($_GET['user'])):?>
    <?php echo "<script>window.location = 'view-volunteers.php';</script>"; ?>
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
      $staff = $_GET['volunteer'];
      $slug = $_GET['slug'];
      $user = $_GET['user'];
      ?>
      <div class="row" style="margin-top: 5%;">
        <?php 
        $member_sql = "SELECT * FROM volunteers WHERE id='$staff' AND company='$slug' AND full_name = '$user'";
      $member_query = mysqli_query($conn, $member_sql);
      if (mysqli_num_rows($member_query) > 0) {
                    while ($row = mysqli_fetch_assoc($member_query)) {
                      $volunteer_id = $row['id'];
                      $full_name = $row['full_name'];
                      $email = $row['email'];
                      $ministry = $row['ministry'];
                      $event = $row['event'];
                      $phone = $row['phone'];
                      $company = $row['company'];
                      $comment = $row['comment'];
                      $address = $row['address'];
                    }
                  }
      ?>
        <div class="col-md-3">
           <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
          
              <h3 class="profile-username text-center"><?php echo $full_name;?></h3>
              <?php if(isset($ministry)): ?>
              <li class="list-group-item">
                  <b>Ministry</b> <a class="pull-right"><?php echo $ministry; ?></a>
                </li>
            <?php endif;?>
            <?php if (isset($event)): ?>
               <li class="list-group-item">
                  <b>Event</b> <a class="pull-right"><?php echo $event; ?></a>
                </li>
            <?php endif;?>
                <li class="list-group-item">
                  <b>Email</b> <a class="pull-right"><?php echo $email; ?></a>
                </li>
                <li class="list-group-item">
                  <b>Phone</b> <a class="pull-right"><?php echo $phone; ?></a>
                </li>
                <li class="list-group-item">
                  <b>Company</b> <a class="pull-right"><?php echo $company; ?></a>
                </li>
                <li class="list-group-item" style="padding-bottom: 14%;">
                  <b>Address</b> <a class="pull-right"><?php echo $address; ?></a>
                </li>

              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <style type="text/css">
          form .col-md-6{
            padding-bottom: 4%;
          }
        </style>
        <div class="col-md-8">
          <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#description" data-toggle="tab" aria-expanded="false">More Details</a></li>
                  <li class=""><a href="#editmember" data-toggle="tab" aria-expanded="true">Edit Volunteer</a></li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="description">
                    <div class="row">
                      <div class="col-md-10">
                        <h4>Biography</h4>
                        <p><?php echo $comment; ?></p>
                      </div>
                    </div>
                  </div>
                  <!-- <div class="tab-content"> -->
                  <div class="tab-pane" id="editmember">
                 <p id="formError" style="margin-bottom: -1%;"></p>
             <form class="row" method="POST" action="" style="padding:2% 10px;" id="volunteer_form">
              <input type="hidden" value="<?php echo $volunteer_id; ?>" name="e_volunteer_id" id="e_volunteer_id">
                <div class="col-md-6">
                  <label>Full Name *</label>
                  <div class="input-group credential_form">
                    <div class="input-group-addon credential_form">
                      <i class="fa fa-user-tie"></i>
                    </div>
                    <input type="text" class="form-control" name="e_full_name" id="e_full_name" value="<?php echo $full_name; ?>" />
                  </div>
                </div>
                 <div class="col-md-6">
                  <label>Phone *</label>
                  <div class="input-group credential_form">
                    <div class="input-group-addon credential_form">
                      <i class="fa fa-phone"></i>
                    </div>
                    <input type="tel" class="form-control" name="e_phone" id="e_phone" value="<?php echo $phone; ?>" />
                  </div>
                </div>
                 <div class="col-md-6">
                  <label>Company *</label>
                  <div class="input-group credential_form">
                    <div class="input-group-addon credential_form">
                      <i class="fa fa-building"></i>
                    </div>
                    <input type="text" class="form-control" name="e_company" id="e_company" value="<?php echo $company; ?>" />
                  </div>
                </div>
                <div class="col-md-6">
                  <label>House Address *</label>
                  <div class="input-group credential_form">
                    <div class="input-group-addon credential_form">
                      <i class="fa fa-building"></i>
                    </div>
                    <input type="text" class="form-control" name="e_house_address" id="e_house_address" value="<?php echo $address; ?>"/>
                  </div>
                </div>
                 <div class="col-md-6">
                  <label>Email *</label>
                  <div class="input-group credential_form">
                    <div class="input-group-addon credential_form">
                      <i class="fa fa-envelope"></i>
                    </div>
                    <input type="email" class="form-control" name="e_email" id="e_email" value="<?php echo $email; ?>" />
                  </div>
                </div>
                  <div class="col-md-6">
                  <label>Volunteer Events *</label>
                  <div class="form-group credential_form">
                    <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="e_event" id="e_event">
                      <option><?php if (isset($event)){echo $event;} ?></option>
                    <option>Crusade</option>
                    <option>Sunday Service</option>
                    <option>Camp Meetings</option>
                    <option>Visitations</option>
                    <option>Evangelism</option>
                    <option>General Events</option>
                    </select>
                  </div>
                </div>
                  <div class="col-md-6">
                  <label>Serve God through *</label>
                  <div class="form-group credential_form">
                    <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="e_ministry" id="e_ministry">
                      <option><?php if(isset($ministry)){echo $ministry;} ?></option>
                   <option>Youth Ministry</option>
                    <option>Men Ministry</option>
                    <option>Women Ministry</option>
                    <option>Children Ministry</option>
                    <option>Evangelism Ministry</option>
                    </select>
                  </div>
                </div>
                <div class="box-body col-md-12">
                <div class="form-group credential_form">
                  <label style="padding: 10px 10px;">Comments/Feedback/Contribution</label>
                  <textarea class="form-control" rows="10" id="e_user_comment" name="e_user_comment"><?php echo $comment; ?></textarea>
                </div>
                <p align="center"><button class="btn btn-primary" type="submit" name="e_volunteer_submit_btn" id="e_volunteer_update_btn">Update Volunteer</button></p>
              </div>

              </form>
                </div>
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
<script type="text/javascript">
    $(document).ready(function (){
       $('#volunteer_form').submit(function (event) {
            event.preventDefault();
            var e_full_name = $('#e_full_name').val();
            var e_volunteer_id = $('#e_volunteer_id').val();
            var e_phone = $('#e_phone').val();
            var e_company = $('#e_company').val();
            var e_email = $('#e_email').val();
            var e_event = $('#e_event').val();
            var e_ministry = $('#e_ministry').val();
            var e_user_comment = $('#e_user_comment').val();
            var e_house_address = $('#e_house_address').val();
            var e_volunteer_submit_btn = $('#e_volunteer_update_btn').val();
            $('#formError').load('includes/volunteer-update.php',{
              e_volunteer_id: e_volunteer_id,
              e_full_name: e_full_name,
              e_phone: e_phone,
              e_company: e_company,
              e_email: e_email,
              e_event: e_event,
              e_ministry: e_ministry,
              e_house_address: e_house_address,
              e_user_comment: e_user_comment,
              e_volunteer_submit_btn: e_volunteer_submit_btn
            });
          });
    });
  </script>
</body>
</html>
<?php endif;?>