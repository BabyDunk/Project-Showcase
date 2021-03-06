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
	$router->map( 'GET', '/sc-panel/deleteusers/[i:id]',  'Controllers\Scpanel\ScpanelUsersController@remove', 'delete_user');
	
	// Map Admin User List
	$router->map( 'GET', '/sc-panel/users',  'Controllers\Scpanel\ScpanelUsersController@show', 'admin_users');
	
	
	// Map Admin Showcase
	$router->map( 'GET', '/sc-panel/showcase',  'Controllers\Scpanel\ScpanelShowcaseController@show', 'admin_showcase');
	$router->map( 'GET', '/sc-panel/showcase/[i:id]/delete',  'Controllers\Scpanel\ScpanelShowcaseController@remove', 'admin_remove_showcase');
	
	
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
	
	// Map User Inbox
	$router->map( 'GET', '/sc-panel/user_contacts',  'Controllers\Scpanel\ScpanelContactsController@show_users', 'user_contacts');
	$router->map( 'GET', '/sc-panel/user_contacts/[i:id]/delete',  'Controllers\Scpanel\ScpanelContactsController@remove_users', 'user_remove_contacts');
	
	
	// Map Promotions List
	$router->map('GET', '/sc-panel/promotions', 'Controllers\Scpanel\ScpanelPromoController@show', 'admin_promotions');
	
	// Map Add Promotion
	$router->map('GET', '/sc-panel/add_promotion', 'Controllers\Scpanel\ScpanelPromoController@showAdd', 'admin_add_promotion');
	$router->map('POST', '/sc-panel/add_promotion', 'Controllers\Scpanel\ScpanelPromoController@insertAdd', 'admin_insert_promotion');
	
	// Map Delete Promotion
	$router->map('GET', '/sc-panel/promo/[i:id]/delete', 'Controllers\Scpanel\ScpanelPromoController@deleteAdd', 'admin_delete_promotion');
	
	// Map Edit Promotion
	$router->map('GET', '/sc-panel/updatepromo/[i:id]/edit', 'Controllers\Scpanel\ScpanelPromoController@showAdd', 'admin_edit_promotion');
	$router->map('POST', '/sc-panel/updatepromo/[i:id]/edit', 'Controllers\Scpanel\ScpanelPromoController@insertAdd', 'admin_update_promotion');
	
	// Map Ajax Promotion
	$router->map('POST', '/sc-panel/promo/ajax', 'Controllers\Scpanel\ScpanelPromoController@ajax', 'multi_use_ajax_promotion');
	
	// Map Admin Statistics
	$router->map( 'GET', '/sc-panel/statistics',  'Controllers\Scpanel\ScpanelStatsController@show', 'admin_statistics');
	
	
	// Map Shopping List
	$router->map('GET', '/sc-panel/shopping_lists', 'Controllers\Scpanel\ScpanelShoppingCartController@show', 'admin_show_shopping_list');
	
	// Map Admin General Settings
	$router->map( 'GET', '/sc-panel/general_settings',  'Controllers\Scpanel\ScpanelSettingsController@showGeneral', 'admin_general_settings');
	$router->map( 'POST', '/sc-panel/general_settings',  'Controllers\Scpanel\ScpanelSettingsController@storeGeneral', 'admin_store_general_settings');
	
	// Map Payment Settings
	$router->map('GET', '/sc-panel/payment_settings', 'Controllers\Scpanel\ScpanelSettingsController@showPayment', 'admin_show_payment_settings');
	$router->map( 'POST', '/sc-panel/payment_settings',  'Controllers\Scpanel\ScpanelSettingsController@storePayment', 'admin_store_payment_settings');
	
	// Map Admin Email Settings
	$router->map( 'GET', '/sc-panel/email_settings',  'Controllers\Scpanel\ScpanelSettingsController@showEmail', 'admin_email_settings');
	$router->map( 'GET', '/sc-panel/email_templates_settings',  'Controllers\Scpanel\ScpanelSettingsController@showEmailTemplates', 'admin_email_templates_settings');
	$router->map( 'POST', '/sc-panel/email_templates_settings',  'Controllers\Scpanel\ScpanelSettingsController@storeEmailTemplates', 'admin_store_email_templates_settings');
	$router->map( 'POST', '/sc-panel/email_settings',  'Controllers\Scpanel\ScpanelSettingsController@storeEmail', 'admin_store_email_settings');
	$router->map( 'POST', '/sc-panel/email_test_message',  'Controllers\Scpanel\ScpanelSettingsController@sendTestMessage', 'admin_email_test_message');
	
	
	// Map Admin Social Settings
	$router->map( 'GET', '/sc-panel/social_settings',  'Controllers\Scpanel\ScpanelSettingsController@showSocial', 'admin_social_settings');
	$router->map( 'POST', '/sc-panel/social_settings',  'Controllers\Scpanel\ScpanelSettingsController@storeSocial', 'admin_store_social_settings');

	
	// Map Admin Logging Settings
	$router->map( 'GET', '/sc-panel/logging_settings',  'Controllers\Scpanel\ScpanelSettingsController@showLogging', 'admin_logging_settings');
	$router->map( 'POST', '/sc-panel/logging_settings',  'Controllers\Scpanel\ScpanelSettingsController@storeLogging', 'admin_store_logging_settings');

	
	// Map Install path
	$router->map('GET', '/sc-panel/install', '\Controllers\Scpanel\ScpanelContactsInstallController@show', 'show_install_script');