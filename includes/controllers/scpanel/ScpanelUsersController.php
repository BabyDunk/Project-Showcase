<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: oop
	 * Date: 28/05/2018
	 * Time: 01:42
	 */
	
	namespace Controllers\Scpanel;
	
	
	use Classes\Core\Hashing;
	use Classes\Core\CSRFToken;
	use Classes\Core\Params;
	use Classes\Core\Session;
	use Classes\Core\User;

	
	class ScpanelUsersController
	{
		
		
		
		public function show(  )
		{
			\Classes\Core\User::isAdmin();
			
			adminView('users', ['userid'=> Session::instance()->user_id]);
			
			Session::clear('MESSAGE');
			
		}
		
		public function showadduser()
		{
			\Classes\Core\User::isAdmin();
			
			$sess = new Session();
			
			if(!$sess->is_signed_in()){
				
				redirect('/sc-panel');
				
			}else{
				
				adminView( 'add-user' );
				
			}
			
		}
		
		public function insertadduser()
		{
			\Classes\Core\User::isAdmin();
			
			$sess = new Session();
			
			if(!$sess->is_signed_in()){
				
				redirect('/sc-panel');
				return false;
				
			}else {
				
				if(!CSRFToken::_CheckToken()){
					
					redirect('/sc-panel/adduser');
					
					return false;
				}
				
				
				// Get Post Params
				$post = Params::get( 'post' );
				
				
				if ( isset( $post->create ) && ! empty( $post->username ) && ! empty( $post->password )
				     && ! empty( $post->first_name ) && ! empty( $post->last_name ) ) {
					
					
					$userDatas = User::find_all();
					
					$checkUsers = [];
					foreach ( $userDatas as $user_data ) {
						
						$checkUsers[] = $user_data->username;
						
					}
					
					if ( in_array($post->username, $checkUsers, true) ) {
						
						$message = "The username you have selected is not available";
						
						adminView('add-user', [ 'message' => $message ]);
						
						
					} else {
					
						
						$user       = new User();
						$hashing    = new Hashing();
						$password   = $hashing->hashIt($post->password);
						
						$user->username   = $post->username;
						$user->password   = $password;
						$user->first_name = $post->first_name;
						$user->last_name  = $post->last_name;
						$user->email      = $post->email;
						$user->created_at = date("Y-m-d H:i:s");
						
						
						if(!empty(Params::get('file')->user_image->name)) {
							$user->set_file( Params::all( true )['file']['user_image'] );
						}
						
						if ( $user->insert_user()) {
							
							
							$message = 'Account has been created with the username ' . $post->username;
							
							Session::set('MESSAGE', $message);
							
							redirect( '/sc-panel/login');
							
							return true;
							
						} else {
							
							
							$message = 'Account could not be created';
							
							adminView( 'add-user' , [ 'message' => $message, 'error' => $user->errors] );
							
						}
						
					}
					
				} else {
					
					$message = "Please make sure to fill in all fields";
					
					adminView( 'add-user' , [ 'message' => $message ] );
				}
			}
			return false;
		}
		
		public function showupdateuser($id)
		{
			
			$userID       =   User::userID();
			
			if( !empty($id['id']) && User::hasPrivilege() || !empty($id['id']) && (int)$id['id'] === $userID){
				
				adminView('updateuser', ['id'=>$id, 'userid'=>$userID]);
				
				
			}else {
				redirect('/sc-panel/users');
			}
			
			
		}
		
		public function editupdateuser()
		{
			
			if(!CSRFToken::_CheckToken()){
				
				redirect('/sc-panel/users');
				
				return false;
			}
			
			if(!Params::has('userId')){
				
				Session::set('MESSAGE', 'Something went wrong');
				redirect('/sc-panel/users');
				
			}elseif (Params::get('post')->userId === Session::instance()->user_id){
				if($this->updateUser()){
					return true;
				}
				
			}elseif(User::hasPrivilege()){
				User::isAdmin();
				if($this->updateUser()){
					return true;
				}
				
			} else {
				
				Session::set('MESSAGE', 'You are not authorised to complete this process');
				redirect('/sc-panel/users');
			}
			
			return false;
		}
		
		public function updateUser(  )
		{
			
			$post = Params::get('post');
			$sess = new Session();
			
			if ( Params::has('update')) {
				
				
				$username   = Params::has('username') ? $post->username : '';
				$email      = Params::has('email') ? $post->email : '';
				$password   = Params::has('password') ?
					(Hashing::instance()->verify_hash($post->username,$post->password) ? $post->password : Hashing::instance()->hashIt($post->password)): '';
				$first_name = Params::has('first_name') ? $post->first_name : '';
				$last_name  = Params::has('last_name') ? $post->last_name : '';
				$privilege  = Params::has('privilege') ? (int)$post->privilege : 0;
				
				
				if ( $sess->is_signed_in() ) {
					$userHolder = (User::hasPrivilege()) ? (int)$post->userId : $sess->user_id;
					$user = new User();
					$user->id         = $userHolder;
					$user->username   = $username;
					$user->email      = $email;
					$user->password   = $password;
					$user->first_name = $first_name;
					$user->privilege  = $privilege;
					$user->last_name  = $last_name;
					$user->updated_at = date("Y-m-d H:i:s");
				
					if(!empty(Params::get('file')->user_image->name)) {
						$user->set_file( Params::all(true)['file']['user_image']);
					}
					
					if($user->insert_user()){
						
						$message = "You have successfully update you profile";
						Session::set('MESSAGE', $message);
						
						redirect('/sc-panel/updateuser/'.$userHolder);
						
						return true;
						
					} else {
						
						$message = "Something went wrong Error: ". join('<br/', $user->errors);
						
						adminView('updateuser', ['message' => $message, 'id' => $sess->user_id]);
						
					}
					
					
				} else {
					
					$message = "You need to login to update data";
					Session::set('MESSAGE', $message);
					redirect('/sc-panel/login');
				}
				
			} else {
				
				$message           = "Please make sure to fill in all fields";
				
				adminView('updateuser', ['message' => $message, 'id' => $sess->user_id]);
				
			}
			
			return false;
			
		}
		
		public function remove( $id )
		{
			$id = (int)$id['id'];
			
			$sess       =   new Session();
			
			if(User::hasPrivilege()){
				
				\Classes\Core\User::isAdmin();
				
				if ( empty( $id ) ) {
					
					$message = "Can not identify the user";
					adminView('users', ['message' => $message, 'userid'=>$sess->user_id]);
					return false;
				}
				
				$user = User::find_by_id($id);
				
				if ( $user->delete_user()) {
					
					redirect( '/sc-panel/users' );
					
					return true;
					
				} else {
					
					$message = "Sorry Couldn't finalise changes, please try again ";
					
					adminView('users', ['message' => $message, 'userid'=>$sess->user_id]);
					
				}
			}else if ( $id === $sess->user_id ) {
				
				if ( empty( $id ) ) {
					
					$message = "Can not identify the user";
					adminView('updateuser/'.$id, ['message' => $message, 'userid'=>$sess->user_id]);
					return false;
				}
				
				$user = User::find_by_id($id );
				
				if ( $user->delete_user()) {
					
					$sess->logout();
					redirect( '/sc-panel/login' );
					
					return true;
					
				} else {
					
					$message = "Sorry Couldn't finalise changes, please try again ";
					
					adminView('updateuser/'.$id, ['message' => $message, 'userid'=>$sess->user_id]);
					
				}
				
			} else {
				
				$message = "You are not authorised to make these changes";
				adminView('dashboard', ['message' => $message, 'userid'=>$sess->user_id]);
				
			}
			
			return false;
		}
		
		
	}