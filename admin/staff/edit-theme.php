<?php
session_start();
include 'includes/connect.php';
$id = $_SESSION['id'];
include 'includes/edit-theme-validation.php';
?>
 <?php if (!isset($_SESSION['id'])):?>
  <?php  echo "<script>window.location = 'sign-in.php';</script>"; ?>
<?php else:?>
  <!DOCTYPE html>
  <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Rhema Assembly Annual Theme</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="../assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/dist/css/all.css">
    <link rel="stylesheet" href="../assets/bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/js/summernote/dist/summernote.css">
    <link rel="stylesheet" href="../assets/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/admin.css">
    <link rel="stylesheet" href="../assets/js/datatable/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/style.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" type="text/css" href="../assets/css/sweetalert.css">
  </head>
  <body>
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
  <?php
  if (!isset($_GET['year']) || !isset($_GET['id'])) {
    echo "<script>window.location = 'theme.php';</script>";
  }
  $theme_year = $_GET['year'];
  $theme_id = $_GET['id'];
  $fetch_theme = $conn->query("SELECT * FROM themes WHERE id = '$theme_id' AND theme_year = '$theme_year'") or die(mysqli_error($conn));
  $row = mysqli_fetch_assoc($fetch_theme);
  $theme_pic = explode('/', $row['theme_picture']);
  ?>
  <div class="container-fluid">
    <div class="row">
     <div class="col-md-10">
      <div class="card" style="background-color: #fff;margin-top: 5%;">
       <div class="card-body">
         <form role="form" style="padding: 10px 40px;" class="row edit_theme_form" method="POST" action="" enctype="multipart/form-data">
          <?php if(isset($_POST['edit_theme_btn'])):?>
            <p id="formError"><?= $errorMsg;?></p>
          <?php endif;?>
          <div class="box-body col-md-6">
            <input type="hidden" name="theme_id" value="<?= $theme_id; ?>">
            <label>Theme Title *</label>
            <div class="input-group credential_form">
              <div class="input-group-addon credential_form">
                <i class="fa fa-marker"></i>
              </div>
              <input type="text" class="form-control" name="theme_title" id="theme_title" value="<?= (isset($_POST['theme_title'])?$_POST['theme_title']:$row['theme_title']);?>">
            </div>
          </div>
          <div class="box-body col-md-6">
            <label>Bible Verse(s) * NB: Seperate with a comma</label>
            <div class="input-group credential_form">
              <div class="input-group-addon credential_form">
                <i class="fa fa-bible"></i>
              </div>
              <input type="text" class="form-control" name="theme_verse" id="theme_verse" value="<?= (isset($_POST['theme_verse'])?$_POST['theme_verse']:$row['bible_verse']); ?>">
            </div>
          </div>
          <div class="box-body col-md-6">
            <label>Theme Year *</label>
            <div class="input-group credential_form">
              <div class="input-group-addon credential_form">
                <i class="fa fa-calendar-alt"></i>
              </div>
              <input type="number" class="form-control" name="theme_year" id="theme_year" value="<?= (isset($_POST['theme_year'])?$_POST['theme_year']:$row['theme_year']); ?>">
            </div>
          </div>
          <div class="box-body col-md-6">
            <label>Theme Picture *</label>
            <div class="input-group credential_form">
              <div class="input-group-addon credential_form">
                <i class="fa fa-file-upload"></i>
              </div>
              <input type="file" class="form-control" name="theme_picture" id="theme_picture">
            </div><br>

            <!-- Button to delete theme pic before uploading new one -->
            <div class="theme_pic_section">
              <button type="btn" class="theme_pic_delete btn btn-danger"><span class="fa fa-trash"></span></button>
              <!-- End of button to delete theme pic -->
              <img class="img-fluid" id="edit_theme_old_pic" src="../assets/uploads/theme/<?=$theme_pic[8];?>">
            </div>
          </div>
          <div class="col-lg-12 col-sm-12" style="margin-top: 5%;text-align: center;">
            <div class="body" align="left">
              <textarea class="summernote form-control no-resize" type="text" name="theme_description" id="theme_description" placeholder="Type your theme description here" style="resize: none !important;"><?= (isset($_POST['theme_description'])?$_POST['theme_description']:$row["theme_description"]); ?>
              </textarea>
            </div>
            <button class="btn btn-primary" name="edit_theme_btn" align="center" type="submit">Add Theme</button>
          </div>
        </form>
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
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="../assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../assets/dist/js/all.js"></script>
<script src="../assets/dist/js/adminlte.min.js"></script>
<script src="../assets/dist/js/pages/dashboard.js"></script>
<script src="../assets/dist/js/demo.js"></script>
<script src="../assets/js/datatablescripts.bundle.js"></script>
<script src="../assets/js/datatable/buttons/dataTables.buttons.min.js"></script>
<script src="../assets/js/datatable/buttons/buttons.bootstrap4.min.js"></script>
<script src="../assets/js/datatable/buttons/buttons.colVis.min.js"></script>
<script src="../assets/js/datatable/buttons/buttons.flash.min.js"></script>
<script src="../assets/js/datatable/buttons/buttons.html5.min.js"></script>
<script src="../assets/js/datatable/buttons/buttons.print.min.js"></script>
<script type="text/javascript" src="../assets/js/summernote/dist/summernote.js"></script>
<script src="../assets/js/datatable/buttons/jquery-datatable.js"></script>
<script type="text/javascript" src="../assets/js/sweetalert.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('.theme_pic_delete').click(function(e){
      e.preventDefault();
      var theme_pic_id = '<?= $theme_id;?>';
      swal({
        title: "Are you sure?",
        text: "You will not be able to recover this picture!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete!",
        cancelButtonText: "No, cancel!",
        closeOnConfirm: false,
        closeOnCancel: false
      },
      function(isConfirm) {
        if (isConfirm) {
          $.ajax({
            url: 'includes/del_theme_pic.php',
            method: 'POST',
            data:{theme_pic_id:theme_pic_id},
            success:function(data){
              if (data == "Theme picture successfully deleted, page is being refreshed") {
                swal("Info", data, "warning");
                setInterval(reload,3500);
              }
            },
            error:function(){
              swal('Danger', 'There is an error', 'error');
            }
          })
        } else {
          swal("Cancelled", "File deletion cancelled", "error");
        }
      });
    });
  });
  function reload(){
    window.location.reload();
  }
  var success = '<?= $success; ?>';
  if (success == true) {
    $('#formError').css('color','green');
  }
  var theme_picture = '<?= $row["theme_picture"]; ?>';
  if (theme_picture == "") {
    $('.theme_pic_section').hide();
  }
</script>
</body>
</html>
<?php endif;?>