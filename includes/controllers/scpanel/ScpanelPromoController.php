<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: showcase_app
	 * Date: 06/05/2019
	 * Time: 10:14
	 */
	
	namespace Controllers\Scpanel;
	
	
	use Classes\Core\CSRFToken;
	use Classes\Core\Params;
	use Classes\Core\Promotions;
	use Classes\Core\Session;
	use Classes\Core\User;
	
	class ScpanelPromoController
	{
		
		
		
		public function show()
		{
			
			User::isAdmin();
			
			adminView( 'promotion' , [ 'userid' => User::userID() ] );
			
		}
		
		public function showAdd($id='')
		{
			
			User::isAdmin();
			
			$promo = ($id['id']) ? Promotions::find_by_id($id['id']) : '';
			
			
			adminView( 'add-promotion' , [ 'userid' => User::userID() , 'promotion' => $promo] );
		}
		
		public function insertAdd( $param = [] )
		{
			
			// CSRF Protection
			CSRFToken::_CheckToken();
			
			// Check if it admin
			User::isAdmin();
			
			// Get params
			$post = Params::get( 'post' );
			
			( Params::has( 'promo_included_items' ) ) ? serialize( $post->promo_included_items ) : null;
			
			$promo = new Promotions();

			
			if ( $param[ 'id' ] )
			{
				$promo->id = $param[ 'id' ];
			}
			$promo->promo_code      = ( Params::has( 'promo_code' ) ) ? $post->promo_code : '';
			$promo->conversion      = ( Params::has( 'conversion' ) ) ? $post->conversion : '';
			$promo->value           = ( Params::has( 'promo_value' ) ) ? sca_set_price($post->promo_value) : '';
			$promo->valid           = ( Params::has( 'promo_valid' ) ) ? $post->promo_valid : '';
			$promo->valid_email     = ( Params::has( 'promo_valid_email' ) ) ? $post->promo_valid_email : '';
			$promo->valid_for_items = ( Params::has( 'promo_included_items' ) ) ? serialize( $post->promo_included_items ) : null;
			$promo->start_date      = ( Params::has( 'promo_start_date' ) ) ? $post->promo_start_date : '';
			$promo->end_date        = ( Params::has( 'promo_end_date' ) ) ? $post->promo_end_date : '';
			if ( ! empty( Params::get( 'file' )->promo_image->name ) )
			{
				$promo->set_file( Params::all( true )[ 'file' ][ 'promo_image' ] );
			}
			
			if ( $promo->insert_promo_code() )
			{
				
				Session::set( 'MESSAGE' , 'Promotion Has Been Set' );
				redirect( '/sc-panel/promotions'  );
			}
			else
			{
				Session::set( 'MESSAGE' , $promo->errors );
				adminView( 'add-promotion' , [ 'userid' => User::userID() ] );
			}
			
			
		}
		
		public function deleteAdd( $param )
		{
			
			
			if ( $param[ 'id' ] )
			{
				$promo = new Promotions();
				
				$promo->id = $param[ 'id' ];
				
				if ( $promo->delete_promo_code() )
				{
					Session::set( 'MESSAGE' , 'Promotion has been deleted' );
					adminView( 'promotion' , [ 'userid' => User::userID() ] );
				}
				else
				{
					Session::set( 'MESSAGE' , $promo->errors );
					Session::set( 'MESSAGE' , 'Promotion could not be removed, Please try again' );
					redirect( '/sc-panel/promotion/' . $param[ 'id' ] );
				}
			}
			
		}
		
		public function ajax()
		{
			
			// Have we received a promo code
			if ( Params::has( 'promo_code' ) )
			{
				$post = Params::get( 'post' );
			}
			else
			{
				echo json_encode( [ 'response' => 'NO' ] );
				exit();
			}
			
			// Initialize Promotions Class
			$promo = new Promotions();
			
			// Get promo code in records
			$promoData       = $promo->find_by_promo_code( $post->promo_code );
			$validItem       = unserialize( $promoData->valid_for_items );
			$cart            = json_decode( $post->cart_items );
			$cartItems       = $cart->sca_shopping_cart->cart;
			$linkEmail       = $post->promo_email_link;
			$discountedPrice = 0;
			$hasPromo        = 0;
			
			
			// Check if there are items in cart
			if ( ! Params::has( 'cart_items' ) )
			{
				echo json_encode( [ 'response' => 'NO' ] );
				exit();
			}
			
			// Check if promo code exists
			if ( empty( $promoData ) )
			{
				echo json_encode( [ 'response' => 'NO' ] );
				exit();
			}
			
			// Check if promotion is active
			if ( ! $promoData->valid )
			{
				echo json_encode( [ 'response' => 'NO' ] );
				exit();
			}
			
			// Check if promo has started yet
			if ( date( "Y-m-d H:i:s" ) < $promoData->start_date )
			{
				echo json_encode( [ 'response' => 'DATELESSER' ] );
				exit();
			}
			
			// Check if promo have finished
			if ( date( "Y-m-d H:i:s" ) > $promoData->end_date )
			{
				echo json_encode( [ 'response' => 'DATEGREATER' ] );
				exit();
			}
			
			// if email is required make sure email has been supplied
			if ( ! empty( $promoData->valid_email ) && empty( $linkEmail ) )
			{
				echo json_encode( [ 'response' => 'EMAIL' ] );
				exit();
			}
			
			// if email is required make sure supplied email matches
			if ( ! empty( $promoData->valid_email ) && $linkEmail !== $promoData->valid_email )
			{
				echo json_encode( [ 'response' => 'EMAIL' ] );
				exit();
			}
			
			
			foreach($cartItems as $item){
				
				if(is_array($validItem)){
					if(in_array($item->id, $validItem)){
						
						switch($promoData->conversion){
							case 1:
								
								$discountedPrice += ( $item->price * $item->quantity );
								break;
							case 2:
								
								$discountedPrice += ( ( $item->price * $item->quantity ) - (($promoData->value/100)*$item->quantity ));
								break;
							case 3:
								
								$percentToSubtract = ( ( $item->price * $item->quantity ) / 100 ) * ($promoData->value/100);
								
								$discountedPrice += ( $item->price * $item->quantity ) - $percentToSubtract;
								break;
						}
						
					}else {
						
						$hasPromo++;
						$discountedPrice += ( $item->price * $item->quantity );
						
					}
				}else{
					
					switch($promoData->conversion){
						case 1:
							
							$discountedPrice += ( $item->price * $item->quantity );
							break;
						case 2:
							
							$discountedPrice += ( ( $item->price * $item->quantity ) - (($promoData->value/100)*$item->quantity ));
							break;
						case 3:
							
							$percentToSubtract = ( ( $item->price * $item->quantity ) / 100 ) * ($promoData->value/100);
							
							$discountedPrice += ( $item->price * $item->quantity ) - $percentToSubtract;
							break;
					}
				}
			}
			
			if($hasPromo < count($cartItems)){
				echo json_encode( [ 'response' => 'YES', 'promo_price' => $discountedPrice ] );
				exit();
			}
			
		}
		
	}