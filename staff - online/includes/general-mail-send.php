<?php
include 'connect.php';
if (isset($_POST['general_mail_submit_btn'])) {
	$reply_id = mysqli_real_escape_string($conn, $_POST['reply_id']);
	$contact_reply_id = mysqli_real_escape_string($conn, $_POST['contact_reply_id']);
	$contact_reply_email = mysqli_real_escape_string($conn, $_POST['contact_reply_email']);
	$contact_reply_name = mysqli_real_escape_string($conn, $_POST['contact_reply_name']);
	$receiver_email = mysqli_real_escape_string($conn, $_POST['receiver_email']);
	$reply_title = mysqli_real_escape_string($conn, $_POST['reply_title']);
	$reply_desc = mysqli_real_escape_string($conn, $_POST['reply_desc']);
	$errorForm = false;
	if (!empty($receiver_email) && !empty($reply_title) && !empty($reply_desc)) {
	if (!filter_var($receiver_email, FILTER_VALIDATE_EMAIL)) {
			echo "Invalid Email Address";
			$errorForm = true;
		}else{
			$sql = "UPDATE mailbox SET
			contact_reply_id = '$contact_reply_id',
			contact_reply_name = '$contact_reply_name',
			contact_reply_email = '$contact_reply_email',
			reply_title = '$reply_title',
			reply_message = '$reply_desc',
			reply_status = 'Yes' WHERE id = '$reply_id'
			";
			$query = mysqli_query($conn, $sql);
			if ($query) {
				$errorForm = false;
				echo "Message sent successfully";
			}else{
				$errorForm = true;
				echo "Message was not sent".mysqli_error($conn);
			}
		}	
	}
}
?>
<script type="text/javascript">
	var errorForm = "<?php echo $errorForm; ?>";
	if (errorForm == false) {
		$('#formError').css('color', 'green');
	}
</script>