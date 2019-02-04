<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: showcase_app
	 * Date: 30/01/2019
	 * Time: 00:02
	 */
	
	namespace Classes\Core;
	
	
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
		
		public function __construct()
		{
			
			$this->get_property();
			
		}
		
		
		public function set_file( $file )
		{
			
			if ( empty( $file ) || ! is_array( $file ) || ! $file )
			{
				$this->error[] = "There was no file uploaded here";
				
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
			
		}
		
		public static function find_all( $limit = 0 , $order = 'rand' )
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
		
		// Get single user data in a named array
		public static function find_by_id( $id )
		{
			
			$sql = "SELECT * FROM `" . static::$db_table . "` WHERE id = :id LIMIT 1";
			
			$params[] = [ ':id' , $id , 'int' ];
			
			$item_array = static::find_by_query( $sql , $params );
			
			
			return ( ! empty( $item_array ) ) ? array_shift( $item_array ) : false;
			
		} // End of the Find_user_by_id Method
		
		public static function find_by_show_id( $id )
		{
			
			
			$sql      = "SELECT * FROM `" . static::$db_table . "` WHERE `show_id` = :showid ";
			$params   = [];
			$params[] = [ ':showid' , $id , 'int' ];
			
			$item_array = static::find_by_query( $sql , $params );
			
			return ( ! empty( $item_array ) ) ? $item_array : false;
			
		} // End of the Find_user_by_show_id Method
		
		// Get single preference by pref id
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
		
		
		// Search the Database
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
		
		private function has_property( $propName )
		{
			
			$classProperty = get_object_vars( $this );
			
			return array_key_exists( $propName , $classProperty );
		}
		
		private static function instantiation( $data )
		{
			
			$calledClass = get_called_class();
			
			
			$newInstants = new $calledClass;
			/*echo "<pre>";
			print_r($newInstants);
			echo "</pre>";*/
			foreach ( $data as $propName => $propVal )
			{
				
				if ( property_exists( $newInstants , $propName ) )
				{
					$newInstants->$propName = $propVal;
				}
			}
			
			return $newInstants;
		}
		
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
		
		// Auto choose Create or Update Method
		public function save()
		{
			
			return isset( $this->id ) ? $this->update() : $this->create();
			
		} // End of the Save Method
		
		public function create()
		{
			
			global $pdo;
			
			$properties = $this->get_property();
			
			$sortedProps = [];
			foreach ( $properties as $key => $value )
			{
				if ( ! empty( $value ) )
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
		
		public function update()
		{
			
			global $pdo;
			
			$properties = $this->get_property();
			
			$properties_pairs = array();
			$params           = [];
			foreach ( $properties as $property => $value )
			{
				if ( ! empty( $value ))
				{
					if ($property !== 'id')
					{
						$properties_pairs[] = "`{$property}` = :holder{$property}";
					}
					$params[]           = [ ':holder' . $property , $value , '' ];
				}
			}
			
			$sql = "UPDATE `" . static::$db_table . "` SET ";
			$sql .= implode( ", " , $properties_pairs ) . " ";
			$sql .= "WHERE `id` = :holderid LIMIT 1";
	
			$pdo->query( $sql , $params );
			
			
			return ( $pdo->rowsEffected() >= 1 ) ? true : false;
			
		}
		
		public function updateByColString($arrayOfColAndString){
			global $pdo;
			
			$properties =   $this->get_property();
			
			$properties_pairs   =   array();
			$params = [];
		
			foreach ( $properties as $property => $value ) {
				if($property !== 'pref_section' && $property !== 'pref_key')
				{
					$properties_pairs[] = "`{$property}` = :holder{$property}";
				}
				$params[] = [':holder'.$property, $value, ''];
			
			}
			
			$theClause =[];
			foreach ($arrayOfColAndString as $key => $value){
				$theClause[] = "`{$key}` = :holder{$key}";
			}
			
			
			$sql        =   "UPDATE `" . static::$db_table . "` SET ";
			$sql        .=  implode(", ", $properties_pairs ) . " ";
			$sql        .=  "WHERE ";
			$sql        .=  implode(' AND ', $theClause);
			$sql        .=  " LIMIT 1";
			
			
//			echo "<pre>";
//			print_r($sql);
//			print_r($params);
//			echo "</pre>";
			$pdo->query($sql,$params);
			
			
			return ( $pdo->rowsEffected()>= 1 ) ? true : false;
			
		} // End of Update Method
		
		public function updateByColInteger($column, $string){
			global $pdo;
			
			$properties =   $this->get_property();
			
			$properties_pairs   =   array();
			$params = [];
			$params[] = [':holderstring', $string, '' ];
			$params[] = [':holdercolumn', $column, '' ];
			foreach ( $properties as $property => $value ) {
				
				$properties_pairs[] =   "`{$property}` = :holder{$property}";
				$params[] = [':holder'.$property, $value, ''];
			}
			
			$sql        =   "UPDATE `" . static::$db_table . "` SET ";
			$sql        .=  implode(", ", $properties_pairs ) . " ";
			$sql        .=  "WHERE `:holdercolumn` = :holderstring LIMIT 1";
			
			$pdo->query($sql, $params);
			
			
			return ($pdo->rowsEffected() >= 1 ) ? true : false;
			
		} // End of Update Method
		
		public function delete(){
			global $pdo;
			
			
			$params = [];
			$params[] = [':holderid', $this->id, 'int'];
			
			$sql    =   "DELETE FROM `" . static::$db_table . "` WHERE id = :holderid LIMIT 1";
		
			
			$pdo->query($sql,$params);
			
			return ($pdo->rowsEffected() >= 1 ) ? true : false;
			
		} // End of Delete Method
		
		public function deleteByColString($arrayOfColAndString){
			global $pdo;
			
			$theArray = [];
			$params = [];
			foreach ( $arrayOfColAndString as $key => $value ) {
				$theArray[] = "`{$key}` = :holder{$key}";
				$params[] = [':holder'.$key, $value, ''];
			}
			
			$sql    =   "DELETE FROM `" . static::$db_table . "` WHERE ";
			$sql    .=   implode(' AND ', $theArray);
			$sql    .=  " LIMIT 1";
			
			$pdo->query($sql);
			
			return ($pdo->rowsEffected() >= 1 ) ? true : false;
			
		} // End of Delete Method
		
		public static function count_all()
		{
			
			global $pdo;
			
			$sql = "SELECT COUNT(*) FROM " . static::$db_table;
			
			$result = $pdo->query( $sql );
			
			return $result->fetchColumn();
			
		}
		
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
		
		public function get_last_insert()
		{
			
			global $pdo;
			
			return ( $pdo->lastInsertedId() ) ? $this->id = $pdo->lastInsertedId() : $this->id;
			
		}
		
		
	}