<?php
include 'connect.php';
if (isset($_POST['theme_id'])) {
	$theme_id = $_POST['theme_id'];
	$fetch_theme = $conn->query("SELECT * FROM themes WHERE id = '$theme_id'");
	$theme_count = mysqli_num_rows($fetch_theme);
	$row = mysqli_fetch_assoc($fetch_theme);
	$theme_pic = explode('/', $row['theme_picture']);
	$theme_pic = $theme_pic[8];
	$unlink = unlink('../../assets/uploads/theme/'.$theme_pic);
	$del_query = $conn->query("DELETE FROM themes WHERE id = '$theme_id'");
	if ($del_query && $unlink) {
		echo "Theme successfully deleted. You are being redirected";
	}else{
		echo "Theme could not be deleted. Try again later";
	}
}
?>