<?php
include 'connect.php';
if (isset($_POST['category'])) {
	$category = $_POST['category'];
	$conn->query("UPDATE notification SET status = 1 WHERE status = 0 AND category = '$category'");
	$notification_sql = "SELECT * FROM notification WHERE status=0";
$notification_query = mysqli_query($conn, $notification_sql);
$notification_count = mysqli_num_rows($notification_query);
echo $notification_count;
}
?>