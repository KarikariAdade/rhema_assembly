<?php
session_start();
include 'includes/connect.php';
$id = $_SESSION['id'];
include 'includes/delete-volunteer.php';
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
    <link rel="stylesheet" href="../assets/js/datatable/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/style.min.css">
    <style type="text/css">
      table td a{
        color: #000;
      }
       .dataTables_wrapper .dt-buttons {
    display: none;
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
        <div class="container-fluid" style="margin-top: 5%;">
         <div class="row clearfix">
          <div class="col-lg-12" style="background-color: #fff;padding: 4% 10px;">
            <div class="card">
              <div class="body">
                <div class="table-responsive">
                  <table class="table table-bordered table-striped table-hover dataTable js-exportable" style="margin-top: 2%!important;">
                    <?php if(isset($_POST['volunteer_del_button'])): ?>
                    <p align="center" style="font-weight: bold; color: green;"><?= $message;?></p>
                  <?php endif;?>
                    <thead>
                      <tr>
                       <th>Full Name</th>
                       <th>Email</th>
                       <th>Phone</th>
                       <th>Company</th>
                       <th>House Address</th>
                       <th>Volunteer Status</th>
                       <th>Action</th>
                     </tr>
                   </thead>
                  
                 <tbody>
                  <?php
                  $sql = "SELECT * FROM volunteers ORDER BY id DESC";
                  $query = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($query) > 0) {
                    while ($row = mysqli_fetch_assoc($query)) {
                      $volunteer_id = $row['id'];
                      $full_name = $row['full_name'];
                      $email = $row['email'];
                      $ministry = $row['ministry'];
                      $event = $row['event'];
                      $phone = $row['phone'];
                      $company = $row['company'];
                      $address = $row['address'];
                      ?>
                       <tr>
                     <td><a href="volunteer-detail.php?volunteer=<?php echo urlencode($volunteer_id);?>&slug=<?php echo urlencode($company);?>&user=<?php echo urlencode($full_name);?>"><?php echo $full_name; ?></a></td>
                     <td><a href="volunteer-detail.php?volunteer=<?php echo urlencode($volunteer_id);?>&slug=<?php echo urlencode($company);?>&user=<?php echo urlencode($full_name);?>"><?php echo $email; ?></a></td>
                     <td><a href="volunteer-detail.php?volunteer=<?php echo urlencode($volunteer_id);?>&slug=<?php echo urlencode($company);?>&user=<?php echo urlencode($full_name);?>"><?php echo $phone; ?></a></td>
                     <td><a href="volunteer-detail.php?volunteer=<?php echo urlencode($volunteer_id);?>&slug=<?php echo urlencode($company);?>&user=<?php echo urlencode($full_name);?>"><?php echo $company; ?></a></td>
                     <td><a href="volunteer-detail.php?volunteer=<?php echo urlencode($volunteer_id);?>&slug=<?php echo urlencode($company);?>&user=<?php echo urlencode($full_name);?>"><?php echo $address; ?></a></td>
                     <?php if(isset($event)): ?>
                     <td><a href="volunteer-detail.php?volunteer=<?php echo urlencode($volunteer_id);?>&slug=<?php echo urlencode($company);?>&user=<?php echo urlencode($full_name);?>"><?php echo $event; ?></a></td>
                   <?php else: ?>
                     <td><a href="volunteer-detail.php?volunteer=<?php echo urlencode($volunteer_id);?>&slug=<?php echo urlencode($company);?>&user=<?php echo urlencode($full_name);?>"><?php echo $ministry; ?></a></td>
                   <?php endif;?>
                   <td style="display: inline-flex;"><a style="padding-right: 24%;" href="volunteer-detail.php?volunteer=<?php echo urlencode($volunteer_id);?>&slug=<?php echo urlencode($company);?>&user=<?php echo urlencode($full_name);?>"><span class="fa fa-edit"></span></a>
                    <form method="POST" action="">
                        <input type="hidden" name="volunteer_id" value="<?php echo $volunteer_id ?>">
                        <button class="btn btn-danger btn-xs" type="submit" name="volunteer_del_button"><span class="fa fa-trash"></span></button>
                      </form>
                   </td>
                   </tr>
                  <?php
                }
              }else{
                echo "<h4>There is no data to be displayed. Please <a href='add-member.php'>add a member</a> here</h4>";
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