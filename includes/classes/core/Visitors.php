<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: showcase_app
	 * Date: 01/06/2018
	 * Time: 12:48
	 */
	
	namespace Classes\Core;
	
	
	class Visitors extends Db_object
	{
		private     static  $instance;
		protected static    $db_table = "visitors";
		protected static    $db_table_fields = array('visitors_ip', 'visitors_host', 'visited_page_id', 'visistor_sess', 'created_at');
		
		public              $id;
		public              $visitors_ip;
		public              $visitors_host;
		public              $visited_page_id;
		public              $visistor_sess;
		public              $created_at;
		
		
		public static function instance()
		{
			if(!self::$instance instanceof self){
				self::$instance = new self;
			}
			return self::$instance;
		}
		
		public function get()
		{
		
		}
		
		public function set( $page_id='' )
		{
			
			$this->visitors_ip        = $_SERVER['REMOTE_ADDR'];
			$this->visitors_host      = ip2long($_SERVER['REMOTE_HOST']);
			$this->visited_page_id    = (!empty($page_id)) ? $page_id : '';
			$this->visitor_sess       = session_id().'-'.$_SERVER['REMOTE_ADDR'];
			$this->created_at         = date("Y-m-d H:i:s");
			
			if(!Session::has('DATACOLLECT')){
				Session::set('DATACOLLECT', $this->visistor_sess);
			} else {
			
			}
			
			
			
			
			// TODO: finish setting the stats for collection
			
		}
		
		public function check(  )
		{
		
		
		}
	}