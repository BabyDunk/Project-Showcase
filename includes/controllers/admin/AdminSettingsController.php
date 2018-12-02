<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: showcase_app
	 * Date: 06/06/2018
	 * Time: 10:37
	 */
	
	namespace Controllers\Admin;
	
	
	use Classes\Core\Params;
	use Classes\Core\Preference;
	use Classes\Core\Session;
	
	class AdminSettingsController
	{
		
		
		
		public function showGeneral(  )
		{
			
			adminView('general-settings', ['userid'=>Session::instance()->user_id]);
			Session::clear('MESSAGE');
		}
		
		public function storeGeneral(  )
		{
			$post = Params::get('post');
			
			
			if(Params::has('submit')){
				//var_dump(sca_set_preference('showcase', 'sca_sitename', $post->sitename));exit;
				sca_set_preference('showcase', 'sca_sitename', $post->sitename);
				sca_set_preference('showcase', 'sca_siteurl', $post->siteurl);
				sca_set_preference('showcase', 'sca_sitetitle', $post->sitetitle);
				sca_set_preference('showcase', 'sca_sitesubtitle', $post->sitesubtitle);
				sca_set_preference('showcase', 'sca_sitecontact', $post->sitecontact);
				sca_set_preference('showcase', 'sca_sitenumber', $post->sitenumber);
				sca_set_preference('showcase', 'sca_sitedescriptionshort', $post->sitedescriptionshort);
				sca_set_preference('showcase', 'sca_sitedescriptionfull', $post->sitedescriptionfull);
				sca_set_preference('showcase', 'sca_contacttitle', $post->contacttitle);
				sca_set_preference('showcase', 'sca_howmanyfrontfeatured', $post->howmanyfrontfeatured, 'INTEGER');
				sca_set_preference('showcase', 'sca_howmanyfrontfeaturedimg', $post->howmanyfrontfeaturedimg, 'INTEGER');
				sca_set_preference('showcase', 'sca_whichorderfeaturedimg', $post->whichorderfeaturedimg, 'INTEGER');
				sca_set_preference('showcase', 'sca_whichorderfeatured', $post->whichorderfeatured, 'INTEGER');
				sca_set_preference('showcase', 'sca_contactdescription', allowedTags($post->contactdescription));
				sca_set_preference('showcase', 'sca_frontinfoslider1', allowedTags($post->frontinfoslider1));
				sca_set_preference('showcase', 'sca_frontinfoslider2', allowedTags($post->frontinfoslider2));
				sca_set_preference('showcase', 'sca_frontinfoslider3', allowedTags($post->frontinfoslider3));
				sca_set_preference('showcase', 'sca_frontinfoslider4', allowedTags($post->frontinfoslider4));
				
				adminView('general-settings', ['userid'=>Session::instance()->user_id, 'message'=> 'Settings saved successfully']);
			}else{
				adminView('general-settings', ['userid'=>Session::instance()->user_id, 'error'=> 'Something went wrong, please try again']);
			}
			
		}
		
		public function showEmail(  )
		{
			
			adminView('email-settings', ['userid'=>Session::instance()->user_id]);
			Session::clear('MESSAGE');
		}
		
		public function storeEmail(  )
		{
			$post = Params::get('post');
			
			if(Params::has('submit')){
				sca_set_preference('showcase', 'sca_emailtitle', $post->emailtitle);
				sca_set_preference('showcase', 'sca_emailname', $post->emailname);
				sca_set_preference('showcase', 'sca_emailserver', $post->emailserver);
				sca_set_preference('showcase', 'sca_emailgateway', $post->emailgateway);
				sca_set_preference('showcase', 'sca_emailgatewaypass', $post->emailgatewaypass);
				sca_set_preference('showcase', 'sca_emailencryption', trim($post->emailencryption));
				sca_set_preference('showcase', 'sca_emailserverport', trim($post->emailserverport));
				sca_set_preference('showcase', 'sca_emailauth', $post->emailauth, 'INTEGER');
				sca_set_preference('showcase', 'sca_emailsignature', $post->emailsignature);
				
				adminView('email-settings', ['userid'=>Session::instance()->user_id, 'message'=> 'Settings saved successfully']);
			}else{
				adminView('email-settings', ['userid'=>Session::instance()->user_id, 'error'=> 'Something went wrong, please try again']);
			}
			
		}
		
		public function showSocial(  )
		{
			
			adminView('social-settings', ['userid'=>Session::instance()->user_id]);
			Session::clear('MESSAGE');
		}
		
		public function storeSocial(  )
		{
			$post = Params::get('post');

		
			// TODO: create function to upload files
			if(!empty(Params::get( 'file')->fb_default_img->name)){
				$input = "YesHasFile4";
			} else{
				
				$input =	!empty(sca_get_preference('showcase', 'sca_fb_default_img')) ? sca_get_preference('showcase', 'sca_fb_default_img') : '';
			}
			
			if(Params::has('submit')){
				sca_set_preference('showcase', 'sca_fb_app_id', notEmpty($post->fb_app_id));
				sca_set_preference('showcase', 'sca_fb_app_secret', notEmpty($post->fb_app_secret));
				sca_set_preference('showcase', 'sca_fb_page_id', notEmpty($post->fb_page_id));
				sca_set_preference('showcase', 'sca_fb_post_message', notEmpty($post->fb_post_message));
				sca_set_preference('showcase', 'sca_fb_enabler', notEmpty($post->fb_enabler), 'INTEGER');
				sca_set_preference('showcase', 'sca_fb_default_img', $input);
				
				adminView('social-settings', ['userid'=>Session::instance()->user_id, 'message'=> 'Settings saved successfully']);
			}else{
				adminView('social-settings', ['userid'=>Session::instance()->user_id, 'error'=> 'Something went wrong, please try again']);
			}
			
		}
		
		
	}