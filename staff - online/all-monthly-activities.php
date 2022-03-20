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
   <style type="text/css">
       @media print{
        #no-print{
          display: none;
        }
      }
   </style>
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
        <div class="row" style="margin-top: 5%;">
          <div class="col-lg-4" id="no-print">
          <div class="form-group credential form">
          <select name="month" id="month" class="form-control select2 select2-hidden-accessible">
            <option value="">Select Month</option>
            <option value="January">January</option>
            <option value="February">February</option>
            <option value="March">March</option>
            <option value="April">April</option>
            <option value="May">May</option>
            <option value="June">June</option>
            <option value="July">July</option>
            <option value="August">August</option>
            <option value="September">September</option>
            <option value="October">October</option>
            <option value="November">November</option>
            <option value="December">December</option>
          </select>
</div></div>
<div class="col-lg-4" id="no-print">
  <div class="form-group credential form">
          <select name="year" id="year" class="form-control select1 select2-hidden-accessible">
           <option value="<?php echo date('Y'); ?>">Current Year</option>
            <?php 
            $year_sql = "SELECT * FROM monthly_activities GROUP BY year";
            $year_query = mysqli_query($conn, $year_sql);
            while ($row = mysqli_fetch_assoc($year_query)) {
              $year = $row['year'];
             ?>
            <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
            <?php
          }
            ?>
          </select>
        </div>
</div>
          <div class="col-lg-12" style="background-color: #fff;padding: 4% 10px; width: 98%;">
            <div class="card">
              <div class="body">
                <div class="table-responsive">
                  <table class="table table-bordered table-striped table-hover datatable" style="margin-top: 2%!important;">
                    <p id="shitmonth"></p>
                     <thead>
                      <tr>
                       <th>Week</th>
                       <th>Day/Date</th>
                       <th>Activity</th>
                       <th>Opening Prayer</th>
                       <th>Worship</th>
                       <th>Sermon</th>
                       <th>Intensive Prayer</th>
                       <th>Offering</th>
                       <th>Conductor</th>
                       <th>Benediction</th>
                     </tr>
                   </thead>
                   <tbody id="show_month">
                   </tbody>
                   
                 </table>
               </div>
             </div>
             <button class="btn pull-right btn-info" id="print"><span class="fa fa-print"></span> Print</button>
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
    $(document).ready(function(){
      $('#month, #year').change(function(){
        var month_name = $('#month').val();
        var year = $('#year').val();
        $('#shitmonth').html("<h2 align='center' style='margin-bottom:3%;'>The Church Of Pentecost - Rhema Assembly<br>Sunday Service Schedule for "+month_name+" "+year+"</h2>");
        $.ajax({
          url: 'includes/load_month.php',
          method: 'POST',
          data:{
            month_name: month_name,
             year:year
           },
          success:function (data){
            $('#show_month').html(data);
          }
        })
      })
      $('#print').click(function (){
        window.print();
      })
    })
  </script>

</body>
</html>
<?php endif;?>