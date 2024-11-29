<?php
class LanguageLoader {
	function initialize() {
		$CI =& get_instance();
		$CI->load->helper('language');
		$site_lang = $CI->input->cookie('site_lang', TRUE);
		if ($site_lang) {
           $CI->lang->load('global', $site_lang);
		   $CI->lang->load('payment', $site_lang);
		   $CI->lang->load('file', $site_lang);
		   $CI->lang->load('front', $site_lang);
		   $CI->lang->load('menu_lang', $site_lang); 
		   $CI->lang->load('cmp_lang', $site_lang);
		   $CI->lang->load('package_lang', $site_lang);
		   $CI->lang->load('requirement_lang', $site_lang);
		   $CI->lang->load('post_lang', $site_lang);
		   $CI->lang->load('event_lang', $site_lang);
		   $CI->lang->load('recognition_lang', $site_lang);
		   $CI->lang->load('master_lang', $site_lang);
		   $CI->lang->load('buddymeet_lang', $site_lang);
		   $CI->lang->load('followup_lang', $site_lang);
		   $CI->lang->load('users_lang', $site_lang);
		   $CI->lang->load('reward_lang', $site_lang);
		   if (file_exists(FCPATH . 'application/language/' . $site_lang . '/addon_lang.php')) {
			   $CI->lang->load('addon', $site_lang);
		   }
       } else {
           $CI->lang->load('global', $CI->config->item('language'));
		   $CI->lang->load('payment', $CI->config->item('language'));
		   $CI->lang->load('file', $CI->config->item('language'));
		   $CI->lang->load('front', $CI->config->item('language'));
		   $CI->lang->load('menu_lang', $site_lang);
		   $CI->lang->load('cmp_lang', $site_lang);
		   $CI->lang->load('package_lang', $site_lang);
		   $CI->lang->load('requirement_lang', $site_lang);
		   $CI->lang->load('post_lang', $site_lang);
		   $CI->lang->load('event_lang', $site_lang);
		   $CI->lang->load('recognition_lang', $site_lang);
		   $CI->lang->load('master_lang', $site_lang);
		   $CI->lang->load('buddymeet_lang', $site_lang);
		   $CI->lang->load('followup_lang', $site_lang);
		   $CI->lang->load('users_lang', $site_lang);
		   $CI->lang->load('reward_lang', $site_lang);
		   if (file_exists(FCPATH . 'application/language/' . $CI->config->item('language') . '/addon_lang.php')) {
			   $CI->lang->load('addon', $CI->config->item('language'));
		   }
		   
	   }
	}
}
?>