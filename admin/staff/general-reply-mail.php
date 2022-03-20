 <?php
 include 'includes/connect.php';
 session_start();
 $id = $_SESSION['id'];
 ?>
 <?php if (!isset($_SESSION['id'])):?>
  <?php  echo "<script>window.location = 'sign-in.php';</script>"; ?>
  <?php else:?>
    <?php
    if (!isset($_GET['mail']) && !isset($_GET['name'])) {
      echo "<script>window.location = 'general-mailbox.php';</script>";
    }else{
      $mail = $_GET['mail'];
      $name = $_GET['name'];
      $reply_sql = "SELECT * FROM mailbox WHERE id = '$mail' AND contact_name = '$name'";
      $reply_query = mysqli_query($conn, $reply_sql);
      while ($row = mysqli_fetch_assoc($reply_query)) {
        $reply_id = $row['id'];
        $reply_sender = $row['contact_email'];
      }
    }
    $mail_sql = "SELECT * FROM admin_profile WHERE id='$id'";
    $mail_query = mysqli_query($conn, $mail_sql);
    if (mysqli_num_rows($mail_query) > 0) {
      while ($row = mysqli_fetch_assoc($mail_query)) {
        $contact_reply_id = $row['id'];
        $contact_reply_name = $row['first_name']." ".$row['last_name'];
        $contact_reply_email = $row['email'];
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
      <link rel="stylesheet" type="text/css" href="../assets/js/summernote/dist/summernote.css">
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
              <a href="mailbox.php" class="btn btn-primary btn-block margin-bottom">Back to Inbox</a>

              <?php include 'includes/general-mail-counter.php'; ?>
            </div>
            <div class="col-md-9">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Compose New Message</h3>
                </div>
                <p id="formError"></p>
                <form method="POST" action="includes/general-mail-send.php" id="general_mail_send_form">
                  <input type="hidden" name="reply_id" value="<?php echo $reply_id;?>" id="reply_id">
                  <input type="hidden" name="contact_reply_id" id="contact_reply_id" value="<?php echo $contact_reply_id; ?>">

                  <input type="hidden" name="contact_reply_name" id="contact_reply_name" value="<?php echo $contact_reply_name ?>">

                  <input type="hidden" name="contact_reply_email" value="<?php echo $contact_reply_email; ?>" id="contact_reply_email">

                  <div class="box-body">
                    <div class="form-group">
                      <input type="email" class="form-control" name="receiver_email" id="receiver_email" placeholder="To:" value="<?php echo $reply_sender; ?>">
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" name="reply_title" id="reply_title" placeholder="Subject:">
                    </div>
                    <div class="col-lg-12 col-sm-12">
                      <div class="body" align="left">
                        <textarea class="summernote form-control no-resize" type="text" name="reply_desc" id="reply_desc" placeholder="Type your message here..." style="resize: none !important;">
                        </textarea>
                      </div>
                    </div>
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer">
                    <div class="pull-right">
                      <button type="submit" name="general_mail_submit_btn" id="general_mail_submit_btn" class="btn btn-primary"><i class="fa fa-envelope"></i> Send</button>
                    </div>
                    <button type="reset" class="btn btn-default"><i class="fa fa-times"></i> Discard</button>
                  </div>
                </form>
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
  <script type="text/javascript" src="../assets/js/summernote/dist/summernote.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#summernote').summernote({
        placeholder: "Type your blog script here",
        height: 200
      });
      $('#general_mail_send_form').submit(function (e){
        e.preventDefault();
        var reply_id = $('#reply_id').val();
        var contact_reply_id = $('#contact_reply_id').val();
        var contact_reply_email = $('#contact_reply_email').val();
        var contact_reply_name = $('#contact_reply_name').val();
        var receiver_email = $('#receiver_email').val();
        var reply_title = $('#reply_title').val();
        var reply_desc = $('#reply_desc').val();
        var general_mail_submit_btn = $('#general_mail_submit_btn').val();
        $('#formError').load('includes/general-mail-send.php',{
          contact_reply_id: contact_reply_id,
          contact_reply_email: contact_reply_email,
          contact_reply_name: contact_reply_name,
          receiver_email: receiver_email,
          reply_title: reply_title,
          reply_desc: reply_desc,
          general_mail_submit_btn: general_mail_submit_btn,
          reply_id: reply_id
        })
      })
    });

  </script>
  <?php endif;?>