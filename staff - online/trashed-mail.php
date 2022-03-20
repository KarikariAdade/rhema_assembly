<?php
session_start();
include 'includes/connect.php';
$id = $_SESSION['id'];
?>
       <?php if (!isset($_SESSION['id'])):?>
        <?php  echo "<script>window.location = 'sign-in.php';</script>"; ?>
        <?php else:?>
           <?php
          $mail_sql = "SELECT * FROM admin_profile WHERE id='$id'";
          $mail_query = mysqli_query($conn, $mail_sql);
          if (mysqli_num_rows($mail_query) > 0) {
            while ($row = mysqli_fetch_assoc($mail_query)) {
              $user_id = $row['id'];
              $full_name = $row['first_name']." ".$row['last_name'];
              $user_email = $row['email'];
            }
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

    <!-- Main content -->
    <section class="content" style="margin-top: 3%;">
      <div class="row">
        <div class="col-md-3">
          <a href="compose-mail.php" class="btn btn-primary btn-block margin-bottom">Compose</a>
          <?php include 'includes/mail-counter.php'; ?>
        </div>
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Trash</h3>
            </div>
            <div class="box-body no-padding">
              <div class="mailbox-controls">
              </div>
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                  <tbody>
                    <?php
                    $inbox_sql = "SELECT * FROM messages WHERE sender_email = '$user_email' AND sender_name = '$full_name' AND trash_status ='Yes'";
                    $inbox_query = mysqli_query($conn, $inbox_sql);
                    if (mysqli_num_rows($inbox_query) > 0) {
                      while ($row = mysqli_fetch_assoc($inbox_query)) {
                        $message_id = $row['id'];
                        $sender_id = $row['sender_id'];
                        $sender_name = $row['sender_name'];
                        $receiver_email = $row['receiver_email'];
                        $message_title = $row['message_title'];
                        $date = $row['date'];
                    ?>
                  <tr>
                    <td style="display: inline-flex;">
                      <form method="POST" action="includes/restore-mail.php">
                        <input type="hidden" name="restore_id" value="<?php echo $message_id; ?>">
                      <button type="submit" name="mail-restore-btn" onclick="return confirm('Are you sure you want to restore this message?')" style="background-color: transparent;border:none;" class="btn btn-xs btn-danger"><span style="color:#dd4b39;" class="fa fa-recycle"></span></button>
                    </form>
                    <form method="POST" action="includes/delete-mail.php">
                        <input type="hidden" name="delete_id" value="<?php echo $message_id; ?>">
                      <button type="submit" name="mail-delete-btn" onclick="return confirm('Are you sure you want to delete this message? Deleted messages cannot be restored.')" style="background-color: transparent;border:none;" class="btn btn-xs btn-danger"><span style="color:#dd4b39;" class="fa fa-trash"></span></button>
                    </form>
                  </td>
                    <td class="mailbox-name"><a href="mail-detail.php?message=<?php echo urlencode($message_id); ?>&slug=<?php echo urlencode($message_title); ?>"><?php echo $receiver_email; ?></a></td>
                    <td class="mailbox-subject"><a href="mail-detail.php?message=<?php echo urlencode($message_id); ?>&slug=<?php echo urlencode($message_title); ?>" style="color: #000;"><b><?php echo $message_title;?></b> - Trying to find a solution to this problem...</a>
                    </td>
                    <!-- <td class="mailbox-attachment"></td> -->
                    <td class="mailbox-date"><?php echo time_ago($date);?></td>
                  </tr>
                  <?php
                      }
                    }else{
                      echo "<p align='center'>There are no messages in the trash bin</p>";
                    }
                  ?>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="box-footer ">
              <div class="mailbox-controls">
                <div class="btn-group">
                  <!-- <button type="button" class="btn btn-default btn-sm"><i class="fa fa-loading"></i></button> -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
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