<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: oop
	 * Date: 28/05/2018
	 * Time: 02:02
	 */
	
	namespace Controllers\Admin;
	
	
	use Classes\Core\Comment;
	use Classes\Core\Session;
	
	class AdminCommentsController
	{
		
		
		
		public function show(  )
		{
			adminView('comments', ['userid'=> Session::instance()->user_id]);
		}
		
		public function remove($id)
		{
			//var_dump($id);exit;
			if(!empty($id)){
				$comment = new Comment();
				$comment->id = $id['id'];
				
				if($comment->delete()){
					adminView('comments', ['userid' => Session::instance()->user_id, 'message' => 'Comment removed successfully']);
					return true;
				}else {
					adminView('comments', ['userid' => Session::instance()->user_id, 'message' => 'Comment could not be removed, please try again']);
					return false;
				}
			} else {
				adminView('comments', ['userid' => Session::instance()->user_id, 'message' => 'No comment id supplied']);
				return false;
			}
			
		}
		
		public function show_showcase( $id )
		{
			
			adminView('comment_showcase', ['id'=>$id, 'userid'=> Session::instance()->user_id]);
		}
	}