<?php
session_start();
include 'includes/connect.php';
$id = $_SESSION['id'];
$errorMsg ='';
?>
<?php if (!isset($_SESSION['id'])):?>
    <?php  echo "<script>window.location = 'sign-in.php';</script>"; ?>
    <?php else:?>
      <?php include 'includes/profile-stats.php';?>
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
    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
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
                <li class="list-group-item">
                  <b>Email</b> <a class="pull-right"><?php if(isset($email)){echo $email;} ?></a>
                </li>
                <li class="list-group-item">
                  <?php if (isset($_POST['change_picture_btn'])) :?>
                  <p id="formError"><?php echo $errorMsg; ?></p>
                <?php endif;?>
                  <form method="POST" enctype="multipart/form-data" action="view-profile.php">
                    <input type="hidden" name="user_id" value="<?php echo $id; ?>">
                    <input type="hidden" name="user_picture" value="<?php echo $admin_image; ?>">
                    <input type="hidden" name="user_name" value="<?php echo $first_name." ".$last_name; ?>">
                    <input type="hidden" name="position" value="<?php echo $position; ?>">
                    <input type="hidden" name="email" value="<?php echo $email; ?>">
                    <label><?= ((isset($admin_image))?'Change Profile':'Add Profile') ?> Picture</label>
                    <input type="file" name="change_picture"><br>
                    <button class="btn btn-xs btn-primary" name="change_picture_btn" type="submit"><?= ((isset($admin_image))?'Change Profile':'Add Profile') ?> Picture</button>
                  </form>
                  <?php
                  if (isset($_POST['change_picture_btn'])) {
                   $name = $_POST['user_name']; 
                   $file_name = $_FILES['change_picture']['name'];
            $file_size = $_FILES['change_picture']['size'];
            $file_tmp_name = $_FILES['change_picture']['tmp_name'];
            $file_type = $_FILES['change_picture']['type'];
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
                        $errorMsg = $full_image_path;
                        $sql = "UPDATE admin_profile SET
                         admin_image = '$full_image_path' WHERE id = '$id'
                        ";
                        $query = mysqli_query($conn, $sql);

                        $profile_sql = "INSERT INTO profile_pictures(user_id, user_position, user_name, user_email, date_added,picture) VALUES('$id', '$position', '$name', '$email', now(), '$full_image_path')";
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
                  ?>
                </li>
              </ul>

              
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
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

              <strong><i class="fa fa-map-marker-alt margin-r-5"></i> Address</strong>

              <p class="text-muted"><?php if (isset($address)){ echo $address; }?></p>

 <hr>

              <strong><i class="fa fa-phone margin-r-5"></i> Contact</strong>

              <p class="text-muted"><?php if (isset($phone)){ echo $phone; }?></p>
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
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab" aria-expanded="false">Statistics</a></li>
              <li class=""><a href="#gallery" data-toggle="tab" aria-expanded="true">Gallery</a></li>
              <li class=""><a href="#settings" data-toggle="tab" aria-expanded="false">Edit Profile</a></li>
              <li class=""><a href="#change_password" data-toggle="tab" aria-expanded="false">Change Password</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="activity">
                <div class="row">
                  <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-navy"><i class="fa fa-flag"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Events</span>
              <span class="info-box-number"><?php echo $event_count; ?></span>
            </div>
          </div>
        </div>
          <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-navy"><i class="fa fa-newspaper"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">News</span>
              <span class="info-box-number"><?php echo $news_count ?></span>
            </div>
          </div>
        </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-navy"><i class="fa fa-info"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Announcements</span>
              <span class="info-box-number"><?php echo $announcement_count; ?></span>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-navy"><i class="fa fa-bible"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Sermons</span>
              <span class="info-box-number"><?php echo $sermon_count; ?></span>
            </div>
          </div>
        </div>
          <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-navy"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Members</span>
              <span class="info-box-number"><?php echo $member_count; ?></span>
            </div>
          </div>
        </div>
          <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-navy"><i class="fa fa-handshake"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Baptised Members</span>
              <span class="info-box-number"><?php echo $baptised_count; ?></span>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-navy"><i class="fa fa-hands-helping"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Non-Baptised Members</span>
              <span class="info-box-number"><?php echo $non_baptised_count; ?></span>
            </div>
          </div>
        </div>
          <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-navy"><i class="fa fa-users-cog"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Volunteers</span>
              <span class="info-box-number"><?php echo $volunteer_count; ?></span>
            </div>
          </div>
        </div>
         <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-navy"><i class="fa fa-user-tie"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Staff</span>
              <span class="info-box-number"><?php echo $staff_count; ?></span>
            </div>
          </div>
        </div>
         <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-navy"><i class="fa fa-user-friends"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Study Groups</span>
              <span class="info-box-number"><?php echo $study_groups_count; ?></span>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-navy"><i class="fa fa-user-tag"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Home Cell Groups</span>
              <span class="info-box-number"><?php echo $home_cell_count; ?></span>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-navy"><i class="fa fa-user-tag"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Bible Study Groups</span>
              <span class="info-box-number"><?php echo $bible_study_count; ?></span>
            </div>
          </div>
        </div>
          <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-navy"><i class="fa fa-envelope-open"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Private Messages</span>
              <span class="info-box-number"><?php echo $inbox_counter; ?></span>
            </div>
          </div>
        </div>
                </div>
              </div>
<div class="tab-pane" id="gallery">
             <div class="row">
              <?php
              $gallery_sql = "SELECT * FROM profile_pictures WHERE user_id='$id' ORDER BY id DESC";
              $gallery_query = mysqli_query($conn, $gallery_sql);
              $gallery_counter = mysqli_num_rows($gallery_query);
              ?>
              <h3 align="center"><?= (($gallery_counter > 0)?'Take a look at your uploaded pictures so far':'')?></h3>
              <?php
              if ($gallery_counter > 0) {
                while ($row = mysqli_fetch_assoc($gallery_query)) {
                $picture_id = $row['id'];
                  $user_id = $row['user_id'];
                  $user_name = $row['user_name'];
                  $user_email= $row['user_email'];
                  $date_added = $row['date_added'];
                  $picture = $row['picture'];
              ?>
              <div class="col-md-4">
                <div class="profile_gallery">
                  <div class="profile_gallery_form">
                  <form method="POST" action="" enctype="multipart/form-date">
                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                    <input type="hidden" name="picture_id" value="<?= $picture_id;?>">
                    <input type="hidden" name="picture" value="<?php echo $picture; ?>">
                    <button type="submit" class="btn btn-danger btn-sm" id="profile_gallery_remove" name="remove_profile_picture" onclick="return confirm('Are you sure you want to delete this Picture?')">Delete</button>
                  </form>
                </div>
                <div class="profile_gallery_delete">
                  <form method="POST" action="view-profile.php">
                    <input type="hidden" name="user_id_change" value="<?php echo $user_id; ?>">
                    <input type="hidden" name="profile_picture_change" value="<?php echo $picture; ?>">
                    <button type="submit" class="btn btn-primary btn-sm" name="change_profile_picture">Set as Profile Picture</button>
                  </form>
                </div>
                <?php
                if (isset($_POST['change_profile_picture'])) {
                  $profile_picture_change = $_POST['profile_picture_change'];
                  $user_id_change = $_POST['user_id_change'];
                  $change_sql = "UPDATE admin_profile SET admin_image = '$profile_picture_change' WHERE id = '$user_id'";
                  $change_query = mysqli_query($conn, $change_sql);
                  if ($change_query) {
                    echo "<script>window.location = 'view-profile.php';</script>";
                  }
                }
                ?>
                <?php

if (isset($_POST['remove_profile_picture'])) {
  $user_id = $_POST['user_id'];
  $picture = $_POST['picture'];
  $picture_id = $_POST['picture_id'];
  $seg = explode("/", $picture);
  $img = $seg[7];
  $sql = "DELETE FROM profile_pictures WHERE id = '$picture_id'";
  $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
  $unlink = unlink("../assets/uploads/profile/".$img);
  if ($query) {
       $errorMsg = "Picture successfully deleted from folder";
       echo "<script>window.location = 'view-profile.php';</script>";
       if (!$unlink) {
         $errorMsg = "Picture successfully deleted from folder";
       echo "<script>window.location = 'view-profile.php';</script>";
       }
  }else{
    $errorMsg = "Picture could not be deleted".mysqli_error($conn);
  }
}
                ?>
                <a href="<?php echo $picture; ?>" data-lightbox="gallery_image">
                <img src="<?php echo $picture; ?>" class="img-responsive"></a>
                <p id="profile_gallery_time"><span class="fa fa-clock"></span><?php echo time_ago($date_added);?></p>
              </div>
            </div>

              <?php
                }
              }else{
                echo "<h3>There are no pictures yet.</h3>";
              }
              ?>
        </div>
      </div>
              <div class="tab-pane" id="settings">
                <h5><strong>Email entered here should be used for subsequent sign-ins</strong></h5>
                <p id="formError" style="padding-bottom: 2%;"></p>
                   <form class="row" id="profile-reset" method="POST" action="includes/profile-reset.php">
            <div class="col-md-6">
              <input type="hidden" name="user_id" id="user_id" value="<?php echo $id; ?>">
              <label>First Name*</label>
                <div class="input-group credential_form">
                  <div class="input-group-addon credential_form">
                    <i class="fa fa-user-plus"></i>
                  </div>
                  <input type="text" class="form-control" name="first_name" id="first_name" value="<?php echo $first_name; ?>" />
                </div>
              </div>
               <div class="col-md-6">
                <label>Last Name*</label>
                <div class="input-group credential_form">
                  <div class="input-group-addon credential_form">
                    <i class="fa fa-user-plus"></i>
                  </div>
                  <input type="text" class="form-control" name="last_name" id="last_name" value="<?php echo $last_name; ?>" />
                </div>
              </div>
              <div class="col-md-6">
                <label>Email*</label>
                <div class="input-group credential_form">
                  <div class="input-group-addon credential_form">
                    <i class="fa fa-envelope-open"></i>
                  </div>
                  <input type="text" class="form-control" name="email" id="email" value="<?php echo $email; ?>" />
                </div>
              </div>
               <div class="col-md-6">
                <label>Phone*</label>
                <div class="input-group credential_form">
                  <div class="input-group-addon credential_form">
                    <i class="fa fa-phone"></i>
                  </div>
                  <input type="tel" class="form-control" name="phone" id="phone" value="<?php echo $phone; ?>" />
                </div>
              </div>
              <div class="box-body col-md-6">
                <label>Security Question</label>
                <div class="form-group credential_form">
                  <select class="form-control select4 select3-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="security_question" id="security_question">
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
                  <input type="text" class="form-control" name="security_answer" id="security_answer" />
                </div>
              </div>
              <div class="box-body col-md-11">
                <div class="form-group credential_form">
                  <label style="padding: 10px 10px;">Biography</label>
                  <textarea class="form-control" rows="10" name="biography" id="biography" value="<?php echo $description; ?>"><?php echo $description;?></textarea>
                </div>
              </div>
              <div class="col-md-12">
                <button class="btn btn-success" name="update_profile" id="update_profile" type="submit">Update Profile</button>
              </div>
          </form>
              </div>
                <!-- /.tab-pane -->
              <div class="tab-pane" id="change_password">
             <form class="row" method="POST" action="includes/reset-password.php" id="reset-password">

       <h3 align="center">Reset Password Here</h3>
       <p><strong>NB: New password should be used to sign-in next time.</strong></p>
       <p id="formErrorPwd"></p>

        <div class="col-md-6">
                <label>Password</label>
                <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>">
                <div class="input-group credential_form">
                  <div class="input-group-addon credential_form">
                    <i class="fa fa-lock"></i>
                  </div>
                  <input type="password" class="form-control" name="password" id="password" />
                </div>
              </div>
              <div class="col-md-6">
                <label>Confirm Password</label>
                <div class="input-group credential_form">
                  <div class="input-group-addon credential_form">
                    <i class="fa fa-lock-open"></i>
                  </div>
                  <input type="password" class="form-control" name="confirm_password" id="confirm_password" />
                </div>
              </div>
              <p><button class="btn btn-success" type="submit" name="reset_password_btn" id="reset_password_btn" style="margin-top: 4%; margin-bottom: 3%;">Reset Password</button></p>
      </form>
               </div>
              <!-- /.tab-pane -->
        <!-- /.col -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
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
    $('#profile-reset').submit(function(e){
      e.preventDefault();
      var user_id = $('#user_id').val();
      var first_name = $('#first_name').val();
      var last_name = $('#last_name').val();
      var email = $('#email').val();
      var phone = $('#phone').val();
      var security_question = $('#security_question').val();
      var security_answer = $('#security_answer').val();
      var update_profile =$('#update_profile').val();
      var biography = $('#biography').val();

      $('#formError').load('includes/profile-reset.php', {
        user_id: user_id,
        first_name: first_name,
        last_name: last_name,
        email: email,
        phone:phone,
        security_question: security_question,
        security_answer: security_answer,
        biography: biography,
        update_profile: update_profile
      });
    });
  $('#reset-password').submit(function (e){
    e.preventDefault();
    var user_id = $('#user_id').val();
    var password = $('#password').val();
    var confirm_password = $('#confirm_password').val();
    var reset_password_btn = $('#reset_password_btn').val(); 
    $('#formErrorPwd').load('includes/reset-password.php',{
      user_id: user_id,
      password: password,
      confirm_password: confirm_password,
      reset_password_btn: reset_password_btn
    })
  })
  })
</script>
</body>
</html>

<?php endif; ?>