<?php
include 'connect.php';
echo "string";
$output = '';
// $tmp_name = $_FILES['file']['tmp_name'];
if (isset($_FILES['file']['name'][0])) {
	// echo "ok";
	foreach ($_FILES['file']['name'] as $keys => $values) {
		if (move_uploaded_file($_FILES['file']['tmp_name'][$keys], '../../assets/uploads/gallery/'.$values)) {
			$file_name = $_FILES['file']['name'];
			$url = $_SERVER['HTTP_REFERER'];
			$seg = explode("/", $url);
print_r($seg);
			$path = $seg[0]."/".$seg[1]."/".$seg[2]."/".$seg[3]."/".$seg[4];
			echo $path;
			$full_image_path = $path."/"."assets/uploads/gallery/".$values;
			echo $full_image_path;
			$sql = "INSERT INTO gallery(category, picture, date_uploaded) VALUES ('Service Pictures', '$full_image_path', now())";
			$query = mysqli_query($conn, $sql);
			if ($query) {
				echo "Picture saved to database";
				$output .='<div class="col-md-3"><img src="includes/'.$values.'">';
			}else{
				echo "Picture not saved to database";
			}
		}
	}
}
echo $output;
?>