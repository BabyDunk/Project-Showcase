<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: showcase_app
	 * Date: 20/06/2018
	 * Time: 21:02
	 */
	
	namespace Controllers;
	
	
	use Classes\Core\Session;
	
	class IndexHomeController
	{
		public function show(  )
		{
			
			$theUser = isset(Session::instance()->user_id) ? Session::instance()->user_id : '';
			
			view('home', ['user_id' => $theUser]);
			
		}
		
	}