<?php
include 'connect.php';
if (isset($_POST['generate'])) {
	$awaiting_id = $_POST['awaiting_id'];
	$string = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
 $password = substr(str_shuffle($string),0,15);
 $sql = "UPDATE staff_request SET
 password = '$password' WHERE id = '$awaiting_id'";
 $query = mysqli_query($conn, $sql);
 if ($query) {
 	echo $password;
 }else{
 	echo "Request could not be made".mysqli_error($conn);
 }
}                     
?>
<?php
if (isset($_POST['generated_password_btn'])) {
	$generated_password = $_POST['generated_password'];
	$string = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
 $password = substr(str_shuffle($string),0,15);
 echo $password;
}
 ?>