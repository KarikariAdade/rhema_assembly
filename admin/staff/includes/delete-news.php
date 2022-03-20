<?php
include 'connect.php';
if (isset($_POST['delete_news_btn'])) {
	$news_image = $_POST['news_image'];
	$news_id = $_POST['news_id'];
	$seg = explode("/", $news_image);
	$img = $seg[8];

	$sql = "DELETE FROM news WHERE id='$news_id'";
	$query = mysqli_query($conn, $sql);
	$unlink = unlink("../../assets/uploads/news/".$img);
	if ($query || $unlink) {
		echo "<script>window.location = '../view-news.php';</script>";
	}else{
		echo "<script>window.location = '../view-news.php';</script>";
	}
}
?>