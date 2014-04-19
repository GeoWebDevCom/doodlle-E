<?php
if(defined('mnminclude')) {
	include_once('otslider_settings.php');
	
	$do_not_include_in_pages = array();
	$include_in_pages = array('all');	
	if( do_we_load_module() ) {
		include_once(mnmmodules . 'otslider/otslider_main.php');
		module_add_action_tpl('tpl_header_admin_main_links', otsliderTplPath . 'otsliderAdminLink.tpl');
		module_add_action('index_top', 'otsliderData', '');
	}
	
	$include_in_pages = array('module');
	if(do_we_load_module()) {
		$moduleName = $_REQUEST['module'];
		if($moduleName == 'otslider') {
			include_once(mnmmodules . 'otslider/otslider_main.php');
			
			//$otsliderSettings = getOTsliderSettings();
			
			module_add_action('module_page', 'otsliderShowpage', '');
			module_add_css(otsliderPath . '/templates/assets/styles/admin.css');
		}
	}
}
?>