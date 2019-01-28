<?php
/**
 * Created by Chris.
 * Title: oop
 * Date: 05/12/2017
 * Time: 00:16
 */
	
	namespace Classes\Core;

class Session {
	
	private     static  $instance;
	private     $signed_in;
	public      $user_id;
	public      $message;
	public      $count;


	function __construct() {

		if(session_status() !== PHP_SESSION_ACTIVE){
			session_start();
		}
		
		
		$this->check_the_login();
		$this->check_message();
		$this->visitor_count();

	}
	
	public static function instance()
	{
		if(!self::$instance instanceof self){
			self::$instance = new self;
		}
		return self::$instance;
	}
	
	/**
	 * Return all $_SESSION unless a key is defined
	 *
	 * @param string $key
	 *
	 * @return mixed
	 */
	public static function get( $key='' )
	{
		if(!empty($key)) {
			
			if ( isset( $_SESSION[ $key ] ) ) {
				return $_SESSION[ $key ];
			}
			
		} else {
			
			return $_SESSION;
		}
	}
	
	/**
	 * Set $_SESSION by $key and $value
	 *
	 * @param $key
	 * @param $value
	 *
	 * @return bool
	 */
	public static function set($key, $value)
	{
		if(!empty($key) && !empty($value)) {
			$_SESSION[ $key ] = $value;
		} else {
			
			return false;
		}
	}
	
	public static function has( $key )
	{
		return (array_key_exists($key, $_SESSION)) ? true : false;
		
	}
	
	public static function clear( $key )
	{
		if(self::has($key)){
			unset($_SESSION[$key]);
		}
		
	}
	
	public function visitor_count() {
		
		if(isset($_SESSION['count'])){
			
			return $this->count =   $_SESSION['count']++;
			
		} else {
			
			return $_SESSION['count']   =   1;
			
		}
		
	}

	public function message($msg = ""){

		if(!empty($msg)){

			$_SESSION['message']    =   $msg;

		} else {

			return $this->message;

		}

	}

	private function check_message(){

		if(isset($_SESSION['message'])){

			$this->message = $_SESSION['message'];
			unset($_SESSION['message']);

		} else {

			$this->message = '';

		}

	}

	public function is_signed_in(){

		return $this->signed_in;

	}

	public function login( $user ){

		if($user){

			$this->user_id = $_SESSION['user_id'] = $user->id;
			$this->signed_in = true;
			
			return true;

		}

	}

	public function logout(){

		unset($_SESSION['user_id']);
		unset($this->user_id);
		$this->signed_in = false;
	
	}

	private function check_the_login(){

		if(isset($_SESSION['user_id'])){

			$this->user_id      =   $_SESSION['user_id'];
			$this->signed_in    =   true;

		} else {

			unset($this->user_id);
			$this->signed_in = false;

		}

	}
	



}


