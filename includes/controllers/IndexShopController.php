<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: oop
	 * Date: 26/05/2018
	 * Time: 10:12
	 */
	
	namespace Controllers;
	
	
	use Classes\Core\CSRFToken;
	use Classes\Core\Params;
	use Classes\Core\PaymentGateway;
	use Classes\Core\Session;
	use Classes\Core\ShoppingCart;
	use Stripe\Error\SignatureVerification;
	
	class IndexShopController extends BaseController
	{
		
		
		
		function __construct()
		{
		
		}
		
		public function show()
		{
			
			$theUser = isset( Session::instance()->user_id ) ? Session::instance()->user_id : '';
			
			view( 'shop' , [ 'user_id' => $theUser ] );
			
		}
		
		public function showCart()
		{
			
			
			view( 'cart' );
			
			/*if ( CSRFToken::_CheckToken(Params::get('get')->CSRFToken) )
			{
				view( 'cart' );
			}
			else
			{
				redirect( '/shop' );
			}*/
			
			
		}
		
		
		public function stripeAjax()
		{
			
			if ( ! CSRFToken::_CheckToken() )
			{
				echo json_encode( [ 'status' => 'FAILED' , 'message' => 'Refresh page and try again' ] );
				exit();
			}
			
			$post = Params::get( 'post' );
			
			
			$cartObject = json_decode($post->cartObject , true );
			
			if ( ! Params::has( 'cartName' ) )
			{
				echo json_encode( [ 'status' => 'FAILED' , 'message' => 'Please provide your full name' ] );
				exit();
			}
			
			if ( ! Params::has( 'cartAddress' ) )
			{
				echo json_encode( [ 'status' => 'FAILED' , 'message' => 'Please provide your full address' ] );
				exit();
			}
			
			if ( ! Params::has( 'cartPostcode' ) )
			{
				echo json_encode( [ 'status' => 'FAILED' , 'message' => 'Please provide your Postcode' ] );
				exit();
			}
			
			if ( empty( $cartObject['sca_shopping_cart'] ) )
			{
				echo json_encode( [ 'status' => 'FAILED' , 'message' => 'Shopping Cart was not received' ] );
				exit();
			}
			else
			{
				if ( empty( $cartObject['sca_shopping_cart']['cart'] ) )
				{
					echo json_encode( [ 'status' => 'FAILED' , 'message' => 'Shopping Cart is empty' ] );
					exit();
				}
			}
			
			if ( ! Params::has( 'cartEmail' ) )
			{
				echo json_encode( [ 'status' => 'FAILED' , 'message' => 'Please provide a your email address' ] );
				exit();
			}
			
			if ( ! Params::has( 'stripeToken' ) )
			{
				echo json_encode( [ 'status' => 'FAILED' , 'message' => 'Please re-provide your card info' ] );
				exit();
			}
			
			
			$discountCode     = ( Params::has( 'cartDiscounted' ) ) ? $post->cartDiscounted : '';
			$discountLink     = ( Params::has( 'cartDiscountLink' ) ) ? $post->cartDiscountLink : '';
			$payment_response = null;
			
			$waiter = true;
			if ( $waiter )
			{
				$payment_gateway = new PaymentGateway();
				$collectCart = $payment_gateway->set_cart_price( $cartObject, $discountCode , $discountLink );
				$payment_gateway->currency      = strtolower( sca_get_preference( 'showcase' , 'sca_currencyType' ) );
				$payment_gateway->secretKey     = $this->set_correct_stripe_key();
				$payment_gateway->token         = $post->stripeToken;
				$payment_gateway->customerEmail = $post->cartEmail;
				if ( $payment_gateway->value > 30 )
				{
					$payment_response = $payment_gateway->make_payment();
				}
				
				
				if ( $payment_response )
				{
					$shopCart = new ShoppingCart();
					
					$shopCart->name               = $post->cartName;
					$shopCart->address            = $post->cartAddress . ', ' . $post->cartPostcode;
					$shopCart->email              = $post->cartEmail;
					$shopCart->cart               = serialize( $collectCart );
					$shopCart->transaction_amount = $payment_response[ 'amount' ];
					$shopCart->currency           = sca_get_preference( 'showcase' , 'sca_currencyType' );
					$shopCart->transaction_data   = serialize( $payment_response );
					$shopCart->paid               = $payment_response[ 'paid' ];
					$shopCart->promo_code         = $discountCode;
					$shopCart->valid_email        = $discountLink;
					$shopCart->created_at         = date( "Y-m-d H:i:s" );
					$shopCart->save();
					
					
					echo json_encode( [ 'status'    => 'SUCCESS' ,
					                    'message'   => 'Payment Successful' ,
					                    'succid'    => $shopCart->get_last_insert() ,
					                    'CSRFToken' => CSRFToken::_SetToken()
					] );
					exit();
				}
				else
				{
					echo json_encode( [ 'status' => 'FAILED' , 'message' => 'Transaction failed' ] );
					exit();
				}
				
			}
			
			
		}
		
		public function paymentNoticeCart( $params )
		{
			
			if ( ! CSRFToken::_CheckToken( $params[ 'CSRFToken' ] ) )
			{
				Session::set( 'MESSAGE' , 'How did you get here? seems like you are doing something suspicious' );
				redirect( '/redirected' );
			}
			
			$transaction = ShoppingCart::find_by_id( $params[ 'id' ] );
			
			// TODO: consider daylight saving mode when calculating times
			if ( date( "Y-m-d H:i:s" ) > date( 'Y-m-d H:i:s' , strtotime( '+1 minute' , strtotime( $transaction->created_at ) ) ) )
			{
				Session::set( 'MESSAGE' , 'How did you get here? seems like you are doing something suspicious' );
				redirect( '/redirected' );
			}
			
			$payment_response = json_decode( json_encode( unserialize( $transaction->transaction_data ) ) , false );
			$payment_cart     = json_decode( json_encode( unserialize( $transaction->cart ) ) , false );
			
			
	
			view( 'cart-payment-notice' , [
				'trans'       => $transaction ,
				'cart'         => $payment_cart ,
				'transsuccess' => $payment_response
			] );
			
			
		}
		
		private function set_correct_stripe_key()
		{
			
			return ( sca_get_preference( 'showcase' , 'sca_stripe_mode' ) ) ? sca_get_preference( 'showcase' , 'sca_liveSecretKey' ) : sca_get_preference( 'showcase' , 'sca_testSecretKey' );
			
		}
		
	}