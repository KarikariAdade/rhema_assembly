<?php
session_start();
include 'includes/connect.php';
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
            <title>Rhema Assembly Study Groups</title>
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
        <div class="container-fluid" style="margin-top: 5%;">
         <div class="row clearfix">
          <div class="col-lg-12" style="background-color: #fff;padding: 4% 10px;">
            <div class="card">
              <div class="body">
                <div class="table-responsive">
                  <table class="table table-bordered table-striped table-hover dataTable js-exportable" style="margin-top: 2%!important;">
                    <thead>
                      <tr>
                       <th>Group Name</th>
                       <th>Group Category</th>
                       <th>Group Coordinator</th>
                       <th>Coordinator Email</th>
                       <th>Coordinator Phone</th>
                       <th>Coordinator Address</th>
                       <th>Date Created</th>
                       <th>Members</th>
                     </tr>
                   </thead>
                 <tbody>
                  <?php
                  $sql = "SELECT * FROM study_groups ORDER BY id DESC";
                  $query = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($query) > 0) {
                    while ($row = mysqli_fetch_assoc($query)) {
                      $group_id = $row['id'];
                      $group_name = $row['group_name'];
                      $group_category = $row['group_category'];
                      $group_coordinator = $row['group_coordinator'];
                      $coordinator_email = $row['coordinator_email'];
                      $coordinator_phone = $row['coordinator_phone'];
                      $coordinator_address = $row['coordinator_address'];
                      $date_created = $row['date_created'];
                      $timestamp = strtotime($date_created);
                      $date = date("l M d, Y", $timestamp);
                      $coordinator_id = $row['coordinator_id'];
                      $name_seg = explode(" ", $group_coordinator);
                      $first_name = $name_seg[0];
                      $last_name = $name_seg[1];
                      ?>
                       <tr>
                     <td><a href="group-detail.php?group=<?php echo urlencode($group_id);?>&name=<?php echo urlencode($group_name); ?>"><?php echo $group_name; ?></a></td>
                     <td><?php echo $group_category; ?></td>
                     <td><a href="staff-detail.php?staff=<?php echo urlencode($coordinator_id);?>&slug=<?php echo urlencode($last_name);?>&user=<?php echo urlencode($first_name); ?>"><?php echo $group_coordinator; ?></a></td>
                     <td><?php echo $coordinator_email; ?></td>
                     <td><?php echo $coordinator_phone; ?></td>
                     <td><?php echo $coordinator_address; ?></td>
                     <td><?php echo $date; ?></td>
                     <td>
                       <?php
                       $member_count = "SELECT * FROM members WHERE bible_study_group = '$group_name' OR home_cell_group = '$group_name'";
                       $member_sql = mysqli_query($conn, $member_count);
                       echo mysqli_num_rows($member_sql);
                       ?>
                     </td>
                   </tr>
                  <?php
                }
              }else{
                echo "<h4>There is no data to be displayed. Please <a href='create-group.php'>create a group.</a></h4>";
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