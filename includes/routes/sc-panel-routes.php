<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: oop
	 * Date: 27/05/2018
	 * Time: 12:54
	 */
	
	// Map Admin Dashboard
	$router->map( 'GET', '/sc-panel',  'Controllers\Scpanel\ScpanelDashboardController@show', 'admin_dashboard');
	
	
	// Map Admin Login
	$router->map( 'GET', '/sc-panel/login',  'Controllers\Scpanel\ScpanelLoginController@show', 'admin_login');
	$router->map( 'POST', '/sc-panel/login',  'Controllers\Scpanel\ScpanelLoginController@check', 'admin_check_login');
	
	$router->map( 'GET', '/sc-panel/logout',  'Controllers\Scpanel\ScpanelLoginController@logout', 'admin_logout');
	
	
	// Map Admin Add User
	$router->map( 'GET', '/sc-panel/adduser',  'Controllers\Scpanel\ScpanelUsersController@showadduser', 'admin_show_adduser');
	$router->map( 'POST', '/sc-panel/adduser',  'Controllers\Scpanel\ScpanelUsersController@insertadduser', 'admin_insert_adduser');
	
	
	// Map Admin Update User
	$router->map( 'GET', '/sc-panel/updateuser/[i:id]',  'Controllers\Scpanel\ScpanelUsersController@showupdateuser', 'admin_show_updateuser');
	$router->map( 'POST', '/sc-panel/updateuser',  'Controllers\Scpanel\ScpanelUsersController@editupdateuser', 'admin_edit_updateuser');
	
	
	// Map Admin Delete User
	$router->map( 'GET', '/sc-panel/users/[i:id]',  'Controllers\Scpanel\ScpanelUsersController@remove', 'delete_user');
	
	// Map Admin User List
	$router->map( 'GET', '/sc-panel/users',  'Controllers\Scpanel\ScpanelUsersController@show', 'admin_users');
	
	
	// Map Admin Showcase
	$router->map( 'GET', '/sc-panel/showcase',  'Controllers\Scpanel\ScpanelShowcaseController@show', 'admin_showcase');
	$router->map( 'GET', '/sc-panel/showcase/[i:id]',  'Controllers\Scpanel\ScpanelShowcaseController@remove', 'admin_remove_showcase');
	
	
	// Map Admin Uploads
	$router->map( 'GET', '/sc-panel/uploads',  'Controllers\Scpanel\ScpanelUploadsController@show', 'admin_show_showcase_uploads');
	$router->map( 'GET', '/sc-panel/uploads/[i:id]',  'Controllers\Scpanel\ScpanelUploadsController@show', 'admin_show_store_showcase_uploads');
	$router->map( 'POST', '/sc-panel/uploads',  'Controllers\Scpanel\ScpanelUploadsController@store', 'admin_insert_showcase_uploads');
	$router->map( 'POST', '/sc-panel/pins',  'Controllers\Scpanel\ScpanelUploadsController@storepins', 'admin_insert_showcase_pins');
	$router->map( 'POST', '/sc-panel/pins/edit',  'Controllers\Scpanel\ScpanelUploadsController@storepinsedit', 'admin_edit_showcase_pins');
	$router->map( 'POST', '/sc-panel/pins/delete',  'Controllers\Scpanel\ScpanelUploadsController@storepinsdelete', 'admin_delete_showcase_pins');
	
	
	// Map Admin Comments
	$router->map( 'GET', '/sc-panel/comments',  'Controllers\Scpanel\ScpanelCommentsController@show', 'admin_comments');
	$router->map( 'GET', '/sc-panel/comments/[i:id]/delete',  'Controllers\Scpanel\ScpanelCommentsController@remove', 'admin_remove_comments');
	$router->map( 'GET', '/sc-panel/comment_showcase/[i:id]',  'Controllers\Scpanel\ScpanelCommentsController@show_showcase', 'admin_showcase_comments');
	
	
	// Map Contacts
	$router->map( 'GET', '/sc-panel/contacts',  'Controllers\Scpanel\ScpanelContactsController@show', 'admin_contacts');
	$router->map( 'GET', '/sc-panel/contacts/[i:id]/delete',  'Controllers\Scpanel\ScpanelContactsController@remove', 'admin_remove_contacts');
	
	// Map USer Indox
	$router->map( 'GET', '/sc-panel/user_contacts',  'Controllers\Scpanel\ScpanelContactsController@show_users', 'user_contacts');
	$router->map( 'GET', '/sc-panel/user_contacts/[i:id]/delete',  'Controllers\Scpanel\ScpanelContactsController@remove_users', 'user_remove_contacts');
	
	// Map Admin Statistics
	$router->map( 'GET', '/sc-panel/statistics',  'Controllers\Scpanel\ScpanelStatsController@show', 'admin_statistics');
	
	
	// Map Admin Settings
	$router->map( 'GET', '/sc-panel/general_settings',  'Controllers\Scpanel\ScpanelSettingsController@showGeneral', 'admin_general_settings');
	$router->map( 'POST', '/sc-panel/general_settings',  'Controllers\Scpanel\ScpanelSettingsController@storeGeneral', 'admin_store_general_settings');
	
	$router->map( 'GET', '/sc-panel/email_settings',  'Controllers\Scpanel\ScpanelSettingsController@showEmail', 'admin_email_settings');
	$router->map( 'POST', '/sc-panel/email_settings',  'Controllers\Scpanel\ScpanelSettingsController@storeEmail', 'admin_store_email_settings');
	
	$router->map( 'GET', '/sc-panel/social_settings',  'Controllers\Scpanel\ScpanelSettingsController@showSocial', 'admin_social_settings');
	$router->map( 'POST', '/sc-panel/social_settings',  'Controllers\Scpanel\ScpanelSettingsController@storeSocial', 'admin_store_social_settings');

	
	