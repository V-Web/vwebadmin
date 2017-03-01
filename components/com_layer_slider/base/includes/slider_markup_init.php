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

$slider = array();

// Filter to override the defaults
if(jols_has_filter('layerslider_override_defaults')) {
	$newDefaults = apply_filters('layerslider_override_defaults', $lsDefaults);
	if(!empty($newDefaults) && is_array($newDefaults)) {
		$lsDefaults = $newDefaults;
		unset($newDefaults);
	}
}

// Hook to alter slider data *before* filtering with defaults
if(jols_has_filter('layerslider_pre_parse_defaults')) {
	$result = apply_filters('layerslider_pre_parse_defaults', $slides);
	if(!empty($result) && is_array($result)) {
		$slides = $result;
	}
}


// Filter slider data with defaults
$slides['properties'] = apply_filters('ls_parse_defaults', $lsDefaults['slider'], $slides['properties']);
$slides['properties']['attrs']['skinsPath'] = LS_ROOT_URL.'/static/skins/';
if(isset($slides['properties']['autoPauseSlideshow'])) {
	switch($slides['properties']['autoPauseSlideshow']) {
		case 'auto': $slides['properties']['autoPauseSlideshow'] = 'auto'; break;
		case 'enabled': $slides['properties']['autoPauseSlideshow'] = true; break;
		case 'disabled': $slides['properties']['autoPauseSlideshow'] = false; break;
	}
}

// Slides and layers
if(isset($slides['layers']) && is_array($slides['layers'])) {
	foreach($slides['layers'] as $slidekey => $slide) {
		$slider['slides'][$slidekey] = apply_filters('ls_parse_defaults', $lsDefaults['slides'], $slide['properties']);
		if(isset($slide['sublayers']) && is_array($slide['sublayers'])) {
			foreach($slide['sublayers'] as $layerkey => $layer) {
				if(!empty($layer['transition'])) {
					$layer = array_merge($layer, json_decode(stripslashes($layer['transition']), true));
				}
				$slider['slides'][$slidekey]['layers'][$layerkey] = apply_filters('ls_parse_defaults', $lsDefaults['layers'], $layer);
			}
		}
	}
}

// Hook to alter slider data *after* filtering with defaults
if(jols_has_filter('layerslider_post_parse_defaults')) {
	$result = apply_filters('layerslider_post_parse_defaults', $slides);
	if(!empty($result) && is_array($result)) {
		$slides = $result;
	}
}

$root = isset($slides['properties']['props']['cmsrelativeurls']) ? rtrim(JURI::root(true), '/') : '';
if (!empty($slides['properties']['attrs']['globalBGImage']))
	$slides['properties']['attrs']['globalBGImage'] = ls_cmsroot($root, $slides['properties']['attrs']['globalBGImage']);
if (!empty($slides['properties']['attrs']['yourLogo']))
	$slides['properties']['attrs']['yourLogo'] = ls_cmsroot($root, $slides['properties']['attrs']['yourLogo']);

// Get init code
foreach($slides['properties']['attrs'] as $key => $val) {

	if(is_bool($val)) {
		$val = $val ? 'true' : 'false';
		$init[] = $key.': '.$val;
	} elseif(is_numeric($val)) { $init[] = $key.': '.$val;
	} elseif(substr($key, 0, 2) == 'cb' && empty($val)) { continue;
	} elseif(strpos($val, 'function(') === 0) { $init[] = $key.': '.$val;
	} else { $init[] = "$key: '$val'"; }
}
$init = implode(', ', $init);
/*
// Fix multiple jQuery issue
$data[] = '<script type="text/javascript">';
$data[] = 'var lsjQuery = jQuery;';
// $data[] = "var curSkin = '{$slides['properties']['attrs']['skin']}';";
$data[] = '</script>';
*/
// Include JS files to body option
if(jols_get_option('ls_put_js_to_body', false)) {
    $data[] = '<script type="text/javascript" src="'.LS_ROOT_URL.'/static/js/layerslider.kreaturamedia.js?ver='.LS_PLUGIN_VERSION.'"></script>' . NL;
    $data[] = '<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.2/TweenMax.min.js"></script>' . NL;
}

$data[] = '<script type="text/javascript">' . NL;
	$data[] = '(window.lsjq||jQuery)(document).ready(function($) {' . NL;
		$data[] = 'if(typeof $.fn.layerSlider == "undefined") { lsShowNotice(\'layerslider_'.$id.'\',\'jquery\'); }' . NL;
		$data[] = 'else {' . NL;
			$data[] = '$("#layerslider_'.$id.'").layerSlider({'.$init.'})' . NL;
		$data[] = '}' . NL;
	$data[] = '});' . NL;
$data[] = '</script>';


