<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: showcase_app
	 * Date: 20/06/2018
	 * Time: 21:04
	 */
	
	namespace Controllers;
	
	
	use Classes\Core\Session;
	use Classes\Core\Visitors;
	
	class IndexShowcaseController
	{
		
		public function show( $id )
		{
			
			Visitors::instance()->set($id);
			
			
			$theUser = isset(Session::instance()->user_id) ? Session::instance()->user_id : '';
			
			view('showcase', ['id' => $id, 'user_id' => $theUser]);
		}
		
		
	}