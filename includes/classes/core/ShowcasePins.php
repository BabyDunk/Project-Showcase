<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: showcase_app
	 * Date: 26/06/2018
	 * Time: 13:10
	 */
	
	namespace Classes\Core;
	
	
	/**
	 * Class ShowcasePins
	 *
	 * @package Classes\Core
	 */
	class ShowcasePins extends PdoObject
	{
		
		
		
		private static $instance;
		protected static $db_table = DB_PREFIX . "showcasepins";
		protected static $db_table_fields = array(
			'id' ,
			'show_id' ,
			'show_title' ,
			'show_body' ,
			'updated_at' ,
			'created_at'
		);
		
		public $id;
		public $show_id;
		public $show_title;
		public $show_body;
		public $updated_at;
		public $created_at;
		
		
		/**
		 * Creates static instance
		 *
		 * @return \Classes\Core\ShowcasePins
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
		 * Delete showcase pins
		 *
		 * @param $id
		 *
		 * @return bool
		 */
		public function deletePin( $id )
		{
			
			global $pdo;
			
			
			$params = [];
			$params[] = [ ':showid' , $id , 'int' ];
			$sql = "DELETE FROM `" . static::$db_table . "` WHERE show_id = :showid";
			
			$pdo->query( $sql , $params );
			
			return ( $pdo->rowsEffected() >= 1 ) ? true : false;
			
		} // End of Delete Method
		
		
	}