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
	use Classes\Core\Visitors;
	
	class ScpanelDashboardController
	{
		
		
		
		public function show()
		{
			
			
			$sess = new Session();
			if(!$sess->is_signed_in() ) {
				
				redirect('/sc-panel/login');
				
			} else {
				
				$user = User::find_by_id($sess->user_id);
				
				if($user->privilege){
					
					adminView('dashboard', ['sessCount' => Visitors::count_all(), 'ShowcaseCount' => Showcase::count_all(), 'UserCount' => User::count_all(), 'CommentCount' => Comment::count_all(), 'userid' => $sess->user_id]);
					
				}else {
					adminView('dashboard', ['sessCount' => Visitors::count_by_visitor_by_author($sess->user_id), 'ShowcaseCount' => Showcase::count_by_condition(['user_id'=>$sess->user_id]), 'UserCount' => User::count_by_condition(['id'=>$sess->user_id]), 'CommentCount' => Comment::count_comments_by_showcase_author($sess->user_id), 'userid' => $sess->user_id]);
				}
				
			}
			
			
			
		}
		
		
		
	}