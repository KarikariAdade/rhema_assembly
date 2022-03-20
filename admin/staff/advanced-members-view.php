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
          <?php
                  $sql = "SELECT * FROM members ORDER BY id DESC";
                  $query = mysqli_query($conn, $sql);
                      ?>
          <div class="col-md-4" style="margin-bottom: 5%;">
            <div class="form-group credential_form">
              <select class="form-control" name="career_category" id="career_category">
                <option>Career Category</option>
                 <?php
                 $sql = "SELECT * FROM members GROUP BY career_field";
                  $query = mysqli_query($conn, $sql);
                  while($row = mysqli_fetch_assoc($query)){
                    $career_field = $row['career_field'];
                ?>
                <option value="<?= $career_field; ?>"><?= $career_field; ?></option>
              <?php }?>
              </select>
            </div>
          </div>
           <div class="col-md-4">
            <div class="form-group credential_form">
              <select class="form-control select1 select2-hidden-accessible" name="member_status" id="member_status">
                <option value="">Member Status</option>
                <?php
                 $sql = "SELECT * FROM members GROUP BY marital_status";
                  $query = mysqli_query($conn, $sql);
                  while($row = mysqli_fetch_assoc($query)){
                    $member_status = $row['marital_status'];
                ?>
              <option value="<?= $member_status; ?>"><?= $member_status;?></option>
                <?php }?>
              </select>
            </div>
          </div>
           <div class="col-md-4">
             <div class="form-group credential_form">
              <select class="form-control" name="member_gender" id="member_gender">
                <option>Gender</option>
                <?php
                 $sql = "SELECT * FROM members GROUP BY gender";
                  $query = mysqli_query($conn, $sql);
                  while($row = mysqli_fetch_assoc($query)){
                    $member_gender = $row['gender'];
                ?>
                <option value="<?= $member_gender;?>"><?= $member_gender;?></option>
              <?php }?>
              </select>
            </div>
          </div>
        
          
          <div class="col-lg-12" style="background-color: #fff;padding: 4% 10px;">
            <div class="card">
              <div class="body">
                <div class="table-responsive">
                  <table class="table table-bordered table-striped table-hover dataTable js-exportable" style="margin-top: 2%!important;">
                    <thead>
                      <tr>
                       <th>First Name</th>
                       <th>Last Name</th>
                       <th>Gender</th>
                       <th>Email</th>
                       <th>BirthDate</th>
                       <th>Occupation</th>
                       <th>Address</th>
                       <th>Marital Status</th>
                       <th>Phone</th>
                       <th>Membership Duration</th>
                       <th>Baptism</th>
                       <th>Home Cell Group</th>
                       <th>Bible Studies Group</th>
                     </tr>
                   </thead>
                    
                 <tbody id="show_member">
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
<script type="text/javascript">
  $(document).ready(function (){
    $('#career_category, #member_status, #member_gender, #member_baptism').change(function (){
      var career_category = $('#career_category').val();
      var member_status = $('#member_status').val();
      var member_gender = $('#member_gender').val();
      $.ajax({
        url: 'includes/load-members.php',
        method: 'POST',
        data: {
          career_category: career_category,
          member_status: member_status,
          member_gender: member_gender
        },
        success:function(data){
          $('#show_member').html(data);
        }
      })
    })
  })
</script>
</body>
</html>
<?php endif;?>