<?php
include 'connect.php';
if (isset($_FILES['news_image'])) {
	$errorMsg = false;
	$news_id = mysqli_real_escape_string($conn, $_POST['news_id']);
	$image = mysqli_real_escape_string($conn, $_POST['image']);
	$news_title = mysqli_real_escape_string($conn, $_POST['news_title']);
	$news_author = mysqli_real_escape_string($conn, $_POST['news_author']);
	$news_category = mysqli_real_escape_string($conn, $_POST['news_category']);
	$news_description = mysqli_real_escape_string($conn, $_POST['news_description']);

	if (!empty($news_title) && !empty($news_author) && !empty($news_category) && !empty($news_description)) {
		$del_seg = explode("/", $image);
		$img = $del_seg['8'];
		// unlink ("../../assets/uploads/news/".$img);
		 $file_name = $_FILES['news_image']['name'];
        $file_size = $_FILES['news_image']['size'];
        $file_tmp_name = $_FILES['news_image']['tmp_name'];
        $file_type = $_FILES['news_image']['type'];
        $target_dir = "../assets/uploads/news/";
        $target_file = $target_dir.basename($file_name);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $errorMsg = $target_file;
        if ($file_size > 5000000) {
          $errorMsg = "Image should not be more than 5mb";
          $uploadOk = 0;
        }elseif ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
          && $imageFileType != "gif" ) {
          $errorMsg = "Sorry, only image files are allowed";
          $uploadOk = 0;
        }elseif ($uploadOk == 0) {
          $errorMsg = "Sorry, your file could not be uploaded. Try again.";
        }
	}
}
?>