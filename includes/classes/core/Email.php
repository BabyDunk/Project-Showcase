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
	
	/**
	 * Class Email
	 *
	 * @package Classes\Core
	 */
	class Email
	{
		
		
		
		private static $instance;
		
		/**
		 * Create a static instance
		 *
		 * @return \Classes\Core\Email
		 */
		public static function instance()
		{
			
			if ( ! self::$instance instanceof self )
			{
				self::$instance = new self;
			}
			
			return self::$instance;
		}
		
		/**
		 * Email Send Method
		 *
		 * @param       $emailTitle
		 * @param       $emailBody
		 * @param array $recipient
		 *
		 * @return bool
		 */
		public function send( $emailTitle , $emailBody , $recipient = [] )
		{
			
			$mail = new PHPMailer( true );    // Passing `true` enables exceptions
			try
			{
				//Server settings
				$mail->SMTPDebug = sca_get_preference( 'showcase' , 'sca_email_debugger' );   // Enable verbose debug output
				$mail->isSMTP();    // Set mailer to use SMTP
				$mail->Host     = sca_get_preference( 'showcase' , 'sca_emailserver' );    // Specify main and backup SMTP servers
				$mail->SMTPAuth = ! empty( sca_get_preference( 'showcase' , 'sca_emailauth' ) ) ? true : false;   // Enable SMTP authentication
				
				$mail->Username = sca_get_preference( 'showcase' , 'sca_emailgateway' );   // SMTP username
				$mail->Password = sca_get_preference( 'showcase' , 'sca_emailgatewaypass' );   // SMTP password
				
				if ( sca_get_preference( 'showcase' , 'sca_emailencryption' ) == 'tls' )
				{
					$mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
				}
				elseif ( sca_get_preference( 'showcase' , 'sca_emailencryption' ) == 'ssl' )
				{
					$mail->SMTPSecure = 'ssl'; // Enable SSL encryption, `tls` also accepted
				}
				else
				{
					$mail->SMTPSecure = ''; // No encryption is enabled, `tls` or `ssl` also accepted
				}
				
				$mail->Port = ! empty( sca_get_preference( 'showcase' , 'sca_emailserverport' ) ) ? sca_get_preference( 'showcase' , 'sca_emailserverport' ) : 587; // TCP port to connect to
				
				
				//Recipients
				$mail->setFrom( sca_get_preference( 'showcase' , 'sca_emailgateway' ) , sca_get_preference( 'showcase' , 'sca_emailname' ) );
				foreach ( $recipient as $address => $name )
				{
					$mail->addAddress( $address , $name );     // Add a recipient
				}
				
				$mail->addReplyTo( sca_get_preference( 'showcase' , 'sca_emailgateway' ) , sca_get_preference( 'showcase' , 'sca_emailname' ) );
				
				
				//Attachments
				//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
				//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
				
				//Content
				$mail->Subject = $emailTitle;
				$mail->Body    = $emailBody;
				$mail->isHTML( true );                                  // Set email format to HTML
				
				
				if ( $mail->send() )
				{
					return true;
				}
				
			}
			catch ( Exception $e )
			{
				Session::set( 'EMAIL_DEBUGGING' , $e->getMessage() . ' ' . $e->getCode() );
			}
			
		}
		
		/**
		 * For testing email
		 *
		 * @return bool
		 */
		public static function testMail()
		{
			
			$testAddress = sca_get_preference( 'showcase' , 'sca_testemailaddess' );
			$testName    = "Showcase Admin Test Message";
			
			
			if ( static::instance()->send( 'Test Message' , '<h1>Test Success</h1><p>This is a success message to verify that the mail server is working correctly</p>' , [ $testAddress => $testName ] ) )
			{
				return true;
			}
			
			return false;
			
			
		}
		
	}