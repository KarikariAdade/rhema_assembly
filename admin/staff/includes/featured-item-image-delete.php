<?php
include 'connect.php';
if (isset($_POST['item'])) {
	$item = $_POST['item'];
	$path = $_POST['path'];
	$fetch_item = $conn->query("SELECT featured_image FROM featured WHERE id = '$item'");
	$row = mysqli_fetch_assoc($fetch_item);
	$root = $_SERVER['DOCUMENT_ROOT'];
	if (!empty($row['featured_image'])) {
		$db_path = explode('/', $row['featured_image']);
		$new_path = $root.'/'.$db_path[1].'/'.$db_path[2].'/'.$db_path[3].'/'.$db_path[4].'/'.$db_path[5].'/'.$db_path[6];
		$unlink = unlink($new_path);
		$del_img = $conn->query("UPDATE featured SET featured_image = NULL WHERE id = '$item'");
		if ($unlink && $del_img) {
			echo "Image deleted successfully";
		}else{
			echo "Image could not be deleted";
		}
	}else{
		echo "No image found";
	}
}
?>