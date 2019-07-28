<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: oop
	 * Date: 25/05/2018
	 * Time: 23:50
	 */

	
	$router = new AltoRouter();
	
	// Map Redirect
	$router->map('GET', '/redirected', 'Controllers\BaseController@show', 'redirected');
	
	// Map About Page
	$router->map( 'GET', '/',  'Controllers\IndexHomeController@show', 'home');
	
	// Map Shop
	$router->map( 'GET', '/shop',  'Controllers\IndexShopController@show', 'shop');
	
	// Map Contact Form
	$router->map( 'POST', '/contact',  'Controllers\IndexContactController@insert', 'front_contact');
	$router->map( 'POST', '/getinfo',  'Controllers\IndexContactController@getInfo', 'home_request_info');
	
	
	// Map Contact Form
	$router->map( 'POST', '/shop/showcase_contact',  'Controllers\IndexContactController@insert', 'showcases_contact');
	

	// Map Showcase Page
	$router->map( 'GET', '/shop/showcase/[i:id]/[*]',  'Controllers\IndexShowcaseController@show', 'front_showcase');

	
	// Map Comment
	$router->map( 'POST', '/shop/showcase/comment',  'Controllers\IndexCommentController@store', 'store_comment');

	
	// Map Shopping Cart
	$router->map('GET', '/shop/cart', 'Controllers\IndexShopController@showCart', 'shopping_cart');
	// Map Stripe Payment
	$router->map('POST', '/shop/stripe_payment', 'Controllers\IndexShopController@stripeAjax', 'stripe_payment');
	// Map Payment Success
	$router->map('GET', '/shop/payment_notice/[i:id]/[:CSRFToken]', 'Controllers\IndexShopController@paymentNoticeCart', 'shopping_cart_payment_notice');
	
	
	require_once(__DIR__ . '/sc-panel-routes.php');
	