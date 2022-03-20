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

         <?php include 'includes/mail-counter.php'; ?>
        </div>
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Compose New Message</h3>
            </div>
            <p id="formError"></p>
            <form method="POST" action="includes/mail-send.php" id="mail_send_form">
            <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>">
            <input type="hidden" name="full_name" id="full_name" value="<?php echo $full_name ?>">
            <input type="hidden" name="user_email" value="<?php echo $user_email; ?>" id="user_email">
            <div class="box-body">
              <div class="form-group">
                <input type="email" class="form-control" name="receiver_email" id="receiver_email" placeholder="To:">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="message_title" id="message_title" placeholder="Subject:">
              </div>
            <div class="col-lg-12 col-sm-12">
                      <div class="body" align="left">
                        <textarea class="summernote form-control no-resize" type="text" name="message_desc" id="message_desc" placeholder="Type your message here..." style="resize: none !important;">
                        </textarea>
                      </div>
                    </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <div class="pull-right">
                <button type="submit" name="mail_submit_btn" id="mail_submit_btn" class="btn btn-primary"><i class="fa fa-envelope"></i> Send</button>
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
        $('#mail_send_form').submit(function (e){
          e.preventDefault();
          var user_id = $('#user_id').val();
          var user_email = $('#user_email').val();
          var full_name = $('#full_name').val();
          var receiver_email = $('#receiver_email').val();
          var message_title = $('#message_title').val();
          var message_desc = $('#message_desc').val();
          var mail_submit_btn = $('#mail_submit_btn').val();
          $('#formError').load('includes/mail-send.php',{
            user_id: user_id,
            user_email: user_email,
            full_name: full_name,
            receiver_email: receiver_email,
            message_title: message_title,
            message_desc: message_desc,
            mail_submit_btn: mail_submit_btn
          })
        })
      });

    </script>
  <?php endif;?>