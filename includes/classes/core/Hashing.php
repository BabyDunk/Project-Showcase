<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: showcase_app
	 * Date: 31/05/2018
	 * Time: 12:26
	 */
	
	namespace Classes\Core;
	
	
	class Hashing
	{
		private     static  $instance;
		
		
		public  $errors = array();
		
		
		public static function instance()
		{
			if(!self::$instance instanceof self){
				self::$instance = new self;
			}
			return self::$instance;
		}
		
		/**
		 * Get Real Unique ID
		 * @param int $lenght
		 *
		 * @return bool|string
		 * @throws \Exception
		 */
		public function uniqidReal($lenght = 32) {
			// uniqid gives 32 chars, but you could adjust it to your needs.
			if (function_exists("random_bytes")) {
				$bytes = random_bytes(ceil($lenght / 2));
			} elseif (function_exists("openssl_random_pseudo_bytes")) {
				$bytes = openssl_random_pseudo_bytes(ceil($lenght / 2));
			} else {
				$this->errors[] = "no cryptographically secure random function available";
			}
			return substr(bin2hex($bytes), 0, $lenght);
		}
		
		public function hashIt( $password)
		{
			return password_hash($password, PASSWORD_DEFAULT );
		}
		
		public function checkHash($password, $hash)
		{
			return password_verify($password, $hash);
		}
		
		// Verify User for login
		public function verify_user($username, $password){
			
			if(empty($username)){
				return false;
			}
			
			if(empty($password)){
				return  false;
			}
			
			$user = User::find_by_username($username);
			
			if(empty($user)){
				return false;
			}
			
			$ifVerified = $this->checkHash($password, $user->password);
			
			if($ifVerified) {
				
				if (!empty($user) ) {
					$sess = new Session();
					$sess->login( $user );
					
					return $user;
					
				}
			}
			
			return false;
			
		} // End of Verify_user Method
		
		
		// Verify Hash
		public function verify_hash($username, $password){
			
			if(empty($username)){
				return false;
			}
			
			if(empty($password)){
				return  false;
			}
			
			$user = User::find_by_username($username);

			if(empty($user)){
				return false;
			}

			if($password === $user->password) {
				
				return true;
			}
			
			return false;
			
		} // End of Verify Hash
		
		public function show_id(  )
		{
			return 'ID_'.$this->uniqidReal(64).'_'.time();
			
		}
		
	}