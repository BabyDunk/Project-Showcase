<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: oop
	 * Date: 26/05/2018
	 * Time: 01:06
	 */
	
	namespace Classes;
	
	use AltoRouter;
	
	class RouteDispatcher
	{
		public $match;
		public $controller;
		public $method;
		
		function __construct(AltoRouter $router)
		{
			
			$this->match = $router->match();
			
			if ( $this->match ) {
				
				list( $this->controller , $this->method ) = explode( '@' , $this->match['target'] );
				
				if ( is_callable( array( new $this->controller , $this->method ) ) ) {
					call_user_func_array(
						array( new $this->controller , $this->method ) ,
						array( $this->match[ 'params' ] )
					);
				} else {
					
					echo "The method {$this->method} isn\'t define in controller {$this->controller}";
					
				}
			} else {
				
				header($_SERVER['SERVER_PROTOCOL'] . ' 404 not found');
				
				view('errors/404');
				
			}
		}
		
	}