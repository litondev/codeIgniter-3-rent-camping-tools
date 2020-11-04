<?php 
include "phpmailer/PHPMailerAutoload.php";

class LMail{
	public $ci;

	public function __construct(){
		$this->ci = & get_instance();
	}

	public function send($user_email,$view,$subject){
		$mail = new PHPMailer;
		$mail->isSMTP();
		
		$mail->Host = 'smtp.mailtrap.io'; // Which SMTP server to use.
		$mail->Port = 2525; // Which port to use, 587 is the default port for TLS security.
		$mail->SMTPSecure = 'tls'; // Which security method to use. TLS is most secure.
		$mail->SMTPAuth = true; // Whether you need to login. This is almost always required.
		$mail->Username = ""; // Your Gmail address.
		$mail->Password = ""; // Your Gmail login password or App Specific Password.

		$mail->setFrom('EmailAgan'); // Set the sender of the message.
		$mail->addAddress($user_email); // Set the recipient of the message.
		$mail->Subject = $subject; // The subject of the message.
		$mail->msgHTML($view);

		if ($mail->send()) {
		    return true;
		} else {
		    return false;
		}
	}
}