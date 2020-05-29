<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: showcase_app
	 * Date: 05/06/2018
	 * Time: 22:05
	 */
	
	namespace Classes\Core;
	
	
	/**
	 * Class Preference
	 *
	 * @package Classes\Core
	 */
	class Preference extends PdoObject
	{
		
		
		
		private static $instance;
		protected static $db_table = DB_PREFIX . "preference";
		protected static $db_pref_section = "pref_section";
		protected static $db_pref_key = "pref_key";
		protected static $db_table_fields = array( 'pref_section' , 'pref_key' , 'pref_value' , 'pref_type' );
		protected static $db_Enum_Types = array( 'STRING' , 'INTEGER' , 'BOOLEAN' );
		
		
		public $pref_section;
		public $pref_key;
		public $pref_value = ' ';
		public $pref_type;
		
		
		/**
		 * Creates static instance
		 *
		 * @return \Classes\Core\Preference
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
		 * Set Preference
		 *
		 * @param        $pref_section
		 * @param        $pref_key
		 * @param        $pref_value
		 * @param string $pref_type
		 *
		 * @return bool|string
		 */
		public function set( $pref_section , $pref_key , $pref_value , $pref_type = 'STRING' )
		{
			
			if ( empty( $pref_section ) )
			{
				return $this->errors[] = "Your section id is missing";
			}
			if ( empty( $pref_key ) )
			{
				return $this->errors[] = "Your request is missing preference id";
			}
			if ( empty( $pref_type ) )
			{
				return $this->errors[] = "Your request is missing preference type. can be STRING | INTEGER | BOOLEAN";
			}
			
			$pref_type = ( in_array( $pref_type , static::$db_Enum_Types ) ) ? $pref_type : 'STRING';
			
			$this->pref_section = $pref_section;
			$this->pref_key     = $pref_key;
			$this->pref_value   = ($pref_value) ? $pref_value : null;
			$this->pref_type    = $pref_type;
			
			
			if ( $this->find() )
			{
				return ( $this->updateByColString( [
					static::$db_pref_section => $this->pref_section ,
					static::$db_pref_key     => $this->pref_key
				] ) ) ? true : false;
			}
			else
			{
				return ( $this->create() ) ? true : false;
			}
			
		}
		
		/**
		 * returns row if preference is found
		 *
		 * @return bool|mixed
		 */
		public function find()
		{
			
			if ( ! empty( self::find_by_like( [ static::$db_pref_section => $this->pref_section ] , 0 ) ) )
			{
				return self::find_by_like( [
					static::$db_pref_section => $this->pref_section ,
					static::$db_pref_key     => $this->pref_key
				] );
			}
			
			return false;
		}
		
		public function has( $pref_section = '' , $pref_key = '' )
		{
			
			if ( ! empty( $pref_key ) && ! empty( $pref_section ) )
			{
				$this->pref_section = $pref_section;
				$this->pref_key     = $pref_key;
			}
			
			return !empty($this->find()) ? true : false;
		}
			
			
			/**
		 * Get the value of perference
		 *
		 * @param string $pref_section
		 * @param string $pref_key
		 *
		 * @return bool|int|string
		 */
		public function get( $pref_section = '' , $pref_key = '' )
		{
			
			if ( ! empty( $pref_key ) && ! empty( $pref_section ) )
			{
				$this->pref_section = $pref_section;
				$this->pref_key     = $pref_key;
			}
			
			
			if ( ! empty( $this->find() ) )
			{
				
				$type = $this->find()->pref_type;
				
				if ( $type === 'STRING' )
				{
					return (string) $this->find()->pref_value;
				}
				
				if ( $type === 'INTEGER' )
				{
					return (int) $this->find()->pref_value;
				}
				
				if ( $type === 'BOOLEAN' )
				{
					return (boolean) $this->find()->pref_value;
				}
			}
			
			return false;
		}
		
		/**
		 * Delete preference
		 *
		 * @param $pref_section
		 * @param $pref_key
		 *
		 * @return bool
		 */
		public function remove( $pref_section , $pref_key )
		{
			
			$this->pref_section = $pref_section;
			$this->pref_key     = $pref_key;
			
			return ( $this->deleteByColString( [
				static::$db_pref_section => $this->pref_section ,
				static::$db_pref_key     => $this->pref_key
			] ) ) ? true : false;
			
		}
		
		
	}