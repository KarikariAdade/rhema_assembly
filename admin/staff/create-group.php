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
  					echo $remove."P";
  					?>
  				</h1>
  				<ol class="breadcrumb">
  					<li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
  					<li class="active">
  						<?php
  						$remove = chop(basename($_SERVER['PHP_SELF']),'.php');
  						$remove = strtoupper($remove);
  						$remove = str_replace("-", " ", $remove);
  						echo $remove."P";
  						?>
  					</li>
  				</ol>
  			</section>
          <div class="row" style="margin-top: 5%;">
            <div class="col-md-7">
                
                <div class="box box-info">
            <div class="box-header with-border">
                   <p id="formError" style="margin-bottom: 1%;"></p>
              <form class="row" method="POST" action="includes/create-group.php" style="padding:2% 10px;" id="group_create_form">
                <div class="col-md-6">
                  <label>Group Name *</label>
                  <div class="input-group credential_form">
                    <div class="input-group-addon credential_form">
                      <i class="fa fa-users"></i>
                    </div>
                    <input type="text" class="form-control" name="group_name" id="group_name" />
                  </div>
                </div>
                 <div class="col-md-6">
                  <label>Group Coordinator *</label>
                  <div class="form-group credential_form">
                    <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="group_coordinator" id="group_coordinator">
                      <option selected>Select Coordinator</option>
                      <?php
                      $sql = "SELECT * FROM admin_profile";
                      $query = mysqli_query($conn, $sql);
                      if (mysqli_num_rows($query) > 0) {
                        while ($row = mysqli_fetch_assoc($query)) {
                          $coordinator_id = $row['id'];
                          $full_name = $row['first_name']." ".$row['last_name'];
                      ?>
                    <option><?php echo $full_name;?></option>
                    <?php
                    }
                      }
                    ?>
                    </select>
                  </div>
                </div>
                  <div class="col-md-6">
                  <label>Group Category</label>
                  <div class="form-group credential_form">
                    <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="group_category" id="group_category">
                      <option>Select Group Category</option>
                    <option>Bible Studies</option>
                    <option>Home Cells</option>
                    </select>
                  </div>
                </div>
                <div class="box-body col-md-12">
                <p align="center"><button class="btn btn-primary" type="submit" name="group_submit_btn" id="group_submit_btn">Create Group</button></p>
              </div>
              </form>
                  </div>
                </div>
          </div>
          <div class="col-md-5">
            <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Recent Groups</h3>

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
                    <th style="padding-right: 50px !important;">Group Name</th>
                    <th>Category</th>
                    <th>Coordinator</th>
                    <th>Coordinator Email</th>
                    <th>Phone</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sql = "SELECT * FROM study_groups ORDER BY id DESC LIMIT 6";
                    $query = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($query) > 0) {
                      while ($row = mysqli_fetch_assoc($query)) {
                       $group_name = $row['group_name'];
                       $category = $row['group_category'];
                       $coordinator = $row['group_coordinator'];
                       $coordinator_email = $row['coordinator_email'];
                       $coordinator_phone = $row['coordinator_phone'];
                    ?>
                  <tr>
                    <td><a href="#"><?php echo $group_name; ?></a></td>
                    <td>
                      <?php if($category == 'Bible Studies'): ?>
                      <span class="label label-info"><?php echo $category;?></span>
                    <?php endif;?>
                    <?php if($category == 'Home Cells'): ?>
                      <span class="label label-success"><?php echo $category;?></span>
                    <?php endif;?>
                    </td>
                    <td><?php echo $coordinator; ?></td>
                    <td><?php echo $coordinator_email; ?></td>
                    <td><?php echo $coordinator_phone; ?></td>
                    
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
              <a href="view-groups.php" class="btn btn-sm btn-default btn-flat pull-right">View All Groups</a>
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
    $(document).ready(function () {
      $('#group_create_form').submit(function (e){
        e.preventDefault();
        var group_name = $('#group_name').val();
        var group_coordinator = $('#group_coordinator').val();
        var group_category = $('#group_category').val();
        var group_submit_btn = $('#group_submit_btn').val();
        $('#formError').load('includes/create-group.php',{
          group_name: group_name,
          group_coordinator: group_coordinator,
          group_category: group_category,
          group_submit_btn: group_submit_btn
        })
      })
    })
  </script>

</body>
</html>
<?php endif;?>