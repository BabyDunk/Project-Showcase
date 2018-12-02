<?php
/**
 * Created by Chris.
 * Title: oop
 * Date: 03/12/2017
 * Time: 02:41
 */



require_once( INCLUDES_PATH . "new_config.php" );
require_once( INCLUDES_PATH . "functions.php" );
foreach ( glob(INCLUDES_PATH.'helpers/*.php') as $file ) {require_once ($file);}
require_once( INCLUDES_PATH . "routes/routes.php" );

	
	
	
$db   = new Classes\Core\Database();
$sess = new Classes\Core\Session();
$user = new Classes\Core\User();

new Classes\RouteDispatcher($router);
?>