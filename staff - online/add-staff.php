<?php
include 'includes/connect.php';
session_start();
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
        <div class="container" style="margin-top: 5%;">
          <div class="row">
            <div class="col-md-7">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Add Staff</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->

                <form role="form" class="row" method="POST" action="includes/add-staff.php" id="add_staff_form">
                  <p align="center" id="formError"></p>
                  <div class="box-body col-md-5">
                    <label>First Name</label>
                    <div class="input-group credential_form">
                      <div class="input-group-addon credential_form">
                        <i class="fa fa-user-tie"></i>
                      </div>
                      <input type="text" class="form-control" name="first_name" id="first_name">
                    </div>
                  </div>

                  <div class="box-body col-md-5">
                    <label>Last Name</label>
                    <div class="input-group credential_form">
                      <div class="input-group-addon credential_form">
                        <i class="fa fa-user-tie"></i>
                      </div>
                      <input type="text" class="form-control" name="last_name" id="last_name" />
                    </div>
                  </div>
                  <div class="box-body col-md-5">
                    <label>Email</label>
                    <div class="input-group credential_form">
                      <div class="input-group-addon credential_form">
                        <i class="fa fa-envelope"></i>
                      </div>
                      <input type="email" class="form-control" name="email" id="email" />
                    </div>
                  </div>
                  <div class="box-body col-md-5">
                    <label>Gender</label>
                    <select class="form-control credential_form" name="gender" id="gender">
                      <option></option>
                      <option>Male</option>
                      <option>Female</option>
                    </select>
                  </div>
                  <div class="box-body col-md-5">
                    <label>Phone</label>
                    <div class="input-group credential_form">
                      <div class="input-group-addon credential_form">
                        <i class="fa fa-phone"></i>
                      </div>
                      <input type="tel" class="form-control" name="phone" id="phone" />
                    </div>
                  </div>

                  <div class="box-body col-md-5">
                    <label>Generated Password</label>
                    <div class="input-group credential_form">
                      <div class="input-group-addon credential_form">
                        <i class="fa fa-lock"></i>
                      </div>
                      <input type="text" class="form-control" name="generated_password" id="generated_password" />
                    </div>
                    <button class="btn btn-xs btn-primary" name="generated_password_btn" id="generated_password_btn" style="margin-top: 3%;">Generate Password</button>
                  </div>
                  <div class="box-body col-md-5">
                    <label>Staff Position</label>
                    <select class="form-control credential_form" name="position" id="position">
                      <option></option>
                      <option>Elder</option>
                      <option>Secretary</option>
                      <option>Deacon</option>
                      <option>Deaconess</option>
                      <option>Choir Leader</option>
                    </select>
                  </div>
                  <div class="box-body col-md-12">
                    <textarea class="credential_form form-control" id="staff_description" placeholder="Something brief about staff" rows="10"></textarea>
                  </div>
                  <!-- /.box-body -->

                  <div class="box-footer col-md-4" style="width: 90%;">
                    <button type="submit" class="btn btn-primary" name="add_staff_btn" id="add_staff_btn">Submit</button>
                  </div>

                </form>
              </div>
            </div>
            <?php include 'includes/view-staff-widget.php'; ?>
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
    <script type="text/javascript">
      $(document).ready(function (){
       var generated_password = $('#generated_password').val();
       var generated_password_btn = $('#generated_password_btn').val();
       $('#generated_password_btn').click(function (e){
        e.preventDefault();
        $.post('includes/random_password.php',{
          generated_password:generated_password,
          generated_password_btn: generated_password_btn
        },
        function (data,status){
          // $('#random_password').html(data);
          $('#generated_password').attr("value",data);
        })
      })

       $('#add_staff_form').submit(function (event){
        event.preventDefault();
        var first_name = $('#first_name').val();
        var last_name = $('#last_name').val();
        var email = $('#email').val();
        var generated_password = $('#generated_password').val();
        var add_staff_btn = $('#add_staff_btn').val();
        var phone = $('#phone').val();
        var gender = $('#gender').val();
        var position = $('#position').val();
        var staff_description = $('#staff_description').val();
        $.ajax({
          url: 'includes/add-staff.php',
          method: 'POST',
          data: {
            first_name: first_name,
            last_name: last_name,
            email: email,
            generated_password: generated_password,
            add_staff_btn: add_staff_btn,
            phone: phone,
            gender: gender,
            position: position,
            staff_description: staff_description
          },
          success: function(data){
            $('#formError').html(data);
          }
        })
      })
     })
   </script>
 </body>
 </html>
<?php endif;?>