<?php
/*-------------------------------------------------------------------------
# mod_layer_slider - Layer Slider
# -------------------------------------------------------------------------
# @ author    John Gera, George Krupa, Janos Biro, Balint Polgarfi
# @ copyright Copyright (C) 2015 Offlajn.com  All Rights Reserved.
# @ license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# @ website   http://www.offlajn.com
-------------------------------------------------------------------------*/
?><?php
defined('_JEXEC') or die;

require_once JPATH_ADMINISTRATOR.'/components/com_layer_slider/helpers/wp_helper.php';

if (jols_get_option('load_fonts_dynamic', 0)) {
	$GLOBALS['ls-google-fonts'] = jols_get_option('ls-google-fonts', array());
	$GLOBALS['ls-google-subsets'] = jols_get_option('ls-google-font-scripts', array('latin', 'latin-ext'));
	$GLOBALS['ls-fonts'] = array();
} else {
	ls_load_google_fonts();
}

/********************************************************/
/*                        MISC                          */
/********************************************************/

function layerslider_check_unit($str) {

	if(strstr($str, 'px') == false && strstr($str, '%') == false) {
		return $str.'px';
	} else {
		return $str;
	}
}

function layerslider_convert_urls($arr) {

	// Layer BG
	if(strpos($arr['properties']['background'], 'http://') !== false) {
		$arr['properties']['background'] = parse_url($arr['properties']['background'], PHP_URL_PATH);
	}

	// Layer Thumb
	if(strpos($arr['properties']['thumbnail'], 'http://') !== false) {
		$arr['properties']['thumbnail'] = parse_url($arr['properties']['thumbnail'], PHP_URL_PATH);
	}

	// Image sublayers
	foreach($arr['sublayers'] as $sublayerkey => $sublayer) {

		if($sublayer['type'] == 'img') {
			if(strpos($sublayer['image'], 'http://') !== false) {
				$arr['sublayers'][$sublayerkey]['image'] = parse_url($sublayer['image'], PHP_URL_PATH);
			}
		}
	}

	return $arr;
}
?>