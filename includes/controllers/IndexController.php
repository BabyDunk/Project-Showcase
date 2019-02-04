<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: oop
	 * Date: 26/05/2018
	 * Time: 10:12
	 */
	
	namespace Controllers;
	
	
	use Classes\Core\Session;
	
	class IndexController extends BaseController
	{
		
		function __construct()
		{
		
		}
		
		public function show()
		{
			Session::instance()->visitor_count();

			$theUser = isset(Session::instance()->user_id) ? Session::instance()->user_id : '';
			
			view('home', ['user_id' => $theUser]);
			
		}
		
	}