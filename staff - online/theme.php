<?php
session_start();
include 'includes/connect.php';
include 'includes/add_theme_validation.php';
?>
<?php if (!isset($_SESSION['id'])):?>
    <?php  echo "<script>window.location = 'sign-in.php';</script>"; ?>
    <?php else:?>
      <?php
      $id = $_SESSION['id'];
?>  
      
        <!DOCTYPE html>
        <html>
        <head>
          <meta charset="utf-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <title>Rhema Assembly Annual Theme</title>
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
          <link rel="stylesheet" type="text/css" href="../assets/js/summernote/dist/summernote.css">
          <link rel="stylesheet" href="../assets/dist/css/skins/_all-skins.min.css">
          <link rel="stylesheet" type="text/css" href="../assets/css/admin.css">
          <link rel="stylesheet" type="text/css" href="../assets/css/style.min.css">
          <!-- Google Font -->
          <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
          <link rel="stylesheet" type="text/css" href="../assets/css/sweetalert.css">
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
                <div class="nav-tabs-custom">
                  <ul class="nav nav-tabs">
                    <li class="active"><a href="#add_theme" data-toggle="tab" aria-expanded="false">Add Theme</a></li>
                    <li class=""><a href="#view_themes" data-toggle="tab" aria-expanded="true">View Themes</a></li>
                  </ul>
                  <div class="tab-content">
                    <div class="tab-pane active" id="add_theme">
                      <div class="row">
                        <div class="col-md-8">
                          <form role="form" class="row add_theme_form" method="POST" action="" enctype="multipart/form-data">
                            <?php if(isset($_POST['add_theme_btn'])):?>
                              <p id="formError"><?= $errorMsg;?></p>
                            <?php endif;?>
                            <div class="box-body col-md-6">
                              <label>Theme Title *</label>
                              <div class="input-group credential_form">
                                <div class="input-group-addon credential_form">
                                  <i class="fa fa-marker"></i>
                                </div>
                                <input type="text" class="form-control" name="theme_title" id="theme_title" value="<?= (isset($_POST['theme_title'])?$_POST['theme_title']:'');?>">
                              </div>
                            </div>
                            <div class="box-body col-md-6">
                              <label>Bible Verse(s) * NB: Seperate with a comma</label>
                              <div class="input-group credential_form">
                                <div class="input-group-addon credential_form">
                                  <i class="fa fa-bible"></i>
                                </div>
                                <input type="text" class="form-control" name="theme_verse" id="theme_verse" value="<?= (isset($_POST['theme_verse'])?$_POST['theme_verse']:''); ?>">
                              </div>
                            </div>
                            <div class="box-body col-md-6">
                              <label>Theme Year *</label>
                              <div class="input-group credential_form">
                                <div class="input-group-addon credential_form">
                                  <i class="fa fa-calendar-alt"></i>
                                </div>
                                <input type="number" class="form-control" name="theme_year" id="theme_year" value="<?= (isset($_POST['theme_year'])?$_POST['theme_year']:date('Y')) ?>">
                              </div>
                            </div>
                            <div class="box-body col-md-6">
                              <label>Theme Picture *</label>
                              <div class="input-group credential_form">
                                <div class="input-group-addon credential_form">
                                  <i class="fa fa-file-upload"></i>
                                </div>
                                <input type="file" class="form-control" name="theme_picture" id="theme_picture">
                              </div>
                            </div>
                            <div class="col-lg-12 col-sm-12" style="margin-top: 5%;margin-bottom:5%;">
                              <div class="body">
                               <textarea class=" form-control no-resize summernote" type="text" name="theme_description" id="summernote"></textarea>
                             </div>
                             <p align="center">
                              <button style="margin-top: 5%;" class="btn btn-primary" name="add_theme_btn" align="center" type="submit">Add Theme</button>
                            </p>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane" id="view_themes">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="table-responsive">
                          <table class="table table-bordered table-striped table-hover dataTable">
                            <thead>
                              <th>Theme Title</th>
                              <th>Theme Year</th>
                              <th>Edit Theme</th>
                              <th>Delete Theme</th>
                            </thead>
                            <tbody>
                              <?php
                              $theme = $conn->query("SELECT * FROM themes ORDER BY id DESC");
                              if (mysqli_num_rows($theme) > 0){
                                while ($row = mysqli_fetch_assoc($theme)) {
                                  $theme_id = $row['id'];
                                  ?>
                                  <tr>
                                    <td><a href="theme-detail.php?year=<?= urlencode($row['theme_year']);?>&id=<?= urlencode($row['id']);?>"><?= $row['theme_title']; ?></a></td>
                                    <td><a href="theme-detail.php?year=<?= urlencode($row['theme_year']);?>&id=<?= urlencode($row['id']);?>"><?= $row['theme_year']; ?></a></td>
                                    <td><a href="edit-theme.php?year=<?= urlencode($row['theme_year']);?>&id=<?= urlencode($row['id']);?>"><button class="btn btn-primary btn-xs"><span class="fa fa-edit"></span></button></a></td>
                                    <td><button class="btn btn-danger btn-xs delete_theme_btn" onclick="return delete_theme('<?= $theme_id; ?>')"><span class="fa fa-trash"></span></button></td>
                                  </tr>
                                  <?php }} ?>
                                </tbody>
                              </table>
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
            <script src="../assets/bower_components/jquery/dist/jquery.min.js"></script>
            <script src="../assets/bower_components/jquery-ui/jquery-ui.min.js"></script>
            <script src="../assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
            <script src="../assets/dist/js/all.js"></script>

            <!-- AdminLTE App -->
            <script src="../assets/dist/js/adminlte.min.js"></script>
            <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
            <script src="../assets/dist/js/pages/dashboard.js"></script>
            <!-- AdminLTE for demo purposes -->
            <script src="../assets/dist/js/demo.js"></script>
            <script type="text/javascript" src="../assets/js/sweetalert.min.js"></script>
            <script type="text/javascript" src="../assets/js/summernote/dist/summernote.js"></script>
            <script type="text/javascript">
              $(document).ready(function() {
                $('#summernote').summernote({
                  placeholder: "Type your theme description here",
                  height: 200
                });
                var success = '<?= $success; ?>';
                if (success == true) {
                  $('#formError').css('color','green');
                }
              });
              function delete_theme(theme_id){
                swal({
                  title: "Are you sure?",
                  text: "You will not be able to recover this theme!",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonClass: "btn-danger",
                  confirmButtonText: "Yes, delete!",
                  cancelButtonText: "No, cancel!",
                  closeOnConfirm: false,
                  closeOnCancel: false
                },
                function (isConfirm){
                  if (isConfirm) {
                    $.ajax({
                      url: 'includes/delete-theme.php',
                      method: 'POST',
                      data:{theme_id:theme_id},
                      success:function(data){
                        if (data == "Theme successfully deleted. You are being redirected") {
                          swal("Info", data, "warning");
                          setInterval(reload, 3500);
                        }
                      },
                      error:function(){
                        swal('Danger', 'Ajax request failed', 'error');
                      }
                    });
                  }else{
                    swal("Cancelled", "Theme deletion cancelled", "error");
                  }
                })
              }
              function reload(){
                window.location.reload();
              }
            </script>
          </body>
          </html>
        <?php endif;?>