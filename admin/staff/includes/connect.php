<?php
date_default_timezone_set("Africa/Accra");
$localhost = "fdb21.awardspace.net";
$root = "3098535_rhemassembly";
$password = "godovermoney0548";
$db_name = "3098535_rhemassembly";


$conn = mysqli_connect($localhost, $root, $password, $db_name) or die("Could not connect to database".mysqli_error($conn));
?>