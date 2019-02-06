<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: oop
	 * Date: 28/05/2018
	 * Time: 01:50
	 */
	
	namespace Controllers\Scpanel;
	
	
	use Classes\Core\Comment;
	use Classes\Core\Session;
	use Classes\Core\Showcase;
	
	class ScpanelShowcaseController
	{
		
		
		
		public function show()
		{
			
			adminView( 'showcase' , [ 'userid' => Session::instance()->user_id ] );
			
			Session::clear( 'MESSAGE' );
			
		}
		
		public function remove( $id )
		{
			
			if ( empty( $id ) )
			{
				
				$message = "no identity supplied";
				
				adminView( 'showcase' , [ 'message' => $message ] );
				
			}
			else
			{
				
				$showcase = Showcase::find_by_id( $id[ 'id' ] );
				$sess     = new Session();
				
				if ( $showcase )
				{
					
					if ( Comment::find_by_show_id( $id[ 'id' ] ) )
					{
						Comment::deleteAllByCond( [ 'show_id' => $id[ 'id' ] ] );
					}
					
					if ( $showcase->delete_showcase() )
					{
						
						$message = "Showcase removed successfully";
						
						adminView( 'showcase' , [ 'message' => $message , 'userid' => $sess->user_id ] );
						
						return true;
						
					}
					else
					{
						
						$message = "Could not remove showcase";
						
						adminView( 'showcase' , [ 'message' => $message , 'userid' => $sess->user_id ] );
						
					}
					
					
				}
				else
				{
					
					$message = "Could not identify selected showcase";
					
					adminView( 'showcase' , [ 'message' => $message , 'userid' => $sess->user_id ] );
					
				}
			}
			
			return false;
		}
		
	}