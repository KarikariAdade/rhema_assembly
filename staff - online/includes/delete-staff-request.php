<?php
include 'connect.php';
if (isset($_POST['delete_request_btn'])) {
	$delete_id = $_POST['delete_id'];
	$request_error = false;
	$sql = "DELETE FROM staff_request WHERE id='$delete_id'";
	$query = mysqli_query($conn, $sql);
	if ($query) {
		$request_error = false;
		echo "Staff request has been deleted successfully.";
	}else{
		$request_error = true;
		echo "Staff request could not be deleted. Please try again";
	}
}
?>
<script type="text/javascript">
	var request_error = "<?php echo $request_error; ?>";
	if (request_error == false) {
		$('#delete_request_error').css("color", "green");
		function redirect(){
			window.location = 'staff-request.php';
		}
		setInterval(redirect, 2000);
	}
</script>