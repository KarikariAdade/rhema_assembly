<?php
include 'connect.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require '../../../../vendor/autoload.php';
if (isset($_POST['sendEmail'])) {
	$emailto = $_POST['emailto'];
	$subject = $_POST['subject'];
	$message = $_POST['message'];

	$quick_mail_sender = $_POST['quick_mail_sender'];
	$fetch_sender = $conn->query("SELECT * FROM admin_profile WHERE id = '$quick_mail_sender'");
	while ($row = mysqli_fetch_assoc($fetch_sender)) {
		$sender_name = $row['first_name'].' '.$row['last_name'];
		if (!empty($emailto) && !empty($subject) && !empty($message)) {
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
    $mail->addAddress($emailto);     // Add a recipient
    $mail->SMTPOptions = array(
    	'ssl' => array(
    		'verify_peer' => false,
    		'verify_peer_name' => false,
    		'allow_self_signed' => true
    	)
    );

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $subject;
    $mail->AddEmbeddedImage("../../assets/img/pentecost.png", "my-attach", "");
    $mail->Body    = '<div style="width:100%; font-size="17px;">
    <p align="center"><img alt="PHPMailer" src="cid:my-attach"></p>
    <h3>Greetings Sir/Madam</h3>
    <h2 align="center">'.$subject.'</h2>
    <p>'.$message.'</p>';
    $mail->AltBody = $message;
    $mail->SMTPDebug  = 3;
    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
	echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}else{
	echo "Fill all fields before sending Email";
}
  
}
}
?>