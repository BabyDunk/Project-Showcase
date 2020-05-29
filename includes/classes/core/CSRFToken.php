<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: showcase_app
	 * Date: 31/05/2018
	 * Time: 12:27
	 */
	
	namespace Classes\Core;
	
	
	/**
	 * Class CSRFToken
	 *
	 * @package Classes\Core
	 */
	class CSRFToken
	{
		
		
		
		private static $instance;
		
		/**
		 * Create a static instance
		 *
		 * @return \Classes\Core\CSRFToken
		 */
		public static function instance()
		{
			
			if ( ! self::$instance instanceof self )
			{
				self::$instance = new self;
			}
			
			return self::$instance;
		}
		
		
		/**
		 * Set a CSRF Token if not already present
		 *
		 * @return mixed
		 * @throws \Exception
		 */
		public static function _SetToken()
		{
			
			If ( session_status() !== PHP_SESSION_ACTIVE )
			{
				session_start();
			}
			
			if ( ! Session::has( 'CSRFToken' ) )
			{
				Session::set( 'CSRFToken' , Hashing::instance()->uniqidReal( 64 ) . '-' . time() );
			}
			
			return Session::get( 'CSRFToken' );
		}
		
		
		/**
		 * Check if CSRF Token match then clear of correct
		 *
		 * @param string $_CSRFToken
		 *
		 * @return bool
		 */
		public static function _CheckToken( $_CSRFToken = '' )
		{
			
			if ( Session::has( 'CSRFToken' ) && Session::get( 'CSRFToken' ) === Params::get( 'post' )->CSRFToken
			     || Session::has( 'CSRFToken' ) && Session::get( 'CSRFToken' ) === $_CSRFToken )
			{
				
				Session::clear( 'CSRFToken' );
				
				return true;
			}
			
			return false;
		}
	}