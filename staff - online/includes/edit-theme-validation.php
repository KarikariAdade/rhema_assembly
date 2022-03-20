<?php
include 'connect.php';
$errorMsg = '';
$success = false;
if (isset($_POST['edit_theme_btn'])) {
	$theme_title = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['theme_title']));
	$theme_verse = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['theme_verse']));
	$theme_year = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['theme_year']));
	$theme_description = mysqli_real_escape_string($conn, $_POST['theme_description']);
	$theme_id = $_POST['theme_id'];
	if (!empty($theme_title) && !empty($theme_verse) && !empty($theme_year) && !empty($theme_description)) {
		if (strlen($theme_description) < 50) {
			$errorMsg = "Theme Description should not be less than 50 characters";
		}else{
			if (!empty($_FILES['theme_picture']['name'])) {
				$file_name = $_FILES['theme_picture']['name'];
				$file_tmp_name = $_FILES['theme_picture']['tmp_name'];
				$file_type = array('jpg','png','jpeg');
				$target_dir = $_SERVER['DOCUMENT_ROOT'].'/admin/assets/uploads/theme/'.$file_name;
				$file_extension = explode('.', $file_name);
				$file_extension = $file_extension[1];
				if (!in_array($file_extension, $file_type)) {
					$errorMsg = "Upload only images";
				}else{
					if (move_uploaded_file($file_tmp_name, $target_dir)) {
						$query = $conn->query("UPDATE themes SET 
							theme_title = '$theme_title',
							bible_verse = '$theme_verse',
							theme_picture = '$target_dir',
							theme_description = '$theme_description',
							theme_year = '$theme_year' WHERE id = '$theme_id'") or die(mysqli_error($conn));
						if ($query) {
							$errorMsg = "Theme successfully updated";
							$success = true;
						}
					}else{
						$errorMsg = "File could not be uploaded. Try again";
					}
				}
			}else{
				$query = $conn->query("UPDATE themes SET 
					theme_title = '$theme_title',
					bible_verse = '$theme_verse',
					theme_description = '$theme_description',
					theme_year = '$theme_year' WHERE id = '$theme_id'") or die(mysqli_error($conn));
				if ($query) {
					$errorMsg = "Theme successfully updated";
					$success = true;
				}
			}
		}
	}else{
		$errorMsg = "Fill all fields before submtting";
	}
}
?>