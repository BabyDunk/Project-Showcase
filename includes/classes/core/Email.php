<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: showcase_app
	 * Date: 15/06/2018
	 * Time: 11:15
	 */
	
	namespace Classes\Core;
	

	
	use PHPMailer\PHPMailer\Exception;
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	
	class Email
	{
		
		private static $instance;
		
		public static function instance(  )
		{
			if(!self::$instance instanceof self){
				self::$instance = new self;
			}
			
			return self::$instance;
		}
		
		public function send($recipient=[])
		{
			$mail = new PHPMailer(true);    // Passing `true` enables exceptions
			try {
				//Server settings
				$mail->SMTPDebug = SMTP::DEBUG_LOWLEVEL;   // Enable verbose debug output
				$mail->isSMTP();    // Set mailer to use SMTP
				$mail->Host = sca_get_preference('showcase', 'sca_emailserver');    // Specify main and backup SMTP servers
				$mail->SMTPAuth = !empty(sca_get_preference('showcase', 'sca_smtpauth')) ?  true : false;   // Enable SMTP authentication
				
				$mail->Username = sca_get_preference('showcase', 'sca_emailgateway');   // SMTP username
				$mail->Password = sca_get_preference('showcase', 'sca_emailgatewaypass');   // SMTP password
				
				if(sca_get_preference('showcase', 'sca_emailencryption') == 'tls'){
					$mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
				} elseif (sca_get_preference('showcase', 'sca_emailencryption') == 'ssl'){
					$mail->SMTPSecure = 'ssl'; // Enable SSL encryption, `tls` also accepted
				}else{
					$mail->SMTPSecure = ''; // No encryption is enabled, `tls` or `ssl` also accepted
				}
				
				$mail->Port = !empty(sca_get_preference('showcase', 'sca_emailserverport')) ? sca_get_preference('showcase', 'sca_emailserverport') : 587; // TCP port to connect to
				
				
				//Recipients
				$mail->setFrom(sca_get_preference('showcase', 'sca_emailgateway'), sca_get_preference('showcase', 'sca_emailname'));
				foreach ($recipient as $address => $name){
					$mail->addAddress($address, $name);     // Add a recipient
				}

				$mail->addReplyTo('info@example.com', 'Information');

				
				//Attachments
				//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
				//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
				
				//Content
				$mail->isHTML(true);                                  // Set email format to HTML
				$mail->Subject = 'Here is the subject';
				$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
				$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
				
				$mail->send();
				return true;
			} catch (Exception $e) {
				Session::set('TESTER', 'Message could not be sent. Mailer Error: '. $mail->ErrorInfo);
			}
			
		}
		
	}