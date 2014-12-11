<?php
/*Commercial theme update*/
require_once(dirname(__FILE__). DIRECTORY_SEPARATOR. 'wpThemeUpdater.php');
if(!defined('S_YOUR_SECRET_HASH_EntireSpace'))
	define('S_YOUR_SECRET_HASH_EntireSpace', 'efef#F#WFOPF#O(0fu3jfi9w08ru0r355r]5[3fkwewfj#mF983f');
add_filter('pre_set_site_transient_update_themes', 'myCheckForThemeUpdateEntireSpace');
// Take over the Theme info screen on WP multisite
add_filter('themes_api', 'myThemeApiCallEntireSpace', 10, 3);
if(!function_exists('myCheckForThemeUpdateEntireSpace')) {
	function myCheckForThemeUpdateEntireSpace($checkedData) {
		if(class_exists('wpThemeUpdater')) {
			return wpThemeUpdater::getInstance()->checkForThemeUpdate($checkedData);
		}
		return $checkedData;
	}
}
if(!function_exists('myThemeApiCallEntireSpace')) {
	function myThemeApiCallEntireSpace($def, $action, $args) {
		if(class_exists('wpThemeUpdater')) {
			return wpThemeUpdater::getInstance()->myThemeApiCall($def, $action, $args);
		}
		return $def;
	}
}
/*****/
if(class_exists('frame')) {require_once (TEMPLATEPATH . '/theme-functions.php'); }

?>