<?php
$errorMsg = '';
$success = false;
include 'connect.php';
if (isset($_POST['add_theme_btn'])) {
	$theme_title = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['theme_title']));
	$theme_verse = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['theme_verse']));
	$theme_year = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['theme_year']));
	$theme_description = mysqli_real_escape_string($conn, $_POST['theme_description']);
	if (!empty($theme_title) && !empty($theme_verse) && !empty($theme_year) && !empty($theme_description)) {
		$fetch_theme = $conn->query("SELECT * FROM themes WHERE theme_year = '$theme_year'");
		if (mysqli_num_rows($fetch_theme) > 0) {
			$errorMsg = "You cannot add two themes for ".$theme_year." please change theme year, edit or delete ".$theme_year." theme before adding a new one";
		}else{
			if (strlen($theme_description) < 50) {
			$errorMsg = "Theme Description should not be less than 50 characters";
		}else{
			$file_name = $_FILES['theme_picture']['name'];
			if (isset($file_name)) {
				$file_tmp_name = $_FILES['theme_picture']['tmp_name'];
				$file_type = array('jpg','png','jpeg');
				$target_dir = $_SERVER['DOCUMENT_ROOT'].'/admin/assets/uploads/theme/'.$file_name;
				$file_extension = explode('.', $file_name);
				$file_extension = $file_extension[1];
				if (!in_array($file_extension, $file_type)) {
					$errorMsg = "Upload only images";
				}else{
					if (move_uploaded_file($file_tmp_name, $target_dir)) {
						$query = $conn->query("INSERT INTO themes (theme_title, bible_verse,theme_picture, theme_description, theme_year) VALUES ('$theme_title', '$theme_verse', '$target_dir', '$theme_description', '$theme_year')") or die(mysqli_error($conn));
						if ($query) {
							$errorMsg = "Theme successfully uploaded";
							$success = true;
						}
					}else{
						$errorMsg = "File could not be uploaded. Try again";
					}
				}
			}
		}
		}
	}else{
		$errorMsg = "Fill all fields before submtting";
	}
}
?>
