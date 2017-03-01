<?php
/*-------------------------------------------------------------------------
# com_layer_slider - com_layer_slider
# -------------------------------------------------------------------------
# @ author    John Gera, George Krupa, Janos Biro, Balint Polgarfi
# @ copyright Copyright (C) 2015 Offlajn.com  All Rights Reserved.
# @ license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# @ website   http://www.offlajn.com
-------------------------------------------------------------------------*/
?><?php
defined('_JEXEC') or die;

if(!defined('NL')) { define("NL", "\r\n"); }
if(!defined('TAB')) { define("TAB", "\t"); }

function jols_get_option($option, $default = false) {
	static $settings = null;

	if (!$settings) {
		$db = JFactory::getDbo();
		$db->setQuery('SELECT option_name, option_value FROM #__layerslider_options');
		$settings = $db->loadObjectList('option_name');
	}

	return isset($settings[$option]) ? json_decode($settings[$option]->option_value, true) : $default;
}

function ls_cmsroot($root, $url) {
	return $root && $url[0] == '/' ? $root.$url : $url;
}

function ls_load_google_fonts() {

	// Get font list
	$fonts = jols_get_option('ls-google-fonts', array());
	$scripts = jols_get_option('ls-google-font-scripts', array('latin', 'latin-ext'));

	// Check fonts if any
	if(!empty($fonts) && is_array($fonts)) {
		$lsFonts = array();
		foreach($fonts as $item) {
			if(!$item['admin']) {
				$lsFonts[] = $item['param'];
			} else {
				$lsFonts[] = $item['param'];
			}
		}
		$lsFonts = implode('%7C', $lsFonts);
		$protocol = JURI::getInstance()->getScheme();
		$query_args = array(
			'family' => $lsFonts,
			'subset' => implode('%2C', $scripts),
		);

		$doc = JFactory::getDocument();
		$doc->addCustomTag( '<link id="ls-google-fonts-css" media="all" type="text/css" href="'.$protocol.'://fonts.googleapis.com/css?family='.$query_args['family'].'&subset='.$query_args['subset'].'" rel="stylesheet">' );
	}
}

function ls_add_google_fonts(&$fonts, &$scripts) {

	// Check fonts if any
	if(!empty($fonts) && is_array($fonts)) {
		$lsFonts = array();
		foreach($fonts as $item) {
			if(!$item['admin']) {
				$lsFonts[] = $item['param'];
			} else {
				$lsFonts[] = $item['param'];
			}
		}
		$lsFonts = implode('%7C', $lsFonts);
		$protocol = JURI::getInstance()->getScheme();
		$query_args = array(
			'family' => $lsFonts,
			'subset' => implode('%2C', $scripts),
		);

		$doc = JFactory::getDocument();
		$exists = false;
		$tag = '<link id="ls-google-fonts-css" media="all" type="text/css" href="'.$protocol.'://fonts.googleapis.com/css?family='.$query_args['family'].'&subset='.$query_args['subset'].'" rel="stylesheet">';
		foreach ($doc->_custom as &$custom) {
			if (substr($custom, 10, 19) == 'ls-google-fonts-css') {
				$exists = true;
				$custom = $tag;
			}
		}
		if (!$exists) $doc->addCustomTag($tag);
	}
}

function jols__($a, $b){
	$key = 'COM_LAYER_SLIDER_'.strtoupper(md5($a));
	$out = JText::_($key);
	return $key == $out ? $a : $out;
}

function jols_has_filter() {
	return false;
}

function jols_upload_dir() {
	return array("basedir" => JPATH_SITE."/images", "baseurl" => JURI::root()."images");
}

?>