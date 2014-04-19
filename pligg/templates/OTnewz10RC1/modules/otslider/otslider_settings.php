<?php
define('otsliderPath', my_pligg_base . '/modules/otslider/');
if(!defined('otsliderLangLoc')) {
	$pos = strrpos($_SERVER["SCRIPT_NAME"], "/");
	$path = substr($_SERVER["SCRIPT_NAME"], 0, $pos);
	if ($path == "/") {
		$path = "";
	}
	if($path != my_pligg_base) {
		define('otsliderLangLoc', '..');
	}
	else {
		define('otsliderLangLoc', '.');
	}
}
define('otsliderSettingsPath', my_pligg_base . '/module.php?module=otslider');
define('otsliderLangConf', otsliderLangLoc . '/modules/otslider/lang.conf');
define('otsliderPliggLangConf', otsliderLangLoc . "/languages/lang_" . pligg_language . ".conf");
define('otsliderTplPath', '../modules/otslider/templates/');

if(isset($main_smarty) && is_object($main_smarty)) {
	$main_smarty->assign('otsliderPath', otsliderPath);
	$main_smarty->assign('otsliderSettingsPath', otsliderSettingsPath);
	$main_smarty->assign('otsliderLangConf', otsliderLangConf);
	$main_smarty->assign('otsliderPliggLangConf', otsliderPliggLangConf);
	$main_smarty->assign('otsliderTplPath', otsliderTplPath);
}
?>