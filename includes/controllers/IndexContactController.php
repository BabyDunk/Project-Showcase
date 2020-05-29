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
					$showcaseID = 0;
				}else{
					$user_id = Showcase::find_by_id($post->showcaseID)->user_id;
					$showcaseID = $post->showcaseID;
				}
				
				if(empty($post->date_est)){
					$dateUser = '1970-04-30';
				}else{
					$dateUser = $post->date_est;
				}
				
				$contact    = Contact::set_inputs($post->userName, $user_id, $showcaseID, $post->userEmail, $post->userPhone, $post->userMess, $dateUser);
				
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
						
						Email::instance()->send( sca_get_preference('showcase', 'sca_item_contact_notifier_title'), sca_get_preference('showcase', 'sca_item_contact_notifier'), [$post->userEmail => $post->userName]);
						
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
		
		
		public function getInfo(  )
		{
			
			if(Params::has('submitInfoForm')){
				
				
				$post       = Params::get('post');
				
				
				if($post->emailInfoForm){
					
					if(!CSRFToken::_CheckToken()){
						
						echo json_encode([
							'status'    =>  'FAILED',
							'message'   =>  'There was a problem, Refresh page and try again'.$post->CSRFToken
						]);
						
						return false;
					}
					
					if(Email::instance()->send( sca_get_preference('showcase', 'sca_user_request_info_notifier_title'), sca_get_preference('showcase', 'sca_user_request_info_notifier'), [$post->emailInfoForm => 'Cherished Customer'])){
						
						echo json_encode([
							'status'    =>  'OK',
							'message'   =>  'All relevant information has been sent to the email address, We hope to hear back from you soon'
						]);
						
						return true;
						
					} else {
						
						echo json_encode([
							'status'    =>  'FAILED',
							'message'   =>  'Sorry there was a problem sending the information, please try again. if you keep getting this message, please contact the sites manager '
						]);
						
						return false;
					}
					
				} else {
					echo json_encode([
						'status'    =>  'FAILED',
						'message'   =>  'There was a problem, You didn\'t supply a valid email address'
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