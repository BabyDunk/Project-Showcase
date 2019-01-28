<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: showcase_app
	 * Date: 05/06/2018
	 * Time: 22:05
	 */
	
	namespace Classes\Core;
	
	
	class Preference extends  Db_object
	{
		private     static  $instance;
		protected   static  $db_table = DB_PREFIX."preference";
		protected   static  $db_pref_section = "pref_section";
		protected   static  $db_pref_key = "pref_key";
		protected   static  $db_table_fields = array('pref_section', 'pref_key', 'pref_value', 'pref_type');
		protected   static  $db_Enum_Types = array('STRING', 'INTEGER', 'BOOLEAN');
		
		
		public              $id;
		public              $pref_section;
		public              $pref_key;
		public              $pref_value;
		public              $pref_type;
		
		
		public static function instance()
		{
			if(!self::$instance instanceof self){
				self::$instance = new self;
			}
			return self::$instance;
		}
		
		// TODO: figure a way to store values even if empty
		public function set( $pref_section,$pref_key, $pref_value, $pref_type='STRING' )
		{
			if(empty($pref_section)){
				return $this->errors[] = "Your section id is missing";
				//return false;
			}
			if(empty($pref_key)){
				return $this->errors[] = "Your request is missing preference id";
				//return false;
			}
			if(empty($pref_type)){
				return $this->errors[] = "Your request is missing preference type. can be STRING | INTEGER | BOOLEAN";
				//return false;
			}
			
			$pref_type = (in_array($pref_type, static::$db_Enum_Types)) ? $pref_type : 'STRING';
			
			$this->pref_section = $pref_section;
			$this->pref_key     = $pref_key;
			$this->pref_value   = $pref_value;
			$this->pref_type    = $pref_type;
			
			
			if($this->find()){
				return ($this->updateByColString([static::$db_pref_section => $this->pref_section, static::$db_pref_key => $this->pref_key])) ? true : false;
			}else{
				return ($this->create()) ? true : false;
			}
			
		}
		
		public function find()
		{
			if(!empty(self::find_by_like([static::$db_pref_section => $this->pref_section], 0))) {
				return self::find_by_like( [
					static::$db_pref_section => $this->pref_section ,
					static::$db_pref_key     => $this->pref_key
				]);
			}
			
			return false;
		}
		
		public function get($pref_section='', $pref_key='')
		{
			if(!empty($pref_key) && !empty($pref_section)) {
				$this->pref_section = $pref_section;
				$this->pref_key = $pref_key;
			}
			
			
			if(!empty($this->find())){
				
				$type = $this->find()->pref_type;
				
				if($type === 'STRING'){
					return (string)$this->find()->pref_value;
				}
				
				if($type === 'INTEGER'){
					return (int)$this->find()->pref_value;
				}
				
				if($type === 'BOOLEAN'){
					return (boolean)$this->find()->pref_value;
				}
			}
			
			return false;
		}
		
		public function remove($pref_section, $pref_key)
		{
			$this->pref_section= $pref_section;
			$this->pref_key = $pref_key;
			
			return ($this->deleteByColString([static::$db_pref_section => $this->pref_section, static::$db_pref_key => $this->pref_key])) ? true : false;
			
		}
		
		
		
		
		
	}