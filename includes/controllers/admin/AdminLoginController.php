<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: oop
	 * Date: 27/05/2018
	 * Time: 15:41
	 */
	
	namespace Controllers\Admin;
	
	
	use Classes\Core\CSRFToken;
	use Classes\Core\Hashing;
	use Classes\Core\Params;
	use Classes\Core\Session;

	class AdminLoginController
	{
		
		public function show()
		{
			$sess = new Session();
			
			if($sess->is_signed_in()){
				
				redirect('/admin');
			
			}else{
				
				adminView('login');
				
				Session::clear('MESSAGE');
			}
			
		}
		
		public function check()
		{
			if(!CSRFToken::_CheckToken()){
				
				redirect('/admin/login');
				
				Session::set('MESSAGE', 'There was a problem, Refresh page and try again');
				
				return false;
			}
			
			$post = Params::get('post');
			
			if($post) {
				$password = $post->password;
				$username = $post->username;
			}
			
			$userData = Hashing::instance()->verify_user($username, $password);
			
			if(!empty($userData)){
				redirect('/admin');
			} else {
				adminView('login', ['message' => 'something went wrong']);
			}
	
		}
		
		public function logout(  )
		{
			$sess = new Session();
			
			$sess->logout();
				
			redirect('/admin/login');
			
			
			
		}
		
	}