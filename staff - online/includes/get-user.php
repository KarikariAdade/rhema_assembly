<?php
include 'connect.php';
$user = $_REQUEST['user'];
$sql = "SELECT * FROM admin_profile WHERE first_name = '$user'";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($query);
json_encode($row); die;