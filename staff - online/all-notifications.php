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
<div class="content">
  <div class="row">
    <div class="col-md-11">

       <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">NOTIFICATIONS</h3>
            </div>
            <div class="box-body no-padding">
              <div class="mailbox-controls">
              </div>
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                  <tbody>
                    <?php
                    $notification = "SELECT * FROM notification ORDER BY id DESC";
                    $notification_query = mysqli_query($conn, $notification);
                    if (mysqli_num_rows($notification_query) > 0) {
                      while ($row = mysqli_fetch_assoc($notification_query)) {
                        $notification_id = $row['id'];
                        $notification_category = $row['category'];
                        $notification_message = $row['message'];
                        $notification_date = $row['date'];
                        $date = date("l M d Y", strtotime($notification_date));
                        $time = date("h:ia", strtotime($notification_date));
                    ?>
                    <tr>
                      <td><p><?php echo '<strong>'.$notification_message.'</strong>'.' on '.$date.' at '.$time ?></p></td>
                      <td>
                        <form method="POST" action="includes/delete-notification.php">
                          <input type="hidden" name="notification_id" value="<?php echo $notification_id; ?>">
                          <button class="btn btn-xs btn-danger" type="submit" onclick="return confirm('Are you sure you want to delete this notification?. Deleted data cannot be retrieved!')" name="delete-notification-btn">
                        <span class="fa fa-trash"></span>
                      </button>
                      </form>
                      </td>
                    </tr>
                    <?php
                     }
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
  <?php endif;?>