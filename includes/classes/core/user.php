<?php
/**
 * Created by Chris.
 * Title: oop
 * Date: 04/12/2017
 * Time: 00:15
 */
	
	namespace Classes\Core;

class User extends Db_object {
	
	private     static  $instance;
	protected   static  $db_table = DB_PREFIX."users";
	protected   static  $db_table_fields = array('username', 'password', 'first_name', 'last_name', 'email', 'filename', 'privilege', 'updated_at', 'created_at');

	public              $id;
	public              $username;
	public              $password;
	public              $first_name;
	public              $last_name;
	public              $email;
	public              $privilege;
	public              $updated_at;
	public              $created_at;


	

	// HANDLING FILE UPLOADS
	public              $filename;
	public              $filetype;
	public              $size;
	public              $tmp_path;
	public              $image_placeholder  =   'http://via.placeholder.com/400x400&text=image';
	public              $upload_path        =    UPLOADED_IMAGES_PATH;
	public              $upload_directory   =    'profile';
	public              $upload_url         =    UPLOADED_IMAGES_PATH_URL;
	
	
	public static function instance()
	{
		if(!self::$instance instanceof self){
			self::$instance = new self;
		}
		return self::$instance;
	}
	
	// Get single user data in a named array
	public static function find_by_username( $username ){
		global $db;
		
		$username =   $db->escape_string( $username );
		
		$item_array   =   static::find_by_query( "SELECT * FROM `" . static::$db_table . "` WHERE `username` = '" . $username . "' LIMIT 1" );
		
		
		return (!empty($item_array)) ? array_shift($item_array) : false;
		
	} // End of the Find_user_by_id Method
	

	// Image path Placeholder switch
	public function image_path_placeholder(){

		return empty($this->filename) ? $this->image_placeholder : $this->picture_url();


	} // End of the Image_path_placeholder Method


	// Image path Placeholder switch for comment
	public function comment_image_path_placeholder(){

		return empty($this->filename) ? $this->image_placeholder : $this->picture_url();


	} // End of the Image_path_placeholder Method


	// No hide image path
	public function picture_path(){

		return $this->upload_path.$this->get_last_insert().DS.$this->upload_directory.DS.$this->filename;

	}
	
	public function picture_url(  )
	{
		
		return  $this->upload_url.$this->get_last_insert().DS.$this->upload_directory.DS.$this->filename;
		
	}


	// file saving
	public function save_user_image() {
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

			$users_dir    =  $this->upload_path . $this->get_last_insert() . DS . $this->upload_directory . DS;

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
				
				$users_dir    =  $this->upload_path . $this->get_last_insert() . DS . $this->upload_directory . DS;


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
	
	
	public function save_user()
	{
		$this->filename = '';
		
		if($this->id) {
			
			if(!empty($this->errors)){
				
				return false;
				
			} else {
				
				$this->filename = self::find_by_id($this->id)->filename;
				
				if($this->update()) {
					
					return true;
				}else {
					
					$this->errors[]     =   "There was a problem updating user";
					return false;
					
				}
			}
			
		} else  {
			
			
			if(!empty($this->errors)){
				
				return false;
				
			} else {
				
				if($this->create()){
					
					return true;
					
				} else {
					
					$this->errors[]     =   "There was a problem creating user";
					return false;
					
				}
			}
		}
		
	}
	
	
	public function insert_user()
	{
		
		if($this->filename){
			
			return ($this->save_user_image()) ? true : false;
			
		} else {
			
			if(isset($this->id)) {
				$this->filename = User::find_by_id( $this->id )->filename;
			}
			
			return ($this->save_user()) ? true : false;
			
		}
		
	}
	
	
	/**
	 * Delete User
	 *
	 * @return bool
	 */
	public function delete_user(){
			// TODO: need to take into account the showcase files and data for the user being deleted
		$files = glob( $this->upload_path . $this->get_last_insert(). DS. $this->upload_directory . DS. '*' );
		if(!empty($files)) {
			foreach ( $files as $file ) {
				unlink( $file );
			}
		}
	
		$showcasefiles = glob( $this->upload_path . $this->get_last_insert(). DS. '*' );
		if(!empty($showcasefiles)) {
			foreach ( $showcasefiles as $file ) {
				unlink( $file );
			}
		}
		
		if(is_dir($this->upload_path . $this->get_last_insert(). DS. $this->upload_directory)) {
			rmdir( $this->upload_path . $this->get_last_insert(). DS. $this->upload_directory );
		}
		
		if ( is_dir( $this->upload_path.$this->get_last_insert(). DS ) ) {
			 rmdir( $this->upload_path.$this->get_last_insert(). DS );
		}
		
		$showcase = new Showcase();
		if(!$showcase->deleteAllOfUser($this->id)){
			$this->errors[] = "Could not delete showcase for this user";
			return false;
		}

		//var_dump($this->delete()); exit;
		if ( $this->delete() ) {
			return true;
		}
		
		return false;
		
	} // End of the delete_user Method
	
	
	public static function isAdmin()
	{
		$user = 0;
		if (Session::instance()->user_id){
			$user = self::find_by_id(Session::instance()->user_id);
		}
		
		if(empty($user)){
			redirect('/');
			Session::set('MESSAGE', 'Sorry you need account to see that page');
			return;
		}
		
		if(!$user->privilege){
			redirect('/sc-panel');
			Session::set('MESSAGE', 'Redirected due to insignificant privilege');
			return;
		}
	}
	
	public static function hasPrivilege(  )
	{
		$user = self::find_by_id(Session::instance()->user_id);
		
		return ($user->privilege) ? true : false;
		
	}


} // End of User class