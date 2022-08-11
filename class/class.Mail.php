<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './phpmailer/src/Exception.php';
require './phpmailer/src/PHPMailer.php';
require './phpmailer/src/SMTP.php';



class Mail
{
	public function SendMail($InputEmail, $name, $subject, $message)
	{
		
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = "tls";
		$mail->Host = "smtp.gmail.com";
		$mail->Port = 587;
		$mail->Username = "bintan.litbang@gmail.com";
		$mail->Password = "uuitlllhwvixquvc";
		$mail->From = "roombookingebs@gmail.com";
		$mail->FromName = "Sistem E-Rapat Bapelitbang";
		$mail->SMTPOptions = array(
				'ssl' => array(
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true
				));

		$mail->WordWrap = 50;
		$mail->IsHTML(true);

		$mail->AddAddress($InputEmail, $name);
		$mail->Subject = $subject;
		$mail->Body = $message;
		$mail->AltBody = "This is the body in plain text for non-HTML mail clients";

		$mail->SMTPDebug = 0;

		if(!$mail->Send()){
			echo "Message could not be sent.<p>";
			echo "Mailer Error: " . $mail->ErrorInfo;
			exit;
		}
	}	
}
?>