 <?php
       include 'includes/connect.php';
       session_start();
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
          if (!isset($_GET['message']) && !isset($_GET['slug'])) {
            echo "<script>window.location = 'mailbox.php';</script>";
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
      @media print{
        .printable{
          display: block !important;
        }
        #non_print{
          display: none;
        }
        title{
          display: none;
        }
        ::-webkit-scrollbar{display: none;}
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
        <section class="content" style="margin-top: 3%;">
  <div class="row">
    <div class="col-md-3" id="non_print">
      <a href="compose-mail.php" class="btn btn-primary btn-block margin-bottom">Compose</a>
          <?php include 'includes/mail-counter.php'; ?>
    </div>
    <?php
    $message = $_GET['message'];
    $slug = $_GET['slug'];
    $mail_sql = "SELECT * FROM messages WHERE id='$message' AND message_title = '$slug'";
    $mail_query = mysqli_query($conn, $mail_sql);
    if (mysqli_num_rows($mail_query) > 0) {
      while ($row = mysqli_fetch_assoc($mail_query)) {
        $message_id = $row['id'];
                        $sender_id = $row['sender_id'];
                        $sender_name = $row['sender_name'];
                        $receiver_email = $row['receiver_email'];
                        $message_title = $row['message_title'];
                        $date = $row['date'];
                        $message_desc = nl2br($row['message_desc']);
                        $sender_email = $row['sender_email'];
                        $timestamp = strtotime($date);
                        $day = date("l M d, Y", $timestamp);
                        $time = date("h:ia", $timestamp);
      }
    }
    ?>
        <div class="col-md-9" id="fuck">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Read Mail</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-read-info">
                <h3><?php echo $message_title; ?></h3>
                <h5>From: <?php echo $sender_email; ?>
                  <span class="mailbox-read-time pull-right"><?php echo $day." at ".$time; ?></span></h5>
              </div>
              <!-- /.mailbox-read-info -->
              <div class="mailbox-controls with-border text-center" id="non_print">
                <div class="btn-group" style="display: inline-flex;">
                 <form method="POST" action="includes/trash-mail.php" style="margin-right: 3%;">
                        <input type="hidden" name="trash_id" value="<?php echo $message_id; ?>">
                      <button data-toggle="tooltip" title="Delete" type="submit" onclick="return confirm('Are you sure you want to move this message to trash bin?')" name="mail-trash-btn" class="btn btn-sm" style="background-color: #f4f4f4;border-color: #ddd;"><span class="fa fa-trash"></span></button>
                    </form>
                  <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Reply">
                    <a href="reply-mail.php?mail=<?php echo $message_id; ?>&message=<?php echo $message_title; ?>" style="color: #000;"><i class="fa fa-reply"></i></a></button>
                </div>
                <!-- /.btn-group -->
                <button onclick="return divPrint()" type="button" class="btn btn-default btn-sm" data-toggle="tooltip" title="Print">
                  <i class="fa fa-print"></i></button>
              </div>
              <!-- /.mailbox-controls -->
              <div class="mailbox-read-message">
                <?php echo $message_desc; ?>
              </div>
            </div>
            <div class="box-footer" id="non_print">
              <div class="pull-right">
                <button type="button" class="btn btn-default"><a href="reply-mail.php?mail=<?php echo $message_id; ?>&message=<?php echo $message_title; ?>"><i class="fa fa-reply"></i> Reply</a></button>
              </div>
              <button type="button" onclick="return divPrint()" class="btn btn-default"><i class="fa fa-print"></i> Print</button>
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
  <script type="text/javascript">
    function divPrint(){
      $('#fuck').addClass('printable');
      window.print();
    }
  </script>
  <?php endif;?>