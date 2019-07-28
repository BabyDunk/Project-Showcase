<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: showcase_app
	 * Date: 07/02/2019
	 * Time: 11:06
	 */
	
	namespace Controllers\Scpanel;
	
	
	use Classes\Core\Contact;
	use Classes\Core\Session;
	use Classes\Core\User;
	
	class ScpanelContactsController
	{
		
		
		
		public function show(  )
		{
			
			
			adminView('contacts', ['userid'=>Session::instance()->user_id]);
			
		}
		
		public function remove( $id )
		{
			
			if($id){
				
				if(User::hasPrivilege()){
					$Contact = new Contact();
					$Contact->id = (int)$id['id'];
					
					if($Contact->delete()){
						$message = 'Contact deleted successfully';
						Session::set('MESSAGE', $message);
						
						redirect('/sc-panel/contacts');
					}else{
						$message = "Something went wrong please try again";
						Session::set('MESSAGE', $message);
						
						redirect('/sc-panel/contacts');
					}
				}else{
					$message = 'You don\'t have authorisation';
					Session::set('MESSAGE', $message);
					
					redirect('/sc-panel/login');
				}
				
			}else{
				
				$message = 'Invalid identifier';
				
				Session::set('MESSAGE', $message);
				redirect('/sc-panel/contacts');
			}
			
			return false;
		}
		public function show_users(  )
		{
			
			
			adminView('user-contacts', ['userid'=>User::userID()]);
			
		}
		
		public function remove_users( $id )
		{
			
			if($id){
				
				$getOfficialUser = Contact::find_by_id($id['id']);
				
				if(Session::instance()->user_id === $getOfficialUser->user_id){
					
					if( Contact::deleteAllByCond(['id'=>$id['id'],'user_id'=>Session::instance()->user_id])){
						$message = 'Contact deleted successfully';
						Session::set('MESSAGE', $message);
						
						redirect('/sc-panel/user_contacts');
					}
				}else{
					$message = 'You don\'t have authorisation';
					Session::set('MESSAGE', $message);
					
					redirect('/sc-panel/login');
				}
				
			}else{
				
				$message = 'Invalid identifier';
				
				Session::set('MESSAGE', $message);
				redirect('/sc-panel/user_contacts');
			}
			
			return false;
		}
		
		
	}