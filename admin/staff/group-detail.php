<?php
session_start();
include 'includes/connect.php';
$id = $_SESSION['id'];
?>
       <?php if (!isset($_SESSION['id'])):?>
        <?php  echo "<script>window.location = 'sign-in.php';</script>"; ?>
        <?php else:?>
          <?php
          if (!isset($_GET['group']) && !isset($_GET['name'])) {
            echo "<script>window.location = 'view-groups.php';</script>";
          }
          ?>
          <!DOCTYPE html>
          <html>
          <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <title>Rhema Assembly Study Group Members (<?php echo $_GET['name']; ?>)</title>
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
    <link rel="stylesheet" href="../assets/js/datatable/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/style.min.css">
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
        <div class="row" style="margin-top: 5%;margin-bottom: 7%;">
          <?php
          $group = $_GET['group'];
          $name = $_GET['name'];
          ?>
          <?php
          $sql = "SELECT * FROM study_groups WHERE id='$group' AND group_name = '$name'";
          $query = mysqli_query($conn, $sql);
          while ($row = mysqli_fetch_assoc($query)) {
            $group_id = $row['id'];
            $group_name = $row['group_name'];
            $group_category = $row['group_category'];
            $group_category = $row['group_category'];
            $group_coordinator = $row['group_coordinator'];
            $coordinator_email = $row['coordinator_email'];
            $coordinator_phone = $row['coordinator_phone'];
            $coordinator_address = $row['coordinator_address'];
            $date_created = $row['date_created'];
            $timestamp = strtotime($date_created);
            $date = date("l M d, Y", $timestamp);
            $coordinator_id = $row['coordinator_id'];
            $coordinator_picture = $row['coordinator_picture'];
            $name_seg = explode(" ", $group_coordinator);
                      $first_name = $name_seg[0];
                      $last_name = $name_seg[1];
          }
          ?>
          <div class="col-md-5">
            <!-- Widget: user widget style 1 -->
            <div class="box box-widget widget-user-2">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-blue">
                <div class="widget-user-image">
                  <img class="img-circle" src="<?php echo $coordinator_picture; ?>" alt="User Avatar" style="height: 65px; width: 65px;">
                </div>
                <!-- /.widget-user-image -->
                <h3 class="widget-user-username"><a href="staff-detail.php?staff=<?php echo urlencode($coordinator_id);?>&slug=<?php echo urlencode($last_name);?>&user=<?php echo urlencode($first_name); ?>" style="color: #fff;"><?php echo $group_coordinator; ?></a></h3>
                <h5 class="widget-user-desc"><?php echo $group_name." leader"; ?></h5>
              </div>
              <div class="box-footer no-padding">
              <ul class="nav nav-stacked">
                <li><a href="#">Email <span class="pull-right"><?php echo $coordinator_email; ?></span></a></li>
                <li><a href="#">Address <span class="pull-right"><?php echo $coordinator_address; ?></span></a></li>
                <li><a href="#">Phone <span class="pull-right"><?php echo $coordinator_phone; ?></span></a></li>
              </ul>
            </div>
            </div>
            <!-- /.widget-user -->
          </div>
   <div class="col-md-7">
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
                    $sql = "SELECT * FROM study_groups ORDER BY id DESC LIMIT 3";
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
          <h1 align="center">Group Members</h1>
           <div class="container-fluid" style="margin-top: 5%;">
         <div class="row clearfix">
          <div class="col-lg-12" style="background-color: #fff;padding: 4% 10px;">
            <div class="card">
              <div class="body">
                <div class="table-responsive">
                  <table class="table table-bordered table-striped table-hover dataTable js-exportable" style="margin-top: 2%!important;">
                    <thead>
                      <tr>
                       <th>Full Name</th>
                       <th>Gender</th>
                       <th>Email</th>
                       <th>Phone</th>
                       <th>Address</th>
                     </tr>
                   </thead>
                 <tbody>
                  <?php
                  $sql = "SELECT * FROM members WHERE home_cell_group = '$name' OR bible_study_group = '$name' ORDER BY id DESC";
                  $query = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($query) > 0) {
                    while ($row = mysqli_fetch_assoc($query)) {
                      $member_id = $row['id'];
                      $full_name = $row['first_name']." ".$row['last_name'];
                      $gender = $row['gender'];
                      $email = $row['email'];
                      $phone = $row['phone'];
                      $address = $row['address'];
                      ?>
                       <tr>
                     <td><?php echo $full_name; ?></td>
                     <td><?php echo $gender; ?></td>
                     <td><?php echo $email; ?></td>
                     <td><?php echo $phone; ?></td>
                     <td><?php echo $address; ?></td>
                   </tr>
                  <?php
                }
              }else{
                echo "<h4>There is no data to be displayed. Please <a href='assign-group-members.php'>add a member</a> here</h4>";
              }
              ?>

            </tbody>
          </table>
        </div>
      </div>
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
  <script src="../assets/js/datatablescripts.bundle.js"></script>
  <script src="../assets/js/datatable/buttons/dataTables.buttons.min.js"></script>
  <script src="../assets/js/datatable/buttons/buttons.bootstrap4.min.js"></script>
  <script src="../assets/js/datatable/buttons/buttons.colVis.min.js"></script>
  <script src="../assets/js/datatable/buttons/buttons.flash.min.js"></script>
  <script src="../assets/js/datatable/buttons/buttons.html5.min.js"></script>
  <script src="../assets/js/datatable/buttons/buttons.print.min.js"></script>

  <script src="../assets/js/datatable/buttons/jquery-datatable.js"></script>

</body>
</html>
<?php endif;?>