<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: showcase_app
	 * Date: 30/01/2019
	 * Time: 00:02
	 */
	
	namespace Classes\Core;
	
	
	/**
	 * Class PdoObject
	 *
	 * @package Classes\Core
	 */
	class PdoObject
	{
		
		
		
		// Error handling for file uploads
		public $errors = array();
		public $upload_errors_array = array(
			
			UPLOAD_ERR_OK         => "There is no error" ,
			UPLOAD_ERR_INI_SIZE   => "The uploaded file exceeds the Maximum upload size" ,
			UPLOAD_ERR_FORM_SIZE  => "The uploaded file exceeds the Maximum upload size" ,
			UPLOAD_ERR_PARTIAL    => "The uploaded file was only partially uploaded" ,
			UPLOAD_ERR_NO_FILE    => "No file was uploaded" ,
			UPLOAD_ERR_NO_TMP_DIR => "Directory mismatch, Try again" ,
			UPLOAD_ERR_CANT_WRITE => "Failed to write file to disk" ,
			UPLOAD_ERR_EXTENSION  => "A something stopped the file upload"
		
		);
		
		/**
		 * PdoObject constructor.
		 */
		public function __construct()
		{
			
			$this->get_property();
			
		}
		
		
		/**
		 * Set file properties
		 *
		 * @param $file
		 *
		 * @return bool
		 */
		public function set_file( $file )
		{
			
			if ( empty( $file ) || ! is_array( $file ) || ! $file )
			{
				$this->errors[] = "There was no file uploaded here";
				
				return false;
			}
			
			if ( $file[ 'error' ] > 0 )
			{
				$this->errors[] = $this->upload_errors_array[ $file[ 'error' ] ];
				
				return false;
			}
			
			$this->filename = basename( $file[ 'name' ] );
			$this->tmp_path = $file[ 'tmp_name' ];
			$this->filetype = $file[ 'type' ];
			$this->size     = $file[ 'size' ];
			
			return true;
		}
		
		/**
		 * Find all data in a table
		 *
		 * @param int    $limit
		 * @param string $order
		 *
		 * @return array
		 */
		public static function find_all( $limit = 0 , $order = 'desc' )
		{
			
			$limit = ! empty( $limit ) ? " LIMIT $limit " : "";
			
			$isOrder = "";
			if ( $order === 'desc' )
			{
				$isOrder = " ORDER BY id DESC ";
			}
			elseif ( $order === 'asc' )
			{
				$isOrder = " ORDER BY id ASC ";
			}
			elseif ( $order === 'rand' )
			{
				$isOrder = " ORDER BY RAND() ";
			}
			
			$sql = "SELECT * FROM `" . static::$db_table . "` " . $isOrder . $limit;
			
			return static::find_by_query( $sql );
			
		}
		
		
		/**
		 * Get single row of data in an object
		 *
		 * @param $id
		 *
		 * @return bool|mixed
		 */
		public static function find_by_id( $id )
		{
			
			$sql = "SELECT * FROM `" . static::$db_table . "` WHERE id = :id LIMIT 1";
			
			$params[] = [ ':id' , $id , 'int' ];
			
			$item_array = static::find_by_query( $sql , $params );
			
			
			return ( ! empty( $item_array ) ) ? array_shift( $item_array ) : false;
			
		} // End of the Find_user_by_id Method
		
		/**
		 * Find data by show_id returned as an object
		 *
		 * @param        $id
		 * @param int    $limit
		 * @param string $order
		 *
		 * @return array|bool
		 */
		public static function find_by_show_id( $id , $limit = 0 , $order = 'desc' )
		{
			
			$limit = ! empty( $limit ) ? " LIMIT $limit " : "";
			
			$isOrder = "";
			if ( $order === 'desc' )
			{
				$isOrder = " ORDER BY id DESC ";
			}
			elseif ( $order === 'asc' )
			{
				$isOrder = " ORDER BY id ASC ";
			}
			elseif ( $order === 'rand' )
			{
				$isOrder = " ORDER BY RAND() ";
			}
			
			$sql      = "SELECT * FROM `" . static::$db_table . "` WHERE `show_id` = :showid " . $isOrder . $limit;
			$params   = [];
			$params[] = [ ':showid' , $id , 'int' ];
			
			$item_array = static::find_by_query( $sql , $params );
			
			return ( ! empty( $item_array ) ) ? $item_array : false;
			
		} // End of the Find_user_by_show_id Method
		
		
		/**
		 * Find data by user_id returned as an object
		 *
		 * @param        $id
		 * @param int    $limit
		 * @param string $order
		 *
		 * @return array|bool
		 */
		public static function find_by_user_id( $id , $limit = 0 , $order = 'desc' )
		{
			
			$limit = ! empty( $limit ) ? " LIMIT $limit " : "";
			
			$isOrder = "";
			if ( $order === 'desc' )
			{
				$isOrder = " ORDER BY id DESC ";
			}
			elseif ( $order === 'asc' )
			{
				$isOrder = " ORDER BY id ASC ";
			}
			elseif ( $order === 'rand' )
			{
				$isOrder = " ORDER BY RAND() ";
			}
			
			$params   = [];
			$params[] = [ ':holderid' , $id , 'int' ];
			
			$sql = "SELECT * FROM `" . static::$db_table . "` WHERE user_id = :holderid " . $isOrder . $limit;
			
			$item_array = static::find_by_query( $sql , $params );
			
			
			return ( ! empty( $item_array ) ) ? $item_array : false;
			
		} // End of the Find_user_by_id Method
		
		// Get single preference by pref id
		/**
		 * Search and return data by sending array of key value pairs
		 *
		 * @param array $arrayOfColAndString
		 * @param int   $limit
		 *
		 * @return bool|mixed
		 */
		public static function find_by_like( $arrayOfColAndString = [] , $limit = 1 )
		{
			
			if ( empty( $arrayOfColAndString ) )
			{
				return false;
			}
			
			$theLike = [];
			$params  = [];
			foreach ( $arrayOfColAndString as $key => $value )
			{
				$theLike[] = "`{$key}` LIKE :holder" . $key . "";
				$params[]  = [ ':holder' . $key , $value , 'str' ];
				
			}
			
			$sql = "SELECT * FROM `" . static::$db_table . "` WHERE ";
			$sql .= implode( ' AND ' , $theLike );
			if ( ! empty( $limit ) )
			{
				$sql .= " LIMIT $limit ";
			}
			
			$item_array = static::find_by_query( $sql , $params );
			
			return ( ! empty( $item_array ) ) ? array_shift( $item_array ) : false;
			
		} // End of the Find preference by pref id
		
		
		/**
		 * Return all rows by sql query narrow result by adding array of key value pairs
		 *
		 * @param       $sql
		 * @param array $params
		 *
		 * @return array
		 */
		public static function find_by_query( $sql , $params = [] )
		{
			
			global $pdo;
			
			$pdo->query( $sql , $params );
			
			$object_holder = [];
			
			
			foreach ( $pdo->fetchAll( 'ARRAY' ) as $row )
			{
				
				$object_holder[] = static::instantiation( $row );
			}
			
			return $object_holder;
			
		} // End of the Find_the_query Method
		
		
		/**
		 * Instantiates class and build properties
		 *
		 * @param $data
		 *
		 * @return mixed
		 */
		private static function instantiation( $data )
		{
			
			$calledClass = get_called_class();
			
			
			$newInstants = new $calledClass;
			
			foreach ( $data as $propName => $propVal )
			{
				
				if ( property_exists( $newInstants , $propName ) )
				{
					$newInstants->$propName = $propVal;
				}
			}
			
			return $newInstants;
		}
		
		/**
		 * Get property from class
		 *
		 * @return array
		 */
		private function get_property()
		{
			
			$property = [];
			
			foreach ( static::$db_table_fields as $db_table_field )
			{
				
				if ( property_exists( $this , $db_table_field ) )
				{
					$property[ $db_table_field ] = $this->$db_table_field;
				}
			}
			
			return $property;
		}
		
		
		/**
		 * Auto choose Create or Update Method
		 *
		 * @return bool
		 */
		public function save()
		{
			
			return isset( $this->id ) ? $this->update() : $this->create();
			
		} // End of the Save Method
		
		/**
		 * Creates new DB row
		 *
		 * @return bool
		 */
		public function create()
		{
			
			global $pdo;
			
			$properties = $this->get_property();
			
			$sortedProps = [];
			foreach ( $properties as $key => $value )
			{
				if ( ! isEmpty( $value ) )
				{
					$sortedProps[ $key ] = $value;
				}
			}
			
			$sql = "INSERT INTO `" . static::$db_table . "` (" . '`' . implode( "`, `" , array_keys( $sortedProps ) ) . '`' . ") ";
			$sql .= "VALUES (:holder" . implode( ",:holder" , array_keys( $sortedProps ) ) . ")";
			
			
			$params = [];
			foreach ( $sortedProps as $key => $value )
			{
				$params[] = [ ':holder' . $key , $value , '' ];
			}
			
			if ( $pdo->query( $sql , $params ) )
			{
				
				$this->id = $pdo->lastInsertedId();
				
				return true;
				
			}
			else
			{
				
				return false;
				
			}
			
		} // End of Create Method
		
		/**
		 * Updates existing DB row
		 *
		 * @return bool
		 */
		public function update()
		{
			
			global $pdo;
			
			$properties = $this->get_property();
			
			$properties_pairs = array();
			$params           = [];
			foreach ( $properties as $property => $value )
			{
				
				// TODO: Keep until finish testing
				/*if ( ! empty( $value ))
				{*/
				if ( $property !== 'id' )
				{
					$properties_pairs[] = "`{$property}` = :holder{$property}";
				}
				$params[] = [ ':holder' . $property , $value , '' ];
				/*}*/
				
			}
			
			$sql = "UPDATE `" . static::$db_table . "` SET ";
			$sql .= implode( ", " , $properties_pairs ) . " ";
			$sql .= "WHERE `id` = :holderid LIMIT 1";
			
			$pdo->query( $sql , $params );
			
			
			return ( $pdo->rowsEffected() >= 1 ) ? true : false;
			
		}
		
		/**
		 * Update column string
		 *
		 * @param $arrayOfColAndString
		 *
		 * @return bool
		 */
		public function updateByColString( $arrayOfColAndString )
		{
			
			global $pdo;
			
			$properties = $this->get_property();
			
			$properties_pairs = [];
			$params           = [];
			
			foreach ( $properties as $property => $value )
			{
				if ( $property !== 'pref_section' && $property !== 'pref_key')
				{
					$properties_pairs[] = "`{$property}` = :holder{$property}";
					$params[]           = [ ':holder' . $property , $value , '' ];
				}
				
			}
			
			
			$theClause = [];
			foreach ( $arrayOfColAndString as $key => $value )
			{
				$theClause[] = "`{$key}` = :holder{$key}";
				$params[]    = [ ':holder' . $key , $value , '' ];
			}
			
			
			$sql = "UPDATE `" . static::$db_table . "` SET ";
			$sql .= implode( ", " , $properties_pairs ) . " ";
			$sql .= "WHERE ";
			$sql .= implode( ' AND ' , $theClause );
			$sql .= " LIMIT 1";
			
			
			$pdo->query( $sql , $params );
			
			
			return ( $pdo->rowsEffected() >= 1 ) ? true : false;
			
		} // End of Update Method
		
		/**
		 * Update row where clause match. takes single column and data to match
		 *
		 * @param $columnName
		 * @param $clauseInput
		 *
		 * @return bool
		 */
		public function updateByColClause( $columnName , $clauseInput )
		{
			
			global $pdo;
			
			$properties = $this->get_property();
			
			$properties_pairs = array();
			$params           = [];
			$params[]         = [ ':holderstring' , $clauseInput , '' ];
			$params[]         = [ ':holdercolumn' , $columnName , '' ];
			foreach ( $properties as $property => $value )
			{
				
				$properties_pairs[] = "`{$property}` = :holder{$property}";
				$params[]           = [ ':holder' . $property , $value , '' ];
			}
			
			$sql = "UPDATE `" . static::$db_table . "` SET ";
			$sql .= implode( ", " , $properties_pairs ) . " ";
			$sql .= "WHERE `:holdercolumn` = :holderstring LIMIT 1";
			
			$pdo->query( $sql , $params );
			
			
			return ( $pdo->rowsEffected() >= 1 ) ? true : false;
			
		} // End of Update Method
		
		/**
		 * Deletes row from DB
		 *
		 * @return bool
		 */
		public function delete()
		{
			
			global $pdo;
			
			
			$params   = [];
			$params[] = [ ':holderid' , $this->id , 'int' ];
			
			$sql = "DELETE FROM `" . static::$db_table . "` WHERE id = :holderid LIMIT 1";
			
			
			$pdo->query( $sql , $params );
			
			return ( $pdo->rowsEffected() >= 1 ) ? true : false;
			
		} // End of Delete Method
		
		/**
		 * Delete by condition. supply array of key => value pairs
		 *
		 * @param array $conditions
		 *
		 * @return bool
		 */
		public static function deleteAllByCond( $conditions = [] )
		{
			
			global $pdo;
			
			$loadCond = '';
			$params   = [];
			
			if ( ! empty( $conditions ) )
			{
				$arrCount  = count( $conditions );
				$loopCount = 0;
				$loadCond  = ' WHERE ';
				foreach ( $conditions as $key => $condition )
				{
					$loadCond .= $key . " = :holder{$key}";
					$loopCount ++;
					if ( $loopCount < $arrCount )
					{
						$loadCond .= ' AND ';
					}
					$params[] = [ ':holder' . $key , $condition , '' ];
				}
			}
			
			$sql = "DELETE FROM `" . static::$db_table . "`" . $loadCond;
			
			
			$pdo->query( $sql , $params );
			
			return ( $pdo->rowsEffected() >= 1 ) ? true : false;
			
		} // End of Delete Method
		
		/**
		 * Delete one by condition
		 *
		 * @param $arrayOfColAndString
		 *
		 * @return bool
		 */
		public function deleteByColString( $arrayOfColAndString )
		{
			
			global $pdo;
			
			$theArray = [];
			$params   = [];
			foreach ( $arrayOfColAndString as $key => $value )
			{
				$theArray[] = "`{$key}` = :holder{$key}";
				$params[]   = [ ':holder' . $key , $value , '' ];
			}
			
			$sql = "DELETE FROM `" . static::$db_table . "` WHERE ";
			$sql .= implode( ' AND ' , $theArray );
			$sql .= " LIMIT 1";
			
			$pdo->query( $sql , $params );
			
			return ( $pdo->rowsEffected() >= 1 ) ? true : false;
			
		} // End of Delete Method
		
		/**
		 * Deletes all  with the user_id
		 *
		 * @param $id
		 *
		 * @return bool
		 */
		public function deleteAllOfUser( $id )
		{
			
			global $pdo;
			
			$params   = [];
			$params[] = [ ':user_id' , $id , 'int' ];
			$sql      = "DELETE FROM `" . static::$db_table . "` WHERE user_id = :user_id";
			
			$pdo->query( $sql , $params );
			
			return ( $pdo->rowsEffected() >= 1 ) ? true : false;
			
		} // End of Delete Method
		
		/**
		 * Counts all
		 *
		 * @return mixed
		 */
		public static function count_all()
		{
			
			global $pdo;
			
			$sql = "SELECT COUNT(*) FROM " . static::$db_table;
			
			$result = $pdo->query( $sql );
			
			return $result->fetchColumn();
			
		}
		
		/**
		 * Counts by condition
		 *
		 * @param array $conditions
		 *
		 * @return mixed
		 */
		public static function count_by_condition( $conditions = [] )
		{
			
			global $pdo;
			
			$loadCond = '';
			if ( ! empty( $conditions ) )
			{
				$arrCount  = count( $conditions );
				$loopCount = 0;
				$loadCond  = ' WHERE ';
				foreach ( $conditions as $key => $condition )
				{
					$loadCond .= $key . " = '" . $condition . "'";
					$loopCount ++;
					if ( $loopCount < $arrCount )
					{
						$loadCond .= ' AND ';
					}
				}
			}
			$sql = "SELECT COUNT(*) FROM " . static::$db_table . $loadCond;
			
			$result_set = $pdo->query( $sql );
			
			
			return $result_set->fetchColumn();
		}
		
		/**
		 * Returns last inserted
		 *
		 * @return mixed
		 */
		public function get_last_insert()
		{
			
			global $pdo;
			
			return ( $pdo->lastInsertedId() ) ? $this->id = $pdo->lastInsertedId() : $this->id;
			
		}
		
		
	}