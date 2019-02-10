<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: oop
	 * Date: 25/05/2018
	 * Time: 23:50
	 */

	
	$router = new AltoRouter();
	
	// map homepage
	$router->map( 'GET', '/',  'Controllers\IndexController@show', 'home');
	
	// Map Contact Form
	$router->map( 'POST', '/contact',  'Controllers\IndexContactController@insert', 'front_contact');
	
	
	// Map Contact Form
	$router->map( 'POST', '/showcase_contact',  'Controllers\IndexContactController@insert', 'showcases_contact');


	// Map About Page
	$router->map( 'GET', '/about',  'Controllers\IndexAboutController@show', 'front_about');


	// Map Showcase Page
	$router->map( 'GET', '/showcase/[i:id]/[*]',  'Controllers\IndexShowcaseController@show', 'front_showcase');

	
	// Map Comment
	$router->map( 'POST', '/showcase/comment',  'Controllers\IndexCommentController@store', 'store_comment');


	require_once(__DIR__ . '/sc-panel-routes.php');
	