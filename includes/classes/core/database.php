<?php
	/**
	 * Created by Chris.
	 * Title: oop
	 * Date: 03/12/2017
	 * Time: 02:59
	 */
	
	namespace Classes\Core;
	
	use Mysqli;
	
	require_once( INCLUDES_PATH . 'config.php' );
	
	/**
	 * Class Database
	 *
	 * @package Classes\Core
	 */
	class Database
	{
		
		
		
		public $connection;
		
		/**
		 * Database constructor.
		 */
		function __construct()
		{
			
			$this->op_db_connection();
			
		}
		
		
		/**
		 * Create DB connection
		 */
		public function op_db_connection()
		{
			
			//$this->connection  =   mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME );
			
			$this->connection = new Mysqli( DB_HOST , DB_USER , DB_PASS , DB_NAME );
			
			if ( $this->connection->connect_errno )
			{
				
				die( 'Database Connection Error: ' . $this->connection->connect_error );
				
			}
			
			if ( ! $this->connection->set_charset( DB_CHARSET ) )
			{
				printf( "Error loading character set utf8: %s\n" , $this->connection->error );
				exit;
			}
			
		}
		
		/**
		 * Queries the DB
		 *
		 * @param $sql
		 *
		 * @return mixed
		 */
		public function query( $sql )
		{
			
			$result = $this->connection->query( $sql );
			
			$this->confirm_query( $result );
			
			
			return $result;
			
		}
		
		
		/**
		 * Checks for failure
		 *
		 * @param $result
		 */
		private function confirm_query( $result )
		{
			
			if ( ! $result )
			{
				
				die( "Query Failed" . $this->connection->error );
			}
			
		}
		
		/**
		 * Escapes DB string queries
		 *
		 * @param $str
		 *
		 * @return mixed
		 */
		public function escape_string( $str )
		{
			
			
			$escaped_string = $this->connection->real_escape_string( $str );
			
			
			return $escaped_string;
		}
		
		/**
		 * Return last inserted id
		 *
		 * @return mixed
		 */
		public function the_insert_id()
		{
			
			return $this->connection->insert_id;
			
		}
		
		
	} //  End of Database class






