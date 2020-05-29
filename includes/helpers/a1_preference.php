<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: showcase_app
	 * Date: 06/06/2018
	 * Time: 10:19
	 */
	
	function sca_get_preference($section, $key){
		return \Classes\Core\Preference::instance()->get($section, $key) ? \Classes\Core\Preference::instance()->get($section, $key) : false;
	}
	
	function sca_has_preference($section, $key){
		return (\Classes\Core\Preference::instance()->has($section, $key)) ? true : false;
	}
	
	function sca_set_preference($section, $key, $value, $type='STRING'){
		
		return \Classes\Core\Preference::instance()->set($section, $key, $value, $type);
	}
	
	function sca_remove_preference($section, $key){
		return \Classes\Core\Preference::instance()->remove($section, $key);
	}