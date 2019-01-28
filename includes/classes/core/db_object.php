<?php
/**
 * Created by Chris.
 * Title: oop
 * Date: 07/12/2017
 * Time: 03:03
 */
	
	namespace Classes\Core;

class Db_object {
	
	public static $prefix = 'sc_';
	

	// Error handling for file uploads
	public              $errors  =   array();
	public              $upload_errors_array   =   array(

		UPLOAD_ERR_OK           =>  "There is no error",
		UPLOAD_ERR_INI_SIZE     =>  "The uploaded file exceeds the Maximum upload size",
		UPLOAD_ERR_FORM_SIZE    =>  "The uploaded file exceeds the Maximum upload size",
		UPLOAD_ERR_PARTIAL      =>  "The uploaded file was only partially uploaded",
		UPLOAD_ERR_NO_FILE      =>  "No file was uploaded",
		UPLOAD_ERR_NO_TMP_DIR   =>  "Directory mismatch, Try again",
		UPLOAD_ERR_CANT_WRITE   =>  "Failed to write file to disk",
		UPLOAD_ERR_EXTENSION    =>  "A something stopped the file upload"

	);
	
	
	
	

	// This is passing the $_FILEs['upload_files'] as an argument
	public function set_file($file){

		if(empty($file) || !$file || !is_array($file)) {

			$this->errors[]  =   "There was no file uploaded here";
			return false;

		} else if ($file['error'] != 0 ) {

			$this->errors[] =   $this->upload_errors_array[$file['error']];
			return false;

		} else {

			$this->filename =   basename($file['name']);
			$this->tmp_path =   $file['tmp_name'];
			$this->filetype =   $file['type'];
			$this->size     =   $file['size'];

		}

	} // End of the set_file Method


	// Get all users data
	public static function find_all($limit=0, $order=0){

		$limit = !empty($limit) ? " LIMIT $limit " : "";
		
		$isOrder = "";
		if($order === 1){
			$isOrder = " ORDER BY id DESC ";
		}elseif($order === 2){
			$isOrder = " ORDER BY id ASC ";
		}elseif($order === 3){
			$isOrder = " ORDER BY RAND() ";
		}
		
		return static::find_by_query( "SELECT * FROM `" . static::$db_table . "` " .  $isOrder . $limit);

	} // End of the Find_all_users Method


	// Get single user data in a named array
	public static function find_by_id( $id ){
		global $db;

		$id =   $db->escape_string( $id );

		$item_array   =   static::find_by_query( "SELECT * FROM `" . static::$db_table . "` WHERE id = " . $id . " LIMIT 1" );


		return (!empty($item_array)) ? array_shift($item_array) : false;

	} // End of the Find_user_by_id Method
	
	// Get showcase data in a named array
	public static function find_by_show_id( $id ){
		global $db;
		
		$id =   $db->escape_string( $id );
		
		$item_array   =   static::find_by_query( "SELECT * FROM `" . static::$db_table . "` WHERE show_id = '" . $id . "' " );
		
		
		return (!empty($item_array)) ? $item_array : false;
		
	} // End of the Find_user_by_show_id Method


	// Search the Database
	public static function find_by_query( $sql ){
		global $db;

		$result =   $db->query( $sql );

		$the_object_array   =   array();

		while ( $row = mysqli_fetch_array( $result ) ){

			$the_object_array[] = static::instantiation($row);

		}

		return $the_object_array;

	} // End of the Find_the_query Method
	
	// Get single preference by pref id
	public static function find_by_like($arrayOfColAndString=[], $limit=1){
		global $db;
		
		if(empty($arrayOfColAndString)){
			return false;
		}
		
		$theLike = [];
		foreach ($arrayOfColAndString as $key => $value){
			$theLike[] = "`{$key}` LIKE '" . $db->escape_string($value). "'";
		}
		
		$sql   =   "SELECT * FROM `" . static::$db_table . "` WHERE ";
		$sql .= implode(' AND ', $theLike);
		if(!empty($limit)) {
			$sql .= " LIMIT $limit ";
		}

		$item_array = static::find_by_query($sql);
		
		return (!empty($item_array)) ? array_shift($item_array) : false;
		
	} // End of the Find preference by pref id


	// Instantiate the query
	public static function instantiation($the_record){

		$callingClass   =   get_called_class();

		$the_object  =   new $callingClass;

		foreach ( $the_record as $the_attribute => $value ) {

			if($the_object->has_the_attribute($the_attribute)){

				$the_object->$the_attribute = $value;

			}

		}


		return $the_object;

	} // End of Instantiation Method


	// Check if has property
	private function has_the_attribute( $the_attribute ){

		$object_Properties = get_object_vars( $this );


		return array_key_exists( $the_attribute, $object_Properties );

	} // End of Has_the_attribute Method


	// Arrange the property for query
	protected function properties(){

		$properties =   array();

		foreach ( static::$db_table_fields as $db_table_field ) {

			if(property_exists($this, $db_table_field)){

				$properties[$db_table_field]   =   $this->$db_table_field;

			}

		}

		return $properties;

	} // End Properties Method


	// Cleaning Strings Method
	protected function clean_properties(){
		global $db;

		$clean_properties   =   array();

		foreach ( $this->properties() as $property => $value ) {

			$clean_properties[$property] =  $db->escape_string($value);

		}

		return $clean_properties;

	} // End of the Clean_properties Method


