<?php
include 'connect.php';
if (isset($_POST['mail_submit_btn'])) {
	$user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
	$user_email = mysqli_real_escape_string($conn, $_POST['user_email']);
	$full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
	$receiver_email = mysqli_real_escape_string($conn, $_POST['receiver_email']);
	$message_title = mysqli_real_escape_string($conn, $_POST['message_title']);
	$message_desc = mysqli_real_escape_string($conn, $_POST['message_desc']);
	$errorForm = false;
	if (!empty($receiver_email) && !empty($message_title) && !empty($message_desc)) {
	if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
			echo "Invalid Email Address";
			$errorForm = true;
		}else{
			$sql = "INSERT INTO messages (sender_id, sender_name, sender_email, message_title, message_desc,receiver_email, status, date, trash_status) VALUES('$user_id', '$full_name', '$user_email', '$message_title', '$message_desc', '$receiver_email', 'unread', now(), 'No')";
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