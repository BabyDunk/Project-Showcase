<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: showcase_app
	 * Date: 09/05/2019
	 * Time: 15:07
	 */
	
	namespace Controllers\Scpanel;
	
	
	use Classes\Core\PaymentGateway;
	use Classes\Core\Session;
	use Classes\Core\ShoppingCart;
	
	class ScpanelShoppingCartController
	{
		
		
		
		public function show()
		{
			
			adminView( 'shopping-cart' , [ 'userid' => Session::instance()->user_id, 'carts' => ShoppingCart::find_all()] );
		}
		
		
	}