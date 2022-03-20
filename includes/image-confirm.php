<?php

// Membership validation form (Image upload)
include 'connect.php';
if (isset($_POST['data'])) {
	$data = $_POST['data'];
	$file_name =$_FILES['file']['name'];
	$check = $conn->query("SELECT * FROM members WHERE email = '$data'");
	$row = mysqli_fetch_assoc($check);
	$reg_email = $row['email'];

	$file_explode = explode('.', $file_name);
	$allowed_extension = array('jpg','jpeg','png','gif');
	if (!in_array($file_explode[1], $allowed_extension)) {
		echo "Upload only images";
	}elseif ($_FILES['file']['size'] > 2000000) {
		echo "Image should not be more than 2MB";
	}else{
		$http_ref = $_SERVER['DOCUMENT_ROOT'];
		$source_path =$_FILES['file']['tmp_name'];
		$target_path = $http_ref.'/rhema_assembly/admin/assets/uploads/members/'.$file_name;
		if (move_uploaded_file($source_path, $target_path)) {
			$update_query = $conn->query("UPDATE members SET picture = '$target_path' WHERE email = '$data'") or die(mysqli_error($conn));
			echo "Image uploaded successfully";
		}else{
			echo "Image could not be uploaded. ";
		}
	}
}
?>