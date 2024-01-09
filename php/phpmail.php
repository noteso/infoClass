<?php
/*##########Script Information#########
  # Purpose: Send mail Using PHPMailer#
  #          & Gmail SMTP Server 	  #
  # Created: 24-11-2019 			  #
  #	Author : Hafiz Haider			  #
  # Version: 1.0					  #
  # Website: www.BroExperts.com 	  #
  #####################################*/
	//Include required PHPMailer files
		include_once 'PHPMailer.php';
		include_once 'SMTP.php';
		include_once 'Exception.php';
	//Define name spaces
		use PHPMailer\PHPMailer\PHPMailer;
		use PHPMailer\PHPMailer\SMTP;
		use PHPMailer\PHPMailer\Exception;
function phpmail($subject, $content, $reciever){
	
	//Create instance of PHPMailer
		$mail = new PHPMailer();
	//Set mailer to use smtp
		$mail->isSMTP();
	//Define smtp host
		$mail->Host = "smtp.gmail.com";
	//Enable smtp authentication
		$mail->SMTPAuth = true;
	//Set smtp encryption type (ssl/tls)
		$mail->SMTPSecure = "tls";
	//Port to connect smtp
		$mail->Port = "587";
	//Set gmail username
		$mail->Username = "infoclass.noreply@gmail.com";
	//Set gmail password
		$mail->Password = "brwaiqqmtflfiect";
	//Email subject
		$mail->Subject = $subject;
	//Set sender email
		$mail->setFrom('infoclass.noreply@gmail.com');
	//Enable HTML
		$mail->isHTML(true);
	//Attachment
		//$mail->addAttachment('img/attachment.png');
	//Email body
		$mail->Body = $content;
	//Add recipient
		$mail->addAddress($reciever);
	//Finally send email
		if ( $mail->send() ) {
			//echo "Email Sent..!";
		}
	//Closing smtp connection
		$mail->smtpClose();
}

