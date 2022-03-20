<?php
include 'connect.php';
if (isset($_POST['data'])) {
	$mark_active = (isset($_POST['mark_active'])?htmlspecialchars(mysqli_real_escape_string($conn, $_POST['mark_active'])):'');
	$featured_text = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['featured_text']));
	if (!empty($featured_text)) {
		if (!empty($_FILES['featured_image']['name'])) {
			$file_name = $_FILES['featured_image']['name'];
			$file_name_explode = explode('.', $file_name);
			$file_path = $_FILES['featured_image']['tmp_name'];
			$target_dir = "../../assets/uploads/featured/";
			$target_file = $target_dir.basename($file_name);
			$target = $_SERVER['HTTP_REFERER'];
			$target = explode('/', $target);
			$target_path = $target[2].'/'.$target[3].'/'.$target[4].'/assets/uploads/featured/'.$file_name;
			$allowed_ext = array('jpg', 'jpeg', 'png');
			if (!in_array($file_name_explode[1], $allowed_ext)) {
				echo "Upload only image files";
			}elseif ($_FILES['featured_image']['size'] > 2000000) {
				echo "File size should be less than 2MB";
			}else{
				if (move_uploaded_file($file_path, $target_file)) {
					if (!empty($mark_active)) {
						$add = $conn->query("INSERT INTO featured (featured_text, featured_image, status) VALUES ('$featured_text', '$target_path',1)") or die(mysqli_error($conn));
						if ($add) {
							echo "Featured item added";
						}
					}else{
						$add = $conn->query("INSERT INTO featured (featured_text, featured_image) VALUES ('$featured_text', '$target_path')") or die(mysqli_error($conn));
						if ($add) {
							echo "Featured item added";
						}
					}
				}
			}
		}else{
			echo "Add a featured image to proceed";
		}
	}else{
		echo "Featured Text field should not be empty";
	}
}
?>