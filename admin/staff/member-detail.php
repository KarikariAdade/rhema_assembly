<?php
include 'includes/connect.php';
session_start();
$id = $_SESSION['id'];
$errorMsg ='';
?>
<?php if (!isset($_SESSION['id'])):?>
  <?php  echo "<script>window.location = 'sign-in.php';</script>"; ?>
  <?php elseif(!isset($_GET['member']) && !isset($_GET['slug']) && !isset($_GET['user'])):?>
  <?php echo "<script>window.location = 'view-staff.php';</script>"; ?>
  <?php else:?>
<?php

// Fetch admin position to restrict view of member details

$sql = "SELECT * FROM admin_profile WHERE id='$id'";
$query = mysqli_query($conn, $sql);
if (mysqli_num_rows($query) > 0) {
  while ($row = mysqli_fetch_assoc($query)) {
    $position = $row['position'];
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

      // Fetch member details using $_GET
      $staff = $_GET['member'];
      $slug = $_GET['slug'];
      $user = $_GET['user'];
      ?>
      <div class="row" style="margin-top: 5%;">
        <?php 
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
            $home_cell_group = $row['home_cell_group'];
            $bible_study_group = $row['bible_study_group'];
            $member_picture = $row['picture'];
            // echo $member_picture;
            if (isset($member_picture)) {
              $member_picture = explode('/', $member_picture);
               $member_picture = '../'.$member_picture[5].'/'.$member_picture[6].'/'.$member_picture[7].'/'.$member_picture[8];
            }
           

            $timestamp = strtotime($birthdate);
            // echo $birthdate;
            $diff = (date('Y') - date('Y', strtotime($birthdate)));
            $date = date("l, M d Y", $timestamp);
             
          }
        }
        ?>
        <div class="col-md-3">
         <!-- Profile Image -->
         <div class="box box-primary">
          <div class="box-body box-profile">
 <?php if(isset($member_picture)):?>
              <img class="profile-user-img img-responsive img-circle" src="<?= $member_picture;?>" alt="User profile picture">
            <?php endif;?>
            <h3 class="profile-username text-center"><?php echo $first_name." ".$last_name;?></h3>

            <p class="text-muted text-center"><?php echo $ministry; ?></p>

            <ul class="list-group list-group-unbordered">
              <li class="list-group-item">
                <b>Gender</b> <a class="pull-right"><?php echo $gender; ?></a>
              </li>

              <li class="list-group-item">
                <b>Email</b> <a class="pull-right"><?php echo $email; ?></a>
              </li>
              <li class="list-group-item">
                <b>Phone</b> <a class="pull-right"><?php echo $phone; ?></a>
              </li>
              <li class="list-group-item">
                <b>Occupation</b> <a class="pull-right"><?php echo $occupation; ?></a>
              </li>
              <li class="list-group-item" style="padding-bottom: 15%;">
                <b>Address</b> <a class="pull-right"><?php echo $address; ?></a>
              </li>
              <li class="list-group-item">
                <b>Birthdate</b> <a class="pull-right"><?php echo $date; ?></a>
              </li>
              <li class="list-group-item">
                <b>Age</b> <a class="pull-right"><?php echo $diff. ' year(s)'; ?></a>
              </li>
              <li class="list-group-item">
                <b>Ministry</b> <a class="pull-right"><?php echo $ministry; ?></a>
              </li>
              <li class="list-group-item">
                <b>Duration</b> <a class="pull-right"><?= time_ago($year_duration); ?></a>
              </li>
              <li class="list-group-item">
                <b>Marital Status</b> <a class="pull-right"><?php echo $marital_status; ?></a>
              </li>
              <li class="list-group-item">
                <b>Home Cell Group</b> <a class="pull-right"><?php echo $home_cell_group; ?></a>
              </li>
              <li class="list-group-item">
                <b>Bible Studies Group</b> <a class="pull-right"><?php echo $bible_study_group; ?></a>
              </li>
              <?php if($baptism == "Yes"): ?>
                <li class="list-group-item">
                  <b>Baptism</b> <a class="pull-right">Baptised</a>
                </li>
                <?php else:?>
                  <li class="list-group-item">
                    <b>Baptism</b> <a class="pull-right">Not Baptised</a>
                  </li>
                <?php endif;?>
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
            <?php if($position == "Presiding Elder"):?>
              <li class=""><a href="#editmember" data-toggle="tab" aria-expanded="true">Edit Member</a></li>
            <?php endif;?>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="description">
              <div class="row">
                <div class="col-md-10">
                  <h4>Biography</h4>
                  <p><?php echo $user_comment; ?></p>
                </div>
              </div>
            </div>
            <!-- <div class="tab-content"> -->
              <div class="tab-pane" id="editmember">
               <p id="formError" style="margin-bottom: -1%;"></p>
               <form class="row" method="POST" action="" style="padding-top: 4%;" id="membership_form">
                <input type="hidden" name="member_id" id="member_id" value="<?php echo $member_id; ?>">
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
                  <label>Marital Status *</label>
                  <div class="form-group credential_form">
                    <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="marital_status" id="marital_status">
                      <option><?php echo $marital_status; ?></option>
                      <option>In a Relationship</option>
                      <option>Single</option>
                      <option>Married</option>
                      <option>Divorced</option>
                      <option>Complicated</option>
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
                  <label>Home Cell Group *</label>
                  <div class="form-group credential_form">
                    <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="home_cell_group" id="home_cell_group">
                      <option><?php echo $home_cell_group; ?></option>
                      <?php
                      $sql = "SELECT * FROM study_groups WHERE group_category = 'Home Cells';";
                      $query = mysqli_query($conn, $sql);
                      while ($row = mysqli_fetch_assoc($query)) {
                        ?>
                        <option><?php echo $row['group_name']; ?></option>
                        <?php
                      }
                      ?>

                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <label>Bible Study Group *</label>
                  <div class="form-group credential_form">
                    <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="bible_study_group" id="bible_study_group">
                      <option><?php echo $bible_study_group; ?></option>
                      <?php
                      $sql = "SELECT * FROM study_groups WHERE group_category = 'Bible Studies';";
                      $query = mysqli_query($conn, $sql);
                      while ($row = mysqli_fetch_assoc($query)) {
                        ?>
                        <option><?php echo $row['group_name']; ?></option>
                        <?php
                      }
                      ?>

                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                <p align="center"><button class="btn btn-primary" type="submit" id="member_update_btn">Update Member</button></p>
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
    $('#membership_form').submit(function (e){
      e.preventDefault();
      var home_cell_group = $('#home_cell_group').val();
      var bible_study_group = $('#bible_study_group').val();
      var member_id = $('#member_id').val();
      var address = $('#address').val();
      var email = $('#email').val();
      var phone = $('#phone').val();
      var occupation = $('#occupation').val();
      var ministry = $('#ministry').val();
      var marital_status = $('#marital_status').val();
      var baptism = $('#baptism').val();
      var member_update_btn = $('#member_update_btn').val();
      $('#formError').load('includes/membership-update.php',{
        member_id: member_id,
        home_cell_group: home_cell_group,
        bible_study_group: bible_study_group,
        address: address,
        email: email,
        phone: phone,
        occupation: occupation,
        ministry: ministry,
        marital_status: marital_status,
        baptism: baptism,
        member_update_btn: member_update_btn
      })
    })
  });
</script>
</body>
</html>
<?php endif;?>