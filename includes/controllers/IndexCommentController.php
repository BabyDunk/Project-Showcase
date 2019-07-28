<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: showcase_app
	 * Date: 06/07/2018
	 * Time: 18:15
	 */
	
	namespace Controllers;
	
	
	use Classes\Core\Comment;
	use Classes\Core\CSRFToken;
	use Classes\Core\Params;

	
	class IndexCommentController
	{
		
		
		
		public function store()
		{
			
			if(!CSRFToken::_CheckToken()){
				echo json_encode([
					'status'    =>  'FAILED',
					'message'   =>  'Please refresh page and try again'
				]);
				
				return false;
			}
			
			if(Params::has('commentSubmit')){
				$post = Params::get('post');
				
				$comment = new Comment();
				
				$comment->show_id   =   $post->showcaseId;
				$comment->author        =   $post->commentAuthor;
				$comment->email         =   $post->commentEmail;
				$comment->body          =   $post->commentBody;
				$comment->created_at    =   date("Y-m-d H:i:s");
				
				if($comment->create()){
					echo json_encode([
						'status'    =>  'OK',
						'message'   =>  'You comment have been submitted'
					]);
				}else{
					echo json_encode([
						'status'    =>  'FAILED',
						'message'   =>  'We couldn\'t store your comment, please try again'
					]);
				}
				
			}
			
			
			
			
		}
		
		
	}