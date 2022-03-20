<?php
include 'connect.php';
if (isset($_POST['sermon_delete_btn'])) {
	$sermon_id = $_POST['sermon_id'];
	$sermon_image = $_POST['sermon_image'];
        
        $fetch_file = $conn->query("SELECT sermon_file FROM sermon WHERE id = '$sermon_id'");
        $row = mysqli_fetch_assoc($fetch_file);
        $file_seg = explode('/', $row['sermon_file']);
        $sermon_file = $file_seg[7];
	$seg = explode("/", $sermon_image);
	$img = $seg[7];
	$sql = "DELETE FROM sermon WHERE id= '$sermon_id'";
	$query = mysqli_query($conn, $sql);
	$unlink = unlink("../assets/uploads/sermon/".$img);
        $unlink_file = unlink('../assets/uploads/sermon_file/'.$sermon_file);
	if ($query || $unlink || $unlink_file) {
		echo "<script>window.location = '../view-sermons.php';</script>";
	}else{
		echo "<script>window.location = '../view-sermons.php';</script>";
	}
}
?>