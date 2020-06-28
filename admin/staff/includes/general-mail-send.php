<?php
include 'connect.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require '../../../vendor/autoload.php';
if (isset($_POST['general_mail_submit_btn'])) {
	$reply_id = mysqli_real_escape_string($conn, $_POST['reply_id']);
	$contact_id = mysqli_real_escape_string($conn, $_POST['contact_id']);
	$contact_reply_id = mysqli_real_escape_string($conn, $_POST['contact_reply_id']);
	$contact_reply_email = mysqli_real_escape_string($conn, $_POST['contact_reply_email']);
	$contact_reply_name = mysqli_real_escape_string($conn, $_POST['contact_reply_name']);
	$receiver_email = mysqli_real_escape_string($conn, $_POST['receiver_email']);
	$reply_title = mysqli_real_escape_string($conn, $_POST['reply_title']);
	$reply_desc = mysqli_real_escape_string($conn, $_POST['reply_desc']);
	$errorForm = false;
	$fetch_reply_position = $conn->query("SELECT position FROM admin_profile WHERE id = '$contact_reply_id'");
		$row = mysqli_fetch_assoc($fetch_reply_position);
		$reply_position = $row['position'];
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
				$mail = new PHPMailer(true);

				try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'mail.nakroteck.site';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'support@ghbrain.com';                     // SMTP username
    $mail->Password   = 'GodOverMoney0548';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('support@ghbrain.com', 'GH Brain');
    $mail->addAddress($contact_reply_email, $contact_reply_name);     // Add a recipient
    $mail->SMTPOptions = array(
    	'ssl' => array(
    		'verify_peer' => false,
    		'verify_peer_name' => false,
    		'allow_self_signed' => true
    	)
    );

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'COP Rhema Assembly: '.$reply_title;
    $mail->AddEmbeddedImage("../../assets/img/pentecost.png", "my-attach", "");
    $mail->Body    = '<div style="width:100%; font-size="17px;">
    <p align="center"><img alt="PHPMailer" src="cid:my-attach"></p>
    <h3>Greetings '.$contact_id.',</h3>
    <h3>'.$reply_title.'</h3>
    <p>'.$reply_desc.'</p>
    <p>'.$contact_reply_name.' ('.$reply_position.')</p>
    <p>Signed</p>';
    $mail->AltBody = $reply_desc;
    // $mail->SMTPDebug  = 3;
    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
	echo "Message could not be sent. Mailer Error:"{$mail->ErrorInfo};
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