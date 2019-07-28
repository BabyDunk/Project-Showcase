<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: showcase_app_online
	 * Date: 10/05/2019
	 * Time: 20:36
	 */
	
	namespace Classes\Core;
	
	
	use Stripe\Charge;
	use Stripe\Stripe;
	
	class PaymentGateway
	{
		
		
		
		public $paymentMethod = 'stripe';
		public $isLiveMode = false;
		public $secretKey;
		public $apiKey;
		public $value;
		public $currency;
		public $customerEmail;
		public $token;
		
		
		public function __construct()
		{
		
		}
		
		public function set_cart_price( $cartObj , $discountCode = '' , $discountLink = '' )
		{
			$cartArr = $cartObj['sca_shopping_cart']['cart'];
			
			if ( empty( $cartArr ) )
			{
				return false;
			}
			
			
			$promotion = Promotions::find_by_promo_code( $discountCode );
			
			$newCartObject = [ 'sca_shopping_cart' => [ 'listStarted' => $cartObj['sca_shopping_cart']['listStarted'] , 'cart' => [] ] ];
			
			
			
			foreach ( $cartArr as $item )
			{
				$showcaseCart = Showcase::find_by_id( $item[ 'id' ] );
				
				array_push( $newCartObject[ 'sca_shopping_cart' ][ 'cart' ] , [
					'id'          => $showcaseCart->id ,
					'title'       => $showcaseCart->title ,
					'subtitle'    => $showcaseCart->subtitle ,
					'description' => $showcaseCart->description1 ,
					'price'       => $showcaseCart->price ,
					'quantity'    => $item[ 'quantity' ]
				] );
				
				if ( $showcaseCart )
				{
					$promoCal = false;
					if($promotion){
						$promoCal = $promotion->cal_promo($showcaseCart, $item['quantity'], $discountLink);
					}
					
					$this->value += ($promoCal) ? $promoCal : ($showcaseCart->price*$item['quantity']);
					
				}
				
			}
			
			if($promotion->conversion === 1){
				$this->value -= $promotion->value;
			}
			
			
			return $newCartObject;
			
		}
		
		
		public function make_payment()
		{
			
			return ( $this->paymentMethod === 'paypal' ) ? $this->paypal() : $this->stripe();
			
		}
		
		protected function set_secret_key()
		{
			
			$checkKey = substr( $this->secretKey , 0 , 7 );
			
			$correctKey = '';
			if ( $this->isLiveMode )
			{
				if ( $checkKey === 'sk_live' )
				{
					$correctKey = $this->secretKey;
				}
			}
			
			if ( ! $this->isLiveMode )
			{
				if ( $checkKey === 'sk_test' )
				{
					$correctKey = $this->secretKey;
				}
			}
			
			return $correctKey;
		}
		
		private function stripe()
		{
			
			Stripe::setApiKey( $this->set_secret_key() );
			
			$charge = Charge::create( [
				'amount'        => $this->value ,
				'currency'      => $this->currency ,
				'source'        => $this->set_token() ,
				'receipt_email' => $this->customerEmail ,
			] );
			
			return $charge;
		}
		
		private function set_token()
		{
			
			return ( $this->paymentMethod === 'stripe' ) ? $this->token : null;
		}
		
		private function paypal()
		{
			
			return '';
		}
		
		public static function echoStripeForm()
		{
			
			$html = '<figure id="personal-finance">';
			$html .= '<div id="card-surround">';
			$html .= '<div class="notification"></div>';
			$html .= '<form action="" method="post" id="payment-form">';
			$html .= returnCSRFInput();
			$html .= '<div class="">';
			$html .= '<label for="card-element">';
			$html .= 'Credit or debit card';
			$html .= '</<label>';
			$html .= '<div id="card-element">';
			$html .= '<!-- a Stripe Element will be inserted here. -->';
			$html .= '</div>';
			$html .= '</div>';
			$html .= '<!-- Used to display form errors -->';
			$html .= '<div id="card-errors" role="alert"></div>';
			$html .= '<div class="form-content">';
			$html .= '<div></div>';
			$html .= '<button class="button success" id="submitStripeToServer">Submit Payment</button>';
			$html .= '</div>';
			$html .= '</form>';
			$html .= '</div>';
			$html .= '</figure>';
			
			echo $html;
			
		}
		
	}
	