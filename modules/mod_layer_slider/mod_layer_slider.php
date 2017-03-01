<?php
/*-------------------------------------------------------------------------
# mod_layer_slider - Layer Slider
# -------------------------------------------------------------------------
# @ author    John Gera, George Krupa, Janos Biro, Balint Polgarfi
# @ copyright Copyright (C) 2015 Offlajn.com  All Rights Reserved.
# @ license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# @ website   http://www.offlajn.com
-------------------------------------------------------------------------*/
$revision = '5.5.291';
$revision = '5.5.291';
?><?php
defined('_JEXEC') or die;

if (!defined('LS_ROOT_PATH')) define("LS_ROOT_PATH", JPATH_SITE."/components/com_layer_slider/base/");
if (!defined('LS_ROOT_URL')) define("LS_ROOT_URL", JURI::root()."components/com_layer_slider/base/" );

$GLOBALS['j25'] = version_compare(JVERSION, '3.0.0', 'l');

require_once JPATH_SITE.'/components/com_layer_slider/base/wp/hooks.php';
require_once JPATH_SITE.'/components/com_layer_slider/base/classes/class.ls.sliders.php';
require_once dirname(__FILE__).'/layer_slider_helper.php';

$root = rtrim(JURI::root(true), '/');

$document = JFactory::getDocument();

if ($GLOBALS['j25']) {
  if (jols_get_option('load_jquery', false)) {
    $document->addScript(JURI::getInstance()->getScheme() . '://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js');
    $document->addScript($root . '/media/offlajn/jquery.noconflict.js');
  }
}
else JHtml::_('jquery.framework');

$document->addScript('https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.2/TweenMax.min.js');
if (jols_get_option('load_uncompressed', false)) {
	$document->addScript($root . '/components/com_layer_slider/base/static/js/layerslider.kreaturamedia.js?v='.@$revision);
	$document->addScript($root . '/components/com_layer_slider/base/static/js/layerslider.transitions.js?v='.@$revision);
	$document->addStyleSheet($root . '/components/com_layer_slider/base/static/css/layerslider.css?v='.@$revision);
} else {
	$document->addScript($root . '/components/com_layer_slider/base/static/js/layerslider.kreaturamedia.min.js?v='.@$revision);
	$document->addScript($root . '/components/com_layer_slider/base/static/js/layerslider.transitions.min.js?v='.@$revision);
	$document->addStyleSheet($root . '/components/com_layer_slider/base/static/css/layerslider.min.css?v='.@$revision);
}

// User resources
$uploads = jols_upload_dir();
if(file_exists($uploads['basedir'].'/layerslider.custom.transitions.js')) {
  $document->addCustomTag( '<script id="ls-user-transitions" src="'.$uploads['baseurl'].'/layerslider.custom.transitions.js" type="text/javascript" ></script>' );
}

if(file_exists($uploads['basedir'].'/layerslider.custom.css')) {
  $document->addCustomTag( '<link id="ls-user-css" href="'.$uploads['baseurl'].'/layerslider.custom.css" type="text/css" rel="stylesheet" ></link>' );
}


$id = $params->get('slider',0);

if(!($slider = LS_Sliders::find($id)) || $slider['flag_deleted']) {
	return '[LayerSlider] '.jols__('Slider not found', 'LayerSlider').'';
}

// Slider and markup data
$slides = $slider['data'];
$data = '';

// Include slider file
if(is_array($slides)) {

	// Get phpQuery
	if(!class_exists('phpQuery')) {
		libxml_use_internal_errors(true);
		include LS_ROOT_PATH.'/helpers/phpQuery.php';
	}

	include LS_ROOT_PATH.'/config/defaults.php';
	include LS_ROOT_PATH.'/includes/slider_markup_init.php';
	include LS_ROOT_PATH.'/includes/slider_markup_html.php';
	$data = implode('', $data);

	// dynamic google font loading
	if (isset($GLOBALS['ls-fonts'])) {
		$fonts = array();
		foreach ($GLOBALS['ls-google-fonts'] as $font) {
			list($family) = explode(':', $font['param']);
			$family = strtolower($family);

			foreach (array_keys($GLOBALS['ls-fonts']) as $fontfamily) {
				if ($fontfamily == $family) {
					$fonts[] = $font;
					break;
				}
			}
		}
		ls_add_google_fonts($fonts, $GLOBALS['ls-google-subsets']);
	}

}

if (jols_get_option('load_module', 0)) {
	echo JHtml::_('content.prepare', $data);
} else {
	echo $data;
}

?>

