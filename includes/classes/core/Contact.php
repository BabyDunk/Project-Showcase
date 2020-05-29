<?php
	/**
	 * Created by Chris.
	 * Title: oop
	 * Date: 04/12/2017
	 * Time: 00:15
	 */
	
	namespace Classes\Core;
	
	
	/**
	 * Class Contact
	 *
	 * @package Classes\Core
	 */
	class Contact extends PdoObject
	{
		
		
		
		private static $instance;
		protected static $db_table = DB_PREFIX . "contacted";
		protected static $db_table_fields = array(
			'id' ,
			'user_id' ,
			'show_id' ,
			'name' ,
			'email' ,
			'phone' ,
			'message' ,
			'date_est' ,
			'created_at'
		);
		
		public $id;
		public $user_id;
		public $show_id;
		public $name;
		public $email;
		public $phone;
		public $message;
		public $date_est;
		public $created_at;
		
		/**
		 * @return \Classes\Core\Contact
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
		 * Set input values
		 *
		 * @param $name
		 * @param $userId
		 * @param $showcaseID
		 * @param $email
		 * @param $phone
		 * @param $message
		 * @param $date_est
		 *
		 * @return bool|\Classes\Core\Contact
		 */
		public static function set_inputs( $name , $userId , $showcaseID , $email , $phone , $message , $date_est )
		{
			
			if ( ! empty( $name ) && ! empty( $userId ) && ! empty( $email ) && ! empty( $phone ) && ! empty( $message ) && ! empty( $date_est ) )
			{
				
				$contact = new Contact();
				
				$contact->name       = (string) $name;
				$contact->user_id    = (int) $userId;
				$contact->show_id    = (int) $showcaseID;
				$contact->email      = (string) $email;
				$contact->phone      = (string) $phone;
				$contact->message    = (string) $message;
				$contact->date_est   = (string) $date_est;
				$contact->created_at = date( "Y-m-d H:i:s" );
				
				return $contact;
				
			}
			else
			{
				
				return false;
				
			}
			
		} // End of create_comment Method
		
		
		/**
		 * Echo contact form where ever called
		 */
		public static function echo_form()
		{
			
			$isShowCase   = showcaseUriID();
			$formlocation = ( $isShowCase ) ? 'showcase_contact' : 'contact';
			
			$html = '<div>';
			if ( $isShowCase )
			{
				$html .= '<h3>Dev Contact</h3>';
			}
			$html .= '<div class="outta-cont-notification">';
			$html .= '<div class="cont-notification">';
			$html .= '</div>';
			$html .= '</div>';
			
			$html .= '<form method="POST" action="/' . $formlocation . '" enctype="multipart/form-data">';
			$html .= '<input type="hidden" name="CSRFToken" id="CSRFToken" value="' . CSRFToken::_SetToken() . '" />';
			if ( $isShowCase )
			{
				$html .= '<input type="hidden" name="showcaseID" id="showcaseID" value="' . $isShowCase . '" />';
			}
			
			$html .= '<div class="form-content">';
			$html .= '<label for="name"><i class="fas fa-user-ninja"></i> What\'s your name?</label>';
			$html .= '<input type="text" name="name" id="name" value="" placeholder="Enter a contact name"/>';
			$html .= '</div>';
			$html .= '<div class="form-content">';
			$html .= '<label for="email"><i class="far fa-envelope-open"></i> What\'s your email address?</label>';
			$html .= '<input type="email" name="email" id="email" value="" placeholder="Enter a contact email"/>';
			$html .= '</div>';
			$html .= '<div class="form-content">';
			$html .= '<label for="phone"><i class="fas fa-mobile"></i> What\'s your phone number?</label>';
			$html .= '<input type="number" name="phone" id="phone" value="" placeholder="Enter a contact phone number"/>';
			$html .= '</div>';
			$html .= '<div class="form-content">';
			$html .= '<label for="message"><i class="far fa-comment"></i> Tell us your query?</label>';
			$html .= '<textarea name="message" id="message" placeholder="Write in as much detail what we can help you with!"></textarea>';
			$html .= '</div>';
			if ( ! $isShowCase )
			{
				$html .= '<div class="form-content">';
				$html .= '<label for="date_est"><i class="far fa-calendar-alt"></i> Job Completion Deadline?</label>';
				$html .= '<input type="text" name="date_est" id="date_est" value="" required placeholder="Select a date for completion" />';
				$html .= '</div>';
			}
			$html .= '<div class="form-content">';
			$html .= '<div></div>';
			$html .= '<button type="submit" name="submit" id="submit" value="Submit!"><i class="far fa-paper-plane"></i> Submit!</button>';
			$html .= '</div>';
			
			$html .= '</form>';
			
			$html .= '</div>';
			
			
			echo $html;
			
		}
		
		
	} // End of Comment class