	// Auto choose Create or Update Method
	public function save(){

		return isset($this->id) ? $this->update() : $this->create();

	} // End of the Save Method


	// Create new User
	public function create(){
		global $db;

		$properties =   $this->clean_properties();

		$sql        =   "INSERT INTO `" . static::$db_table . "` (" . '`' . implode("`, `", array_keys($properties)) . '`' . ") ";
		$sql        .=  "VALUES ('" . implode("','", array_values($properties)) . "')";

		if($db->query( $sql )) {

			$this->id   =   $db->the_insert_id();

			return true;

		}else{

			return false;

		}

	} // End of Create Method


	// Update User
	public function update(){
		global $db;

		$properties =   $this->clean_properties();

		$properties_pairs   =   array();

		foreach ( $properties as $property => $value ) {

			$properties_pairs[] =   "`{$property}` = '{$value}'";

		}

		$sql        =   "UPDATE `" . static::$db_table . "` SET ";
		$sql        .=  implode(", ", $properties_pairs ) . " ";
		$sql        .=  "WHERE `id` = "     . $db->escape_string($this->id) . " LIMIT 1";

		$db->query($sql);


		return (mysqli_affected_rows($db->connection) == 1 ) ? true : false;

	} // End of Update Method
	
	/**
	 *  Update by column & string
	 *
	 * @return bool
	 */
	public function updateByColString($arrayOfColAndString){
		global $db;
		
		$properties =   $this->clean_properties();
		$properties_pairs   =   array();
		foreach ( $properties as $property => $value ) {
			$properties_pairs[] =   "`{$property}` = '{$value}'";
		}
		
		$theArray =[];
		foreach ($arrayOfColAndString as $key => $value){
			$theArray[] = "`{$key}` = '" . $db->escape_string($value) . "'";
		}
		
		
		$sql        =   "UPDATE `" . static::$db_table . "` SET ";
		$sql        .=  implode(", ", $properties_pairs ) . " ";
		$sql        .=  "WHERE ";
		$sql        .=  implode(' AND ', $theArray);
		$sql        .=  " LIMIT 1";
		
		$db->query($sql);
		
		
		return (mysqli_affected_rows($db->connection) == 1 ) ? true : false;
		
	} // End of Update Method
	
	
	 /**
	 *  Update by column & integer
	 *
	 * @return bool
	 */
	public function updateByColInteger($column, $string){
		global $db;
		
		$properties =   $this->clean_properties();
		
		$properties_pairs   =   array();
		
		foreach ( $properties as $property => $value ) {
			
			$properties_pairs[] =   "`{$property}` = '{$value}'";
			
		}
		
		$sql        =   "UPDATE `" . static::$db_table . "` SET ";
		$sql        .=  implode(", ", $properties_pairs ) . " ";
		$sql        .=  "WHERE `{$column}` = "     . $db->escape_string($string) . " LIMIT 1";
		
		$db->query($sql);
		
		
		return (mysqli_affected_rows($db->connection) == 1 ) ? true : false;
		
	} // End of Update Method

	// Delete User
	public function delete(){
		global $db;

		$sql    =   "DELETE FROM `" . static::$db_table . "` WHERE id = " . $db->escape_string($this->id);
		$sql    .=  " LIMIT 1";

		$db->query($sql);
		
		return (mysqli_affected_rows($db->connection) == 1 ) ? true : false;

	} // End of Delete Method
	
	// Delete User
	public function deleteByColString($arrayOfColAndString){
		global $db;
		
		$theArray = [];
		foreach ( $arrayOfColAndString as $key => $value ) {
			$theArray[] = "`{$key}` = '" . $db->escape_string($value)."'";
		}

		$sql    =   "DELETE FROM `" . static::$db_table . "` WHERE ";
		$sql    .=   implode(' AND ', $theArray);
		$sql    .=  " LIMIT 1";

		$db->query($sql);
		
		return (mysqli_affected_rows($db->connection) == 1 ) ? true : false;

	} // End of Delete Method
	
	
	/**
	 * Count all rows in a given table
	 *
	 * @return mixed
	 */
	public static function count_all() {
		global $db;
		
		$sql    =   "SELECT COUNT(*) FROM " . static::$db_table;
		
		$result_set =   $db->query($sql);
		
		$row =  mysqli_fetch_array($result_set);
		
		return array_shift($row);
	}
	
	/**
	 * Count all row by condition in a given table
	 *
	 * @param array $conditions
	 *
	 * @return mixed
	 */
	public static function count_by_condition($conditions=[]) {
		global $db;
		
		$loadCond = '';
		if(!empty($conditions)){
			$arrCount = count($conditions);
			$loopCount = 0;
			$loadCond = ' WHERE ';
			foreach ( $conditions as $key => $condition ) {
				$loadCond .= $key . " = '" . $condition ."'";
				$loopCount++;
				if($loopCount < $arrCount){
					$loadCond .= ' AND ';
				}
			}
		}
		$sql    =   "SELECT COUNT(*) FROM " . static::$db_table . $loadCond;
		
		$result_set =   $db->query($sql);
		
		$row =  mysqli_fetch_array($result_set);
		
		return array_shift($row);
	}
	
	/**
	 * Get last users insert
	 *
	 * @return mixed
	 */
	public function get_last_insert() {
		global $db;
		
		return ($db->the_insert_id()) ? $this->id = $db->the_insert_id() : $this->id;
		
		
	} // End Of the get_last_insert_user Method




} // End of Db_object class