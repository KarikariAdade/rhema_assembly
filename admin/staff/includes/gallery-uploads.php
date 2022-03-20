<?php
include 'connect.php';
$output = '';
// $tmp_name = $_FILES['file']['tmp_name'];
if (isset($_FILES['file']['name'][0])) {
	// echo "ok";
	foreach ($_FILES['file']['name'] as $keys => $values) {
		if (move_uploaded_file($_FILES['file']['tmp_name'][$keys], '../../assets/uploads/gallery/'.$values)) {
			$file_name = $_FILES['file']['name'];
			$url = $_SERVER['HTTP_REFERER'];
			$seg = explode("/", $url);
			$path = $seg[0]."/".$seg[1]."/".$seg[2]."/".$seg[3]."/".$seg[4];
			$full_image_path = $path."/"."assets/uploads/gallery/".$values;
			$sql = "INSERT INTO gallery(category, picture, date_uploaded) VALUES ('Committee Pictures', '$full_image_path', now())";
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