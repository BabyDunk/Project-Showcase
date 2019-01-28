<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: showcase_app
	 * Date: 20/06/2018
	 * Time: 21:04
	 */
	
	namespace Controllers;
	
	
	use Classes\Core\Visitors;
	
	class IndexShowcaseController
	{
		
		public function show( $id )
		{
			
			Visitors::instance()->set($id);
			view('showcase', $id);
		}
		
		
	}