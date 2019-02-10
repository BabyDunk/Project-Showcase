<?php
/**
 * Created by Chris.
 * Title: oop
 * Date: 04/12/2017
 * Time: 00:15
 */
	
	namespace Classes\Core;


class Contact extends PdoObject
{
	
	private     static  $instance;
	protected static    $db_table = DB_PREFIX."contacted";
	protected static    $db_table_fields = array('id', 'user_id', 'show_id', 'name', 'email', 'phone', 'message', 'date_est', 'created_at');

	public              $id;
	public              $user_id;
	public              $show_id;
	public              $name;
	public              $email;
	public              $phone;
	public              $message;
	public              $date_est;
	public              $created_at;
	
	public static function instance()
	{
		if(!self::$instance instanceof self){
			self::$instance = new self;
		}
		return self::$instance;
	}

	// Create Comment
	public static function set_inputs($name, $userId, $showcaseID, $email, $phone, $message, $date_est) {

		if(!empty($name) && !empty($userId) && !empty($email) && !empty($phone)&& !empty($message)&& !empty($date_est)){

			$contact    =   new Contact();

			$contact->name          =   (string)$name;
			$contact->user_id       =   (int)$userId;
			$contact->show_id       =   (int)$showcaseID;
			$contact->email         =   (string)$email;
			$contact->phone         =   (string)$phone;
			$contact->message       =   (string)$message;
			$contact->date_est      =   (string)$date_est;
			$contact->created_at    =   date("Y-m-d H:i:s");

			return $contact;

		} else {

			return false;

		}

	} // End of create_comment Method
	
	
	public static function echo_form()
	{
		
		$isShowCase   = showcaseUriID();
		$formlocation = ( $isShowCase ) ? 'showcase_contact' : 'contact';
		
		$html = '<div class="grid-container">';
		$html .= '<div class="grid-x grid-padding-x">';
		$html .= '<div class="medium-12 cell">';
		if ($isShowCase)
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
		$html .= '<label for="name">Your Name Please</label>
				    <input type="text" name="name" id="name" value="" required placeholder="Your Name" />';
		
		$html .= '<label for="email">Your Email Address please</label>
				    <input type="email" name="email" id="email" value="" required placeholder="Your Email" />';
		
		$html .= '<label for="phone">Your Phone Number please</label>
				    <input type="text" name="phone" id="phone" value="" minlength="10" placeholder="Your Phone" />';
		
		$html .= '<label for="message">Descripption Of Job Request</label>
				    <textarea name="message" id="message" rows="3" required placeholder="Describe with as much detail the job you would like us to perform" ></textarea>';
		if ( ! $isShowCase )
		{
			$html .= '<label for="date_est">Deadline For Job Completion</label>
				    <input type="text" name="date_est" id="date_est" value="" required placeholder="Select a date for completion" />';
		}
		$html .= '<button type="submit" name="submit" id="submit" value="true" class="button success float-right" >Submit!</button>';
		
		$html .= '</form>';
		
		
		$html .= '</div>';
		$html .= '</div>';
		$html .= '</div>';
		
		
		echo $html;
		
	}
	
	
	
	


} // End of Comment class