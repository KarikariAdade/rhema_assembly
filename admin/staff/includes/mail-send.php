<?php
include 'connect.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require '../../../vendor/autoload.php';
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
				$mail = new PHPMailer(true);

				try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'mail.nakroteck.site';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'support@ghbrain.com';                     // SMTP username
    $mail->Password   = 'GodOverMoney0548';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('support@ghbrain.com', 'GH Brain');
    $mail->addAddress($receiver_email, $full_name);     // Add a recipient
    $mail->SMTPOptions = array(
    	'ssl' => array(
    		'verify_peer' => false,
    		'verify_peer_name' => false,
    		'allow_self_signed' => true
    	)
    );

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Administrator Verification';
    $mail->AddEmbeddedImage("../assets/img/pentecost.png", "my-attach", "");
    $mail->Body    = '<div style="width:100%; font-size="17px;">
    <p align="center"><img alt="PHPMailer" src="cid:my-attach"></p>
    <h3>Greetings '.$full_name.',</h3>
    <h3>'.$message_title.'</h3>
    <p>'.$messages_desc.'</p>
    <p>Mr. Emmanuel Kobeah</p>
    <p>Signed</p>';
    $mail->AltBody = $message_desc;
    $mail->SMTPDebug  = 3;
    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
	echo "Message could not be sent. Mailer Error:". {$mail->ErrorInfo};
}
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