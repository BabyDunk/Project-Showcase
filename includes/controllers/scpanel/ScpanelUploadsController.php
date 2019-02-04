<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: oop
	 * Date: 28/05/2018
	 * Time: 01:58
	 */
	
	namespace Controllers\Scpanel;
	
	
	use Classes\Core\CSRFToken;
	use Classes\Core\Params;
	use Classes\Core\Preference;
	use Classes\Core\Session;
	use Classes\Core\Showcase;
	use Classes\Core\ShowcasePins;
	
	class ScpanelUploadsController
	{
		
		
		
		public function show( $id )
		{
			
			if ( isset( $id ) )
			{
				adminView( 'uploads' , [ 'id' => $id , 'userid' => Session::instance()->user_id ] );
			}
			else
			{
				adminView( 'uploads' , [ 'userid' => Session::instance()->user_id ] );
			}
			
			
			Session::clear( 'MESSAGE' );
			
		}
		
		public function store()
		{
			
			$sess = new Session();
			if ( Params::has( 'submit' ) )
			{
				
				if ( ! CSRFToken::_CheckToken() )
				{
					
					redirect( '/sc-panel/uploads' );
					
					return false;
				}
				
				$showcase = new Showcase();
				$post     = Params::get( 'post' );
				
				$showcasePayment = ( Params::has( 'showcasePayment' ) ) ? serialize( $post->showcasePayment ) : '';
				
				if ( Params::has( 'showcaseId' ) )
				{
					$showcase->id = $post->showcaseId;
				}
				
				$the3BlockNotice = serialize( [
					'blocknoticetitle1'          => $post->blocknoticetitle1 ,
					'blocknoticefaicon1'         => $post->blocknoticefaicon1 ,
					'blocknotice_colorselector1' => $post->blocknotice_colorselector1 ,
					'blocknoticesubtitle1'       => $post->blocknoticesubtitle1 ,
					'blocknoticedescrip1'        => $post->blocknoticedescrip1 ,
					'blocknoticetitle2'          => $post->blocknoticetitle2 ,
					'blocknoticefaicon2'         => $post->blocknoticefaicon2 ,
					'blocknotice_colorselector2' => $post->blocknotice_colorselector2 ,
					'blocknoticesubtitle2'       => $post->blocknoticesubtitle2 ,
					'blocknoticedescrip2'        => $post->blocknoticedescrip2 ,
					'blocknoticetitle3'          => $post->blocknoticetitle3 ,
					'blocknoticefaicon3'         => $post->blocknoticefaicon3 ,
					'blocknotice_colorselector3' => $post->blocknotice_colorselector3 ,
					'blocknoticesubtitle3'       => $post->blocknoticesubtitle3 ,
					'blocknoticedescrip3'        => $post->blocknoticedescrip3
				] );
				
				$showcase->user_id            = $sess->user_id;
				$showcase->show_id            = $post->tempID;
				$showcase->title              = $post->title;
				$showcase->subtitle           = $post->subtitle;
				$showcase->description1       = $post->description1;
				$showcase->showcasePayment    = $showcasePayment;
				$showcase->three_notice_block = $the3BlockNotice;
				$showcase->job_deposit        = $post->job_deposit;
				$showcase->job_duration       = $post->job_duration;
				$showcase->bg_colorselector   = $post->bg_colorselector;
				$showcase->fg_colorselector   = $post->fg_colorselector;
				$showcase->front_demo_link    = $post->frontDemo;
				$showcase->back_demo_link     = $post->backDemo;
				$showcase->back_demo_user     = $post->backDemoUser;
				$showcase->back_demo_pass     = $post->backDemoPass;
				if ( Params::has( 'showcaseId' ) )
				{
					$showcase->updated_at = date( "Y-m-d H:i:s" );
				}
				else
				{
					$showcase->created_at = date( "Y-m-d H:i:s" );
				}
				
				
				
				if ( ! empty( Params::get( 'file' )->upload_file->name ) )
				{
					$imageSize = getimagesize(Params::get( 'file' )->upload_file->tmp_name);
			
					if($imageSize[0] === 1200 && $imageSize[1] === 600){
						$showcase->set_file( Params::all( true )[ 'file' ][ 'upload_file' ] );
					}else{
						
						Session::set('MESSAGE', 'Image dimension must be 1200X600');
						redirect('/sc-panel/uploads');
					}
					
				}
				
				if ( $showcase->save() )
				{
					
					$message = "Showcase uploaded Successfully!";
					
					Session::set( 'MESSAGE' , $message );
					
					redirect( '/sc-panel/showcase' );
					
				}
				else
				{
					
					$errors = $showcase->errors;
					
					adminView( 'uploads' , [ 'error' => $errors , 'userid' => $sess->user_id ] );
					
				}
				
				
			}
			else
			{
				
				adminView( 'uploads' , [
					'message' => 'Problems submitting data, please try again' ,
					'userid'  => $sess->user_id
				] );
				
			}
			
		}
		
		public function storepins()
		{
			
			if ( Params::has( 'pinSubmit' ) )
			{
				
				$showcasePins = new ShowcasePins();
				$post         = Params::get( 'post' );
				
				$showcasePins->show_id    = $post->pinShowcaseId;
				$showcasePins->show_title = $post->pinTitle;
				$showcasePins->show_body  = $post->pinBody;
				$showcasePins->created_at = date( "Y-m-d H:i:s" );
				
				if ( $showcasePins->create() )
				{
					
					$thePins = '<fieldset class="fieldset">
									<legend>Inserted Pins: ' . $post->pinTitle . '</legend>
									<div class="card">
										<div class="callout">
									 	
											<p>' . $post->pinBody . '</p>
									</div>
									</div>
								</fieldset>';
					
					echo json_encode( [
						'status'  => 'OK' ,
						'message' => 'Pin set successfully' ,
						'pins'    => $thePins
					] );
					
				}
				else
				{
					
					echo json_encode( [
						'status'  => 'FAILED' ,
						'message' => 'This was a problem inserting your latest pins, please try again'
					
					] );
					
				}
				
			}
			else
			{
				
				echo json_encode( [
					'status'  => 'FAILED' ,
					'message' => 'This was a problem inserting your latest pins, please try again'
				
				] );
				
			}
			
		}
		
		public function storepinsdelete()
		{
			
			/*if(!CSRFToken::_CheckToken()){
				echo json_encode([
					'status'    =>  'FAILED',
					'message'   =>  'Please refresh page and try again'
				]);
				
				return false;
			}*/
			
			
			if ( Params::has( 'pinId' ) )
			{
				$post = Params::get( 'post' );
				
				/*Session::set( 'TESTER' , $post );
				exit;*/
				
				$pins     = new ShowcasePins();
				$pins->id = $post->pinId;
				
				if ( $pins->delete() )
				{
					
					echo json_encode( [
						'status'  => 'OK' ,
						'pin_id'  => $post->pinId ,
						'message' => 'Pin has been deleted successfully'
					] );
					
					
				}
				else
				{
					echo json_encode( [
						'status'  => 'FAILED' ,
						'pin_id'  => $post->pinId ,
						'message' => 'Pin could not be deleted'
					] );
				}
				
			}
			
			
		}
		
		public function storepinsedit()
		{
			
			if ( ! CSRFToken::_CheckToken() )
			{
				echo json_encode( [
					'status'  => 'FAILED' ,
					'message' => 'Please refresh page and try again'
				] );
				
				return false;
			}
			
			
			if ( Params::has( 'pinId' ) )
			{
				$post = Params::get( 'post' );
				
				/*Session::set( 'TESTER' , $post );
				exit;*/
				
				$pins             = new ShowcasePins();
				$pins->id         = $post->pinId;
				$pins->show_id    = ShowcasePins::find_by_id( $post->pinId )->show_id;
				$pins->show_title = $post->pinTitle;
				$pins->show_body  = $post->pinBody;
				
				if ( $pins->update() )
				{
					
					echo json_encode( [
						'status'   => 'OK' ,
						'pin_id'   => $post->pinId ,
						'pinTitle' => $post->pinTitle ,
						'pinBody'  => $post->pinBody ,
						'message'  => 'Pin has been updated successfully'
					] );
					
					
				}
				else
				{
					echo json_encode( [
						'status'  => 'FAILED' ,
						'pin_id'  => $post->pinId ,
						'message' => 'Pin could not be updated'
					] );
				}
				
			}
			
			
		}
		
	}