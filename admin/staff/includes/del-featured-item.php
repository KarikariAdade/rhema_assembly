<?php
include 'connect.php';
if (isset($_POST['id'])) {
	$id = $_POST['id'];
	$fetch_featured = $conn->query("SELECT featured_image FROM featured WHERE id = '$id'");
	$row = mysqli_fetch_assoc($fetch_featured);
	$root = $_SERVER['DOCUMENT_ROOT'];
	if (!empty($row['featured_image'])) {
		$db_path = explode('/', $row['featured_image']);
		$new_path = $root.'/'.$db_path[1].'/'.$db_path[2].'/'.$db_path[3].'/'.$db_path[4].'/'.$db_path[5].'/'.$db_path[6];
		$unlink = unlink($new_path);
		$del_item = $conn->query("DELETE FROM featured WHERE id = '$id'") or die(mysqli_error($conn));
		if ($unlink && $del_item) {
			echo "Featured item deleted successfully";
		}else{
			echo "Featured item could not be deleted";
		}
	}

}
?>