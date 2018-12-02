<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: showcase_app
	 * Date: 08/06/2018
	 * Time: 12:05
	 */
	
	namespace Controllers;
	
	
	use Classes\Core\Contact;
	use Classes\Core\CSRFToken;
	use Classes\Core\Email;
	use Classes\Core\Params;
	use Classes\Core\Session;
	
	class IndexContactController
	{
		
		
		
		public function insert(  )
		{
			
			if(Params::has('submit')){
				
				
				$post       = Params::get('post');
				$contact    = Contact::set_inputs($post->userName, $post->userEmail, $post->userPhone, $post->userMess, $post->userDate);
				
				if($contact){
					
					if(!CSRFToken::_CheckToken()){
						
						echo json_encode([
							'status'    =>  'FAILED',
							'message'   =>  'There was a problem, Refresh page and try again'
						]);
						
						return false;
					}
					
					if($contact->create()){
						
						echo json_encode([
							'status'    =>  'OK',
							'message'   =>  'Your request has been submitted successfully. We will get back you your ASAP'
						]);
						
						Email::instance()->send([$post->userEmail => $post->userName]);
						
						return true;
					} else {
						echo json_encode([
							'status'    =>  'FAILED',
							'message'   =>  'We couldn\'t registered your request: '.$contact->errors
						]);
						
						return false;
					}
					
				} else {
					echo json_encode([
						'status'    =>  'FAILED',
						'message'   =>  'There was a problem, Some of your inputs where empty'
					]);
					
					return false;
				}
				
				
				
				
			} else {
				echo json_encode([
					'status'    =>  'FAILED',
					'message'   =>  'There was a problem, No data was received'
				]);
				
				return false;
			}
			
		}
		
	}