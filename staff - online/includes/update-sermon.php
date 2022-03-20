<?php
include 'connect.php';
function slug($text){
  $text = str_replace(' ', '-', $text);
  $text = preg_replace('/[^A-Za-z\-]/', '', $text);
  $text = preg_replace('/-+/', '-', $text);
  $text = strtolower($text);
  return $text;
}
 // $id = $_SESSION['id'];
if (isset($_POST['sermon_update_btn'])) {
	$publisher_id = $_POST['publisher_id'];
	$sermon_id = mysqli_real_escape_string($conn, $_POST['sermon_id']);
	$sermon_title = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['sermon_title']));
	$preacher = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['sermon_author']));
	$bible_verse = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['bible_verse']));
	$sermon_link = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['sermon_link']));
	$sermon_category = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['sermon_category']));
	$sermon_description = mysqli_real_escape_string($conn, $_POST['sermon_description']);
	$sermon_slug = slug($sermon_title);
	$sermon_del_img = $_POST['sermon_del_img'];
  $sermon_del_file = $_POST['sermon_file'];

	if (!empty($sermon_title) && !empty($preacher) && !empty($bible_verse) && !empty($sermon_link) && !empty($sermon_category) && !empty($sermon_description)) {
        if (!empty($file_del_img)){
        $del_seg = explode("/", $sermon_del_img);
    $img = $del_seg[8];
    unlink("assets/uploads/sermon/".$img);
    }
		
                if(!empty($sermon_del_file)){
  $del_file_seg = explode("/", $sermon_del_file);
    $del_file = $del_file_seg[7];
    unlink("assets/uploads/sermon_file/".$del_file);
                }

    $file_name = $_FILES['sermon_image']['name'];
    $file_size = $_FILES['sermon_image']['size'];
    $file_tmp_name = $_FILES['sermon_image']['tmp_name'];
    $file_type = $_FILES['sermon_image']['type'];
    $target_dir = "../assets/uploads/sermon/";
    $target_file = $target_dir.basename($file_name);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $errorMsg = $target_file;
    $sermon_file_name = $_FILES['sermon_file']['name'];
    $sermon_file_size = $_FILES['sermon_file']['size'];
    $sermon_file_tmp_name = $_FILES['sermon_file']['tmp_name'];
    $sermon_file_type = $_FILES['sermon_file']['type'];
    $sermon_target_dir = "../assets/uploads/sermon_file/";
    $sermon_target_file = $sermon_target_dir.basename($sermon_file_name);
    $sermon_uploadOk = 1;
    $sermon_FileType = strtolower(pathinfo($sermon_target_file,PATHINFO_EXTENSION));

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
    elseif ($sermon_file_size > 5000000) {
      $errorMsg = "Sermon File should not be more than 5mb";
      $sermon_uploadOk = 0;
    }elseif ($sermon_FileType != "pdf" && $sermon_FileType != "docx" && $sermon_FileType != 'doc') {
      $errorMsg = "Only pdf and .docx documents are allowed";
      $sermon_uploadOk = 0;
    }elseif ($sermon_uploadOk == 0) {
      $errorMsg = "Sermon File could not be uploaded";
    }else{
      if (move_uploaded_file($file_tmp_name, $target_file) && move_uploaded_file($sermon_file_tmp_name, $sermon_target_file)) {

        $image_url = $_SERVER['HTTP_REFERER'];
        $seg = explode("/", $image_url);
        $path = $seg[0]."/".$seg[1]."/".$seg[2]."/".$seg[3];
        $full_image_path = $path."/"."assets/uploads/sermon/".$file_name;
        $sermon_file_url = $_SERVER['HTTP_REFERER'];
        $sermon_seg = explode("/", $sermon_file_url);
        $sermon_path = $sermon_seg[0]."/".$sermon_seg[1]."/".$sermon_seg[2]."/".$sermon_seg[3];
        $errorMsg = $sermon_path;
        $sermon_full_image_path = $sermon_path."/"."assets/uploads/sermon_file/".$sermon_file_name;
        $sql = "UPDATE sermon SET 
        publisher_id = '$publisher_id',
        title = '$sermon_title',
        sermon_slug = '$sermon_slug',
        author = '$preacher',
        bible_verses = '$bible_verse',
        sermon_link = '$sermon_link',
        service_type = '$sermon_category',
        sermon_notes = '$sermon_description',
        sermon_file = '$sermon_full_image_path',
        sermon_image ='$full_image_path' WHERE id ='$sermon_id'";
        $query = mysqli_query($conn, $sql);
        if ($query) {
                    			// echo "<script>window.location = 'view-sermon.php';<script>";
         header("Location:view-sermons.php");
       }else{
         $errorMsg = "Sermon could not be uploaded".mysqli_error($conn);
       }
     }else{
      $errorMsg = "Sermon could not be uploaded".mysqli_error($conn);
    }
  }
}else{
 $errorMsg = "Fill all fields before submitting";
}
}
?>