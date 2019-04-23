<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: oop
	 * Date: 26/05/2018
	 * Time: 12:13
	 */
	
	
	
	defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
	define('SITE_ROOT', __DIR__ . DS);
	define('INCLUDES_PATH', SITE_ROOT . 'includes' . DS );
	define('UPLOAD_PATH', SITE_ROOT . 'resources' . DS . 'uploads' . DS);
	define('UPLOADED_IMAGES_PATH', UPLOAD_PATH . 'images' . DS);
	define('IS_HTTP', (isset($_SERVER['HTTPS'])) ? 'https' : 'http');
	define('SITE_URL', IS_HTTP . '://'. $_SERVER['HTTP_HOST'] . '/');
	define('UPLOADED_IMAGES_PATH_URL', SITE_URL . 'resources/uploads/images/');
	define('ASSETS_IMAGES_PATH_URL', SITE_URL . 'resources/assets/images/');
	
	require_once(INCLUDES_PATH . 'init.php');
	
	