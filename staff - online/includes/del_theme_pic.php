<?php
include 'connect.php';
if (isset($_POST['theme_pic_id'])) {
	$theme_pic_id = $_POST['theme_pic_id'];
	$fetch_theme = $conn->query("SELECT * FROM themes WHERE id = '$theme_pic_id'");
	$row = mysqli_fetch_assoc($fetch_theme);
	$theme_pic = explode('/', $row['theme_picture']);
	$theme_pic = $theme_pic[8];
	$unlink = unlink('../../assets/uploads/theme/'.$theme_pic);
	$del_query = $conn->query("UPDATE themes SET theme_picture = NULL WHERE id = '$theme_pic_id'") or die(mysqli_error($conn));
	if ($del_query && $unlink) {
		echo "Theme picture successfully deleted, page is being refreshed";
	}else{
		echo "Theme picture could not be deleted. Please try again later";
	}
}
?>