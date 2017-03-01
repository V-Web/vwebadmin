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

// Full-width slider
if(isset($slides['properties']['props']['forceresponsive'])) {
	$slider_height = isset($slides['properties']['attrs']['fullPage']) ? '100vh' : layerslider_check_unit($slides['properties']['props']['height']);
	$data[] = '<div class="ls-wp-fullwidth-container" style="height:'.$slider_height.';">';
	$data[] = '<div class="ls-wp-fullwidth-helper">';
}

// Get slider style
$sliderStyleAttr[] = 'width:'.layerslider_check_unit($slides['properties']['props']['width']).';';
$sliderStyleAttr[] = 'height:'.layerslider_check_unit($slides['properties']['props']['height']).';';

if(!empty($slides['properties']['props']['maxwidth'])) {
	$sliderStyleAttr[] = 'max-width:'.layerslider_check_unit($slides['properties']['props']['maxwidth']).';';
}

$sliderStyleAttr[] = 'margin:0 auto;';
if(isset($slides['properties']['props']['sliderStyle'])) {
	$sliderStyleAttr[] = $slides['properties']['props']['sliderStyle'];
}

// Before slider content hook
/*if(has_action('layerslider_before_slider_content')) {
	do_action('layerslider_before_slider_content');
}*/

// Start of slider container
$data[] = '<div id="layerslider_'.$id.'" class="ls-wp-container" style="'.implode('', $sliderStyleAttr).'">';

$gen = "imagesfromfolder";
if(isset($slides['properties']['props']['generator_type'])){
  $gen = $slides['properties']['props']['generator_type'];
}

