<?php
	/**
	 * Created by Chris.
	 * Title: oop
	 * Date: 03/12/2017
	 * Time: 02:41
	 */
	
	# Load db config
	include_once ( INCLUDES_PATH . "config.php" );

	# if fresh install load installer script
	if ( empty( $DB_USER ) )
	{
		header( 'location: install.php' );
	}
	
	# Define db constants
	if ( ! empty( $DB_USER ) )
	{
		define( 'DB_HOST' , $DB_HOST );
		define( 'DB_USER' , $DB_USER );
		define( 'DB_PASS' , $DB_PASS );
		define( 'DB_NAME' , $DB_NAME );
		define( 'DB_CHARSET' , $DB_CHARSET );
		define( 'DB_PREFIX' , $DB_PREFIX );
	}
	
	
	
	function admin_autoload( $class )
	{
		
		$class = strtolower( $class );
		$path  = INCLUDES_PATH . "classes/core/{$class}.php";
		
		if ( is_file( $path ) && ! class_exists( $class ) )
		{
			require_once( $path );
		}
		else
		{
			die( "This file name {$class}.php was not found..." );
		}
	}
	
	spl_autoload_register( 'admin_autoload' );
	foreach ( glob( INCLUDES_PATH . 'helpers/*.php' ) as $file )
	{
		require_once( $file );
	}
	
	# Load route mapping
	require_once( INCLUDES_PATH . "routes/routes.php" );
	
	// Low level Exception Handling
	set_exception_handler('exceptionCatcher');
	
	
	# Instantiate import class
	$pdo  = new \Classes\Core\PdoDatabase();
	$sess = new Classes\Core\Session();
	$user = new Classes\Core\User();
	
	# activate RouteDispatcher once install is complete
	if($IS_INSTALLED)
	{
		 new Classes\RouteDispatcher( $router );
	}else{
		include_once 'install.php';
	}
?>