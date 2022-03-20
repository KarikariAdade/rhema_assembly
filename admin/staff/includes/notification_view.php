<?php
include 'connect.php';
$notif = "UPDATE notification SET status=1 WHERE status=0";
$query = mysqli_query($conn, $notif);