<?php
include 'connect.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require '../../../vendor/autoload.php';
if (isset($_POST['transaction_id'])) {
	$transaction_id = mysqli_real_escape_string($conn, $_POST['transaction_id']);
	$fetch_transaction = $conn->query("SELECT * FROM finance WHERE transaction_id = '$transaction_id'") or die(mysqli_error($conn));
	$row = mysqli_fetch_assoc($fetch_transaction);
	$full_name = $row['full_name'];
	$amount = $row['amount'];
	$type = $row['type'];
	$date = $row['date'];
	$email = $row['email'];
	$approve_transaction = $conn->query("UPDATE finance SET status = 1 WHERE transaction_id = '$transaction_id'") or die(mysqli_error($conn));
	if ($approve_transaction) {
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
    $mail->addAddress($email, $full_name);     // Add a recipient
    $mail->SMTPOptions = array(
    	'ssl' => array(
    		'verify_peer' => false,
    		'verify_peer_name' => false,
    		'allow_self_signed' => true
    	)
    );

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $type.' Receipt';
    $mail->Body    = '<div class="receipt_card" style="
    padding-top: 10px;
    box-shadow: 0 5px 10px rgba(0,0,0,.4);
    font-family: sans-serif; text-align:center;">
	<h3 style="border-bottom: 5px solid #1d2cb7;
    padding-bottom: 20px;">Rhema Assembly</h3>
	<div class="receipt_info" style="padding: 10px 40px;">
		<h5>Receipt from Rhema Assembly</h5>
		<p style="font-size: 13px;">Dear '.$full_name.', your payment of <strong>GHC '.$amount.'</strong> as <strong>'.$type.'</strong> has been received by Rhema Assembly. Please print this page as receipt.</p>
		<h5 align="center">Payment Details</h5>
		<div class="row">
			<div class="property" style="float: left;
    width: 50%;">
				<p style="font-size: 13px;">Amount Paid</p>
				<p style="font-size: 13px;">Transaction ID</p>
				<p style="font-size: 13px;">Payment Method</p>
			</div>
			<div class="value" style="width: 50%;
    float: right;">
				<p>GHC '.$amount.'</p>
				<p>'.$transaction_id.'</p>
				<p>Online Payment</p>
			</div>
		</div>
	</div>
	<div align="center">
		<p class="date" style="padding-top:10%;">'.date("l M d Y").'</p>
		</div>
</div>';
    $mail->AltBody = 'hello';
    $mail->SMTPDebug  = 3;
    $mail->send();
    echo 'Transaction successfully approved with receipt sent. Page will refresh';
} catch (Exception $e) {
	echo "Transaction could not be approved. Mailer Error:"{$mail->ErrorInfo};
}
echo 'Transaction successfully approved with receipt sent. Page will refresh';
	}
}
?>
