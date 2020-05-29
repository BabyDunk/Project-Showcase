<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: showcase_app
	 * Date: 13/06/2018
	 * Time: 11:03
	 */
	
	namespace Controllers\Scpanel;
	
	
	use Classes\Core\Session;
	use Classes\Core\User;
	
	class ScpanelStatsController
	{
		
		
		
		public function show(  )
		{
			
			User::isAdmin();
			
			adminView('statistics', ['userid'=> Session::instance()->user_id]);
			
		}
		
	}