<?php
include 'connect.php';
if (isset($_POST['contact_form_submit'])) {
	$errorForm = false;
	$contact_name = mysqli_real_escape_string($conn, $_POST['contact_name']);
	$contact_email = mysqli_real_escape_string($conn, $_POST['contact_email']);
	$contact_phone = mysqli_real_escape_string($conn, $_POST['contact_phone']);
	$contact_company = mysqli_real_escape_string($conn, $_POST['contact_company']);
	$comment_description = mysqli_real_escape_string($conn, $_POST['comment_description']);
	$number = preg_match('@[0-9]@', $contact_phone);
	if (!empty($contact_name) && !empty($contact_email) && !empty($contact_email) && !empty($contact_phone) && !empty($contact_company) && !empty($contact_company) && !empty($comment_description)) {
		if (strlen($contact_name) < 5) {
			$errorForm = true;
			echo "Full Name too short";
		}elseif (!filter_var($contact_email, FILTER_VALIDATE_EMAIL)) {
			$errorForm = true;
			echo "Invalid Email Address";
		}elseif (!$number) {
			$errorForm = true;
			echo "Invalid Phone Number";
		}elseif (strlen($contact_phone) < 10) {
			$errorForm = true;
			echo "Invalid Phone Number";
		}elseif (strlen($contact_phone) > 20) {
			$errorForm = true;
			echo "Invalid Phone Number";
		}else{
			$sql = "INSERT INTO mailbox (contact_name, contact_phone,contact_company, contact_email, contact_message, reply_status, message_status, trash, date) VALUES ('$contact_name', '$contact_phone', '$contact_company', '$contact_email', '$comment_description', 'No', 'unread', 'No', now())";
			$query = mysqli_query($conn, $sql);
			if ($query) {
				$errorForm = false;
				echo "Thanks for getting in touch. You will hear from us soon";
			}else{
				$errorForm = true;
				echo "Message could not be sent. Please try again later";
			}
		}
	}else{
		$errorForm = true;
		echo "Fill all fields before submitting";
	}
}
?>
<script>
	var errorForm = "<?php echo $errorForm; ?>";
	if (errorForm == false) {
		$('#formError').css('color','green');
		function redirect(){
			window.location = 'contact';
		}
		// setInterval(redirect, 2000);
	}
</script>