<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: showcase_app
	 * Date: 02/05/2019
	 * Time: 19:35
	 */
	
	namespace Classes\Core;
	
	
	/**
	 * Class ShoppingCart
	 *
	 * @package Classes\Core
	 */
	class ShoppingCart extends PdoObject
	{
		
		
		
		private static $instance;
		protected static $db_table = DB_PREFIX . "carts";
		protected static $db_table_fields = array(
			'id' ,
			'name' ,
			'address' ,
			'email' ,
			'cart' ,
			'transaction_amount' ,
			'currency' ,
			'transaction_data' ,
			'paid' ,
			'promo_code' ,
			'valid_email' ,
			'updated_at' ,
			'created_at'
		);
		
		public $id;
		public $name;
		public $address;
		public $email;
		public $cart;
		public $transaction_amount;
		public $currency;
		public $transaction_data;
		public $paid;
		public $promo_code;
		public $valid_email;
		public $updated_at;
		public $created_at;
		
		
		/**
		 * @return \Classes\Core\ShoppingCart
		 */
		public function instance()
		{
			
			if ( self::$instance instanceof self )
			{
				self::$instance = new self;
			}
			
			return self::$instance;
		}
		
		
		/**
		 * Echo add to cart button where ever called
		 */
		public static function echoAddButton()
		{
			
			$item = Showcase::find_by_id( showcaseUriID() );
			
			if ( ! empty( $item->price ) )
			{
				$html = '';
				$html .= '<fieldset class="fieldset">';
				$html .= '<legend>Add To Cart</legend>';
				$html .= '<section id="shopping-controls">';
				
				$html .= '<div class="shop-window">';
				$html .= '<label for="priceperitem">Price Per Item</label>';
				$html .= '<span id="priceperitem">&pound;'.sca_show_price($item->price).'</span>';
				$html .= '<label for="addLicence-id-' . $item->id . '">Select how many licences<br>you would like to purchase  </label>';
				$html .= '<select id="addLicence-id-' . $item->id . '">';
				for ( $x = 1; $x <= 20; $x ++ )
				{
					$html .= '<option value="' . $x . '">' . $x . '</option>';
				}
				$html .= '</select>';
				$html .= '</div>';
				
				$html .= '<div class="shop-buttons">';
				$html .= '<form action="/shop/cart">';
				$html .= '<input type="hidden" name="CSRFToken" id="CSRFToken" value="' . \Classes\Core\CSRFToken::_SetToken() . '" />';
				$html .= '<button class="button default" id="viewCart">View Cart</button>';
				$html .= '</form>';
				$html .= '<button class="button success" id="addToCart" data-shopitemtitle="' . $item->title . '" data-shopitemimage="' . $item->get_picture() . '" data-shopitemprice="' . sca_show_price($item->price) . '" data-shopitemid="' . $item->id . '">Add To Cart</button>';
				$html .= '</div>';
				
				$html .= '</section>';
				$html .= '</fieldset>';
				
				echo $html;
			}
			
		}
		
		
	}