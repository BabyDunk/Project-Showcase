<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: oop
	 * Date: 25/05/2018
	 * Time: 23:50
	 */

	
	$router = new AltoRouter();
	
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


	require_once(__DIR__ . '/sc-panel-routes.php');
	