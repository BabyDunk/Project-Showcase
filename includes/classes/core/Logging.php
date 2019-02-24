<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: showcase_app
	 * Date: 01/06/2018
	 * Time: 12:48
	 */
	
	namespace Classes\Core;
	
	
	/**
	 * Class Visitors
	 *
	 * @package Classes\Core
	 */
	class Logging extends PdoObject
	{
		
		
		
		private static $instance;
		protected static $db_table = DB_PREFIX . "logging";
		protected static $db_table_fields = array(
			'id' ,
			'logs' ,
			'created_at'
		);
		
		public $id;
		public $logs;
		public $created_at;
		
		
		public static function instance()
		{
			
			if ( ! self::$instance instanceof self )
			{
				self::$instance = new self;
			}
			
			return self::$instance;
		}
		
		public function get()
		{
		
		}
		
		
		
		
	}