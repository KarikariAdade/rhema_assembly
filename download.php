<?php
include 'includes/connect.php';
if (isset($_REQUEST['downloads'])) {
	$download = urldecode($_REQUEST['downloads']);

	$sql = "SELECT * FROM sermon WHERE sermon_slug = '$download'";
	$query = mysqli_query($conn, $sql);
	if (mysqli_num_rows($query) > 0) {
		while ($row = mysqli_fetch_assoc($query)) {
			$sermon_title = $row['title'];
			$sermon_file = $row['sermon_file'];
			$seg = explode("/", $sermon_file);
			$filename = $seg[8];
			$realfile = "admin/assets/uploads/sermon_file/".$filename;
			echo $realfile;
			if (file_exists($realfile)) {
				header('Content-Description: File Transfer');
				header('Content-Type: application/octet-stream');
				header('Content-Disposition: attachment; filename="'.basename($realfile).'"');
				header('Expires: 0');
				header('Cache-Control: must-revalidate');
				header('Pragma: public');
				header('Content-Length:'.filesize($realfile));
				readfile($realfile);
				exit;
			}else{
				echo "<script>window.location = 'view-sermons.php';</script>";
			}
		}
	}else{
		echo "<script>window.location = '../view-sermons.php';</script>";
	}
}