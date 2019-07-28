<?php
	/**
	 * Created by Chris.
	 * Title: oop
	 * Date: 10/12/2017
	 * Time: 17:30
	 */
	
	namespace Classes\Core;
	
	/**
	 * Class Paginate
	 *
	 * @package Classes\Core
	 */
	class Paginate
	{
		
		
		
		private static $instance;
		public $current_page;
		public $items_per_page;
		public $items_total_count;
		
		
		/**
		 * Creates static instance
		 *
		 * @return \Classes\Core\Paginate
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
		 * Paginate constructor.
		 *
		 * @param int $current_page
		 * @param int $items_per_page
		 * @param int $items_total_count
		 */
		public function __construct( $current_page = 1 , $items_per_page = 4 , $items_total_count = 0 )
		{
			
			$this->current_page      = (int) $current_page;
			$this->items_per_page    = (int) $items_per_page;
			$this->items_total_count = (int) $items_total_count;
			
		}
		
		
		/**
		 * Moves forward one page
		 *
		 * @return int
		 */
		public function next_page()
		{
			
			return $this->current_page + 1;
			
		}
		
		
		/**
		 * Moves back one page
		 *
		 * @return int
		 */
		public function prev_page()
		{
			
			return $this->current_page - 1;
			
		}
		
		
		/**
		 * Get total amount of pages
		 *
		 * @return float
		 */
		public function page_total()
		{
			
			return ceil( $this->items_total_count / $this->items_per_page );
			
		}
		
		
		/**
		 * Check if has a previous page
		 *
		 * @return bool
		 */
		public function has_previous()
		{
			
			return $this->prev_page() >= 1 ? true : false;
			
		}
		
		
		/**
		 * Checks if has a next page
		 *
		 * @return bool
		 */
		public function has_next()
		{
			
			return $this->next_page() <= $this->page_total() ? true : false;
			
		}
		
		
		/**
		 * Sets the page offset depending on items per page
		 *
		 * @return float|int
		 */
		public function page_offset()
		{
			
			return ( $this->current_page - 1 ) * $this->items_per_page;
			
		}
		
	}