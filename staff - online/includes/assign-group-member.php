<?php
include 'connect.php';
if (isset($_POST['assign_group_btn'])) {
	$member_id = mysqli_real_escape_string($conn, $_POST['member_id']);
	$bible_study_group = mysqli_real_escape_string($conn, $_POST['bible_study_group']);
	$home_cells_group = mysqli_real_escape_string($conn, $_POST['home_cells_group']);
	$errorMsg = false;
	if (!empty($bible_study_group) || !empty($home_cells_group)) {
		$sql = "UPDATE members SET home_cell_group = '$home_cells_group',
		 bible_study_group = '$bible_study_group'
		  WHERE id = '$member_id'";
		$query = mysqli_query($conn, $sql);
		if ($query) {
			$errorMsg = false;
			echo "Member successfully assigned to group(s)";
		}else{
			$errorMsg = true;
			echo "Member could not be assigned to group(s)".mysqli_error($conn);
		}
	}else{
		$errorMsg = true;
		echo "Please assign a group before submitting";
	}

}
?>
<script type="text/javascript">
	var errorMsg = "<?php echo $errorMsg; ?>";
	if (errorMsg == false) {
		$('#formError').css('color','green');
	}
</script>