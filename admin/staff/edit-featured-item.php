      <?php
      session_start();
      include 'includes/connect.php';
      $errorMsg = '';
      $id = $_SESSION['id'];
      if (!isset($_GET['item'])) {
            echo "<script>window.location = 'featured-pictures.php';</script>";
      }
      $item = $_GET['item'];
      $fetch_items = $conn->query("SELECT * FROM featured WHERE id = '$item'") or die(mysqli_error($conn));
      if (mysqli_num_rows($fetch_items) < 1) {
            echo "<script>window.location = 'featured-pictures.php';</script>";
      }
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
                        <div class="container" style="width:98%; margin-top: 5%;background: #fff;padding: 4%;">
                              <small>NB: Delete default image before adding a new one to save disk space</small>
                              <form method="POST" enctype="multipart/form-data" id="fileform" class="row">
                                    <?php if(isset($_POST['add_featured_btn'])):?>
                                          <p id="formError"><?= $errorMsg; ?></p>
                                    <?php endif;?>
                                    <?php
                                    $row = mysqli_fetch_assoc($fetch_items);
                                    if (!empty($row['featured_image'])) {
                                         $featured_image = explode('/', $row['featured_image']);
                                    $featured_image = '../'.$featured_image[3].'/'.$featured_image[4].'/'.$featured_image[5].'/'.$featured_image[6];
                                    }
                                    ?>
                                    <input type="hidden" name="feature_id" id="feature_id" value="<?= $row['id']; ?>">
                                    <div class="col-md-6">
                                          <button class="btn btn-sm btn-danger" type="button" id="featured_image_del_btn" onclick="return feat_img_del(<?= $row['id']; ?>)"><span class="fa fa-trash"></span></button>
                                          <img class="file_drag_area_img" <?= (!empty($row['featured_image'])?'src="'.$featured_image.'"':'') ?>>
                                    </div>
                                    <div class="col-md-6" style="margin-top: 2%;">
                                          <label>Featured Text *</label> <small id="countdown"></small>
                                          <div class="form-group credential_form">
                                                <textarea class="form-control" rows="8" id="featured-text" name="featured_text"><?= (isset($_POST['featured_text'])?$_POST['featured_text']:$row['featured_text']); ?></textarea>
                                          </div>
                                    </div>
                                    <div class="col-md-3">
                                          <label>Featured Picture</label>
                                          <div class="form-group credential_form">
                                                <input class="form-control" type="file" name="featured_image" id="picname">
                                          </div>
                                    </div>
                                    <div class="col-md-12" align="center">
                                          <p><button type="button" class="btn btn-primary" id="edit_featured_btn" name="edit_featured_btn">Update Featured Item</button></p>
                                    </div>
                              </form>
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
                  $('#featured_image_del_btn').click(function (){
                        var item = '<?= $item; ?>';
                        var path = '<?= $row["featured_image"]; ?>';
                        swal({
                          title: "Are you sure?",
                          text: "Your will not be able to recover this image!",
                          type: "warning",
                          showCancelButton: true,
                          confirmButtonClass: "btn-danger",
                          confirmButtonText: "Yes, delete it!",
                          closeOnConfirm: false
                    },
                    function(){
                          $.ajax({
                              url: 'includes/featured-item-image-delete.php',
                              method: 'POST',
                              data:{
                                    item:item,
                                    path:path
                              },
                              success:function(data){
                                    if (data == "Image deleted successfully") {
                                          swal('Info',''+data+'. Page will refresh','info');
                                          setInterval(reload_function, 1000); 
                                    }else{
                                          swal('Info',''+data,'info');
                                    }    
                              }
                        });
                    });
                  })
                  function reload_function(){
                  window.location.reload();
            }
            </script>

      </body>
      </html>
<?php endif;?>