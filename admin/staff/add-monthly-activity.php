<?php
session_start();
include 'includes/connect.php';
$id = $_SESSION['id'];
?>
       <?php if (!isset($_SESSION['id'])):?>
       	<?php  echo "<script>window.location = 'sign-in.php';</script>"; ?>
       	<?php else:?>
          <?php
          $sql = "SELECT * FROM admin_profile WHERE id = '$id'";
          $query = mysqli_query($conn, $sql);
          while ($row = mysqli_fetch_assoc($query)) {
            $full_name = $row['first_name']." ".$row['last_name'];
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
  	<link rel="stylesheet" type="text/css" href="../assets/css/style.min.css">
    <style type="text/css">
      .col-md-6{
        margin-bottom: 4%;
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
        <div class="row" style="margin-top: 5%;">
          <div class="col-md-8">
            <div class="box box-primary" style="padding-bottom: 5%;">
            <div class="box-header with-border">
<p id="formError" style="margin-bottom: -1%;"></p>
              <form class="row" method="POST" action="includes/add-monthly-activity.php" style="padding: 2%;" id="monthly_activity_form">
                <div class="col-md-7" style="margin-bottom: 2%;">
                  <input type="hidden" name="year" id="year" value="<?php echo date('Y');?>">
                  <input type="hidden" id="user_name" name="user_name" value="<?php echo $full_name; ?>">
                  <label>Month *</label>
                  <div class="form-group credential_form">
                    <select class="form-control select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="month_name" id="month_name">
                      <option selected><?php echo date("F"); ?></option>
                      <option>January</option>
                      <option>February</option>
                      <option>March</option>
                      <option>April</option>
                      <option>May</option>
                      <option>June</option>
                      <option>July</option>
                      <option>August</option>
                      <option>September</option>
                      <option>October</option>
                      <option>November</option>
                      <option>December</option>
                    </select>
                  </div>
                </div>
                 <div class="col-md-6">
                  <label>Week Number*</label>
                  <div class="input-group credential_form">
                    <div class="input-group-addon credential_form">
                      <i class="fa fa-calendar-alt"></i>
                    </div>
                    <input type="text" class="form-control" name="week_number" id="week_number" />
                  </div>
                </div>
<div class="col-md-6">
                  <label>Week Activity*</label>
                  <div class="input-group credential_form">
                    <div class="input-group-addon credential_form">
                      <i class="fa fa-church"></i>
                    </div>
                    <input type="text" class="form-control" name="week_activity_name" id="week_activity_name" />
                  </div>
                </div>
                <div class="col-md-6">
                  <label>Week Day *</label>
                  <div class="input-group credential_form">
                    <div class="input-group-addon credential_form">
                      <i class="fa fa-calendar-alt"></i>
                    </div>
                    <input type="date" class="form-control" name="week_day" id="week_day" />
                  </div>
                </div>
                <div class="col-md-6">
                  <label>Opening Prayer *</label>
                  <div class="input-group credential_form">
                    <div class="input-group-addon credential_form">
                      <i class="fa fa-cross"></i>
                    </div>
                    <input type="text" class="form-control" name="opening_prayer" id="opening_prayer" />
                  </div>
                </div>
                <div class="col-md-6">
                  <label>Worship *</label>
                  <div class="input-group credential_form">
                    <div class="input-group-addon credential_form">
                      <i class="fa fa-cross"></i>
                    </div>
                    <input type="text" class="form-control" name="worship" id="worship" />
                  </div>
                </div>
                <div class="col-md-6">
                  <label>Intensive Prayer *</label>
                  <div class="input-group credential_form">
                    <div class="input-group-addon credential_form">
                      <i class="fa fa-pray"></i>
                    </div>
                    <input type="text" class="form-control" name="intensive_prayer" id="intensive_prayer" />
                  </div>
                </div>
                <div class="col-md-6">
                  <label>Sermon *</label>
                  <div class="input-group credential_form">
                    <div class="input-group-addon credential_form">
                      <i class="fa fa-bullhorn"></i>
                    </div>
                    <input type="text" class="form-control" name="sermon" id="sermon" />
                  </div>
                </div>
                <div class="col-md-6">
                  <label>Offering *</label>
                  <div class="input-group credential_form">
                    <div class="input-group-addon credential_form">
                      <i class="fa fa-money-bill-wave"></i>
                    </div>
                    <input type="text" class="form-control" name="offering" id="offering" />
                  </div>
                </div>
                <div class="col-md-6">
                  <label>Conductor *</label>
                  <div class="input-group credential_form">
                    <div class="input-group-addon credential_form">
                      <i class="fa fa-user-tie"></i>
                    </div>
                    <input type="text" class="form-control" name="conductor" id="conductor" />
                  </div>
                </div>
                <div class="col-md-6">
                  <label>Benediction *</label>
                  <div class="input-group credential_form">
                    <div class="input-group-addon credential_form">
                      <i class="fa fa-user-shield"></i>
                    </div>
                    <input type="text" class="form-control" name="benediction" id="benediction" />
                  </div>
                </div>
                <div class="col-md-12" align="center" style="margin-top: 3%;">
                  <button type="submit" name="monthly_activity_btn" id="monthly_activity_btn" class="btn btn-primary">Add Activity</button>
                </div>
              </form>
            </div>
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
      $('#monthly_activity_form').submit(function(e){
        e.preventDefault();
        var user_name = $('#user_name').val();
        var year = $('#year').val();
        var month_name = $('#month_name').val();
        var week_number = $('#week_number').val();
        var week_activity_name = $('#week_activity_name').val();
        var week_day = $('#week_day').val();
        var opening_prayer = $('#opening_prayer').val();
        var worship = $('#worship').val();
        var intensive_prayer = $('#intensive_prayer').val();
        var sermon = $('#sermon').val();
        var offering = $('#offering').val();
        var benediction = $('#benediction').val();
        var conductor = $('#conductor').val();
        var monthly_activity_btn = $('#monthly_activity_btn').val();
        $('#formError').load('includes/add-monthly-activity.php',{
          user_name: user_name,
          year: year,
          conductor: conductor,
          month_name: month_name,
          week_number: week_number,
          week_activity_name: week_activity_name,
          week_day: week_day,
          opening_prayer: opening_prayer,
          worship: worship,
          intensive_prayer: intensive_prayer,
          sermon: sermon,
          offering: offering,
          benediction: benediction,
          monthly_activity_btn: monthly_activity_btn
        })
      })
    })
  </script>
</body>
</html>
<?php endif;?>