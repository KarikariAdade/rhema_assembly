<?php
include 'connect.php';
if (isset($_POST['email'])) {
	$email = $_POST['email'];
	$sql = "UPDATE messages SET status='read' WHERE receiver_email = '$email'";
	$query = mysqli_query($conn, $sql);
}