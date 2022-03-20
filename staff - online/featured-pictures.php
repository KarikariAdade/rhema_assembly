<?php
session_start();
include 'includes/connect.php';
$errorMsg = '';
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
      		<link rel="stylesheet" type="text/css" href="../assets/css/sweetalert.css">
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
      			<div class="container" style="width:98%; margin-top: 5%;">
      				<div class="nav-tabs-custom">
      					<ul class="nav nav-tabs">
      						<li class="active"><a href="#add_featured" data-toggle="tab" aria-expanded="false">Add Featured Item</a></li>
      						<li class=""><a href="#view_featured" data-toggle="tab" aria-expanded="true">View Featured Items</a></li>
      					</ul>
      					<div class="tab-content">
      						<div class="tab-pane active" id="add_featured">
      							<small>NB: The text and images uploaded will appear on the church's homepage</small>
      							<form method="POST" enctype="multipart/form-data" id="fileform" class="row">
      								<?php if(isset($_POST['add_featured_btn'])):?>
      									<p id="formError"><?= $errorMsg; ?></p>
      								<?php endif;?>
      								<div class="col-md-6">

      									<img class="file_drag_area_img">
      								</div>
      								<div class="col-md-6" style="margin-top: 2%;">
      									<label>Featured Text *</label> <small id="countdown"></small>
      									<div class="form-group credential_form">
      										<textarea class="form-control" rows="8" id="featured-text" name="featured_text"><?= (isset($_POST['featured_text'])?$_POST['featured_text']:''); ?></textarea>
      									</div>
      								</div>
      								<div class="col-md-3">
      									<label>Featured Picture</label>
      									<div class="form-group credential_form">
      										<input class="form-control" type="file" name="featured_image" id="picname">
      									</div>
      								</div>
      								<div class="col-md-3">
      									<div class="form-group" style="margin-top: 15%;">
      										<input type="checkbox" name="mark_active" id="mark_active"> Mark Active
      									</div>
      								</div>
      								<div class="col-md-12" align="center">
      									<p><button type="button" class="btn btn-primary" id="add_featured_btn" name="add_featured_btn">Add Featured Item</button></p>
      								</div>
      							</form>

      						</div>
      						<div class="tab-pane" id="view_featured">
      							<?php
      							$fetch_feature = $conn->query("SELECT * FROM featured ORDER BY id DESC");
      							if (mysqli_num_rows($fetch_feature) > 0) {
      								while ($row = mysqli_fetch_assoc($fetch_feature)) {
      									$feature_id = $row['id'];
      								}
      							}
      							
                                             ?>
                                       </div>
                                 </div>
                           </div>
                     </div>
               </div>

               <?php include 'includes/aside.php';?>
         </div>
         <script type="text/javascript" src="../assets/js/jquery-3.3.1.min.js"></script>
         <script type="text/javascript" src="../assets/js/jquery-ui.min.js"></script>
         <script src="../assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
         <script src="../assets/dist/js/all.js"></script>
         <script src="../assets/dist/js/adminlte.min.js"></script>
         <script src="../assets/dist/js/pages/dashboard.js"></script>
         <script src="../assets/dist/js/demo.js"></script>
         <script type="text/javascript" src="../assets/js/feature.js"></script>
         <script type="text/javascript" src="../assets/js/sweetalert.min.js"></script>
         <script type="text/javascript">
          var id = '<?= $feature_id; ?>';
          $('#view_featured').load('includes/load-featured-items.php',{
               id: id
         });
          function reload(){
                window.location.reload();
          }

          function mark_function(id){
               var marked_status = $('#marked_status'+id);
               $.ajax({
                    url: 'includes/feature-status.php',
                    method: 'POST',
                    data:{
                         id:id
                   },
                   beforeSend:function(){
                         marked_status.html('Processing...');
                   },
                   success:function(data){
                         if (data == "Item successfully marked") {
                              $('.mark-btn'+id).html('<span class="fa fa-times fa-lg"></span>');
                              $('.mark-btn'+id).attr('title','Unmark');
                              
                        }
                        if(data == "Item successfully unmarked"){
                              $('.mark-btn'+id).attr('title','Mark');
                              $('.mark-btn'+id).html('<span class="fa fa-check fa-lg"></span>');
                        }
                        swal("Alert", ""+data, "info");
                        marked_status.html(data);
                  }
            })
         }
         function delete_featured_item(id){
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this image!",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
          },
          function(){
            $.ajax({
                  url: 'includes/del-featured-item.php',
                  method: 'POST',
                  data:{
                        id:id
                  },
                  success:function(data){
                        if (data == "Featured item deleted successfully") {
                              swal('Info', ''+data+'. Page will refresh', 'info');
                              setInterval(reload, 1000);
                        }else{
                              swal('Info', ''+data, 'info');
                        }
                        
                  }
            })
      })
            
      }
</script>
</body>
</html>
<?php endif;?>