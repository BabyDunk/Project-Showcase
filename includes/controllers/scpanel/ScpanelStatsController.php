<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: showcase_app
	 * Date: 13/06/2018
	 * Time: 11:03
	 */
	
	namespace Controllers\Scpanel;
	
	
	use Classes\Core\Session;
	
	class ScpanelStatsController
	{
		
		
		
		public function show(  )
		{
			
			adminView('statistics', ['userid'=> Session::instance()->user_id]);
			
		}
		
	}