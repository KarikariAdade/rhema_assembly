<?php
include 'connect.php';
if (isset($_POST['picture_delete_btn'])) {
	$picture_id = $_POST['picture_id'];
	$picture = $_POST['picture'];
	$seg = explode("/", $picture);
        print_r($seg);
	$img = $seg[7];
	$sql = "DELETE FROM gallery WHERE id= '$picture_id'";
	$query = mysqli_query($conn, $sql);
	unlink("../../assets/uploads/gallery/".$img);
	if ($query || $unlink) {
		echo "<script>window.location = '../view-gallery.php';</script>";
	}else{
		echo "<script>window.location = '../view-gallery.php';</script>";
	}

}
?>