if(is_dir(JPATH_ADMINISTRATOR.'/components/com_layer_slider/generators/'.$gen)){

  if (is_file(JPATH_ADMINISTRATOR.'/components/com_layer_slider/generators/'.$gen.'/generator.php')){
    require_once JPATH_ADMINISTRATOR.'/components/com_layer_slider/generators/'.$gen.'/generator.php';
    $class = 'OfflajnGenerator_'.$gen;
    $generator = new $class($slides['properties']['props']);
  }
}
$postContent = $generator;
// Add slides
if(!empty($slider['slides']) && is_array($slider['slides'])) {
	foreach($slider['slides'] as $slidekey => $slide) {

		// Skip this slide?
		if(isset($slide['props']['skip'])) { continue; }

		// Get slide attributes
		$slideId = !empty($slide['props']['id']) ? ' id="'.$slide['props']['id'].'"' : '';
		$slideAttrs = !empty($slide['attrs']) ? ls_array_to_attr($slide['attrs']) : '';
//		$postContent = false;

		// No transition selected
		if(empty($slide['attrs']['transition2d']) && empty($slide['attrs']['transition3d'])) {
			if(empty($slide['attrs']['customtransition2d']) && empty($slide['attrs']['customtransition3d'])) {
				$slideAttrs .= ' transition2d: all;';
			}
		}

		// Post content
		$queryArgs = array( 'post_status' => 'publish', 'limit' => 30, 'posts_per_page' => 30 );

		if(isset($slide['props']['post_offset'])) {
			if($slide['props']['post_offset'] == -1) {
				$slide['props']['post_offset'] = $slidekey;
			}

			$queryArgs['offset'] = $slide['props']['post_offset'];
		}

		if(!empty($slides['properties']['props']['post_type'])) {
			$queryArgs['post_type'] = $slides['properties']['props']['post_type']; }

		if(!empty($slides['properties']['props']['post_orderby'])) {
			$queryArgs['orderby'] = $slides['properties']['props']['post_orderby']; }

		if(!empty($slides['properties']['props']['post_order'])) {
			$queryArgs['order'] = $slides['properties']['props']['post_order']; }

		if(!empty($slides['properties']['props']['post_categories'][0])) {
			$queryArgs['category__in'] = $slides['properties']['props']['post_categories']; }

		if(!empty($slides['properties']['props']['post_tags'][0])) {
			$queryArgs['tag__in'] = $slides['properties']['props']['post_tags']; }

		if(!empty($slides['properties']['props']['post_taxonomy']) && !empty($slides['properties']['props']['post_tax_terms'])) {
			$queryArgs['tax_query'][] = array(
				'taxonomy' => $slides['properties']['props']['post_taxonomy'],
				'field' => 'id',
				'terms' => $slides['properties']['props']['post_tax_terms']
			);
		}

		$postContent->setSliderCounter($queryArgs['offset']);
		//$postContent = LS_Posts::find($queryArgs);

		// Start of slide

		$slideAttrs = !empty($slideAttrs) ? 'data-ls="'.$slideAttrs.'"' : '';
		$data[] = '<div class="ls-slide"'.$slideId.' '.$slideAttrs.'>';

		// Add slide background
		if(!empty($slide['props']['background'])) {
			if(!empty($slide['props']['backgroundId'])) {
				$src = apply_filters('ls_get_image', $slide['props']['backgroundId'], $slide['props']['background']);
				$src = ls_cmsroot($root, $src);
				$alt = get_post_meta($slide['props']['backgroundId'], '_wp_attachment_image_alt', true);
				$alt = empty($alt) ? get_the_title($slide['props']['backgroundId']) : $alt;
				$alt = empty($alt) ? 'Slide background' : $alt;
			} elseif($slide['props']['background'] == '[image-url]') {
				$src = $postContent->getWithFormat($slide['props']['background']);

				if(is_object($postContent->post)) {
					$attchID = get_post_thumbnail_id($postContent->post->ID);
					$alt = get_post_meta($attchID, '_wp_attachment_image_alt', true);
					$alt = empty($alt) ? get_the_title($attchID) : $alt;
					$alt = empty($alt) ? get_the_title($postContent->post->ID) : $alt;
					$alt = empty($alt) ? 'Slide background' : $alt;
				}else{
					$alt = $postContent->getWithFormat('[title]');
					$alt = empty($alt) ? 'Slide background' : $alt;
        }
			} else {
				$src = $slide['props']['background'];
				$src = ls_cmsroot($root, $src);
				$alt = isset($slide['props']['imgalt']) ? $slide['props']['imgalt'] : 'Slide background';
			}


			$data[] = '<img src="'.LS_ROOT_URL.'/static/img/blank.gif" data-src="'.$src.'" class="ls-bg" alt="'.$alt.'" />';
		}

		// Add slide thumbnail
		if(!isset($slides['properties']['attrs']['thumbnailNavigation']) || $slides['properties']['attrs']['thumbnailNavigation'] != 'disabled') {
			if(!empty($slide['props']['thumbnail'])) {
				$src = !empty($slide['props']['thumbnailId']) ? apply_filters('ls_get_image', $slide['props']['thumbnailId'], $slide['props']['thumbnail']) : $slide['props']['thumbnail'];
				$src = ls_cmsroot($root, $src);
				$data[] = '<img src="'.LS_ROOT_URL.'/static/img/blank.gif" data-src="'.$src.'" class="ls-tn" alt="Slide thumbnail" />';
			}
		}

		// Add layers
		if(!empty($slide['layers']) && is_array($slide['layers'])) {
			foreach($slide['layers'] as $layerkey => $layer) {

				// Skip this slide?
				if(isset($layer['props']['skip'])) { continue; }

				// JText support
				if(!empty($layer['props']['html']) && preg_match('/^p|h[1-6]$/', $layer['props']['type'])) {
					$layer['props']['html'] = JText::_(trim($layer['props']['html']));
				}

				// Get layer type
				$layer['props']['media'] = !empty($layer['props']['media']) ? $layer['props']['media'] : '';
				if(!empty($layer['props']['media'])) {
					switch($layer['props']['media']) {
						case 'img': $layer['props']['type'] = 'img'; break;
						case 'html': $layer['props']['type'] = 'div'; break;
						case 'post': $layer['props']['type'] = 'div'; break;
					}
				}

				// Post layer
				if(!empty($layer['props']['media']) && $layer['props']['media'] == 'post') {
					$layer['props']['post_text_length'] = !empty($layer['props']['post_text_length']) ? $layer['props']['post_text_length'] : 0;
					$layer['props']['html'] = $postContent->getWithFormat($layer['props']['html'], $layer['props']['post_text_length']);
				}

				// Skip image layer without src
				if($layer['props']['type'] == 'img' && empty($layer['props']['image'])) { continue; }

				// Create layer
				$html = trim($layer['props']['html']);

				if($layer['props']['media'] == 'post' && preg_match('/^<[^>]+>$/', $html)) {
					$type = $layer['props']['html'];
				} else {
					$type = '<'.$layer['props']['type'].'>';
				}

				if(!empty($layer['props']['url']) && !preg_match('/^\#[0-9]/', $layer['props']['url'])) {
					$el = phpQuery::newDocumentHTML('<a>')->children();
					if($layer['props']['url'] == '[url]') {
						$layer['props']['url'] = $postContent->getWithFormat($layer['props']['url']);
					}
					$el->attr('href', $layer['props']['url']);
					if(!empty($layer['props']['target'])) {
						$el->attr('target', $layer['props']['target']); }

					$inner = $el->append($type)->children();
				} else {
					$el = $inner = phpQuery::newDocumentHTML($type)->children();
				}

				// HTML attributes
				$level = isset($layer['props']['level']) ? $layer['props']['level'] : '';
				$el->addClass('ls-l'.$level);
				if(!empty($layer['props']['id'])) { $inner->attr('id', $layer['props']['id']); }
				if(!empty($layer['props']['class'])) { $inner->addClass($layer['props']['class']); }
				if(!empty($layer['props']['url'])) {
					if(!empty($layer['props']['rel'])) {
						$el->attr('rel', $layer['props']['rel']); }
					if(!empty($layer['props']['title'])) {
						$el->attr('title', $layer['props']['title']); }
				} else {
					if(!empty($layer['props']['title'])) {
						$inner->attr('title', $layer['props']['title']); }
				}

				// Transition & style
				$el->attr('style', 'top:'.layerslider_check_unit($layer['props']['top']).';');
				$el->attr('style', $el->attr('style') . 'left:'.layerslider_check_unit($layer['props']['left']).';');

				if(isset($layer['attrs']) && isset($layer['props']['transition'])) { $el->attr('data-ls', ls_array_to_attr($layer['attrs'])); }
					elseif(isset($layer['attrs'])) { $el->attr('style', $el->attr('style') . ls_array_to_attr($layer['attrs'])); }

				if(!empty($layer['props']['style'])) {
					if(substr($layer['props']['style'], -1) != ';') { $layer['props']['style'] .= ';'; }
					$inner->attr('style', $inner->attr('style') . preg_replace('/\s\s+/', ' ', $layer['props']['style']));
				}

				if(!empty($layer['props']['styles'])) {
					$layerStyles = json_decode($layer['props']['styles'], true);
					if($layerStyles === null) { $layerStyles = json_decode(stripslashes($layer['props']['styles']), true);  }

					// fix for custom background styles
					if (!empty($layerStyles['background'])) {
						$layerStyles['background-color'] = $layerStyles['background'];
						unset($layerStyles['background']);
					}

					$inner->attr('style', $inner->attr('style') . ls_array_to_attr($layerStyles, 'css'));

					// Collect first font families
					if (isset($GLOBALS['ls-fonts']) && !empty($layerStyles['font-family'])) {
						list($family) = explode(',', $layerStyles['font-family']);
						$family = preg_replace('/[^\w ]/', '', trim($family) );
						$family = strtolower( str_replace(' ', '+', $family) );
						if ($family) $GLOBALS['ls-fonts'][$family] = true;
					}
				}

				if(empty($layer['props']['wordwrap'])) {
					$inner->attr('style', $inner->attr('style') . 'white-space: nowrap;');
				}

				// Link to slides
				if(!empty($layer['props']['url']) && preg_match('/^\#[0-9]/', $layer['props']['url'])) {
					$el->addClass('ls-linkto-'.substr($layer['props']['url'], 1));
				}

				// Image layer
				if($layer['props']['type'] == 'img') {
					$inner->attr('src', LS_ROOT_URL.'/static/img/blank.gif');
					$inner->attr('src', LS_ROOT_URL.'/static/img/blank.gif');

					if($layer['props']['image'] == '[image-url]') {
						$src = $postContent->getWithFormat($layer['props']['image']);
					} else {
						$src = !empty($layer['props']['imageId']) ? apply_filters('ls_get_image', $layer['props']['imageId'], $layer['props']['image']) : $layer['props']['image'];
						$src = ls_cmsroot($root, $src);
					}
					$inner->attr('data-src', $src);

					if(!empty($layer['props']['alt'])) {
						$inner->attr('alt', $layer['props']['alt']); }
							else { $inner->attr('alt', ''); }

				// Text / HTML layer
				} elseif($layer['props']['media'] != 'post' || !preg_match('/^<[^>]+>$/', $html)) {
					$inner->html(stripslashes($layer['props']['html']));
				}

				$data[] = $el;
			}
		}

		// Link this slide
		if(!empty($slide['props']['linkUrl'])) {
			if(!empty($slide['props']['linkTarget'])) {
				$target = ' target="'.$slide['props']['linkTarget'].'"'; } else { $target = '';
			}

			if($slide['props']['linkUrl'] == '[url]') {
				$slide['props']['linkUrl'] = $postContent->getWithFormat($slide['props']['linkUrl']);
			}

			$data[] = '<a href="'.$slide['props']['linkUrl'].'"'.$target.' class="ls-link"></a>';
		}

		// End of slide
		$data[] = '</div>';
	}
}

// End of slider container
$data[] = '</div>';

// Full-width slider
if(isset($slides['properties']['props']['forceresponsive'])) {
	$data[] = '</div>';
	$data[] = '</div>';
}

// After slider content hook
/*if(has_action('layerslider_after_slider_content')) {
	do_action('layerslider_after_slider_content');
} */

?>
