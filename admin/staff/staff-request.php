	 <?php
  include 'includes/connect.php';
  session_start();
  use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require '../../../vendor/autoload.php';
  $id = $_SESSION['id'];
  $request_error ='';
  ?>
  <?php if (!isset($_SESSION['id'])):?>
    <?php  echo "<script>window.location = 'sign-in.php';</script>"; ?>
    <?php else:?>
      <?php

      //Approve staff validation


      if (isset($_POST['approve_staff_btn'])) {
        $awaiting_id = $_POST['awaiting_id'];
        $generated_password = $_POST['generated_password'];
        $staff_position = $_POST['staff_position'];
        if (!empty($awaiting_id) && !empty($generated_password)) {
          $staff_request_sql = "SELECT * FROM staff_request WHERE id = '$awaiting_id'";
          $staff_request_query = mysqli_query($conn, $staff_request_sql);
            while($row = mysqli_fetch_assoc($staff_request_query)){
              $staff_id = $row['id'];
              $first_name = $row['first_name'];
              $last_name = $row['last_name'];
              $phone = $row['phone'];
              $staff_email = $row['email'];
              $gender = $row['gender'];
              $date = $row['date'];
              $password = $row['password'];
              $password = md5($password);
              $hash_staff_id = md5($staff_id);
          }
          $check_sql = "SELECT * FROM admin_profile WHERE email='$staff_email'";
          $check_query = mysqli_query($conn, $check_sql) or die(mysqli_error($conn));
          if (mysqli_num_rows($check_query) > 0) {
           $request_error = "Staff account already exists";
         }elseif ($staff_position == "Select Position") {
           $request_error = "Select staff position before approving";
         }else{
          $verify_sql = "UPDATE staff_request SET position = '$staff_position',
          status = 'pending',date=now() WHERE id = '$staff_id'
          ";
          $verify_query = mysqli_query($conn, $verify_sql);
          if ($verify_query) {
            // echo 'wow';
//             $mail = new PHPMailer(true);

//       try {
//     //Server settings
//     $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
//     $mail->isSMTP();                                            // Send using SMTP
//     $mail->Host       = 'mail.nakroteck.site';                    // Set the SMTP server to send through
//     $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
//     $mail->Username   = 'support@ghbrain.com';                     // SMTP username
//     $mail->Password   = 'GodOverMoney0548';                               // SMTP password
//     $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
//     $mail->Port       = 587;                                    // TCP port to connect to

//     //Recipients
//     $mail->setFrom('support@ghbrain.com', 'GH Brain');
//     $mail->addAddress('juniorlecrae@gmail.com', $first_name);     // Add a recipient
//     $mail->SMTPOptions = array(
//       'ssl' => array(
//         'verify_peer' => false,
//         'verify_peer_name' => false,
//         'allow_self_signed' => true
//       )
//     );

//     // Content
//     $mail->isHTML(true);                                  // Set email format to HTML
//     $mail->Subject = 'Administrator Verification';
//     $mail->AddEmbeddedImage("../assets/img/pentecost.png", "my-attach", "");
//     $mail->Body    = '<div style="width:100%; font-size="17px;">
//     <p align="center"><img alt="PHPMailer" src="cid:my-attach"></p>
//     <h3>Greetings '.$first_name.',</h3>
//     <p>Your request to become an admin of <a href="www.coprhemassembly.tk">Rhema Assembly</a> has been approved. Please click this <a href="verify-admin.php?token='.$generated_password.'&id='.$hash_staff_id.'">link</a> to complete registration.</p>
//     <p>Church Admin<p>
//     <p>Mr. Emmanuel Kobeah</p>
//     <p>Signed</p>';
//     $mail->AltBody = 'hwolo';
//     $mail->SMTPDebug  = 3;
//     $mail->send();
//     $request_error = 'Message has been sent';
// } catch (Exception $e) {
//   $request_error = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
// }


            echo "<script>
           window.location = '../../verify-admin.php?token=$generated_password&id=$hash_staff_id';
            </script>";
          }else{
            $request_error = "Staff could not be added. Try again later";
          }
        } 
      }else{
        $request_error = "Generate Password and select Staff Position before approving a Staff";
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
  <!-- AdminLTE Skins. Choose a skin from the css/skins
  	folder instead of downloading all of them to reduce the load. -->
  	<link rel="stylesheet" href="../assets/dist/css/skins/_all-skins.min.css">
  	<link rel="stylesheet" type="text/css" href="../assets/css/admin.css">

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
  					Dashboard
  					<small>Control panel</small>
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
        <div class="container" style="margin-top: 3%;width: 98%;">
          <div class="row">
            <div class="col-md-12">
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#awaiting_staff" data-toggle="tab" aria-expanded="false">Awaiting Staff</a></li>
                  <li class=""><a href="#verified_staff" data-toggle="tab" aria-expanded="true">Approved Staff</a></li>
                  <li class=""><a href="#pending_staff" data-toggle="tab" aria-expanded="true">Pending Staff</a></li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="awaiting_staff">
                    <!-- /.row -->
                    <div class="row">
                      <?php if (isset($_POST['approve_staff_btn'])): ?>
                        <p id="request_error"><?php echo $request_error; ?></p>
                      <?php endif;?>
                      <p id="delete_request_error"></p>
                      <div class="col-xs-12">
                        <div class="box">

                          <div class="box-header">

                            <h3 class="box-title">Awaiting Staff</h3>
                            <small style=""> NB:Generate password before approving, only one password can be generated at a time</small>


                          </div>
                          <!-- /.box-header -->
                          <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">


                              <tr>
                                <th> Full Name</th>
                                <th> Phone</th>
                                <th> Email</th>
                                <th> Gender</th>
                                <th> Request Time</th>
                                <th> Password</th>
                                <th> Add Position</th>
                                <th> Generate Password</th>
                                <th> Approve</th>
                                <th> Delete</th>
                              </tr>
                              <?php
                              $awaiting_sql = "SELECT * FROM staff_request WHERE status='not verified' ORDER BY id DESC";
                              $awaiting_query = mysqli_query($conn, $awaiting_sql);
                              if (mysqli_num_rows($awaiting_query) > 0) {
                               while ($row = mysqli_fetch_assoc($awaiting_query)) {
                                 $id = $row['id'];
                                 $full_name = $row['first_name']." ".$row['last_name'];
                                 $phone = $row['phone'];
                                 $email = $row['email'];
                                 $gender = $row['gender'];
                                 $date = $row['date'];
                                 $password = $row['password'];
                                 ?>
                                 <tr>
                                  <td> <?php echo $full_name ?></td>
                                  <td> <?php echo $phone; ?></td>
                                  <td> <?php echo $email; ?></td>
                                  <th> <?php echo $gender; ?></th>
                                  <td> <?php echo time_ago($date); ?></td>
                                  <form method="POST" id="password_gen" action="staff-request.php">
                                    <td>  <input type="hidden" name="awaiting_id" id="awaiting_id" value="<?php echo $id; ?>">
                                      <span type="text" name="" id="random_password"></span></td>
                                        <td>
                                       <select name="staff_position" id="staff_position">
                                          <option selected>Select Position</option>
                                          <option>Elder</option>
                                          <option>Secretary</option>
                                          <option>Deacon</option>
                                          <option>Deaconess</option>
                                          <option>Choir Leader</option>
                                        </select>
                                    </td>
                                      <td> <button type="button" name="generate" id="generate" class="btn btn-xs">Generate Password</button></td>
                                      <td> 
                                        <input type="hidden" name="awaiting_id" class="awaiting_id" id="awaiting_id" value="<?php echo $id; ?>">
                                        <input type="hidden" id="generated_password" name="generated_password" class="generated_password">
                                        <button class="btn btn-xs" name="approve_staff_btn" type="submit" id="approve_staff_btn">Approve</button></td>
                                        <td>
                                        </form>
                                        <form method="POST" action="includes/delete-staff-request.php" id="delete_staff_request">
                                          <input type="hidden" id="delete_id" name="delete_id" value="<?php echo $id; ?>">
                                          <button type="submit" class="btn btn-xs" name="delete_request_btn" id="delete_request_btn"><span class="fa fa-trash"></span></button>
                                        </form></td>
                                      </tr>
                                      <?php
                                    }
                                  }
                                  ?>

                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="tab-pane" id="verified_staff">
                        <div class="row">
                          <p id="delete_request_error"></p>
                         <div class="col-xs-12">
                          <div class="box">

                            <div class="box-header">

                              <h3 class="box-title">Approved Staff</h3>
                              <small> NB:Generated Passwords may have been changed.</small>


                            </div>
                            <!-- /.box-header -->
                            <div class="box-body table-responsive no-padding">
                              <table class="table table-hover">


                                <tr>
                                  <th> Full Name</th>
                                  <th> Phone</th>
                                  <th> Email</th>
                                  <th> Gender</th>
                                  <th> Request Time</th>
                                  <th> Generated Password</th>
                                  <th> Delete</th>
                                </tr>
                                <?php
                                 $approved_sql = "SELECT * FROM staff_request WHERE status='verified' ORDER BY id DESC";
                              $approved_query = mysqli_query($conn, $approved_sql);
                              if (mysqli_num_rows($approved_query) > 0) {
                               while ($row = mysqli_fetch_assoc($approved_query)) {
                                 $id = $row['id'];
                                 $full_name = $row['first_name']." ".$row['last_name'];
                                 $phone = $row['phone'];
                                 $email = $row['email'];
                                 $gender = $row['gender'];
                                 $date = $row['date'];
                                 $password = $row['password'];
                                 ?>
                                <tr>
                                  <td><?php echo $full_name; ?></td>
                                  <td><?php echo $phone;?></td>
                                  <td><?php echo $email;?></td>
                                  <td><?php echo $gender;?></td>
                                  <td><?php echo time_ago($date);?></td>
                                  <td><?php echo $password; ?></td>
                                  <td>
                                      <form method="POST" action="includes/delete-staff-request.php" id="delete_staff_request">
                                          <input type="hidden" id="delete_id" name="delete_id" value="<?php echo $id; ?>">
                                          <button type="submit" class="btn btn-xs" name="delete_request_btn" id="delete_request_btn"><span class="fa fa-trash"></span></button>
                                        </form>
                                  </td>
                                </tr>
                                <?php
                              }
                            }
                                ?>
                              </table>
                            </div>
                          </div>
                        </div>

                      </div>
                    </div>
                     <div class="tab-pane" id="pending_staff">
                        <div class="row">
                          <p id="delete_request_error"></p>
                         <div class="col-xs-12">
                          <div class="box">

                            <div class="box-header">

                              <h3 class="box-title">Pending Staff</h3>
                              <small> NB:Generated Passwords may have been changed.</small>


                            </div>
                            <!-- /.box-header -->
                            <div class="box-body table-responsive no-padding">
                              <table class="table table-hover">


                                <tr>
                                  <th> Full Name</th>
                                  <th> Phone</th>
                                  <th> Email</th>
                                  <th> Gender</th>
                                  <th> Request Time</th>
                                  <th> Generated Password</th>
                                  <th> Delete</th>
                                </tr>
                                <?php
                                 $approved_sql = "SELECT * FROM staff_request WHERE status='pending' ORDER BY id DESC";
                              $approved_query = mysqli_query($conn, $approved_sql);
                              if (mysqli_num_rows($approved_query) > 0) {
                               while ($row = mysqli_fetch_assoc($approved_query)) {
                                 $id = $row['id'];
                                 $full_name = $row['first_name']." ".$row['last_name'];
                                 $phone = $row['phone'];
                                 $email = $row['email'];
                                 $gender = $row['gender'];
                                 $date = $row['date'];
                                 $password = $row['password'];
                                 ?>
                                <tr>
                                  <td><?php echo $full_name; ?></td>
                                  <td><?php echo $phone;?></td>
                                  <td><?php echo $email;?></td>
                                  <td><?php echo $gender;?></td>
                                  <td><?php echo time_ago($date);?></td>
                                  <td><?php echo $password; ?></td>
                                  <td>
                                      <form method="POST" action="includes/delete-staff-request.php" id="delete_staff_request">
                                          <input type="hidden" id="delete_id" name="delete_id" value="<?php echo $id; ?>">
                                          <button type="submit" class="btn btn-xs" name="delete_request_btn" id="delete_request_btn"><span class="fa fa-trash"></span></button>
                                        </form>
                                  </td>
                                </tr>
                                <?php
                              }
                            }
                                ?>
                              </table>
                            </div>
                          </div>
                        </div>

                      </div>
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
    <script type="text/javascript" src="../assets/js/lightbox.min.js"></script>
    <script type="text/javascript">
      var generate = $('#generate').val();
      var awaiting_id = $('#awaiting_id').val();
      $('#generate').click(function (e){
        e.preventDefault();
        $.post('includes/random_password.php',{
          generate:generate,
          awaiting_id: awaiting_id
        },
        function (data,status){
          $('#random_password').html(data);
          $('#generated_password').attr("value",data);
        })
      })

      var delete_request_btn = $('#delete_request_btn').val();
      var delete_id = $('#delete_id').val();
      $('#delete_staff_request').submit(function (event){
        event.preventDefault();
        $('#delete_request_error').load('includes/delete-staff-request.php',{
          delete_request_btn:delete_request_btn,
          delete_id: delete_id
        })
      })

    </script>
  </body>
  </html>
  <?php endif;?>