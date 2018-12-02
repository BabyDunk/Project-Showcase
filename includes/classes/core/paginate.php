<?php
	/**
	 * Created by Chris.
	 * Title: oop
	 * Date: 10/12/2017
	 * Time: 17:30
	 */
	
	namespace Classes\Core;
	
	class Paginate
	{
		
		private static  $instance;
		public  $current_page;
		public  $items_per_page;
		public  $items_total_count;
		
		
		public static function instance()
		{
			if(!self::$instance instanceof self){
				self::$instance = new self;
			}
			return self::$instance;
		}
		
		public function __construct($current_page = 1, $items_per_page = 4, $items_total_count = 0) {
		
			$this->current_page         =   (int)$current_page;
			$this->items_per_page       =   (int)$items_per_page;
			$this->items_total_count    =   (int)$items_total_count;
			
		}
		
		
		public function next_page(){
			
			return $this->current_page + 1;
		
		}
		
		
		public function prev_page() {
		
			return $this->current_page - 1;
		
		}
		
		
		public function page_total() {
			
			return  ceil($this->items_total_count / $this->items_per_page);
			
		}
		
		
		public function has_previous() {
			
			return $this->prev_page() >= 1 ? true : false;
			
		}
		
		
		public function has_next() {
			
			return $this->next_page() <= $this->page_total()  ? true : false;
			
		}
		
		
		public function page_offset() {
		
			return ($this->current_page - 1) * $this->items_per_page;
			
		}
		
	}