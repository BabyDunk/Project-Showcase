<?php
	/**
	 * Created by Chris.
	 * Title: oop
	 * Date: 04/12/2017
	 * Time: 00:15
	 */
	
	namespace Classes\Core;
	
	/**
	 * Class Promotions
	 *
	 * @package Classes\Core
	 */
	class Promotions extends PdoObject
	{
		
		
		
		private static $instance;
		protected static $db_table = DB_PREFIX . "promotions";
		protected static $db_table_fields = array(
			'id' ,
			'promo_code' ,
			'value' ,
			'conversion' ,
			'valid' ,
			'valid_email' ,
			'valid_for_items' ,
			'start_date' ,
			'end_date' ,
			'filename' ,
			'updated_at' ,
			'created_at'
		);
		
		public $id;
		public $promo_code;
		public $value;
		public $conversion;
		public $valid;
		public $valid_email;
		public $valid_for_items;
		public $start_date;
		public $end_date;
		public $updated_at;
		public $created_at;
		
		
		// HANDLING FILE UPLOADS
		public $filename;
		public $filetype;
		public $size;
		public $tmp_path;
		public $image_placeholder = 'http://via.placeholder.com/400x400/8500f2/ffffff/&text=Promotion+Code';
		public $upload_path = UPLOADED_IMAGES_PATH;
		public $upload_directory = 'promotions';
		public $upload_url = UPLOADED_IMAGES_PATH_URL;
		
		
		/**
		 * Creates statis instance
		 *
		 * @return \Classes\Core\Promotions
		 */
		public static function instance()
		{
			
			if ( ! self::$instance instanceof self )
			{
				self::$instance = new self;
			}
			
			return self::$instance;
		}
		
		// Get single promo_code data in a named array
		
		/**
		 * @param $promo_code
		 *
		 * @return bool|mixed
		 */
		public static function find_by_promo_code( $promo_code )
		{
			
			global $pdo;
			
			$params = [];
			$params[] = [ ':promo_code' , $promo_code , 'str' ];
			
			$sql = "SELECT * FROM `" . static::$db_table . "` WHERE `promo_code` = :promo_code LIMIT 1";
			
			$item_array = static::find_by_query( $sql , $params );
			
			
			return ( ! empty( $item_array ) ) ? array_shift( $item_array ) : false;
			
		} // End of the Find_promo_code_by_id Method
		
		
		/**
		 *  Image path Placeholder switch
		 *
		 * @return string
		 */
		public function get_picture()
		{
			
			return empty( $this->filename ) ? $this->image_placeholder : $this->picture_url();
			
			
		} // End of the Image_path_placeholder Method
		
		
		/**
		 * Image path
		 *
		 * @return string
		 */
		public function picture_path()
		{
			
			return $this->upload_path . $this->upload_directory . DS . $this->get_last_insert() . DS . $this->filename;
			
		}
		
		/**
		 * Image url
		 *
		 * @return string
		 */
		public function picture_url()
		{
			
			return $this->upload_url . $this->upload_directory . DS . $this->get_last_insert() . DS . $this->filename;
			
		}
		
		
		/**
		 * Save Promotion with image
		 *
		 * @return bool
		 */
		public function save_promo_code_image()
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
				
				$promo_codes_dir = $this->upload_path . $this->upload_directory . DS . $this->get_last_insert() . DS;
				
				if ( is_dir( $promo_codes_dir ) )
				{
					
					$target_path = $this->picture_path();
					
				}
				else
				{
					
					mkdir( $promo_codes_dir , 0755 , true );
					$target_path = $this->picture_path();
					
				}
				
				
				if ( file_exists( $target_path ) )
				{
					
					$this->removePromoImage();
					
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
					
					$promo_codes_dir = $this->upload_path . $this->upload_directory . DS . $this->get_last_insert() . DS;
					
					
					if ( file_exists( $promo_codes_dir ) )
					{
						
						$target_path = $this->picture_path();
						
					}
					else
					{
						
						mkdir( $promo_codes_dir , 0755 , true );
						$target_path = $this->picture_path();
						
					}
					
					if ( file_exists( $target_path ) )
					{
						
						$this->removePromoImage();
						
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
		 * Save Promotion
		 *
		 * @return bool
		 */
		public function save_promo_code()
		{
			
			$this->filename = '';;
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
						
						$this->errors[] = "There was a problem updating promo_code";
						
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
						
						return true;
						
					}
					else
					{
						
						$this->errors[] = "There was a problem creating promo_code";
						
						return false;
						
					}
				}
			}
			
		}
		
		
		/**
		 * Auto save Promotion whether it has image or not
		 *
		 * @return bool
		 */
		public function insert_promo_code()
		{
			
			if ( $this->filename )
			{
				
				return ( $this->save_promo_code_image() ) ? true : false;
				
			}
			else
			{
				
				return ( $this->save_promo_code() ) ? true : false;
				
			}
			
		}
		
		
		/**
		 * Remove promo images
		 *
		 * @return bool
		 */
		public function removePromoImage()
		{
			
			$files = glob( $this->upload_path . $this->upload_directory . DS . $this->get_last_insert() . DS . '*' );
			if ( ! empty( $files ) )
			{
				foreach ( $files as $file )
				{
					if ( ! unlink( $file ) )
					{
						return false;
					}
				}
				
				return true;
			}
			
			return false;
		}
		
		/**
		 * Delete promotion file and database records
		 *
		 * @return bool
		 */
		public function delete_promo_code()
		{
			
			if ( $this->removePromoImage() )
			{
				if ( is_dir( $this->upload_path . $this->upload_directory . DS . $this->get_last_insert() ) )
				{
					
					if ( rmdir( $this->upload_path . $this->upload_directory . DS . $this->get_last_insert() ) )
					{
						if ( $this->delete() )
						{
							return true;
						}
					}
					else
					{
						$this->errors[] = "Could not remove directory";
					}
				}
			}
			
			return false;
			
		} // End of the delete_promo_code Method
		
		/**
		 * Calculate promo deductions
		 *
		 * @param $cartItem
		 * @param $quantity
		 * @param $email_link
		 *
		 * @return bool|float|int
		 */
		public function cal_promo( $cartItem, $quantity, $email_link  )
		{
			
			
			/**
			 * Kill process if price is empty
			 */
			if(empty($cartItem))
			{
				return false;
			}
			
			/**
			 * Kill process if quantity is empty
			 */
			if(empty($quantity)){
				return false;
			}
			
			/**
			 * Deduction option 2 calculations
			 */
			$deductHolder = $this->value*$quantity;
			$deductType2Calculation =  ( $cartItem->price * $quantity ) - $deductHolder;
			
			/**
			 * Deduction option 3 calculation
			 */
			$percentHolder = ( ( $cartItem->price * $quantity ) / 100 ) * ( $this->value / 100 );
			$deductType3Calculation =  ( $cartItem->price * $quantity ) - $percentHolder;
			
			/**
			 * Get allowed promotion items
			 */
			$allowed_items = ($this->valid_for_items) ? unserialize($this->valid_for_items) : null;
			
			/**
			 * Kill process if promo isn't valid
			 */
			if(empty($this->valid))
			{
				return false;
			}
			
			/**
			 * Kill process if promo hasn't started yet
			 */
			if(date("Y-m-d H:i:s") < $this->start_date){
				return false;
			}
			
			/**
			 * Kill process if promo has ended
			 */
			if(date("Y-m-d H:i:s") > $this->end_date){
				return false;
			}
			
			/**
			 * Kill process if email doesnt match
			 */
			if($this->valid_email){
				
				if($this->valid_email !== $email_link){
					return false;
				}
				
			}
			
			/**
			 * Kill process if item isn't in allowed items
			 */
			if(is_array($allowed_items)){
				if(!in_array($cartItem->id, $allowed_items)){
					return false;
				}
				
			}
			
			/**
			 * Make the promo deductions or set item value for later deductions
			 */
			switch($this->conversion){
				case 1:
					
					return ( $cartItem->price * $quantity );
					break;
				case 2:
					
					return $deductType2Calculation;
					break;
				case 3:
					
					return $deductType3Calculation;
					break;
				default:
					return false;
					break;
			}
			
		}
		
		
	} // End of User class