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
	use Classes\Core\Showcase;
	use Classes\Core\ShowcasePins;
	
	class IndexContactController
	{
		
		
		
		public function insert(  )
		{
			
			if(Params::has('submit')){
				
				
				$post       = Params::get('post');
				
				if(empty($post->showcaseID)){
					$user_id = 1;
				}else{
					$user_id = Showcase::find_by_id($post->showcaseID)->user_id;
				}
				
				if(empty($post->userDate)){
					$dateUser = '1970-04-30';
				}else{
					$dateUser = $post->userDate;
				}
				
				$contact    = Contact::set_inputs($post->userName, $user_id, $post->showcaseID, $post->userEmail, $post->userPhone, $post->userMess, $dateUser);
				
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
							'message'   =>  'Your request has been submitted successfully. We\'ll get back to you ASAP'
						]);
						
						Email::instance()->send('Your message has been received', '<h2>Thank you for your message</h2><p>We will get back to you in due course</p>',[$post->userEmail => $post->userName]);
						
						return true;
					} else {
						echo json_encode([
							'status'    =>  'FAILED',
							'message'   =>  'We couldn\'t register your request: '.$contact->errors
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