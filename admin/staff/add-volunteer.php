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
  	<link rel="stylesheet" href="../assets/dist/css/skins/_all-skins.min.css">
  	<link rel="stylesheet" type="text/css" href="../assets/css/admin.css">
  	<link rel="stylesheet" type="text/css" href="../assets/css/style.min.css">
    <style type="text/css">
      form .col-md-6{
        padding-bottom: 4%;
      }
    </style>

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
          <div class="row" style="margin-top: 5%;">
            <div class="col-md-7">
                   <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#description" data-toggle="tab" aria-expanded="false">Add Event Volunteer</a></li>
                  <li class=""><a href="#editmember" data-toggle="tab" aria-expanded="true">Add Ministry Volunteer</a></li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="description">
                   <p id="formError" style="margin-bottom: -1%;"></p>
              <form class="row" method="POST" action="" style="padding:2% 10px;" id="volunteer_form">
                <div class="col-md-6">
                  <label>Full Name *</label>
                  <div class="input-group credential_form">
                    <div class="input-group-addon credential_form">
                      <i class="fa fa-user-tie"></i>
                    </div>
                    <input type="text" class="form-control" name="e_full_name" id="e_full_name" />
                  </div>
                </div>
                 <div class="col-md-6">
                  <label>Phone *</label>
                  <div class="input-group credential_form">
                    <div class="input-group-addon credential_form">
                      <i class="fa fa-phone"></i>
                    </div>
                    <input type="tel" class="form-control" name="e_phone" id="e_phone" />
                  </div>
                </div>
                 <div class="col-md-6">
                  <label>Company *</label>
                  <div class="input-group credential_form">
                    <div class="input-group-addon credential_form">
                      <i class="fa fa-building"></i>
                    </div>
                    <input type="text" class="form-control" name="e_company" id="e_company" />
                  </div>
                </div>
                <div class="col-md-6">
                  <label>House Address *</label>
                  <div class="input-group credential_form">
                    <div class="input-group-addon credential_form">
                      <i class="fa fa-home"></i>
                    </div>
                    <input type="text" class="form-control" name="e_house_address" id="e_house_address" />
                  </div>
                </div>
                 <div class="col-md-6">
                  <label>Email *</label>
                  <div class="input-group credential_form">
                    <div class="input-group-addon credential_form">
                      <i class="fa fa-envelope"></i>
                    </div>
                    <input type="email" class="form-control" name="e_email" id="e_email" />
                  </div>
                </div>
                  <div class="col-md-6">
                  <label>Volunteer Events *</label>
                  <div class="form-group credential_form">
                    <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="e_event" id="e_event">
                    <option>Crusade</option>
                    <option>Sunday Service</option>
                    <option>Camp Meetings</option>
                    <option>Visitations</option>
                    <option>Evangelism</option>
                    <option>General Events</option>
                    </select>
                  </div>
                </div>
                <div class="box-body col-md-12">
                <div class="form-group credential_form">
                  <label style="padding: 10px 10px;">Comments/Feedback/Contribution</label>
                  <textarea class="form-control" rows="10" id="e_user_comment" name="e_user_comment"></textarea>
                </div>
                <p align="center"><button class="btn btn-primary" type="submit" name="e_volunteer_submit_btn" id="e_volunteer_submit_btn">Add Volunteer</button></p>
              </div>

              </form>
                  </div>


                  <div class="tab-pane" id="editmember">
                       <p id="formError2" style="margin-bottom: -1%;"></p>
              <form class="row" method="POST" action="" style="padding:2% 10px;" id="volunteer_ministry_form">
                <div class="col-md-6">
                  <label>Full Name *</label>
                  <div class="input-group credential_form">
                    <div class="input-group-addon credential_form">
                      <i class="fa fa-user-tie"></i>
                    </div>
                    <input type="text" class="form-control" name="full_name" id="full_name" />
                  </div>
                </div>
                 <div class="col-md-6">
                  <label>Phone *</label>
                  <div class="input-group credential_form">
                    <div class="input-group-addon credential_form">
                      <i class="fa fa-phone"></i>
                    </div>
                    <input type="tel" class="form-control" name="phone" id="phone" />
                  </div>
                </div>
                 <div class="col-md-6">
                  <label>Company *</label>
                  <div class="input-group credential_form">
                    <div class="input-group-addon credential_form">
                      <i class="fa fa-building"></i>
                    </div>
                    <input type="text" class="form-control" name="company" id="company" />
                  </div>
                </div>
                 <div class="col-md-6">
                  <label>House Address *</label>
                  <div class="input-group credential_form">
                    <div class="input-group-addon credential_form">
                      <i class="fa fa-home"></i>
                    </div>
                    <input type="text" class="form-control" name="house_address" id="house_address" />
                  </div>
                </div>
                 <div class="col-md-6">
                  <label>Email *</label>
                  <div class="input-group credential_form">
                    <div class="input-group-addon credential_form">
                      <i class="fa fa-envelope"></i>
                    </div>
                    <input type="email" class="form-control" name="email" id="email" />
                  </div>
                </div>
                  <div class="col-md-6">
                  <label>Serve God through *</label>
                  <div class="form-group credential_form">
                    <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="event" id="event">
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
                  <textarea class="form-control" rows="10" id="user_comment" name="user_comment"></textarea>
                </div>
                <p align="center"><button class="btn btn-primary" type="submit" name="volunteer_submit_btn" id="volunteer_submit_btn">Add Ministry Volunteer</button></p>
              </div>

              </form>
                  </div>
                  </div>
                </div>
          </div>
          <div class="col-md-5">
            <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Recent Volunteers</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>

                  <tr>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Volunteer Status</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sql = "SELECT * FROM volunteers ORDER BY id DESC LIMIT 6";
                    $query = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($query) > 0) {
                      while ($row = mysqli_fetch_assoc($query)) {
                       $full_name = $row['full_name'];
                       $email = $row['email'];
                       $phone = $row['phone'];
                       $ministry = $row['ministry'];
                       $event = $row['event'];
                    ?>
                  <tr>
                    <td><a href="#"><?php echo $full_name; ?></a></td>
                    <td><?php echo $email; ?></td>
                   
                    <td>
                      <span><?php echo $phone;?></span>
                    </td>
                    <?php if (isset($ministry)): ?>
                     <td><span class="label label-success"><?php echo $ministry; ?></span></td>
                     <?php else: ?>
                      <td><span class="label label-warning"><?php echo $event; ?></span></td>
                    <?php endif;?>
                  </tr>
                  <?php
                   }
                    }
                  ?>
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <a href="view-volunteers.php" class="btn btn-sm btn-default btn-flat pull-right">View All Volunteers</a>
            </div>
            <!-- /.box-footer -->
          </div>
          </div>
        </div>
        </div>
      <?php include 'includes/aside.php'; ?>
    </div>


  </div>
  <!-- ./wrapper -->

  <!-- jQuery 3 -->
  <script src="../assets/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="../assets/bower_components/jquery-ui/jquery-ui.min.js"></script>
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
          $('#volunteer_form').submit(function (event) {
            event.preventDefault();
            var e_full_name = $('#e_full_name').val();
            var e_phone = $('#e_phone').val();
            var e_company = $('#e_company').val();
            var e_email = $('#e_email').val();
            var e_event = $('#e_event').val();
            var e_user_comment = $('#e_user_comment').val();
            var e_house_address = $('#e_house_address').val();
            var e_volunteer_submit_btn = $('#e_volunteer_submit_btn').val();
            $('#formError').load('includes/volunteer-validation.php',{
              e_full_name: e_full_name,
              e_phone: e_phone,
              e_company: e_company,
              e_email: e_email,
              e_event: e_event,
              e_house_address: e_house_address,
              e_user_comment: e_user_comment,
              e_volunteer_submit_btn: e_volunteer_submit_btn
            });
          });
           $('#volunteer_ministry_form').submit(function (e) {
            e.preventDefault();
            var full_name = $('#full_name').val();
            var phone = $('#phone').val();
            var company = $('#company').val();
            var email = $('#email').val();
            var event = $('#event').val();
            var house_address = $('#house_address').val();
            var user_comment = $('#user_comment').val();
            var volunteer_submit_btn = $('#volunteer_submit_btn').val();
            $('#formError2').load('includes/volunteer-ministry-validation.php',{
              full_name: full_name,
              phone: phone,
              company: company,
              email: email,
              house_address: house_address,
              event: event,
              user_comment: user_comment,
              volunteer_submit_btn: volunteer_submit_btn
            });
          });
       });
      </script>
</body>
</html>
<?php endif;?>