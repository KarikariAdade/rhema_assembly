<?php
include 'connect.php';
if (isset($_POST['sermon_delete_btn'])) {
	$sermon_id = $_POST['sermon_id'];
	$sermon_image = $_POST['sermon_image'];

	$seg = explode("/", $sermon_image);
	// print_r($seg);
	$img = $seg['8'];
	// echo $img;
	$sql = "DELETE FROM sermon WHERE id= '$sermon_id'";
	$query = mysqli_query($conn, $sql);
	$unlink = unlink("../../assets/uploads/sermon/".$img);
	if ($query || $unlink) {
		echo "<script>window.location = '../view-sermons.php';</script>";
	}else{
		echo "<script>window.location = '../view-sermons.php';</script>";
	}
}
?>