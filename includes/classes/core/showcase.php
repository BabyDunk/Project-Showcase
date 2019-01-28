<?php
/**
 * Created by Chris.
 * Title: oop
 * Date: 07/12/2017
 * Time: 02:52
 */
	
	namespace Classes\Core;

class Showcase extends Db_object {
	
	private     static  $instance;

	protected static    $db_table = DB_PREFIX."showcases";
	protected static    $db_table_fields = array('id', 'show_id', 'user_id', 'title', 'subtitle', 'description1', 'showcasePayment', 'three_notice_block', 'bg_colorselector', 'fg_colorselector', 'job_deposit', 'job_duration', 'filename', 'front_demo_link', 'back_demo_user', 'back_demo_pass', 'back_demo_link', 'updated_at', 'created_at');

	public              $id;
	public              $show_id;
	public              $user_id;
	public              $title;
	public              $subtitle;
	public              $description1;
	public              $showcasePayment;
	public              $three_notice_block;
	public              $bg_colorselector;
	public              $fg_colorselector;
	public              $front_demo_link;
	public              $back_demo_link;
	public              $back_demo_user;
	public              $back_demo_pass;
	public              $job_deposit;
	public              $job_duration;
	public              $updated_at;
	public              $created_at;

	// HANDLING FILE UPLOADS
	public              $filename;
	public              $tmp_path;
	public              $image_placeholder  =   'http://via.placeholder.com/1200x600&text=No Image';
	public              $upload_path        =    UPLOADED_IMAGES_PATH;
	public              $upload_directory   =    'showcases';
	public              $upload_url         =    UPLOADED_IMAGES_PATH_URL;
	
	
	public static function instance()
	{
		if(!self::$instance instanceof self){
			self::$instance = new self;
		}
		return self::$instance;
	}
	
	/*
	 * Get single user data in a named array
	 *
	 * */
	public static function find_by_user_id($id, $limit=0, $order='desc'){
		global $db;
		
		$limit = !empty($limit) ? " LIMIT $limit " : "";
		
		$isOrder = "";
		if($order === 'desc'){
			$isOrder = " ORDER BY id DESC ";
		}elseif($order === 'asc'){
			$isOrder = " ORDER BY id ASC ";
		}elseif($order === 'rand'){
			$isOrder = " ORDER BY RAND() ";
		}
		
		$id =   $db->escape_string( $id );
		
		$item_array   =   static::find_by_query( "SELECT * FROM `" . static::$db_table . "` WHERE user_id = " . $id  .  $isOrder . $limit);
		
		
		return (!empty($item_array)) ? $item_array : false;
		
	} // End of the Find_user_by_id Method
	
	public function picture_dir(  )
	{
		return  $this->upload_path.$this->user_id.DS.$this->upload_directory.DS.$this->get_last_insert().DS;
		
	}
	
	// No hide image path
	public function picture_path(){
		
		return $this->upload_path.$this->user_id.DS.$this->upload_directory.DS.$this->get_last_insert().DS.$this->filename;
		
	}
	
	public function picture_url(  )
	{
		return $this->upload_url . $this->user_id.DS.$this->upload_directory.DS.$this->get_last_insert().DS.$this->filename;
		
	}
	
	public function get_picture(  )
	{
		
		return  !empty($this->filename) ? $this->picture_url() : $this->image_placeholder;
	}
	
	// file saving
	public function save_withImage() {
		global $db;
		
		
		// TODO: make method more efficient, remove image when new images is uploaded, allow image with the same filename to replace already loaded image
		if($this->id) {
			
			if(!empty($this->errors)){
				
				return false;
				
			}
			
			if(empty($this->filename || empty($this->tmp_path))){
				
				$this->errors[] =   "The file was not available";
				return false;
				
			}
			
			$users_dir    =  $this->picture_dir();
			
			if(is_dir($users_dir)){
				
				$target_path    =    $this->picture_path();
				
			} else {
				
				mkdir($users_dir, 0755, true );
				$target_path    =   $this->picture_path();
				
			}
			
			
			
			if(file_exists($target_path)) {
				
				$this->errors[] =   "The file {$this->filename} already exists";
				return false;
				
			}
			
			if(move_uploaded_file($this->tmp_path, $target_path)){
				
				if($this->update()){
					
					unset($this->tmp_path);
					return true;
					
				}
				
			} else {
				
				$this->errors[] =   "The file most likely does not have permission";
				return false;
				
			}
			
			
			
		} else  {
			
			if(!empty($this->errors)){
				
				return false;
				
			}
			
			if(empty($this->filename || empty($this->tmp_path))){
				
				$this->errors[] =   "The file was not available";
				return false;
				
			}
			
			
			if($this->create()){
				
				$users_dir    =  $this->picture_dir();
				
				
				if(file_exists($users_dir)){
					
					$target_path    =   $this->picture_path();
					
				} else {
					
					mkdir($users_dir, 0755, true );
					$target_path    =   $this->picture_path();
					
				}
				
				if(file_exists($target_path)) {
					
					$this->errors[] =   "The file {$this->filename} already exists";
					$this->id = $db->the_insert_id();
					$this->delete();
					return false;
					
				}
				
				if(move_uploaded_file($this->tmp_path, $target_path)) {
					
					unset( $this->tmp_path );
					return true;
					
				} else {
					
					$this->errors[]     =   "There was a problem transferring image to disk";
					return false;
					
				}
				
			} else {
				
				$this->errors[] =   "The file most likely does not have permission";
				return false;
				
			}
			
			
		}
		
	} // End of the Save Method
	
	public function save_withoutImage() {
		
		if($this->id) {
			
			if(!empty($this->errors)){
				
				return false;
				
			} else {
				
				$this->filename = self::find_by_id($this->id)->filename;
				
				if($this->update()){
					
					return true;
					
				} else {
					
					$this->errors[] =   "The showcase update could not be set";
					return false;
				}
			}
			
		} else  {
			
			if(!empty($this->errors)){
				
				return false;
				
			} else {
				
				if($this->create()){
					
					$this->errors[] = "The Showcase was created successfully";
					return true;
					
				} else {
					
					$this->errors[] =   "The showcase could not be inserted";
					return false;
					
				}
			}
		}
		
	} // End of the Save without image Method
	
	/**
	 * Save Showcase
	 *
	 * @return bool|void
	 */
	public function save(  )
	{
		if($this->filename){
			
			if($this->save_withImage()){
				return true;
			}
			return false;
			
		}else{
			
			if($this->save_withoutImage()){
				return true;
			}
			return false;
		}
		
	} // End of save method
	
	public function deleteAllOfUser($id){
		global $db;
		
		$sql    =   "DELETE FROM `" . static::$db_table . "` WHERE user_id = " . $db->escape_string($id);
		
		$db->query($sql);
		
		return (mysqli_affected_rows($db->connection) >= 1 ) ? true : false;
		
	} // End of Delete Method

	// Delete Showcase
	public function delete_showcase(){
		// TODO: possibly need to add checks for file removal
		if ( $this->filename ) {
			$files = glob( $this->picture_dir() . '*' );
			if(!empty($files)) {
				foreach ( glob( $this->picture_dir() . '*' ) as $filename ) {
					unlink( $filename );
				}
			}
		}
		
		if($this->delete()) {
			
			return true;
		}
		
		return false;

	} // End of the Delete_showcase Method




} // End of Showcase class