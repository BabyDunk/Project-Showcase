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
	class Visitors extends Db_object
	{
		private     static  $instance;
		protected static    $db_table = DB_PREFIX."visitors";
		protected static    $db_table_fields = array('visitors_ip', 'visitors_host', 'visitors_agent', 'visited_page_id', 'visited_page_title', 'visited_page_author', 'visitors_sess', 'created_at');
		
		public              $id;
		public              $visitors_ip;
		public              $visitors_host;
		public              $visitors_agent;
		public              $visited_page_id;
		public              $visited_page_title;
		public              $visited_page_author;
		public              $visitors_sess;
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
		
		/**
		 *  Set Visitors data to storage.
		 *
		 * @param $page_id
		 */
		public function set( $page_id )
		{
			
			$page_id = $page_id[ 'id' ];
			
			$showcase = Showcase::find_by_id( $page_id );
			
			$this->visitors_ip         = ip2long( $_SERVER[ 'REMOTE_ADDR' ] );
			$this->visitors_host       = isset( $_SERVER[ 'REMOTE_HOST' ] ) ? $_SERVER[ 'REMOTE_HOST' ] : gethostbyaddr( $_SERVER[ 'REMOTE_ADDR' ] );
			$this->visitors_agent      = $_SERVER[ 'HTTP_USER_AGENT' ];
			$this->visited_page_id     = ( empty( $page_id ) ) ? '' : $page_id;
			$this->visited_page_title  = ( empty( $page_id ) ) ? '' : $showcase->title;
			$this->visited_page_author = ( empty( $page_id ) ) ? '' : $showcase->user_id;
			$this->visitors_sess       = session_id() . '_' . ip2long( $_SERVER[ 'REMOTE_ADDR' ] );
			$this->created_at          = date( "Y-m-d H:i:s" );

			if ( ! Session::has( 'DATACOLLECT' ) ) {
				Session::set( 'DATACOLLECT' , $this->visitors_sess );
				
				$this->save();
			} else {
				
				if ( Session::has( 'DATACOLLECT' ) ) {
					if ( Session::get( 'DATACOLLECT' ) === $this->visitors_sess ) {
						
						$seenPage = self::find_by_visitor_sess( $this->visitors_sess );
						
						if ( empty( $seenPage ) ) {
							$this->save();
							
							return;
						}
						
						$hasSeen  = 0;
						$arrCount = 0;
						foreach ( $seenPage as $val ) {
							$arrCount ++;
							
							if ( $val->visited_page_id !== $page_id ) {
								
								$hasSeen ++;
							}
						}
						
						if ( $hasSeen === $arrCount ) {
							$this->save();
						}
						
					} else {
						Session::set( 'DATACOLLECT' , $this->visitors_sess );
						$this->save();
					}
				}
			}
		}
			
			
			
		// TODO: finish setting the stats for collection
		
		
			
		
		
		public function check(  )
		{
		
		
		}
		
		
		/**
		 * Get visitors  by sess data in a named array
		 *
		 * @param $sess
		 *
		 * @return array|bool|void
		 */
		public static function find_by_visitor_sess( $sess ){
			global $db;
			
			if(empty($sess)){
				return;
			}
		
			$sess =   $db->escape_string( $sess );
			
			$item_array   =   static::find_by_query( "SELECT * FROM `" . static::$db_table . "` WHERE visitors_sess = '" . $sess . "' " );
			
			
			return (!empty($item_array)) ? $item_array : false;
			
		} // End of the find_by_visitor_sess Method
		
		/**
		 * Count visitors  by sess data
		 *
		 * @param $sess
		 *
		 * @return mixed|void
		 */
		public static function count_by_visitor_sess( $sess ){
			global $db;
			
			if(empty($sess)) return;
			if(!is_string($sess)) return;
			
			$sess =   $db->escape_string($sess);
			
			$result = self::count_by_condition(['visitors_sess'=>$sess]);
			
			return $result;
			
		} // End of the find_by_visitor_sess Method
		
		/**
		 * Count visitors  by author id
		 *
		 * @param $author
		 *
		 * @return mixed|void
		 */
		public static function count_by_visitor_by_author( $author ){
			global $db;
			
			if(empty($author)) return;
			if (!is_integer($author)) $author = intval($author);
			
			$result = self::count_by_condition(['visited_page_author'=>$author]);
			
			return $result;
			
		} // End of the count_by_visitor_by_author Method
	}