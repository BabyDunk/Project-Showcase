<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: showcase_app
	 * Date: 26/06/2018
	 * Time: 13:10
	 */
	
	namespace Classes\Core;
	
	
	class ShowcasePins extends Db_object
	{
		private     static  $instance;
		protected   static  $db_table = DB_PREFIX."showcase_text";
		protected   static  $db_table_fields = array('show_id', 'show_title', 'show_body', 'updated_at', 'created_at');
		
		public              $id;
		public              $show_id;
		public              $show_title;
		public              $show_body;
		public              $updated_at;
		public              $created_at;
		
		
		
		
		
		public static function instance()
		{
			if(!self::$instance instanceof self){
				self::$instance = new self;
			}
			return self::$instance;
		}
		
		
		public function deletePin($id){
			global $db;
			
			$sql    =   "DELETE FROM `" . static::$db_table . "` WHERE show_id = " . $db->escape_string($id);
			
			$db->query($sql);
			
			return (mysqli_affected_rows($db->connection) >= 1 ) ? true : false;
			
		} // End of Delete Method
		
		
		
		
		
	}