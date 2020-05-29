<?php
	/**
	 * Created by Chris.
	 * Title: oop
	 * Date: 07/12/2017
	 * Time: 02:52
	 */
	
	namespace Classes\Core;
	
	/**
	 * Class Showcase
	 *
	 * @package Classes\Core
	 */
	class Showcase extends PdoObject
	{
		
		
		
		private static $instance;
		
		protected static $db_table = DB_PREFIX . "showcases";
		protected static $db_table_fields = array(
			'id' ,
			'show_id' ,
			'user_id' ,
			'title' ,
			'subtitle' ,
			'description1' ,
			'showcasePayment' ,
			'three_notice_block' ,
			'bg_colorselector' ,
			'fg_colorselector' ,
			'price' ,
			'job_deposit' ,
			'job_duration' ,
			'filename' ,
			'front_demo_link' ,
			'back_demo_user' ,
			'back_demo_pass' ,
			'back_demo_link' ,
			'updated_at' ,
			'created_at'
		);
		
		public $id;
		public $show_id;
		public $user_id;
		public $title;
		public $subtitle;
		public $description1;
		public $showcasePayment;
		public $three_notice_block;
		public $bg_colorselector;
		public $fg_colorselector;
		public $front_demo_link;
		public $back_demo_link;
		public $back_demo_user;
		public $back_demo_pass;
		public $price;
		public $job_deposit;
		public $job_duration;
		public $updated_at;
		public $created_at;
		
		// HANDLING FILE UPLOADS
		public $filename;
		public $tmp_path;
		public $image_placeholder = '//via.placeholder.com/1200x600&text=No Image';
		public $upload_path = UPLOADED_IMAGES_PATH;
		public $upload_directory = 'showcases';
		public $upload_url = UPLOADED_IMAGES_PATH_URL;
		
		
		/**
		 * Creates static instance
		 *
		 * @return \Classes\Core\Showcase
		 */
		public static function instance()
		{
			
			if ( ! self::$instance instanceof self )
			{
				self::$instance = new self;
			}
			
			return self::$instance;
		}
		
		
		/**
		 * Finds all featured showcase items
		 *
		 * @param int $limit
		 * @param string $order
		 *
		 * @return array|bool
		 */
		public static function find_all_for_feature( $limit = 0 , $order = 'desc' )
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
			
			
			$sql = "SELECT * FROM `" . static::$db_table . "` WHERE `filename` IS NOT NULL AND `title` IS NOT NULL " .
			       "AND `description1` IS NOT NULL AND `fg_colorselector` IS NOT NULL AND `bg_colorselector` IS NOT NULL " . $isOrder . $limit;
			
			$item_array = static::find_by_query( $sql );
			
			
			return ( ! empty( $item_array ) ) ? $item_array : false;
			
		} // End of the Find_user_by_id Method
		
		/**
		 * Showcase Image directory path
		 *
		 * @return string
		 */
		public function picture_dir()
		{
			
			return $this->upload_path . $this->user_id . DS . $this->upload_directory . DS . $this->get_last_insert() . DS;
			
		}
		
		
		/**
		 * Showcase image path
		 *
		 * @return string
		 */
		public function picture_path()
		{
			
			return $this->upload_path . $this->user_id . DS . $this->upload_directory . DS . $this->get_last_insert() . DS . $this->filename;
			
		}
		
		/**
		 * Showcase image url
		 *
		 * @return string
		 */
		public function picture_url()
		{
			
			return $this->upload_url . $this->user_id . DS . $this->upload_directory . DS . $this->get_last_insert() . DS . $this->filename;
			
		}
		
		/**
		 * If image is present returns image url else a placeholder
		 *
		 * @return string
		 */
		public function get_picture()
		{
			
			return ! empty( $this->filename ) ? $this->picture_url() : $this->image_placeholder;
		}
		
		
		/**
		 * Save showcase with image present
		 *
		 * @return bool
		 */
		public function save_withImage()
		{
			
			global $pdo;
			
			
			// TODO: make method more efficient, remove image when new images is uploaded, allow image with the same filename to replace already loaded image
			if ( $this->id )
			{
				
				if ( ! empty( $this->errors ) )
				{
					
					return false;
					
				}
				
				if ( empty( $this->filename || empty( $this->tmp_path ) ) )
				{
					
					$this->errors[] = "The file was not available";
					
					return false;
					
				}
				
				$users_dir = $this->picture_dir();
				
				if ( is_dir( $users_dir ) )
				{
					
					$target_path = $this->picture_path();
					
				}
				else
				{
					
					mkdir( $users_dir , 0755 , true );
					$target_path = $this->picture_path();
					
				}
				
				
				if ( file_exists( $target_path ) )
				{
					
					$this->errors[] = "The file {$this->filename} already exists";
					
					return false;
					
				}
				
				if ( move_uploaded_file( $this->tmp_path , $target_path ) )
				{
					
					if ( $this->update() )
					{
						
						unset( $this->tmp_path );
						
						return true;
						
					}
					
				}
				else
				{
					
					$this->errors[] = "The file most likely does not have permission";
					
					return false;
					
				}
				
				
			}
			else
			{
				
				if ( ! empty( $this->errors ) )
				{
					
					return false;
					
				}
				
				if ( empty( $this->filename || empty( $this->tmp_path ) ) )
				{
					
					$this->errors[] = "The file was not available";
					
					return false;
					
				}
				
				
				if ( $this->create() )
				{
					
					$users_dir = $this->picture_dir();
					
					
					if ( file_exists( $users_dir ) )
					{
						
						$target_path = $this->picture_path();
						
					}
					else
					{
						
						mkdir( $users_dir , 0755 , true );
						$target_path = $this->picture_path();
						
					}
					
					if ( file_exists( $target_path ) )
					{
						
						$this->errors[] = "The file {$this->filename} already exists";
						$this->id       = $pdo->lastInsertedId();
						$this->delete();
						
						return false;
						
					}
					
					if ( move_uploaded_file( $this->tmp_path , $target_path ) )
					{
						
						unset( $this->tmp_path );
						
						return true;
						
					}
					else
					{
						
						$this->errors[] = "There was a problem transferring image to disk";
						
						return false;
						
					}
					
				}
				else
				{
					
					$this->errors[] = "The file most likely does not have permission";
					
					return false;
					
				}
				
				
			}
			
		} // End of the Save Method
		
		/**
		 * Saves showcase
		 *
		 * @return bool
		 */
		public function save_withoutImage()
		{
			
			if ( $this->id )
			{
				
				if ( ! empty( $this->errors ) )
				{
					
					return false;
					
				}
				else
				{
					
					$this->filename = self::find_by_id( $this->id )->filename;
					
					if ( $this->update() )
					{
						
						return true;
						
					}
					else
					{
						
						$this->errors[] = "The showcase update could not be set";
						
						return false;
					}
				}
				
			}
			else
			{
				
				if ( ! empty( $this->errors ) )
				{
					
					return false;
					
				}
				else
				{
					
					if ( $this->create() )
					{
						
						$this->errors[] = "The Showcase was created successfully";
						
						return true;
						
					}
					else
					{
						
						$this->errors[] = "The showcase could not be inserted";
						
						return false;
						
					}
				}
			}
			
		} // End of the Save without image Method
		
		/**
		 * Auto Save Showcase whether there is an image present or not
		 *
		 * @return bool|void
		 */
		public function save()
		{
			
			if ( $this->filename )
			{
				
				if ( $this->save_withImage() )
				{
					return true;
				}
				
				
			}
			else
			{
				
				if ( $this->save_withoutImage() )
				{
					return true;
				}
				
			}
			
			return false;
			
		} // End of save method
		

		/**
		 * Completely delete showcase with files
		 *
		 * @return bool
		 */
		public function delete_showcase()
		{
			
			// TODO: possibly need to add checks for file removal
			if ( $this->filename )
			{
				$files = glob( $this->picture_dir() . '*' );
				if ( ! empty( $files ) )
				{
					foreach ( glob( $this->picture_dir() . '*' ) as $filename )
					{
						unlink( $filename );
					}
				}
			}
			
			if ( $this->delete() )
			{
				
				return true;
			}
			
			return false;
			
		} // End of the Delete_showcase Method
		
		
	} // End of Showcase class