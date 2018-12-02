<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: oop
	 * Date: 27/05/2018
	 * Time: 12:54
	 */
	
	// Map Admin Dashboard
	$router->map( 'GET', '/admin',  'Controllers\Admin\AdminDashboardController@show', 'admin_dashboard');
	
	
	// Map Admin Login
	$router->map( 'GET', '/admin/login',  'Controllers\Admin\AdminLoginController@show', 'admin_login');
	$router->map( 'POST', '/admin/login',  'Controllers\Admin\AdminLoginController@check', 'admin_check_login');
	
	$router->map( 'GET', '/admin/logout',  'Controllers\Admin\AdminLoginController@logout', 'admin_logout');
	
	
	// Map Admin Add User
	$router->map( 'GET', '/admin/adduser',  'Controllers\Admin\AdminUsersController@showadduser', 'admin_show_adduser');
	$router->map( 'POST', '/admin/adduser',  'Controllers\Admin\AdminUsersController@insertadduser', 'admin_insert_adduser');
	
	
	// Map Admin Update User
	$router->map( 'GET', '/admin/updateuser/[i:id]',  'Controllers\Admin\AdminUsersController@showupdateuser', 'admin_show_updateuser');
	$router->map( 'POST', '/admin/updateuser',  'Controllers\Admin\AdminUsersController@editupdateuser', 'admin_edit_updateuser');
	
	
	// Map Admin Delete User
	$router->map( 'GET', '/admin/users/[i:id]',  'Controllers\Admin\AdminUsersController@remove', 'admin_delete_user');
	
	// Map Admin User List
	$router->map( 'GET', '/admin/users',  'Controllers\Admin\AdminUsersController@show', 'admin_users');
	
	
	// Map Admin Showcase
	$router->map( 'GET', '/admin/showcase',  'Controllers\Admin\AdminShowcaseController@show', 'admin_showcase');
	$router->map( 'GET', '/admin/showcase/[i:id]',  'Controllers\Admin\AdminShowcaseController@remove', 'admin_remove_showcase');
	
	
	// Map Admin Uploads
	$router->map( 'GET', '/admin/uploads',  'Controllers\Admin\AdminUploadsController@show', 'admin_show_showcase_uploads');
	$router->map( 'GET', '/admin/uploads/[i:id]',  'Controllers\Admin\AdminUploadsController@show', 'admin_show_store_showcase_uploads');
	$router->map( 'POST', '/admin/uploads',  'Controllers\Admin\AdminUploadsController@store', 'admin_insert_showcase_uploads');
	$router->map( 'POST', '/admin/pins',  'Controllers\Admin\AdminUploadsController@storepins', 'admin_insert_showcase_pins');
	$router->map( 'POST', '/admin/pins/edit',  'Controllers\Admin\AdminUploadsController@storepinsedit', 'admin_edit_showcase_pins');
	$router->map( 'POST', '/admin/pins/delete',  'Controllers\Admin\AdminUploadsController@storepinsdelete', 'admin_delete_showcase_pins');
	
	
	// Map Admin Comments
	$router->map( 'GET', '/admin/comments',  'Controllers\Admin\AdminCommentsController@show', 'admin_comments');
	$router->map( 'GET', '/admin/comments/[i:id]/delete',  'Controllers\Admin\AdminCommentsController@remove', 'admin_remove_comments');
	$router->map( 'GET', '/admin/comment_showcase/[i:id]',  'Controllers\Admin\AdminCommentsController@show_showcase', 'admin_showcase_comments');
	
	
	// Map Admin Statistics
	$router->map( 'GET', '/admin/statistics',  'Controllers\Admin\AdminStatsController@show', 'admin_statistics');
	
	
	// Map Admin Settings
	$router->map( 'GET', '/admin/general_settings',  'Controllers\Admin\AdminSettingsController@showGeneral', 'admin_general_settings');
	$router->map( 'POST', '/admin/general_settings',  'Controllers\Admin\AdminSettingsController@storeGeneral', 'admin_store_general_settings');
	
	$router->map( 'GET', '/admin/email_settings',  'Controllers\Admin\AdminSettingsController@showEmail', 'admin_email_settings');
	$router->map( 'POST', '/admin/email_settings',  'Controllers\Admin\AdminSettingsController@storeEmail', 'admin_store_email_settings');
	
	$router->map( 'GET', '/admin/social_settings',  'Controllers\Admin\AdminSettingsController@showSocial', 'admin_social_settings');
	$router->map( 'POST', '/admin/social_settings',  'Controllers\Admin\AdminSettingsController@storeSocial', 'admin_store_social_settings');
	
	