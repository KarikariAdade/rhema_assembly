 <?php
 session_start();
 include 'connect.php';
 $errorMsg ='';
if (isset($_POST['announcement_update_btn'])) {
  $id = mysqli_real_escape_string($conn, $_POST['id']);
  $image = mysqli_real_escape_string($conn, $_POST['image']);
  $announcement_title = mysqli_real_escape_string($conn, $_POST['announcement_title']);
  $publisher_name = mysqli_real_escape_string($conn, $_POST['publisher_name']);
  $announcement_category = mysqli_real_escape_string($conn, $_POST['announcement_category']);
  // $announcement_image = $_POST['announcement_image'];
  $announcement_description = mysqli_real_escape_string($conn, $_POST['announcement_description']);
$errorMsg = "You tried updating your announcement_description";
}
?>