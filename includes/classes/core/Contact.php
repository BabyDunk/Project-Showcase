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
	protected static    $db_table_fields = array('id', 'name', 'email', 'phone', 'message', 'date_est', 'created_at');

	public              $id;
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
	public static function set_inputs($name, $email, $phone, $message, $date_est) {

		if(!empty($name) && !empty($email) && !empty($phone)&& !empty($message)&& !empty($date_est)){

			$contact    =   new Contact();

			$contact->name          =   (string)$name;
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
		
		$html = '<div class="grid-container">';
		$html .= '<div class="grid-x grid-padding-x">';
		$html .= '<div class="medium-12 cell">';
		$html .= '<div class="outta-cont-notification">';
		$html .= '<div class="cont-notification">';
		$html .= '</div>';
		$html .= '</div>';
		
		$html .= '<form method="POST" action="/contact" enctype="multipart/form-data">
					<input type="hidden" name="CSRFToken" id="CSRFToken" value="'.CSRFToken::_SetToken().'" />

						<label for="name">Your Name Please</label>
				    	<input type="text" name="name" id="name" value="" required placeholder="Your Name" />

				    	<label for="email">Your Email Address please</label>
				    	<input type="email" name="email" id="email" value="" required placeholder="Your Email" />

				    	<label for="phone">Your Phone Number please</label>
				    	<input type="text" name="phone" id="phone" value="" placeholder="Your Phone" />
			
				    	<label for="message">Descripption Of Job Request</label>
				    	<textarea name="message" id="message" rows="3" required placeholder="Describe with as much detail the job you would like us to perform" ></textarea>

				    	<label for="date_est">Deadline For Job Completion</label>
				    	<input type="text" name="date_est" id="date_est" value="" required placeholder="Select a date for completion" />
	
				    	<button type="submit" name="submit" id="submit" value="true" class="button success float-right" >Submit!</button>';

		$html .= '</form>';
		
		
		$html .= '</div>';
		$html .= '</div>';
		$html .= '</div>';
	
		
		echo $html;
		
	}
	
	
	
	


} // End of Comment class