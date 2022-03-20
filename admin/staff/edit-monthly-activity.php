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
            <title>
              The Church of Pentecost, Agona Rhema Assembly
            </title>
            <style type="text/css">
            @media print{
              title{
                display: none;
              }
              ::-webkit-scrollbar{display: none;}
            }
            .dataTables_wrapper .dt-buttons {
              display: none;
            }
          </style>
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
                       <th>Week</th>
                       <th>Day/Date</th>
                       <th>Activity</th>
                       <th>Opening Prayer</th>
                       <th>Worship</th>
                       <th>Sermon</th>
                       <th>Intensive Prayer</th>
                       <!-- <th>Sermon</th> -->
                       <th>Offering</th>
                       <th>Conductor</th>
                       <th>Benediction</th>
                       <th>Action</th>
                     </tr>
                   </thead>
                   <tbody>
                    <?php
                    $this_month = date('F');
                    $fetch_act = "SELECT * FROM monthly_activities ORDER BY week_number ASC";
                    $fetch_query = mysqli_query($conn, $fetch_act);
                    if (mysqli_num_rows($fetch_query) > 0) {
                      while ($row = mysqli_fetch_assoc($fetch_query)) {
                        $month_id = $row['month_id'];
                        $month_name = $row['month_name'];
                        $year = $row['year'];
                        $week_number = $row['week_number'];
                        $week_activity_name = $row['week_activity_name'];
                        $week_day = $row['week_day'];
                        $opening_prayer = $row['opening_prayer'];
                        $worship = $row['worship'];
                        $intensive_prayer = $row['intensive_prayer'];
                        $sermon = $row['sermon'];
                        $offering = $row['offering'];
                        $conductor = $row['conductor'];
                        $benediction = $row['benediction'];
                        $timestamp = strtotime($week_day);
                        $day = date("D M d Y", $timestamp);
                    ?>
                    <tr>
                      <td><?php echo $week_number; ?></td>
                      <td><?php echo $day?></td>
                      <td><?php echo $week_activity_name; ?></td>
                      <td><?php echo $opening_prayer; ?></td>
                      <td><?php echo $worship; ?></td>
                      <td><?php echo $sermon; ?></td>
                      <td><?php echo $intensive_prayer; ?></td>
                      <td><?php echo $offering; ?></td>
                      <td><?php echo $conductor; ?></td>
                      <td><?php echo $benediction; ?></td>
                      <td>
                        <button class="btn btn-xs btn-primary" ><a href="edit-activity.php?month=<?php echo $month_id; ?>&name=<?php echo $month_name; ?>"><span class="fa fa-edit" style="color: #fff;"></span></a></button>
                        <form method="POST" action="includes/delete-monthly-activity.php" class="pull-right">
                          <input type="hidden" name="month_id" value="<?php echo $month_id; ?>">
                          <button onclick="return confirm('Are you sure you want to delete this activity?. Deleted activity cannot be restored')" class="btn btn-xs btn-danger" type="submit" name="delete-activity-btn"><span class="fa fa-trash"></span></button>
                        </form>
                      </td>
                    </tr>
                     <?php
                   }
                 }else{
                  echo "<h2>No activity has been scheduled for this month yet. <br> Make a schedule <a href='add-monthly-activity.php'>here</a><h2>";
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