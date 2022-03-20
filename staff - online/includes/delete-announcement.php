<?php
include 'connect.php';
if (isset($_POST['del_announcement'])) {
	$del_img = $_POST['del_img'];
	$id = $_POST['id'];
        if(!empty($del_img)){
        $seg = explode("/", $del_img);
	$img = $seg[7];
        $sql = "DELETE from announcement where id = '$id'";
	$query = mysqli_query($conn, $sql);
	$unlink = unlink("../../assets/uploads/announcement/".$img);
		if ( $unlink || $query) {
		echo "<script>window.location = '../view-announcements.php';</script>";
	}else{
		echo "<script>window.location = '../view-announcements.php';</script>";
	}
        }
}
?>