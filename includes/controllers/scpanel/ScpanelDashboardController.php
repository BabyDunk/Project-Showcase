<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: oop
	 * Date: 27/05/2018
	 * Time: 12:57
	 */
	
	namespace Controllers\Scpanel;
	
	use Classes\Core\Comment;
	use Classes\Core\Preference;
	use Classes\Core\Showcase;
	use Classes\Core\Session;
	use Classes\Core\User;
	
	class ScpanelDashboardController
	{
		
		
		
		public function show()
		{
			
			
			$sess = new Session();
			if(!$sess->is_signed_in() ) {
				
				redirect('/sc-panel/login');
				
			} else {
				
				adminView('dashboard', ['sessCount' => $sess->count, 'ShowcaseCount' => Showcase::count_all(), 'UserCount' => User::count_all(), 'CommentCount' => Comment::count_all(), 'userid' => $sess->user_id]);
			}
			
			
			
		}
		
		
		
	}