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
?><!-- Slider title -->
<div class="ls-slider-titlewrap">
	<input type="text" name="title" value="<?php echo $slider['properties']['title'] ?>" id="title" autocomplete="off" placeholder="<?php jols_e('Type your slider name here', 'LayerSlider') ?>">
	<div class="ls-slider-slug">
		Slider slug:<input type="text" name="slug" value="<?php echo !empty($slider['properties']['slug']) ? $slider['properties']['slug'] : '' ?>" id="title" autocomplete="off" placeholder="<?php jols_e('e.g. homepageslider', 'LayerSlider') ?>" data-help="Set a custom slider identifier to use in shortcodes instead of the database ID. Needs to be unique, and can contain only alphanumeric characters. This setting is optional.">
	</div>
</div>

<!-- Slider settings -->
<div class="ls-box ls-settings">
	<h3 class="header medium"><?php jols_e('Slider Settings', 'LayerSlider') ?></h3>
	<div class="inner">
		<ul class="ls-settings-sidebar">
			<li class="active"><i class="dashicons dashicons-editor-distractionfree"></i><?php jols_e('Layout', 'LayerSlider') ?></li>
			<li><i class="dashicons dashicons-editor-video"></i><?php jols_e('Slideshow', 'LayerSlider') ?></li>
			<li class="codemirror"><i class="dashicons dashicons-admin-appearance"></i><?php jols_e('Appearance', 'LayerSlider') ?></li>
			<li><i class="dashicons dashicons-image-flip-horizontal"></i><?php jols_e('Navigation Area', 'LayerSlider') ?></li>
			<li><i class="dashicons dashicons-screenoptions"></i><?php jols_e('Thumbnail Navigation', 'LayerSlider') ?></li>
			<li><i class="dashicons dashicons-images-alt2"></i><?php jols_e('Parallax', 'LayerSlider') ?></li>
			<li><i class="dashicons dashicons-video-alt3"></i><?php jols_e('Videos', 'LayerSlider') ?></li>
			<li><i class="dashicons dashicons-admin-generic"></i><?php jols_e('Misc', 'LayerSlider') ?></li>
			<li class="codemirror"><i class="dashicons dashicons-admin-post"></i><?php jols_e('YourLogo', 'LayerSlider') ?></li>
		</ul>
		<div class="ls-settings-contents">
			<table>

				<!-- Layout -->
				<tbody class="ls-slider-dimensions active">
					<tr><th colspan="3"><?php jols_e('Slider dimensions', 'LayerSlider') ?></th></tr>
					<tr>
						<td colspan="3">
							<div class="ls-slider-size non-responsive"><span>Non-responsive</span></div>
							<div class="ls-slider-size responsive"><span>Responsive</span></div>
							<div class="ls-slider-size full-width"><span>Full-width</span></div>
							<div class="ls-slider-size full-screen"><span>Full-screen</span></div>
						</td>
					</tr>
					<tr>
						<td><?php jols_e($lsDefaults['slider']['layersContainer']['name'], 'LayerSlider') ?></td>
						<td><?php lsGetInput($lsDefaults['slider']['layersContainer'], $slider['properties'], array('id' => 'container-width')) ?></td>
						<td class="desc"><?php jols_e($lsDefaults['slider']['layersContainer']['desc'], 'LayerSlider') ?></td>
					</tr>
					<tr>
						<td><?php jols_e($lsDefaults['slider']['width']['name'], 'LayerSlider') ?></td>
						<td><?php lsGetInput($lsDefaults['slider']['width'], $slider['properties'], array('id' => 'slider-width')) ?></td>
						<td class="desc"><?php jols_e($lsDefaults['slider']['width']['desc'], 'LayerSlider') ?></td>
					</tr>
					<tr>
						<td>
							<label id="slider-height-lbl"><?php jols_e($lsDefaults['slider']['height']['name'], 'LayerSlider') ?></label>
							<label style="display: none;"><?php jols_e('Layers container height', 'LayerSlider') ?></label>
						</td>
						<td><?php lsGetInput($lsDefaults['slider']['height'], $slider['properties'], array('id' => 'container-height')) ?></td>
						<td class="desc"><?php jols_e($lsDefaults['slider']['height']['desc'], 'LayerSlider') ?></td>
					</tr>
					<tr>
						<td><?php jols_e($lsDefaults['slider']['maxWidth']['name'], 'LayerSlider') ?></td>
						<td><?php lsGetInput($lsDefaults['slider']['maxWidth'], $slider['properties'], array('id' => 'max-width')) ?></td>
						<td class="desc"><?php jols_e($lsDefaults['slider']['maxWidth']['desc'], 'LayerSlider') ?></td>
					</tr>
					<tr>
						<td><?php jols_e($lsDefaults['slider']['responsiveUnder']['name'], 'LayerSlider') ?></td>
						<td><?php lsGetInput($lsDefaults['slider']['responsiveUnder'], $slider['properties'], array('id' => 'responsive-under')) ?></td>
						<td class="desc"><?php jols_e($lsDefaults['slider']['responsiveUnder']['desc'], 'LayerSlider') ?></td>
					</tr>
					<tr>
						<td><?php jols_e($lsDefaults['slider']['reduceHeight']['name'], 'LayerSlider') ?></td>
						<td><?php lsGetInput($lsDefaults['slider']['reduceHeight'], $slider['properties'], array('id' => 'reduce-height')) ?></td>
						<td class="desc"><?php jols_e($lsDefaults['slider']['reduceHeight']['desc'], 'LayerSlider') ?></td>
					</tr>
					<tr class="hidden">
						<td><?php jols_e($lsDefaults['slider']['responsiveness']['name'], 'LayerSlider') ?></td>
						<td><?php lsGetCheckbox($lsDefaults['slider']['responsiveness'], $slider['properties']) ?></td>
						<td class="desc"><?php jols_e($lsDefaults['slider']['responsiveness']['desc'], 'LayerSlider') ?></td>
					</tr>
					<tr class="hidden">
						<td><?php jols_e($lsDefaults['slider']['fullWidth']['name'], 'LayerSlider') ?></td>
						<td><?php lsGetCheckbox($lsDefaults['slider']['fullWidth'], $slider['properties']) ?></td>
						<td class="desc"><?php jols_e($lsDefaults['slider']['fullWidth']['desc'], 'LayerSlider') ?></td>
					</tr>
					<tr class="hidden">
						<td><?php jols_e($lsDefaults['slider']['fullPage']['name'], 'LayerSlider') ?></td>
						<td><?php lsGetCheckbox($lsDefaults['slider']['fullPage'], $slider['properties']) ?></td>
						<td class="desc"><?php jols_e($lsDefaults['slider']['fullPage']['desc'], 'LayerSlider') ?></td>
					</tr>
					<tr><th colspan="3"><?php jols_e('Other settings', 'LayerSlider') ?></th></tr>
					<tr>
						<td><?php jols_e($lsDefaults['slider']['hideOnMobile']['name'], 'LayerSlider') ?></td>
						<td><?php lsGetCheckbox($lsDefaults['slider']['hideOnMobile'], $slider['properties']) ?></td>
						<td class="desc"><?php jols_e($lsDefaults['slider']['hideOnMobile']['desc'], 'LayerSlider') ?></td>
					</tr>
					<tr>
						<td><?php jols_e($lsDefaults['slider']['hideUnder']['name'], 'LayerSlider') ?></td>
						<td><?php lsGetInput($lsDefaults['slider']['hideUnder'], $slider['properties']) ?></td>
						<td class="desc"><?php jols_e($lsDefaults['slider']['hideUnder']['desc'], 'LayerSlider') ?></td>
					</tr>
					<tr>
						<td><?php jols_e($lsDefaults['slider']['hideOver']['name'], 'LayerSlider') ?></td>
						<td><?php lsGetInput($lsDefaults['slider']['hideOver'], $slider['properties']) ?></td>
						<td class="desc"><?php jols_e($lsDefaults['slider']['hideOver']['desc'], 'LayerSlider') ?></td>
					</tr>
				</tbody>

				<!-- Slideshow -->
				<tbody>
					<tr><th colspan="3"><?php jols_e('Slideshow behavior', 'LayerSlider') ?></th></tr>
					<tr>
						<td><?php jols_e($lsDefaults['slider']['autoStart']['name'], 'LayerSlider') ?></td>
						<td><?php lsGetCheckbox($lsDefaults['slider']['autoStart'], $slider['properties']) ?></td>
						<td class="desc"><?php jols_e($lsDefaults['slider']['autoStart']['desc'], 'LayerSlider') ?></td>
					</tr>
					<tr>
						<td><?php jols_e($lsDefaults['slider']['startInViewport']['name'], 'LayerSlider') ?></td>
						<td><?php lsGetCheckbox($lsDefaults['slider']['startInViewport'], $slider['properties']) ?></td>
						<td class="desc"><?php jols_e($lsDefaults['slider']['startInViewport']['desc'], 'LayerSlider') ?></td>
					</tr>
					<tr>
						<td><?php jols_e($lsDefaults['slider']['pauseOnHover']['name'], 'LayerSlider') ?></td>
						<td><?php lsGetCheckbox($lsDefaults['slider']['pauseOnHover'], $slider['properties']) ?></td>
						<td class="desc"><?php jols_e($lsDefaults['slider']['pauseOnHover']['desc'], 'LayerSlider') ?></td>
					</tr>
					<tr><th colspan="3"><?php jols_e('Starting slide options', 'LayerSlider') ?></th></tr>
					<tr>
						<td><?php jols_e($lsDefaults['slider']['firstSlide']['name'], 'LayerSlider') ?></td>
						<td><?php lsGetInput($lsDefaults['slider']['firstSlide'], $slider['properties']) ?></td>
						<td class="desc"><?php jols_e($lsDefaults['slider']['firstSlide']['desc'], 'LayerSlider') ?></td>
					</tr>
					<tr>
						<td><?php jols_e($lsDefaults['slider']['animateFirstSlide']['name'], 'LayerSlider') ?></td>
						<td><?php lsGetCheckbox($lsDefaults['slider']['animateFirstSlide'], $slider['properties']) ?></td>
						<td class="desc"><?php jols_e($lsDefaults['slider']['animateFirstSlide']['desc'], 'LayerSlider') ?></td>
					</tr>
					<tr><th colspan="3"><?php jols_e('Slideshow navigation', 'LayerSlider') ?></th></tr>
					<tr>
						<td><?php jols_e($lsDefaults['slider']['keybNavigation']['name'], 'LayerSlider') ?></td>
						<td><?php lsGetCheckbox($lsDefaults['slider']['keybNavigation'], $slider['properties']) ?></td>
						<td class="desc"><?php jols_e($lsDefaults['slider']['keybNavigation']['desc'], 'LayerSlider') ?></td>
					</tr>
					<tr>
						<td><?php jols_e($lsDefaults['slider']['touchNavigation']['name'], 'LayerSlider') ?></td>
						<td><?php lsGetCheckbox($lsDefaults['slider']['touchNavigation'], $slider['properties']) ?></td>
						<td class="desc"><?php jols_e($lsDefaults['slider']['touchNavigation']['desc'], 'LayerSlider') ?></td>
					</tr>
					<tr><th colspan="3"><?php jols_e('Looping', 'LayerSlider') ?></th></tr>
					<tr>
						<td><?php jols_e('Loops', 'LayerSlider') ?></td>
						<td><?php lsGetInput($lsDefaults['slider']['loops'], $slider['properties']) ?></td>
						<td class="desc"><?php jols_e('Number of loops if automatically start slideshow is enabled (0 means infinite!)', 'LayerSlider') ?></td>
					</tr>
					<tr>
						<td><?php jols_e($lsDefaults['slider']['forceLoopNumber']['name'], 'LayerSlider') ?></td>
						<td><?php lsGetCheckbox($lsDefaults['slider']['forceLoopNumber'], $slider['properties']) ?></td>
						<td class="desc"><?php jols_e($lsDefaults['slider']['forceLoopNumber']['desc'], 'LayerSlider') ?></td>
					</tr>
					<tr><th colspan="3"><?php jols_e('Other settings', 'LayerSlider') ?></th></tr>
					<tr>
						<td><?php jols_e($lsDefaults['slider']['twoWaySlideshow']['name'], 'LayerSlider') ?></td>
						<td><?php lsGetCheckbox($lsDefaults['slider']['twoWaySlideshow'], $slider['properties']) ?></td>
						<td class="desc"><?php jols_e($lsDefaults['slider']['twoWaySlideshow']['desc'], 'LayerSlider') ?></td>
					</tr>
					<tr>
						<td><?php jols_e($lsDefaults['slider']['shuffle']['name'], 'LayerSlider') ?></td>
						<td><?php lsGetCheckbox($lsDefaults['slider']['shuffle'], $slider['properties']) ?></td>
						<td class="desc"><?php jols_e($lsDefaults['slider']['shuffle']['desc'], 'LayerSlider') ?></td>
					</tr>
				</tbody>

				<!-- Appearance -->
				<tbody>
					<tr>
						<td><?php jols_e('Skin', 'LayerSlider') ?></td>
						<td>
							<select name="skin">
								<?php $slider['properties']['skin'] = empty($slider['properties']['skin']) ? $lsDefaults['slider']['skin']['value'] : $slider['properties']['skin'] ?>
								<?php $skins = lsGetSkins(); ?>
								<?php foreach($skins as $skin) : ?>
								<?php $selected = ($skin['folder'] == $slider['properties']['skin']) ? ' selected="selected"' : '' ?>
								<option value="<?php echo $skin['folder'] ?>"<?php echo $selected ?>>
									<?php
									echo $skin['name'];
									if(!empty($skin['info']['note'])) { echo ' - ' . $skin['info']['note']; }
									?>
								</option>
								<?php endforeach; ?>
							</select>
						</td>
						<td class="desc"><?php jols_e("You can change the skin of the slider. The 'noskin' skin is a border- and buttonless skin. Your custom skins will appear in the list when you create their folders as well.", "LayerSlider") ?></td>
					</tr>
					<tr>
						<td><?php jols_e($lsDefaults['slider']['globalBGColor']['name'], 'LayerSlider') ?></td>
						<td><?php lsGetInput($lsDefaults['slider']['globalBGColor'], $slider['properties'], array('class' => 'input ls-colorpicker minicolors-input')) ?></td>
						<td class="desc"><?php jols_e($lsDefaults['slider']['globalBGColor']['desc'], 'LayerSlider') ?></td>
					</tr>
					<tr>
						<td><?php jols_e('Background image', 'LayerSlider') ?></td>
						<td class="ls-image-uploader">
							<?php $bgImage = !empty($slider['properties']['backgroundimage']) ? ls_cmsroot($root, $slider['properties']['backgroundimage']) : null; ?>
							<?php $bgImageId = !empty($slider['properties']['backgroundimageId']) ? $slider['properties']['backgroundimageId'] : null; ?>
							<input type="hidden" name="backgroundimageId" value="<?php echo $bgImageId ?>">
							<input type="hidden" name="backgroundimage" value="<?php echo $bgImage ?>">
							<div class="ls-image ls-upload">
  							<a href="javascript:;" onclick="openModal(this);" class="modal">
  								<div><img src="<?php echo apply_filters('ls_get_thumbnail', $bgImageId, $bgImage) ?>" alt=""></div>
    							</a>
  							<a href="#" class="dashicons dashicons-dismiss"></a>
							</div>
						</td>
						<td class="desc"><?php jols_e($lsDefaults['slider']['globalBGImage']['desc'], 'LayerSlider') ?></td>
					</tr>

					<tr>
						<td><?php jols_e($lsDefaults['slider']['globalBGPosition']['name'], 'LayerSlider') ?></td>
						<td>
							<div class="reset-parent">
								<?php lsGetInput($lsDefaults['slider']['globalBGPosition'], $slider['properties'], array('class' => 'input')) ?>
							</div>
						</td>
						<td class="desc"><?php jols_e($lsDefaults['slider']['globalBGPosition']['desc'], 'LayerSlider') ?></td>
					</tr>

					<tr>
						<td><?php jols_e($lsDefaults['slider']['globalBGSize']['name'], 'LayerSlider') ?></td>
						<td>
							<div class="reset-parent">
								<?php lsGetInput($lsDefaults['slider']['globalBGSize'], $slider['properties'], array('class' => 'input')) ?>
							</div>
						</td>
						<td class="desc"><?php jols_e($lsDefaults['slider']['globalBGSize']['desc'], 'LayerSlider') ?></td>
					</tr>

					<tr>
						<td><?php jols_e('Background repeat', 'LayerSlider') ?></td>
						<td><?php lsGetSelect($lsDefaults['slider']['globalBGRepeat'], $slider['properties']) ?></td>
						<td class="desc"><?php jols_e($lsDefaults['slider']['globalBGRepeat']['desc'], 'LayerSlider') ?></td>
					</tr>

					<tr>
						<td><?php jols_e('Background behaviour', 'LayerSlider') ?></td>
						<td><?php lsGetSelect($lsDefaults['slider']['globalBGBehaviour'], $slider['properties']) ?></td>
						<td class="desc"><?php jols_e($lsDefaults['slider']['globalBGBehaviour']['desc'], 'LayerSlider') ?></td>
					</tr>

					<tr>
						<td><?php jols_e($lsDefaults['slider']['sliderFadeInDuration']['name'], 'LayerSlider') ?></td>
						<td><?php lsGetInput($lsDefaults['slider']['sliderFadeInDuration'], $slider['properties']) ?></td>
						<td class="desc"><?php jols_e($lsDefaults['slider']['sliderFadeInDuration']['desc'], 'LayerSlider') ?></td>
					</tr>

					<tr>
						<td>
							<?php jols_e('Custom slider CSS', 'LayerSlider') ?> <br>
						</td>
						<td colspan="2">
							<textarea name="sliderstyle" class="ls-codemirror" cols="30" rows="10"><?php echo !empty($slider['properties']['sliderstyle']) ? $slider['properties']['sliderstyle'] : $lsDefaults['slider']['sliderStyle']['value'] ?></textarea>
						</td>
					</tr>
				</tbody>

				<!-- Navigation Area -->
				<tbody>
					<tr><th colspan="3"><?php jols_e('Show navigation buttons', 'LayerSlider') ?></th></tr>
					<tr>
						<td><?php jols_e($lsDefaults['slider']['navPrevNextButtons']['name'], 'LayerSlider') ?></td>
						<td><?php lsGetCheckbox($lsDefaults['slider']['navPrevNextButtons'], $slider['properties']) ?></td>
						<td class="desc"><?php jols_e($lsDefaults['slider']['navPrevNextButtons']['desc'], 'LayerSlider') ?></td>
					</tr>
					<tr>
						<td><?php jols_e($lsDefaults['slider']['navStartStopButtons']['name'], 'LayerSlider') ?></td>
						<td><?php lsGetCheckbox($lsDefaults['slider']['navStartStopButtons'], $slider['properties']) ?></td>
						<td class="desc"><?php jols_e($lsDefaults['slider']['navStartStopButtons']['desc'], 'LayerSlider') ?></td>
					</tr>
					<tr>
						<td><?php jols_e($lsDefaults['slider']['navSlideButtons']['name'], 'LayerSlider') ?></td>
						<td><?php lsGetCheckbox($lsDefaults['slider']['navSlideButtons'], $slider['properties']) ?></td>
						<td class="desc"><?php jols_e($lsDefaults['slider']['navSlideButtons']['desc'], 'LayerSlider') ?></td>
					</tr>
					<tr><th colspan="3"><?php jols_e('Navigation buttons on hover', 'LayerSlider') ?></th></tr>
					<tr>
						<td><?php jols_e($lsDefaults['slider']['hoverPrevNextButtons']['name'], 'LayerSlider') ?></td>
						<td><?php lsGetCheckbox($lsDefaults['slider']['hoverPrevNextButtons'], $slider['properties']) ?></td>
						<td class="desc"><?php jols_e($lsDefaults['slider']['hoverPrevNextButtons']['desc'], 'LayerSlider') ?></td>
					</tr>
					<tr>
						<td><?php jols_e($lsDefaults['slider']['hoverSlideButtons']['name'], 'LayerSlider') ?></td>
						<td><?php lsGetCheckbox($lsDefaults['slider']['hoverSlideButtons'], $slider['properties']) ?></td>
						<td class="desc"><?php jols_e($lsDefaults['slider']['hoverSlideButtons']['desc'], 'LayerSlider') ?></td>
					</tr>
					<tr><th colspan="3"><?php jols_e('Slideshow timers', 'LayerSlider') ?></th></tr>
					<tr>
						<td><?php jols_e($lsDefaults['slider']['barTimer']['name'], 'LayerSlider') ?></td>
						<td><?php lsGetCheckbox($lsDefaults['slider']['barTimer'], $slider['properties']) ?></td>
						<td class="desc"><?php jols_e($lsDefaults['slider']['barTimer']['desc'], 'LayerSlider') ?></td>
					</tr>
					<tr>
						<td><?php jols_e($lsDefaults['slider']['circleTimer']['name'], 'LayerSlider') ?></td>
						<td><?php lsGetCheckbox($lsDefaults['slider']['circleTimer'], $slider['properties']) ?></td>
						<td class="desc"><?php jols_e($lsDefaults['slider']['circleTimer']['desc'], 'LayerSlider') ?></td>
					</tr>
				</tbody>

				<!-- Thumbnail navigation -->
				<tbody>
					<tr><th colspan="3"><?php jols_e('Appearance', 'LayerSlider') ?></th></tr>
					<tr>
						<td><?php jols_e('Thumbnail navigation', 'LayerSlider') ?></td>
						<td><?php lsGetSelect($lsDefaults['slider']['thumbnailNavigation'], $slider['properties']) ?></td>
						<td class="desc"></td>
					</tr>
					<tr>
						<td><?php jols_e($lsDefaults['slider']['thumbnailAreaWidth']['name'], 'LayerSlider') ?></td>
						<td><?php lsGetInput($lsDefaults['slider']['thumbnailAreaWidth'], $slider['properties']) ?></td>
						<td class="desc"><?php jols_e($lsDefaults['slider']['thumbnailAreaWidth']['desc'], 'LayerSlider') ?></td>
					</tr>
					<tr><th colspan="3"><?php jols_e('Thumbnail dimensions', 'LayerSlider') ?></th></tr>
					<tr>
						<td><?php jols_e($lsDefaults['slider']['thumbnailWidth']['name'], 'LayerSlider') ?></td>
						<td><?php lsGetInput($lsDefaults['slider']['thumbnailWidth'], $slider['properties']) ?></td>
						<td class="desc"><?php jols_e($lsDefaults['slider']['thumbnailWidth']['desc'], 'LayerSlider') ?></td>
					</tr>
					<tr>
						<td><?php jols_e($lsDefaults['slider']['thumbnailHeight']['name'], 'LayerSlider') ?></td>
						<td><?php lsGetInput($lsDefaults['slider']['thumbnailHeight'], $slider['properties']) ?></td>
						<td class="desc"><?php jols_e($lsDefaults['slider']['thumbnailHeight']['desc'], 'LayerSlider') ?></td>
					</tr>
					<tr><th colspan="3"><?php jols_e('Thumbnail appearance', 'LayerSlider') ?></th></tr>
					<tr>
						<td><?php jols_e($lsDefaults['slider']['thumbnailActiveOpacity']['name'], 'LayerSlider') ?></td>
						<td><?php lsGetInput($lsDefaults['slider']['thumbnailActiveOpacity'], $slider['properties']) ?></td>
						<td class="desc"><?php jols_e($lsDefaults['slider']['thumbnailActiveOpacity']['desc'], 'LayerSlider') ?></td>
					</tr>
					<tr>
						<td><?php jols_e($lsDefaults['slider']['thumbnailInactiveOpacity']['name'], 'LayerSlider') ?></td>
						<td><?php lsGetInput($lsDefaults['slider']['thumbnailInactiveOpacity'], $slider['properties']) ?></td>
						<td class="desc"><?php jols_e($lsDefaults['slider']['thumbnailInactiveOpacity']['desc'], 'LayerSlider') ?></td>
					</tr>
				</tbody>

				<!-- Parallax -->
				<tbody>
					<tr>
						<td><?php jols_e($lsDefaults['slider']['parallaxType']['name'], 'LayerSlider') ?></td>
						<td><?php lsGetSelect($lsDefaults['slider']['parallaxType'], $slider['properties']) ?></td>
						<td class="desc"><?php jols_e($lsDefaults['slider']['parallaxType']['desc'], 'LayerSlider') ?></td>
					</tr>
					<tr><th colspan="3"><?php jols_e('Scroll settings', 'LayerSlider') ?></th></tr>
					<tr>
						<td><?php jols_e($lsDefaults['slider']['slideParallax']['name'], 'LayerSlider') ?></td>
						<td><?php lsGetInput($lsDefaults['slider']['slideParallax'], $slider['properties']) ?></td>
						<td class="desc"><?php jols_e($lsDefaults['slider']['slideParallax']['desc'], 'LayerSlider') ?></td>
					</tr>
					<tr>
						<td><?php jols_e($lsDefaults['slider']['parallaxOrigin']['name'], 'LayerSlider') ?></td>
						<td><?php lsGetSelect($lsDefaults['slider']['parallaxOrigin'], $slider['properties']) ?></td>
						<td class="desc"><?php jols_e($lsDefaults['slider']['parallaxOrigin']['desc'], 'LayerSlider') ?></td>
					</tr>
					<tr>
						<td><?php jols_e($lsDefaults['slider']['parallaxScrollDuration']['name'], 'LayerSlider') ?></td>
						<td><?php lsGetInput($lsDefaults['slider']['parallaxScrollDuration'], $slider['properties']) ?> ms</td>
						<td class="desc"><?php jols_e($lsDefaults['slider']['parallaxScrollDuration']['desc'], 'LayerSlider') ?></td>
					</tr>
					<tr>
						<td><?php jols_e($lsDefaults['slider']['parallaxScrollOnMobile']['name'], 'LayerSlider') ?></td>
						<td><?php lsGetCheckbox($lsDefaults['slider']['parallaxScrollOnMobile'], $slider['properties']) ?></td>
						<td class="desc"><?php jols_e($lsDefaults['slider']['parallaxScrollOnMobile']['desc'], 'LayerSlider') ?></td>
					</tr>
				</tbody>

				<!-- Videos -->
				<tbody>
					<tr>
						<td><?php jols_e($lsDefaults['slider']['autoPlayVideos']['name'], 'LayerSlider') ?></td>
						<td><?php lsGetCheckbox($lsDefaults['slider']['autoPlayVideos'], $slider['properties']) ?></td>
						<td class="desc"><?php jols_e($lsDefaults['slider']['autoPlayVideos']['desc'], 'LayerSlider') ?></td>
					</tr>
					<tr>
						<td><?php jols_e($lsDefaults['slider']['autoPauseSlideshow']['name'], 'LayerSlider') ?></td>
						<td><?php lsGetSelect($lsDefaults['slider']['autoPauseSlideshow'], $slider['properties']) ?></td>
						<td class="desc"><?php jols_e($lsDefaults['slider']['autoPauseSlideshow']['desc'], 'LayerSlider') ?></td>
					</tr>
					<tr>
						<td><?php jols_e($lsDefaults['slider']['youtubePreviewQuality']['name'], 'LayerSlider') ?></td>
						<td><?php lsGetSelect($lsDefaults['slider']['youtubePreviewQuality'], $slider['properties']) ?></td>
						<td class="desc"><?php jols_e($lsDefaults['slider']['youtubePreviewQuality']['desc'], 'LayerSlider') ?></td>
					</tr>
				</tbody>

				<!-- Misc -->
				<tbody>
					<tr>
						<td><?php jols_e($lsDefaults['slider']['imagePreload']['name'], 'LayerSlider') ?></td>
						<td><?php lsGetCheckbox($lsDefaults['slider']['imagePreload'], $slider['properties']) ?></td>
						<td class="desc"><?php jols_e($lsDefaults['slider']['imagePreload']['desc'], 'LayerSlider') ?></td>
					</tr>
					<tr>
						<td><?php jols_e($lsDefaults['slider']['lazyLoad']['name'], 'LayerSlider') ?></td>
						<td><?php lsGetCheckbox($lsDefaults['slider']['lazyLoad'], $slider['properties']) ?></td>
						<td class="desc"><?php jols_e($lsDefaults['slider']['lazyLoad']['desc'], 'LayerSlider') ?></td>
					</tr>
					<tr>
						<td><?php jols_e($lsDefaults['slider']['relativeURLs']['name'], 'LayerSlider') ?></td>
						<td><?php lsGetCheckbox($lsDefaults['slider']['relativeURLs'], $slider['properties']) ?></td>
						<td class="desc"><?php jols_e($lsDefaults['slider']['relativeURLs']['desc'], 'LayerSlider') ?></td>
					</tr>
					<tr class="hidden">
						<td colspan="3"><input type="checkbox" name="cmsrelativeurls" checked="checked" /></td>
					</tr>
				</tbody>

				<!-- YourLogo -->
				<tbody>
					<tr>
						<td><?php jols_e($lsDefaults['slider']['yourLogoImage']['name'], 'LayerSlider') ?></td>
						<td class="ls-image-uploader">
							<?php $slider['properties']['yourlogo'] = !empty($slider['properties']['yourlogo']) ? ls_cmsroot($root, $slider['properties']['yourlogo']) : null; ?>
							<?php $slider['properties']['yourlogoId'] = !empty($slider['properties']['yourlogoId']) ? $slider['properties']['yourlogoId'] : null; ?>
							<input type="hidden" name="yourlogoId" value="<?php echo !empty($slider['properties']['yourlogoId']) ? $slider['properties']['yourlogoId'] : '' ?>">
							<input type="hidden" name="yourlogo" value="<?php echo !empty($slider['properties']['yourlogo']) ? $slider['properties']['yourlogo'] : '' ?>">
							<div class="ls-image ls-upload">
							<a href="javascript:;" onclick="openModal(this);" class="modal">
  								<div><img src="<?php echo apply_filters('ls_get_thumbnail', $slider['properties']['yourlogoId'], $slider['properties']['yourlogo']) ?>" alt=""></div>
  							</a>
							<a href="#" class="dashicons dashicons-dismiss"></a>
							</div>
						</td>
						<td class="desc"><?php jols_e($lsDefaults['slider']['yourLogoImage']['desc'], 'LayerSlider') ?></td>
					</tr>
					<tr>
						<td><?php jols_e($lsDefaults['slider']['yourLogoStyle']['name'], 'LayerSlider') ?></td>
						<td colspan="2">
							<textarea name="yourlogostyle" class="ls-codemirror" cols="30" rows="10"><?php echo !empty($slider['properties']['yourlogostyle']) ? $slider['properties']['yourlogostyle'] : $lsDefaults['slider']['yourLogoStyle']['value'] ?></textarea>
						</td>
					</tr>
					<tr>
						<td><?php jols_e($lsDefaults['slider']['yourLogoLink']['name'], 'LayerSlider') ?></td>
						<td><?php lsGetInput($lsDefaults['slider']['yourLogoLink'], $slider['properties']) ?></td>
						<td class="desc"><?php jols_e($lsDefaults['slider']['yourLogoLink']['desc'], 'LayerSlider') ?></td>
					</tr>
					<tr>
						<td><?php jols_e($lsDefaults['slider']['yourLogoTarget']['name'], 'LayerSlider') ?></td>
						<td><?php lsGetSelect($lsDefaults['slider']['yourLogoTarget'], $slider['properties']) ?></td>
						<td class="desc"><?php jols_e($lsDefaults['slider']['yourLogoTarget']['desc'], 'LayerSlider') ?></td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="clear"></div>
	</div>
</div>
