<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: showcase_app
	 * Date: 28/01/2019
	 * Time: 16:26
	 */
	
	namespace Classes\Core;
	
	require_once( INCLUDES_PATH . 'config.php' );
	
	/**
	 * Class PdoDatabase
	 *
	 * @package Classes\Core
	 */
	class PdoDatabase
	{
		
		
		
		private $pdo;
		protected $lastquery = null;
		public $prefix = DB_PREFIX;
		
		
		private static $options = [
			\PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION ,
			\PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ ,
			\PDO::ATTR_EMULATE_PREPARES   => false
		];
		
		/**
		 * PdoDatabase constructor.
		 */
		public function __construct()
		{
			
			$this->pdo_master_connection();
			
		}
		
		
		/**
		 * Creates PDO DB connection
		 *
		 * @return \PDO
		 */
		private function pdo_master_connection()
		{
			
			try
			{
				$this->pdo = new \PDO( 'mysql: host=' . DB_HOST . '; dbname=' . DB_NAME , DB_USER , DB_PASS , static::$options );
				
				return $this->pdo;
			}
			catch ( \PDOException $e )
			{
				throw new \PDOException( "PDO ERROR: " . $e->getMessage() , $e->getCode() );
			}
		}
		
		/**
		 * Queries PDO DB
		 *
		 * @param       $sql
		 * @param array $params
		 *
		 * @return null|bool
		 */
		public function query( $sql , $params = [] )
		{
			
			try
			{
				$this->lastquery = $this->pdo->prepare( $sql );
				
				if ( ! empty( $params ) )
				{
					
					foreach ( $this->clean_params( $params ) as $param )
					{
						// TODO: Keep until finish testing
						/*if(!isEmpty($param[1]))
						{*/
						
						$this->lastquery->bindParam( $param[ 0 ] , $param[ 1 ] );
						/*}*/
					}
				}
				
				
				$this->lastquery->execute();
				
				return ( $this->lastquery ) ? $this->lastquery : false;
				
				
			}
			catch ( \PDOException $e )
			{
				throw new \PDOException( "PDO ERROR: " . $e->getMessage() , $e->getCode() );
			}
			
			
		}
		
		
		/**
		 * Returns the next row in an Array or Object = Default
		 *
		 * @param string $fetchmode
		 *
		 * @return null|mixed
		 */
		public function fetch( $fetchmode = 'OBJECT' )
		{
			
			$fetchmode = strtoupper( $fetchmode );
			
			if ( $fetchmode === 'ARRAY' )
			{
				$mode = 2;
			}
			else
			{
				$mode = 5;
			}
			
			return ! empty( $this->lastquery->fetch( $mode ) ) ? array_shift( $this->lastquery->fetch( $mode ) ) : null;
			
		}
		
		/**
		 * Returns all rows in an Array or Object = Default
		 *
		 * @param string $fetchmode
		 *
		 * @return mixed
		 */
		public function fetchAll( $fetchmode = 'OBJECT' )
		{
			
			$fetchmode = strtoupper( $fetchmode );
			
			if ( $fetchmode === 'ARRAY' )
			{
				$mode = 2;
			}
			else
			{
				$mode = 5;
			}
			
			$result = $this->lastquery->fetchAll( $mode );
			
			return $result;
			
		}
		
		
		/**
		 * Binds key => value pairs to query string
		 *
		 * @param $sql
		 * @param $params
		 *
		 * @return mixed|void
		 */
		private function bind_params( $sql , $params )
		{
			
			// TODO: incorporate to project
			if ( empty( $sql ) || empty( $params ) )
			{
				return;
			}
			
			$params = $this->clean_params( $params );
			
			for ( $x = 0; $x < count( $params ); $x ++ )
			{
				$sql = str_replace( $params[ $x ][ 0 ] , $params[ $x ][ 1 ] , $sql );
			}
			
			return $sql;
		}
		
		/**
		 * Clean params before interacting with DB
		 *
		 * @param $params
		 *
		 * @return mixed
		 */
		private function clean_params( $params )
		{
			
			if ( empty( $params ) )
			{
				for ( $x = 0; $x < count( $params ); $x ++ )
				{
					if ( $params[ $x ][ 2 ] === 'str' )
					{
						$params[ $x ][ 1 ] = $this->pdo->quote( $params[ $x ][ 1 ] );
					}
					elseif ( $params[ $x ][ 2 ] === 'int' )
					{
						$params[ $x ][ 1 ] = intval( $params[ $x ][ 1 ] );
					}
					elseif ( $params[ $x ][ 2 ] === 'bool' )
					{
						$params[ $x ][ 1 ] = (bool) $params[ $x ][ 1 ];
					}
					elseif ( $params[ $x ][ 2 ] === 'float' )
					{
						$params[ $x ][ 1 ] = floatval( $params[ $x ][ 1 ] );
					}
				}
			}
			
			return $params;
		}
		
		/**
		 * Return last inserted id
		 *
		 * @return mixed
		 */
		public function lastInsertedId()
		{
			
			return $this->pdo->lastInsertId();
		}
		
		/**
		 * Returns count of effect rows
		 *
		 * @return mixed
		 */
		public function rowsEffected()
		{
			
			return $this->lastquery->rowCount();
			
		}
		
		
	}