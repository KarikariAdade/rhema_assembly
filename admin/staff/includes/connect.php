<?php
date_default_timezone_set("Africa/Accra");
$localhost = "localhost";
$root = "root";
$password = "";
$db_name = "rhema_assembly";


$conn = mysqli_connect($localhost, $root, $password, $db_name) or die("Could not connect to database".mysqli_error($conn));
?>