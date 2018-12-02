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
	define('SITE_URL', (isset($_SERVER['HTTPS'])) ? 'https' : 'http' . '://'. $_SERVER['HTTP_HOST'] . '/');
	define('UPLOADED_IMAGES_PATH_URL', (isset($_SERVER['HTTPS'])) ? 'https' : 'http' . '://'. $_SERVER['HTTP_HOST'] . '/resources/uploads/images/');
	
	
	require_once(INCLUDES_PATH . 'init.php');