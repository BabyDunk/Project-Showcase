<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: oop
	 * Date: 27/05/2018
	 * Time: 19:06
	 */
	
	namespace Classes\Core;
	
	
	/**
	 * Class Params
	 *
	 * @package Classes\Core
	 */
	class Params
	{
		
		
		
		private static $instance;
		
		/**
		 * Creates static instance
		 *
		 * @return \Classes\Core\Params
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
		 * Return Parameters as an object
		 * or set $IsArray to true to return as an array
		 *
		 * @param bool $IsArray
		 *
		 * @return mixed
		 */
		public static function all( $IsArray = false )
		{
			
			$request = [];
			if ( ! empty( $_GET ) )
			{
				$request[ 'get' ] = $_GET;
			}
			if ( ! empty( $_POST ) )
			{
				$request[ 'post' ] = $_POST;
			}
			$request[ 'file' ] = $_FILES;
			
			return json_decode( json_encode( $request ) , $IsArray );
		}
		
		/**
		 * Get params as methods post| get | file
		 *
		 * @param $method
		 *
		 * @return mixed
		 */
		public static function get( $method , $asArray = false )
		{
			
			$object = new static;
			
			$data = $object->all( $asArray );
			
			return $data->$method;
			
		}
		
		/**
		 *  Set params - default method post
		 *
		 * @param        $value
		 * @param string $key
		 * @param string $method Takes value post | get | file
		 */
		public static function set( $value , $key = '' , $method = 'post' )
		{
			
			if ( isset( $key ) && isset( $value ) )
			{
				if ( $method === 'post' )
				{
					$_POST[ $key ] = $value;
				}
				elseif ( $method === 'get' )
				{
					$_GET[ $key ] = $value;
				}
				elseif ( $method === 'file' )
				{
					$_FILES[ $key ] = $value;
				}
				else
				{
					echo "Parameter was not set";
				}
			}
		}
		
		/**
		 * Check if has parameters - default method post
		 *
		 * @param        $key
		 * @param string $method
		 *
		 * @return bool
		 */
		public static function has( $key , $method = 'post' )
		{
			
			return ( isset( self::all( true )[ $method ][ $key ] ) ) ? true : false;
			
		}
		
		
		/**
		 * Refresh all parameters
		 */
		public static function refresh()
		{
			
			$_POST  = [];
			$_GET   = [];
			$_FILES = [];
			
		}
		
	}