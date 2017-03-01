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

$lsDefaults = array(

	'slider' => array(

		// ============= //
		// |   Layout  | //
		// ============= //

		// The width of a new slider.
		'width' => array(
			'value' => 600,
			'name' => jols__('Slider width', 'LayerSlider'),
			'keys' => 'width',
			'desc' => jols__('The width of the slider in pixels. Accepts percents, but is only recommended for full-width layout.', 'LayerSlider'),
			'attrs' => array(
				'type' => 'text'
			),
			'props' => array(
				'meta' => true
			)
		),

		// The height of a new slider.
		'height' => array(
			'value' => 300,
			'name' => jols__('Slider height', 'LayerSlider'),
			'keys' => 'height',
			'desc' => jols__('The height of the slider in pixels.', 'LayerSlider'),
			'attrs' => array(
				'type' => 'text'
			),
			'props' => array(
				'meta' => true
			)
		),

		// Whether use or not responsiveness.
		'responsiveness' => array(
			'value' => true,
			'name' => jols__('Responsive', 'LayerSlider'),
			'keys' => 'responsive',
			'desc' => jols__('Responsive mode provides optimal viewing experience across a wide range of devices (from desktop to mobile) by adapting and scaling your sliders for the viewing environment.', 'LayerSlider')
		),


		// The maximum width that the slider can get in responsive mode.
		'maxWidth' => array(
			'value' => '',
			'name' => jols__('Max-width', 'LayerSlider'),
			'keys' => 'maxwidth',
			'desc' => jols__('The maximum width your slider can take in pixels when responsive mode is enabled.', 'LayerSlider'),
			'attrs' => array(
				'type' => 'number',
				'min' => 0
			),
			'props' => array(
				'meta' => true
			)
		),

		// Force the slider to stretch to full-width,
		// even when the theme doesn't designed that way.
		'fullWidth' => array(
			'value' => false,
			'name' => jols__('Full-width', 'LayerSlider'),
			'keys' => 'forceresponsive',
			'desc' => jols__('Enable this option to force the slider to become full-width, even if your theme does not support such layout.', 'LayerSlider'),
			'props' => array(
				'meta' => true
			)
		),

		// Force the slider to stretch to full-height,
		// even when the theme doesn't designed that way.
		'fullPage' => array(
			'value' => false,
			'name' => jols__('Full-height', 'LayerSlider'),
			'keys' => array('fullpage', 'fullPage'),
			'desc' => jols__('Enable this option to force the slider to become full-height, even if your theme does not support such layout.', 'LayerSlider')
		),

		'reduceHeight' => array(
			'value' => '',
			'name' => jols__('Reduce height', 'LayerSlider'),
			'keys' => array('reduceheight', 'reduceHeight'),
			'desc' => jols__('Reduce slider height with the height of given element(s). Use CSS selector to define element(s).', 'LayerSlider')
		),

		// Turn on responsiveness under a given width of the slider.
		// Depends on: enabled fullWidth option. Defaults to: 0
		'responsiveUnder' => array(
			'value' => 0,
			'name' => jols__('Responsive under', 'LayerSlider'),
			'keys' => array('responsiveunder', 'responsiveUnder'),
			'desc' => jols__('Turns on responsive mode in a full-width slider under the specified value in pixels. Can only be used with full-width mode.', 'LayerSlider'),
			'attrs' => array(
				'min' => 0
			)
		),

		// Creates an inner area for sublayers that will be centered
		// regardless the size of the slider.
		// Depends on: enabled fullWidth option. Defaults to: 0
		'layersContainer' => array(
			'value' => 0,
			'name' => jols__('Layers container width', 'LayerSlider'),
			'keys' => array('sublayercontainer', 'layersContainer'),
			'desc' => jols__('Creates an invisible inner container with the given dimension in pixels to hold and center your layers.', 'LayerSlider'),
			'attrs' => array(
				'min' => 0
			)
		),


		// Hides the slider on mobile devices.
		// Defaults to: false
		'hideOnMobile' => array(
			'value' => false,
			'name' => jols__('Hide on mobile', 'LayerSlider'),
			'keys' => array('hideonmobile', 'hideOnMobile'),
			'desc' => jols__('Hides the slider on mobile devices.', 'LayerSlider')
		),


		// Hides the slider under the given value of browser width in pixels.
		// Defaults to: 0
		'hideUnder' => array(
			'value' => 0,
			'name' => jols__('Hide under', 'LayerSlider'),
			'keys' => array('hideunder', 'hideUnder'),
			'desc' => jols__('Hides the slider under the given value of browser width in pixels.', 'LayerSlider'),
			'attrs' => array(
				'min' => 0
			)
		),

		// Hides the slider over the given value of browser width in pixel.
		// Defaults to: 100000
		'hideOver' => array(
			'value' => 100000,
			'name' => jols__('Hide over', 'LayerSlider'),
			'keys' => array('hideover', 'hideOver'),
			'desc' => jols__('Hides the slider over the given value of browser width in pixel.', 'LayerSlider'),
			'attrs' => array(
				'min' => 0
			)
		),

		// ================ //
		// |   Slideshow  | //
		// ================ //

		// Automatically start slideshow.
		'autoStart' => array(
			'value' => true,
			'name' => jols__('Start slideshow', 'LayerSlider'),
			'keys' => array('autostart', 'autoStart'),
			'desc' => jols__('Slideshow will automatically start after pages have loaded.', 'LayerSlider')
		),

		// The slider will start only if it enters in the viewport.
		'startInViewport' => array(
			'value' => true,
			'name' => jols__('Start in viewport', 'LayerSlider'),
			'keys' => array('startinviewport', 'startInViewport'),
			'desc' => jols__('The slider will start only if it enters into the viewport.', 'LayerSlider')
		),

		// Temporarily pauses the slideshow while you are hovering over the slider.
		'pauseOnHover' => array(
			'value' => true,
			'name' => jols__('Pause on hover', 'LayerSlider'),
			'keys' => array('pauseonhover', 'pauseOnHover'),
			'desc' => jols__('Slideshow will temporally pause when someone moves the mouse cursor over the slider.', 'LayerSlider')
		),

		// The starting slide of a slider. Non-index value, starts with 1.
		'firstSlide' => array(
			'value' => 1,
			'name' => jols__('Start with slide', 'LayerSlider'),
			'keys' => array('firstlayer', 'firstSlide'),
			'desc' => jols__('The slider will start with the specified slide. You can use the value "random".', 'LayerSlider'),
			'attrs' => array(
				'type' => 'text'
			)
		),

		// Whether animate or show the ending position of the first slide.
		'animateFirstSlide' => array(
			'value' => true,
			'name' => jols__('Animate starting slide', 'LayerSlider'),
			'keys' => array('animatefirstlayer', 'animateFirstSlide'),
			'desc' => jols__('Disabling this option will result a static starting slide for the fisrt time on page load.', 'LayerSlider')
		),

		// The slideshow will change slides in random order.
		'shuffle' => array(
			'value' => false,
			'name' => jols__('Shuffle mode', 'LayerSlider'),
			'keys' => array('randomslideshow', 'randomSlideshow'),
			'desc' => jols__('Slideshow will proceed in random order. This feature does not work with looping.', 'LayerSlider')
		),

		// Whether slideshow should goind backwards or not
		// when you switch to a previous slide.
		'twoWaySlideshow' => array(
			'value' => false,
			'name' => jols__('Two way slideshow', 'LayerSlider'),
			'keys' => array('twowayslideshow', 'twoWaySlideshow'),
			'desc' => jols__('Slideshow can go backwards if someone switches to a previous slide.', 'LayerSlider')
		),

		// Number of loops taking by the slideshow.
		// Depends on: shuffle. Defaults to: 0 => infinite
		'loops' => array(
			'value' => 0,
			'name' => jols__('Loops', 'LayerSlider'),
			'keys' => 'loops',
			'desc' => jols__('Number of loops if slideshow is enabled. Zero means infinite loops.', 'LayerSlider'),
		),

		// The slideshow will always stop at the given number of
		// loops, even when the user restarts slideshow.
		// Depends on: loop. Defaults to: true
		'forceLoopNumber' => array(
			'value' => true,
			'name' => jols__('Force the number of loops', 'LayerSlider'),
			'keys' => array('forceloopnum', 'forceLoopNum'),
			'desc' => jols__('The slider will always stop at the given number of loops, even if someone restarts slideshow.', 'LayerSlider')
		),

		// Use global shortcuts to control the slider.
		'keybNavigation' => array(
			'value' => true,
			'name' => jols__('Keyboard navigation', 'LayerSlider'),
			'keys' => array('keybnav', 'keybNav'),
			'desc' => jols__('You can navigate through slides with the left and right arrow keys.', 'LayerSlider')
		),

		// Accepts touch gestures if enabled.
		'touchNavigation' => array(
			'value' => true,
			'name' => jols__('Touch navigation', 'LayerSlider'),
			'keys' => array('touchnav', 'touchNav'),
			'desc' => jols__('Gesture-based navigation when swiping on touch-enabled devices.', 'LayerSlider')
		),


		// ================= //
		// |   Appearance  | //
		// ================= //

		// The default skin.
		'skin' => array(
			'value' => 'v5',
			'name' => jols__('Skin', 'LayerSlider'),
			'keys' => 'skin',
			'desc' => jols__("The skin used for this slider. The 'noskin' skin is a border- and buttonless skin. Your custom skins will appear in the list when you create their folders.", "LayerSlider")
		),


		// Global background color on all slides.
		'globalBGColor' => array(
			'value' => '',
			'name' => jols__('Background color', 'LayerSlider'),
			'keys' => array('backgroundcolor', 'globalBGColor'),
			'desc' => jols__('Global background color of the slider. Slides with non-transparent background will cover this one. You can use all CSS methods such as HEX or RGB(A) values.', 'LayerSlider')
		),

		// Global background image on all slides.
		'globalBGImage' => array(
			'value' => '',
			'name' => jols__('Background image', 'LayerSlider'),
			'keys' => array('backgroundimage', 'globalBGImage'),
			'desc' => jols__('Global background image of the slider. Slides with non-transparent background will cover this one.', 'LayerSlider')
		),

		// Global background-position on all slides.
		'globalBGPosition' => array(
			'value' => '50% 50%',
			'name' => jols__('Background position', 'LayerSlider'),
			'keys' => array('background_position', 'globalBGPosition'),
			'desc' => jols__('Global background image position of the slider. The first value is the horizontal position and the second value is the vertical.', 'LayerSlider')
		),

		// Global background-position on all slides.
		'globalBGSize' => array(
			'value' => '',
			'name' => jols__('Background size', 'LayerSlider'),
			'keys' => array('background_size', 'globalBGSize'),
			'desc' => jols__('Global background size of the slider. You can set the size in pixel or percent or constants: auto | cover | contain ', 'LayerSlider')
		),

    // background-attachment css option on all slides.
		'globalBGRepeat' => array(
			'value' => 'no-repeat',
			'name' => jols__('Background repeat', 'LayerSlider'),
			'keys' => array('background_repeat', 'globalBGRepeat'),
			'desc' => jols__('Global background repeat of the slider.', 'LayerSlider'),
			'options' => array(
				'repeat' => jols__('Repeat', 'LayerSlider'),
				'repeat-x' => jols__('Repeat-x', 'LayerSlider'),
				'repeat-y' => jols__('Repeat-y', 'LayerSlider'),
				'no-repeat' => jols__('No-repeat', 'LayerSlider'),
			)
		),

    // background-attachment css option on all slides.
		'globalBGBehaviour' => array(
			'value' => 'scroll',
			'name' => jols__('Background behaviour', 'LayerSlider'),
			'keys' => array('background_behaviour', 'globalBGBehaviour'),
			'desc' => jols__('If you want to set fixed position background, please use Fixed value.', 'LayerSlider'),
			'options' => array(
				'scroll' => jols__('Scroll', 'LayerSlider'),
				'fixed' => jols__('Fixed', 'LayerSlider')
			)
		),


		'sliderFadeInDuration' => array(
			'value' => 350,
			'name' => jols__('Initial fade duration', 'LayerSlider'),
			'keys' => array('sliderfadeinduration', 'sliderFadeInDuration'),
			'desc' => jols__('Change the duration of the initial fade animation when the page loads. Enter 0 to disable fading.', 'LayerSlider'),
			'attrs' => array(
				'min' => 0
			)
		),

		// Some CSS values you can append on each slide individually
		// to make some adjustments if needed.
		'sliderStyle' => array(
			'value' => 'margin-bottom: 0px;',
			'name' => jols__('Slider CSS', 'LayerSlider'),
			'keys' => array('sliderstyle', 'sliderStyle'),
			'desc' => jols__('You can enter custom CSS to change some style properties on the slider wrapper element. More complex CSS should be applied with the Custom Styles Editor.', 'LayerSlider'),
			'props' => array(
				'meta' => true
			)
		),


		// ================= //
		// |   Navigation  | //
		// ================= //

		// Show the next and previous buttons.
		'navPrevNextButtons' => array(
			'value' => true,
			'name' => jols__('Show Prev & Next buttons', 'LayerSlider'),
			'keys' => array('navprevnext', 'navPrevNext'),
			'desc' => jols__('Disabling this option will hide the Prev and Next buttons.', 'LayerSlider')
		),

		// Show the next and previous buttons
		// only when hovering over the slider.
		'hoverPrevNextButtons' => array(
			'value' => true,
			'name' => jols__('Show Prev & Next buttons on hover', 'LayerSlider'),
			'keys' => array('hoverprevnext', 'hoverPrevNext'),
			'desc' => jols__('Show the buttons only when someone moves the mouse cursor over the slider. This option depends on the previous setting.', 'LayerSlider')
		),

		// Show the start and stop buttons
		'navStartStopButtons' => array(
			'value' => true,
			'name' => jols__('Show Start & Stop buttons', 'LayerSlider'),
			'keys' => array('navstartstop', 'navStartStop'),
			'desc' => jols__('Disabling this option will hide the Start & Stop buttons.', 'LayerSlider')
		),

		// Show the slide buttons or thumbnails.
		'navSlideButtons' => array(
			'value' => true,
			'name' => jols__('Show slide navigation buttons', 'LayerSlider'),
			'keys' => array('navbuttons', 'navButtons'),
			'desc' => jols__('Disabling this option will hide slide navigation buttons or thumbnails.', 'LayerSlider')
		),

		// Show the slider buttons or thumbnails
		// ony when hovering over the slider.
		'hoverSlideButtons' => array(
			'value' => false,
			'name' => jols__('Slide navigation on hover', 'LayerSlider'),
			'keys' => array('hoverbottomnav', 'hoverBottomNav'),
			'desc' => jols__('Slide navigation buttons (including thumbnails) will be shown on mouse hover only.', 'LayerSlider')
		),

		// Show bar timer
		'barTimer' => array(
			'value' => false,
			'name' => jols__('Show bar timer', 'LayerSlider'),
			'keys' => array('bartimer', 'showBarTimer'),
			'desc' => jols__('Show the bar timer to indicate slideshow progression.', 'LayerSlider')
		),

		// Show circle timer. Requires CSS3 capable browser.
		// This setting will overrule the 'barTimer' option.
		'circleTimer' => array(
			'value' => true,
			'name' => jols__('Show circle timer', 'LayerSlider'),
			'keys' => array('circletimer', 'showCircleTimer'),
			'desc' => jols__('Use circle timer to indicate slideshow progression.', 'LayerSlider')
		),

		// ========================== //
		// |  Thumbnail navigation  | //
		// ========================== //

		// Use thumbnails for slide buttons
		// Depends on: navSlideButtons.
		// Possible values: 'disabled', 'hover', 'always'
		'thumbnailNavigation' => array(
			'value' => 'hover',
			'name' => jols__('Thumbnail navigation', 'LayerSlider'),
			'keys' => array('thumb_nav', 'thumbnailNavigation'),
			'desc' => jols__('Use thumbnail navigation instead of slide bullet buttons.', 'LayerSlider'),
			'options' => array(
				'disabled' => jols__('Disabled', 'LayerSlider'),
				'hover' => jols__('Hover', 'LayerSlider'),
				'always' => jols__('Always', 'LayerSlider')
			)
		),

		// The width of the thumbnail area in percents.
		'thumbnailAreaWidth' => array(
			'value' => '60%',
			'name' => jols__('Thumbnail container width', 'LayerSlider'),
			'keys' => array('thumb_container_width', 'tnContainerWidth'),
			'desc' => jols__('The width of the thumbnail area.', 'LayerSlider')
		),

		// Thumbnails' width in pixels.
		'thumbnailWidth' => array(
			'value' => 100,
			'name' => jols__('Thumbnail width', 'LayerSlider'),
			'keys' => array('thumb_width', 'tnWidth'),
			'desc' => jols__('The width of thumbnails in the navigation area.', 'LayerSlider'),
			'attrs' => array(
				'min' => 0
			)
		),

		// Thumbnails' height in pixels.
		'thumbnailHeight' => array(
			'value' => 60,
			'name' => jols__('Thumbnail height', 'LayerSlider'),
			'keys' => array('thumb_height', 'tnHeight'),
			'desc' => jols__('The height of thumbnails in the navigation area.', 'LayerSlider'),
			'attrs' => array(
				'min' => 0
			)
		),


		// The opacity of the active thumbnail in percents.
		'thumbnailActiveOpacity' => array(
			'value' => 35,
			'name' => jols__('Active thumbnail opacity', 'LayerSlider'),
			'keys' => array('thumb_active_opacity', 'tnActiveOpacity'),
			'desc' => jols__("Opacity in percentage of the active slide's thumbnail.", "LayerSlider"),
			'attrs' => array(
				'min' => 0,
				'max' => 100
			)
		),

		// The opacity of inactive thumbnails in percents.
		'thumbnailInactiveOpacity' => array(
			'value' => 100,
			'name' => jols__('Inactive thumbnail opacity', 'LayerSlider'),
			'keys' => array('thumb_inactive_opacity', 'tnInactiveOpacity'),
			'desc' => jols__('Opacity in percentage of inactive slide thumbnails.', 'LayerSlider'),
			'attrs' => array(
				'min' => 0,
				'max' => 100
			)
		),

		// ============== //
		// |  Parallax  | //
		// ============== //

		'parallaxType' => array(
			'value' => 'mouse',
			'name' => jols__('Activate parallax on', 'LayerSlider'),
			'keys' => array('parallaxtype', 'parallaxType'),
			'desc' => jols__('This option has effects only on layers. You can setup the parallax level for each layer at the Transition tab.', 'LayerSlider'),
			'options' => array(
				'mouse' => jols__('Mouse move', 'LayerSlider'),
				'scroll' => jols__('Scroll', 'LayerSlider')
			)
		),

		'slideParallax' => array(
			'value' => '0',
			'name' => jols__('Slide images parallax level', 'LayerSlider'),
			'keys' => array('slideparallax', 'slideParallax'),
			'desc' => jols__('In this option you can set the slides background image\'s parallax level from 0 to 10. (0: turns off parallax effect, 10: fixed slide image position)', 'LayerSlider'),
			'attrs' => array(
				'type' => 'number',
				'min' => 0,
				'max' => 10
			)
		),

		'parallaxOrigin' => array(
			'value' => 'top',
			'name' => jols__('Parallax origin', 'LayerSlider'),
			'keys' => array('parallaxorigin', 'parallaxOrigin'),
			'desc' => jols__('This option has effects only on layers. When the slider is on the Top|Center|Bottom of the screen, the layers are in their starting points.', 'LayerSlider'),
			'options' => array(
				'top' => jols__('Top of screen', 'LayerSlider'),
				'center' => jols__('Center of screen', 'LayerSlider'),
				'bottom' => jols__('Bottom of screen', 'LayerSlider'),
			)
		),

		'parallaxScrollDuration' => array(
			'value' => 0,
			'name' => jols__('Effect duration', 'LayerSlider'),
			'keys' => array('parallaxscrollduration', 'parallaxScrollDuration'),
			'desc' => jols__('Duration of the parallax scrolling effect. (1 sec = 1000 ms)', 'LayerSlider'),
			'attrs' => array(
				'type' => 'number',
				'min' => 0,
				'step' => 50
			)
		),

		'parallaxScrollOnMobile' => array(
			'value' => false,
			'name' => jols__('Enable on mobile', 'LayerSlider'),
			'keys' => array('parallaxscrollonmobile', 'parallaxScrollOnMobile'),
			'desc' => jols__('Enable parallax scrolling effect on mobiles.', 'LayerSlider')
		),

		// ============ //
		// |  Videos  | //
		// ============ //

		// Automatically starts vidoes on the given slide.
		'autoPlayVideos' => array(
			'value' => true,
			'name' => jols__('Automatically play videos', 'LayerSlider'),
			'keys' => array('autoplayvideos', 'autoPlayVideos'),
			'desc' => jols__('Videos will be automatically started on the active slide.', 'LayerSlider')
		),

		// Automatically pauses the slideshow when a video is playing.
		// Auto means it only pauses the slideshow while the video is playing.
		// Possible values: 'auto', 'enabled', 'disabled'
		'autoPauseSlideshow' => array(
			'value' => 'auto',
			'name' => jols__('Pause slideshow', 'LayerSlider'),
			'keys' => array('autopauseslideshow', 'autoPauseSlideshow'),
			'desc' => jols__('The slideshow can temporally be paused while videos are playing. You can choose to permanently stop the pause until manual restarting.', 'LayerSlider'),
			'options' => array(
				'auto' => jols__('While playing', 'LayerSlider'),
				'enabled' => jols__('Permanently', 'LayerSlider'),
				'disabled' => jols__('No action', 'LayerSlider')
			)
		),

		// The preview image quality of a YouTube video.
		// Some videos doesn't have HD preview images and
		// you may have to lower the quality settings.
		// Possible values:
			// 'maxresdefault.jpg',
			// 'hqdefault.jpg',
			// 'mqdefault.jpg',
			// 'default.jpg'
		'youtubePreviewQuality' => array(
			'value' => 'maxresdefault.jpg',
			'name' => jols__('Youtube preview', 'LayerSlider'),
			'keys' => array('youtubepreview', 'youtubePreview'),
			'desc' => jols__('The preview image quaility for YouTube videos. Please note, some videos do not have HD previews, and you may need to choose a lower quaility.', 'LayerSlider'),
			'options' => array(
				'maxresdefault.jpg' => jols__('Maximum quality', 'LayerSlider'),
				'hqdefault.jpg' => jols__('High quality', 'LayerSlider'),
				'mqdefault.jpg' => jols__('Medium quality', 'LayerSlider'),
				'default.jpg' => jols__('Default quality', 'LayerSlider')
			)
		),

		// ========== //
		// |  Misc  | //
		// ========== //

		// Preloads images from the first slide before displaying the slider.
		'imagePreload' => array(
			'value' => true,
			'name' => jols__('Image preload', 'LayerSlider'),
			'keys' => array('imgpreload', 'imgPreload'),
			'desc' => jols__('Preloads images used in the next slides for seamless animations.', 'LayerSlider')
		),

		'lazyLoad' => array(
			'value' => true,
			'name' => jols__('Lazy load images', 'LayerSlider'),
			'keys' => array('lazyload', 'lazyLoad'),
			'desc' => jols__('Loads images only when needed to save bandwidth and server resources. Relies on the preload feature.', 'LayerSlider')
		),

		// Ignores the host/domain names in URLS by converting the to
		// relative format. Useful when you move your site.
		// Prevents linking content from 3rd party servers.
		'relativeURLs' => array(
			'value' => false,
			'name' => jols__('Use relative URLs', 'LayerSlider'),
			'keys' => 'relativeurls',
			'desc' => jols__('Use relative URLs for local images. This setting could be important when moving your CMS installation.', 'LayerSlider'),
			'props' => array(
				'meta' => true
			)
		),

		// Store image paths relative from CMS root directory
		'CMSrelativeURLs' => array(
			'value' => false,
			'name' => jols__('Use CMS relative URLs', 'LayerSlider'),
			'keys' => 'cmsrelativeurls',
			'desc' => jols__('Store image paths relative from CMS root directory. This setting could be important when moving your CMS installation.', 'LayerSlider'),
			'props' => array(
				'meta' => true
			)
		),


		// ============== //
		// |  YourLogo  | //
		// ============== //

		// Places a fixed image on the top of the slider.
		'yourLogoImage' => array(
			'value' => '',
			'name' => jols__('YourLogo', 'LayerSlider'),
			'keys' => array('yourlogo', 'yourLogo'),
			'desc' => jols__('A fixed image layer can be shown above the slider that remains still during slide progression. Can be used to display logos or watermarks.', 'LayerSlider')
		),

		// Custom CSS style settings for the YourLogo image.
		// Depends on: yourLogoImage
		'yourLogoStyle' => array(
			'value' => 'left: -10px; top: -10px;',
			'name' => jols__('YourLogo style', 'LayerSlider'),
			'keys' => array('yourlogostyle', 'yourLogoStyle'),
			'desc' => jols__('CSS properties to control the image placement and appearance.', 'LayerSlider')
		),

		// Linking the YourLogo image to a given URL.
		// Depends on: yourLogoImage
		'yourLogoLink' => array(
			'value' => '',
			'name' => jols__('YourLogo link', 'LayerSlider'),
			'keys' => array('yourlogolink', 'yourLogoLink'),
			'desc' => jols__('Enter an URL to link the YourLogo image.', 'LayerSlider')
		),

		// Link target for yourLogoLink.
		// Depends on: yourLogoLink
		'yourLogoTarget' => array(
			'value' => '_self',
			'name' => jols__('Link target', 'LayerSlider'),
			'keys' => array('yourlogotarget', 'yourLogoTarget'),
			'desc' => '',
			'options' => array(
				'_self' => 'Open on the same page',
				'_blank' => 'Open on new page',
				'_parent' => 'Open in parent frame',
				'_top' => 'Open in main frame',
				'ls-gallery' => 'Open in gallery',
				'ls-scroll-to' => 'Scroll to element (ID)'
			),
		),

		// generator options
		'generatorType' => array(
			'value' => '',
			'keys' => 'generator_type',
			'props' => array(
				'meta' => true
			)
		),

		'postPath' => array(
			'value' => '',
			'keys' => 'post_path',
			'props' => array(
				'meta' => true
			)
		),

		// Post options
		'postType' => array(
			'value' => '',
			'keys' => 'post_type',
			'props' => array(
				'meta' => true
			)
		),

		'postOrderBy' => array(
			'value' => 'date',
			'keys' => 'post_orderby',
			'options' => array(
				'date' => 'Date Created',
				'modified' => 'Last Modified',
				'ID' => 'Post ID',
				'title' => 'Post Title',
				'comment_count' => 'Number of Comments',
				'rand' => 'Random'
			),
			'props' => array(
				'meta' => true
			)
		),

		'postOrder' => array(
			'value' => 'DESC',
			'keys' => 'post_order',
			'options' => array(
				'ASC' => 'Ascending',
				'DESC' => 'Descending'
			),
			'props' => array(
				'meta' => true
			)
		),

		'postLanguages' => array(
			'value' => '',
			'keys' => 'post_languages',
			'props' => array(
				'meta' => true
			)
		),

		'postCategories' => array(
			'value' => '',
			'keys' => 'post_categories',
			'props' => array(
				'meta' => true
			)
		),

		'postApps' => array(
			'value' => '',
			'keys' => 'post_apps',
			'props' => array(
				'meta' => true
			)
		),

		'postAuthors' => array(
			'value' => '',
			'keys' => 'post_authors',
			'props' => array(
				'meta' => true
			)
		),

		'postManufacturers' => array(
			'value' => '',
			'keys' => 'post_manufacturers',
			'props' => array(
				'meta' => true
			)
		),

		'postTags' => array(
			'value' => '',
			'keys' => 'post_tags',
			'props' => array(
				'meta' => true
			)
		),

		'postTaxonomy' => array(
			'value' => '',
			'keys' => 'post_taxonomy',
			'props' => array(
				'meta' => true
			)
		),

		'postTaxTerms' => array(
			'value' => '',
			'keys' => 'post_tax_terms',
			'props' => array(
				'meta' => true
			)
		),


		'cbInit' => array(
			'value' => "function(element) {\r\n\r\n}",
			'keys' => array('cbinit','cbInit')
		),

		'cbStart' => array(
			'value' => "function(data) {\r\n\r\n}",
			'keys' => array('cbstart','cbStart')
		),

		'cbStop' => array(
			'value' => "function(data) {\r\n\r\n}",
			'keys' => array('cbstop','cbStop')
		),

		'cbPause' => array(
			'value' => "function(data) {\r\n\r\n}",
			'keys' => array('cbpause','cbPause')
		),

		'cbAnimStart' => array(
			'value' => "function(data) {\r\n\r\n}",
			'keys' => array('cbanimstart','cbAnimStart')
		),

		'cbAnimStop' => array(
			'value' => "function(data) {\r\n\r\n}",
			'keys' => array('cbanimstop','cbAnimStop')
		),

		'cbPrev' => array(
			'value' => "function(data) {\r\n\r\n}",
			'keys' => array('cbprev','cbPrev')
		),

		'cbNext' => array(
			'value' => "function(data) {\r\n\r\n}",
			'keys' => array('cbnext','cbNext')
		),
	),

	'slides' => array(

		// The background image of slides
		// Defaults to: void
		'image' => array (
			'value' => '',
			'name' => jols__('Set a slide image', 'LayerSlider'),
			'keys' => 'background',
			'tooltip' => jols__('The slide image/background. Click on the image to open the Media Library to choose or upload an image.', 'LayerSlider'),
			'props' => array( 'meta' => true )
		),

		'imageId' => array (
			'value' => '',
			'keys' => 'backgroundId',
			'props' => array( 'meta' => true )
		),

		'imageSize' => array(
			'value' => 'auto',
			'name' => jols__('Size', 'LayerSlider'),
			'keys' => 'imgsize',
			'tooltip' => jols__('Size of the slide background image.<br><i>Cover</i>: scale the image to be as large as possible so that the slide area is completely covered by the image.<br><i>Contain</i>: scale the image to the largest size such that both its width and its height can fit inside the slide area.', 'LayerSlider'),
			'options' => array(
				'auto' => jols__('Auto', 'LayerSlider', 'LayerSlider'),
				'cover' => jols__('Cover', 'LayerSlider', 'LayerSlider'),
				'contain' => jols__('Contain', 'LayerSlider', 'LayerSlider'),
				'stretch' => jols__('Stretch', 'LayerSlider', 'LayerSlider')
			)
		),

		'imagePosition' => array(
			'value' => '50% 50%',
			'name' => jols__('Position', 'LayerSlider'),
			'keys' => 'imgposition',
			'tooltip' => jols__('Position of the slide background image. The first value is the horizontal position and the second value is the vertical.', 'LayerSlider'),
			'options' => array(
				'0% 0%' => jols__('left top', 'LayerSlider', 'LayerSlider'),
				'0% 50%' => jols__('left center', 'LayerSlider', 'LayerSlider'),
				'0% 100%' => jols__('left bottom', 'LayerSlider', 'LayerSlider'),
				'50% 0%' => jols__('center top', 'LayerSlider', 'LayerSlider'),
				'50% 50%' => jols__('center center', 'LayerSlider', 'LayerSlider'),
				'50% 100%' => jols__('center bottom', 'LayerSlider', 'LayerSlider'),
				'100% 0%' => jols__('right top', 'LayerSlider', 'LayerSlider'),
				'100% 50%' => jols__('right center', 'LayerSlider', 'LayerSlider'),
				'100% 100%' => jols__('right bottom', 'LayerSlider', 'LayerSlider')
			)
		),

		'imageAlt' => array(
			'value' => '',
			'name' => jols__('Alt', 'LayerSlider'),
			'keys' => 'imgalt',
			'tooltip' => jols__('The alt attribute should describe the image if the image contains information', 'LayerSlider'),
			'props' => array( 'meta' => true )
		),

		'thumbnail' => array (
			'value' => '',
			'name' => jols__('Set a slide thumbnail', 'LayerSlider'),
			'keys' => 'thumbnail',
			'tooltip' => jols__('The thumbnail image of this slide. Click on the image to open the Media Library to choose or upload an image. If you leave this field empty, the slide image will be used.', 'LayerSlider'),
			'props' => array( 'meta' => true )
		),

		'thumbnailId' => array (
			'value' => '',
			'keys' => 'thumbnailId',
			'props' => array( 'meta' => true )
		),

		// Default slide delay in millisecs.
		// Defaults to: 4000 (ms) => 4secs
		'delay' => array(
			'value' => 4000,
			'name' => jols__('Duration', 'LayerSlider'),
			'keys' => 'slidedelay',
			'tooltip' => jols__("Here you can set the time interval between slide changes, this slide will stay visible for the time specified here. This value is in millisecs, so the value 1000 means 1 second. Please don't use 0 or very low values.", "LayerSlider"),
			'attrs' => array(
				'min' => 0,
				'step' => 500
			)
		),

		'2dTransitions' => array(
			'value' => '',
			'keys' => array('2d_transitions', 'transition2d')
		),

		'3dTransitions' => array(
			'value' => '',
			'keys' => array('3d_transitions', 'transition3d')
		),

		'custom2dTransitions' => array(
			'value' => '',
			'keys' => array('custom_2d_transitions', 'customtransition2d')
		),

		'custom3dTransitions' => array(
			'value' => '',
			'keys' => array('custom_3d_transitions', 'customtransition3d')
		),

		'timeshift' => array (
			'value' => 0,
			'name' => jols__('Time Shift', 'LayerSlider'),
			'keys' => 'timeshift',
			'tooltip' => jols__('You can control here the timing of the layer animations when the slider changes to this slide with a 3D/2D transition. Zero means that the layers of this slide will animate in when the slide transition ends. You can time-shift the starting time of the layer animations with positive or negative values.', 'LayerSlider'),
			'attrs' => array(
				'step' => 50
			)
		),

		'linkUrl' => array (
			'value' => '',
			'name' => jols__('Enter URL', 'LayerSlider'),
			'keys' => array('layer_link', 'linkUrl'),
			'tooltip' => jols__('If you want to link the whole slide, enter the URL of your link here.', 'LayerSlider'),
			'props' => array(
				'meta' => true
			)

		),

		'linkTarget' => array (
			'value' => '_self',
			'name' => jols__('Link Target', 'LayerSlider'),
			'keys' => array('layer_link_target', 'linkTarget'),
			'options' => array(
				'_self' => 'Open on the same page',
				'_blank' => 'Open on new page',
				'_parent' => 'Open in parent frame',
				'_top' => 'Open in main frame',
				'ls-gallery' => 'Open in gallery',
				'ls-scroll-to' => 'Scroll to element (ID)'
			),
			'props' => array(
				'meta' => true
			)

		),

		'ID' => array (
			'value' => '',
			'name' => jols__('#ID', 'LayerSlider'),
			'keys' => 'id',
			'tooltip' => jols__('You can apply an ID attribute on the HTML element of this slide to work with it in your custom CSS or Javascript code.', 'LayerSlider'),
			'props' => array(
				'meta' => true
			)
		),

		'deeplink' => array (
			'value' => '',
			'name' => jols__('Deeplink', 'LayerSlider'),
			'keys' => 'deeplink',
			'tooltip' => jols__('You can specify a slide alias name which you can use in your URLs with a hash mark, so LayerSlider will start with the correspondig slide.', 'LayerSlider')
		),

		'postOffset' => array(
			'value' => '',
			'keys' => 'post_offset',
			'props' => array(
				'meta' => true
			)
		),

		'skipSlide' => array(
			'value' => false,
			'name' => jols__('Hidden', 'LayerSlider'),
			'keys' => 'skip',
			'tooltip' => jols__("If you don't want to use this slide in your front-page, but you want to keep it, you can hide it with this switch.", 'LayerSlider'),
			'props' => array(
				'meta' => true
			)
		),

		//  DEPRECATED OLD TRANSITIONS
		'slidedirection' => array( 'value' => 'right', 'keys' => 'slidedirection'),
		'durationin' => array( 'value' => 1500, 'keys' => 'durationin'),
		'durationout' => array( 'value' => 1500, 'keys' => 'durationout'),
		'easingin' => array( 'value' => 'easeInOutQuint', 'keys' => 'easingin'),
		'easingout' => array( 'value' => 'easeInOutQuint', 'keys' => 'easingout'),
		'delayin' => array( 'value' => 0, 'keys' => 'delayin'),
		'delayout' => array( 'value' => 0, 'keys' => 'slidedidelayoutrection')
	),

	'layers' => array(

		// ======================= //
		// |  Content  | //
		// ======================= //

		'type' => array(
			'value' => '',
			'keys' => 'type',
			'props' => array(
				'meta' => true
			)
		),

		'media' => array(
			'value' => '',
			'keys' => 'media',
			'props' => array(
				'meta' => true
			)
		),

		'image' => array(
			'value' => '',
			'keys' => 'image',
			'props' => array(
				'meta' => true
			)
		),

		'imageId' => array(
			'value' => '',
			'keys' => 'imageId',
			'props' => array( 'meta' => true )
		),

		'html' => array(
			'value' => '',
			'keys' => 'html',
			'props' => array(
				'meta' => true
			)
		),

		'postTextLength' => array(
			'value' => '',
			'keys' => 'post_text_length',
			'props' => array(
				'meta' => true
			)
		),


		// ======================= //
		// |  Animation options  | //
		// ======================= //
		'transition' => array( 'value' => '', 'keys' => 'transition', 'props' => array( 'meta' => true )),

		'transitionInOffsetX' => array(
			'value' => '80',
			'name' => jols__('OffsetX', 'LayerSlider'),
			'keys' => 'offsetxin',
			'tooltip' => jols__("The horizontal offset to align the starting position of layers. Positive and negative numbers are allowed or enter left / right to position the layer out of the frame.", "LayerSlider")
		),

		'transitionInOffsetY' => array(
			'value' => '0',
			'name' => jols__('OffsetY', 'LayerSlider'),
			'keys' => 'offsetyin',
			'tooltip' => jols__("The vertical offset to align the starting position of layers. Positive and negative numbers are allowed or enter top / bottom to position the layer out of the frame.", "LayerSlider")
		),

		// Duration of the transition in millisecs when a layer animates in.
		// Original: durationin
		// Defaults to: 1000 (ms) => 1sec
		'transitionInDuration' => array(
			'value' => 1000,
			'name' => jols__('Duration', 'LayerSlider'),
			'keys' => 'durationin',
			'tooltip' => jols__('The transition duration in milliseconds when the layer enters into the slide. A second equals to 1000 milliseconds.', 'LayerSlider'),
			'attrs' => array( 'min' => 0, 'step' => 50 )
		),

		// Delay before the transition in millisecs when a layer animates in.
		// Original: delayin
		// Defaults to: 0 (ms)
		'transitionInDelay' => array(
			'value' => 0,
			'name' => jols__('Delay', 'LayerSlider'),
			'keys' => 'delayin',
			'tooltip' => jols__('Delays the transition with the given amount of milliseconds before the layer enters into the slide. A second equals to 1000 milliseconds.', 'LayerSlider'),
			'attrs' => array( 'min' => 0, 'step' => 50 )
		),

		// Easing of the transition when a layer animates in.
		// Original: easingin
		// Defaults to: 'easeInOutQuint'
		'transitionInEasing' => array(
			'value' => 'easeInOutQuint',
			'name' => jols__('Easing', 'LayerSlider'),
			'keys' => 'easingin',
			'tooltip' => jols__("The timing function of the animation. With this function you can manipulate the movement of the animated object. Please click on the link next to this select field to open easings.net for more information and real-time examples.", "LayerSlider")
		),

		'transitionInFade' => array(
			'value' => true,
			'name' => jols__('Fade', 'LayerSlider'),
			'keys' => 'fadein',
			'tooltip' => jols__('Fade the layer during the transition.', 'LayerSlider'),
		),

		// Initial rotation degrees when a layer animates in.
		// Original: rotatein
		// Defaults to: 0 (deg)
		'transitionInRotate' => array(
			'value' => 0,
			'name' => jols__('Rotate', 'LayerSlider'),
			'keys' => 'rotatein',
			'tooltip' => jols__('Rotates the layer clockwise from the given angle to zero degree. Negative values are allowed for counterclockwise rotation.', 'LayerSlider')
		),

		'transitionInRotateX' => array(
			'value' => 0,
			'name' => jols__('RotateX', 'LayerSlider'),
			'keys' => 'rotatexin',
			'tooltip' => jols__('Rotates the layer along the X (horizontal) axis from the given angle to zero degree. Negative values are allowed for reverse direction.', 'LayerSlider')
		),

		'transitionInRotateY' => array(
			'value' => 0,
			'name' => jols__('RotateY', 'LayerSlider'),
			'keys' => 'rotateyin',
			'tooltip' => jols__('Rotates the layer along the Y (vertical) axis from the given angle to zero degree. Negative values are allowed for reverse direction.', 'LayerSlider')
		),

		'transitionInSkewX' => array(
			'value' => 0,
			'name' => jols__('SkewX', 'LayerSlider'),
			'keys' => 'skewxin',
			'tooltip' => jols__('Skews the layer along the X (horizontal) axis from the given angle to 0 degree. Negative values are allowed for reverse direction.', 'LayerSlider')
		),

		'transitionInSkewY' => array(
			'value' => 0,
			'name' => jols__('SkewY', 'LayerSlider'),
			'keys' => 'skewyin',
			'tooltip' => jols__('Skews the layer along the Y (vertical) axis from the given angle to 0 degree. Negative values are allowed for reverse direction.', 'LayerSlider'),
		),

		'transitionInScaleX' => array(
			'value' => 1,
			'name' => jols__('ScaleX', 'LayerSlider'),
			'keys' => 'scalexin',
			'tooltip' => jols__("Scales the layer's width from the given value to its original size.", "LayerSlider"),
			'attrs' => array( 'step' => 0.1 )
		),

		'transitionInScaleY' => array(
			'value' => 1,
			'name' => jols__('ScaleY', 'LayerSlider'),
			'keys' => 'scaleyin',
			'tooltip' => jols__("Scales the layer's height from the given value to its original size.", "LayerSlider"),
			'attrs' => array( 'step' => 0.1 )
		),

		'transitionInTransformOrigin' => array(
			'value' => '50% 50% 0',
			'name' => jols__('TransformOrigin', 'LayerSlider'),
			'keys' => 'transformoriginin',
			'tooltip' => jols__('This option allows you to modify the origin for transformations of the layer according to its position. The three values represent the X, Y and Z axis in 3D space. OriginX can be left, center, right, a number or a percentage value. OriginY can be top, center, bottom, a number or a percentage value. OriginZ can be a number and corresponds the depth in 3D space.', 'LayerSlider'),
		),

		// ======

		'transitionOutOffsetX' => array(
			'value' => '-80',
			'name' => jols__('OffsetX', 'LayerSlider'),
			'keys' => 'offsetxout',
			'tooltip' => jols__("The horizontal offset to align the ending position of layers. Positive and negative numbers are allowed or write left / right to position the layer out of the frame.", "LayerSlider")
		),

		'transitionOutOffsetY' => array(
			'value' => '0',
			'name' => jols__('OffsetY', 'LayerSlider'),
			'keys' => 'offsetyout',
			'tooltip' => jols__("The vertical offset to align the starting position of layers. Positive and negative numbers are allowed or write top / bottom to position the layer out of the frame.", "LayerSlider")
		),

		// Duration of the transition in millisecs when a layer animates out.
		// Original: durationout
		// Defaults to: 1000 (ms) => 1sec
		'transitionOutDuration' => array(
			'value' => 400,
			'name' => jols__('Duration', 'LayerSlider'),
			'keys' => 'durationout',
			'tooltip' => jols__('The transition duration in milliseconds when the layer leaves the slide. A second equals to 1000 milliseconds.', 'LayerSlider'),
			'attrs' => array( 'min' => 0, 'step' => 50 )
		),

		// You can create timed layers by specifing their time they can take on a slide in millisecs.
		// Original: showuntil
		// Defaults to: 0 (ms)
		'showUntil' => array(
			'value' => 0,
			'name' => jols__('Show until', 'LayerSlider'),
			'keys' => 'showuntil',
			'tooltip' => jols__('The layer will be visible for the time you specify here, then it will slide out. You can use this setting for layers to leave the slide before the slide itself animates out, or for example before other layers will slide in. This value in millisecs, so the value 1000 means 1 second.', 'LayerSlider'),
			'attrs' => array( 'min' => 0, 'step' => 50 )
		),

		// Easing of the transition when a layer animates out.
		// Original: easingout
		// Defaults to: 'easeInOutQuint'
		'transitionOutEasing' => array(
			'value' => 'easeInOutQuint',
			'name' => jols__('Easing', 'LayerSlider'),
			'keys' => 'easingout',
			'tooltip' => jols__("The timing function of the animation. With this function you can manipulate the movement of the animated object. Please click on the link next to this select field to open easings.net for more information and real-time examples.", "LayerSlider")
		),

		'transitionOutFade' => array(
			'value' => true,
			'name' => jols__('Fade', 'LayerSlider'),
			'keys' => 'fadeout',
			'tooltip' => jols__('Fade the layer during the transition.', 'LayerSlider'),
		),


		// Initial rotation degrees when a layer animates out.
		// Original: rotateout
		// Defaults to: 0 (deg)
		'transitionOutRotate' => array(
			'value' => 0,
			'name' => jols__('Rotate', 'LayerSlider'),
			'keys' => 'rotateout',
			'tooltip' => jols__('Rotates the layer clockwise by the given angle from its original position. Negative values are allowed for counterclockwise rotation.', 'LayerSlider')
		),

		'transitionOutRotateX' => array(
			'value' => 0,
			'name' => jols__('RotateX', 'LayerSlider'),
			'keys' => 'rotatexout',
			'tooltip' => jols__('Rotates the layer along the X (horizontal) axis by the given angle from its original state. Negative values are allowed for reverse direction.', 'LayerSlider')
		),

		'transitionOutRotateY' => array(
			'value' => 0,
			'name' => jols__('RotateY', 'LayerSlider'),
			'keys' => 'rotateyout',
			'tooltip' => jols__('Rotates the layer along the Y (vertical) axis by the given angle from its orignal state. Negative values are allowed for reverse direction.', 'LayerSlider')
		),

		'transitionOutSkewX' => array(
			'value' => 0,
			'name' => jols__('SkewX', 'LayerSlider'),
			'keys' => 'skewxout',
			'tooltip' => jols__('Skews the layer along the X (horizontal) axis by the given angle from its orignal state. Negative values are allowed for reverse direction.', 'LayerSlider')
		),

		'transitionOutSkewY' => array(
			'value' => 0,
			'name' => jols__('SkewY', 'LayerSlider'),
			'keys' => 'skewyout',
			'tooltip' => jols__('Skews the layer along the Y (vertical) axis by the given angle from its original state. Negative values are allowed for reverse direction.', 'LayerSlider'),
		),

		'transitionOutScaleX' => array(
			'value' => 1,
			'name' => jols__('ScaleX', 'LayerSlider'),
			'keys' => 'scalexout',
			'tooltip' => jols__("Scales the layer's width by the given value from its original size.", "LayerSlider"),
			'attrs' => array( 'step' => 0.1 )
		),

		'transitionOutScaleY' => array(
			'value' => 1,
			'name' => jols__('ScaleY', 'LayerSlider'),
			'keys' => 'scaleyout',
			'tooltip' => jols__("Scales the layer's height by the given value from its original size.", "LayerSlider"),
			'attrs' => array( 'step' => 0.1 )
		),

		'transitionOutTransformOrigin' => array(
			'value' => '50% 50% 0',
			'name' => jols__('TransformOrigin', 'LayerSlider'),
			'keys' => 'transformoriginout',
			'tooltip' => jols__('This option allows you to modify the origin for transformations of the layer according to its position. The three values represent the X, Y and Z axis in 3D space. OriginX can be left, center, right, a number or a percentage value. OriginY can be top, center, bottom, a number or a percentage value. OriginZ can be a number and corresponds the depth in 3D space.', 'LayerSlider'),
		),

		'transitionParallaxLevel' => array(
			'value' => 0,
			'name' => jols__('Parallax Level', 'LayerSlider'),
			'keys' => 'parallaxlevel',
			'tooltip' => jols__('Applies a parallax effect on layers when you move your mouse over the slider. Higher values make the layer more sensitive to mouse move. Negative values are allowed.', 'LayerSlider')
		),


		// == Compatibility ==
		'transitionInType' => array(
			'value' => 'auto',
			'name' => jols__('Type', 'LayerSlider'),
			'keys' => 'slidedirection'
		),
		'transitionOutType' => array(
			'value' => 'auto',
			'name' => jols__('Type', 'LayerSlider'),
			'keys' => 'slideoutdirection'
		),

		'transitionOutDelay' => array(
			'value' => 0,
			'name' => jols__('Delay', 'LayerSlider'),
			'keys' => 'delayout',
			'tooltip' => jols__('Delay before the animation start when the layer slides out. This value is in millisecs, so the value 1000 means 1 second.', 'LayerSlider'),
			'attrs' => array(
				'min' => 0,
				'step' => 50
			)
		),

		'transitionInScale' => array(
			'value' => '1.0',
			'name' => jols__('Scale', 'LayerSlider'),
			'keys' => 'scalein',
			'tooltip' => jols__('You can set the initial scale of this layer here which will be animated to the default (1.0) value.', 'LayerSlider'),
			'attrs' => array(
				'step' => 0.1
			)
		),

		'transitionOutScale' => array(
			'value' => '1.0',
			'name' => jols__('Scale', 'LayerSlider'),
			'keys' => 'scaleout',
			'tooltip' => jols__('You can set the ending scale value here, this sublayer will be animated from the default (1.0) value to yours.', 'LayerSlider'),
			'attrs' => array(
				'step' => 0.1
			)
		),

		'skipLayer' => array(
			'value' => false,
			'name' => jols__('Hidden', 'LayerSlider'),
			'keys' => 'skip',
			'tooltip' => jols__("If you don't want to use this layer, but you want to keep it, you can hide it with this switch.", "LayerSlider"),
			'props' => array(
				'meta' => true
			)
		),

		// ======

		'transitionInSplit' => array(
			'value' => '',
			'name' => jols__('Animate', 'LayerSlider'),
			'keys' => 'splitin',
			'tooltip' => jols__('You can animate texts by characters, words or lines', 'LayerSlider'),
			'options' => array(
				'' => 'full text',
				'lines_asc'  => 'by lines ascending',
				'lines_desc' => 'by lines descending',
				'lines_rand' => 'by lines random',
				'words_asc'  => 'by words ascending',
				'words_desc' => 'by words descending',
				'words_rand' => 'by words random',
				'chars_asc'  => 'by chars ascending',
				'chars_desc' => 'by chars descending',
				'chars_rand' => 'by chars random'
			)
		),

		'transitionOutSplit' => array(
			'value' => '',
			'name' => jols__('Animate', 'LayerSlider'),
			'keys' => 'splitout',
			'tooltip' => jols__('You can animate texts by characters, words or lines', 'LayerSlider'),
			'options' => array(
				'' => 'full text',
				'lines_asc'  => 'by lines ascending',
				'lines_desc' => 'by lines descending',
				'lines_rand' => 'by lines random',
				'words_asc'  => 'by words ascending',
				'words_desc' => 'by words descending',
				'words_rand' => 'by words random',
				'chars_asc'  => 'by chars ascending',
				'chars_desc' => 'by chars descending',
				'chars_rand' => 'by chars random'
			)
		),

		'transitionInShift' => array(
			'value' => 50,
			'name' => jols__('Shift time', 'LayerSlider'),
			'keys' => 'shiftin',
			'tooltip' => jols__("Shift time between text pieces", "LayerSlider"),
			'attrs' => array(
				'min' => 0,
				'step' => 10
			)
		),

		'transitionOutShift' => array(
			'value' => 50,
			'name' => jols__('Shift time', 'LayerSlider'),
			'keys' => 'shiftout',
			'tooltip' => jols__("Shift time between text pieces", "LayerSlider"),
			'attrs' => array(
				'min' => 0,
				'step' => 10
			)
		),

		// Distance level determines the starting and ending position of a layer out of the frame.
		// The value of -1 means automatic positioning outside of the frame. In some cases you might
		// have to use a manual value greater than 3.
		// Original: level
		// Defaults to: -1
		'distanceLevel' => array(
			'value' => -1,
			'name' => jols__('Distance', 'LayerSlider'),
			'keys' => 'level',
			'tooltip' => jols__('The default value is -1 which means that the layer will be positioned exactly outside of the slide container. You can use the default setting in most of the cases. If you need to set the start or end position of the layer from further of the edges of the slide container, you can use 2, 3 or higher values.', 'LayerSlider'),
			'attrs' => array(
				'min' => -1
			),
			'props' => array(
				'meta' => true
			)
		),
/*
    // LOOP
		'loopOffsetX' => array(
			'value' => '0',
			'name' => jols__('OffsetX', 'LayerSlider'),
			'keys' => 'offsetxloop',
			'tooltip' => jols__("Move the layer horizontally to the given value. Positive and negative numbers are allowed or enter left / right to position the layer out of the frame.", "LayerSlider")
		),

		'loopOffsetY' => array(
			'value' => '0',
			'name' => jols__('OffsetY', 'LayerSlider'),
			'keys' => 'offsetyloop',
			'tooltip' => jols__("Move the layer vertically to the given value. Positive and negative numbers are allowed or write top / bottom to position the layer out of the frame.", "LayerSlider")
		),

		'loopDuration' => array(
			'value' => 1000,
			'name' => jols__('Duration', 'LayerSlider'),
			'keys' => 'durationloop',
			'tooltip' => jols__('The transition duration in milliseconds. A second is equal to 1000 milliseconds.', 'LayerSlider'),
			'attrs' => array( 'min' => 0, 'step' => 50 )
		),

		'loopDelay' => array(
			'value' => 0,
			'name' => jols__('Delay', 'LayerSlider'),
			'keys' => 'delayloop',
			'tooltip' => jols__('Delays the transition with the given amount of milliseconds. A second is equal to 1000 milliseconds.', 'LayerSlider'),
			'attrs' => array( 'step' => 50 )
		),

		'loopEasing' => array(
			'value' => 'easeInOutQuint',
			'name' => jols__('Easing', 'LayerSlider'),
			'keys' => 'easingloop',
			'tooltip' => jols__("The timing function of the animation to manipualte the layer's movement. Click on the link next to this field to open easings.net for examples and more information", "LayerSlider")
		),

		'loopOpacity' => array(
			'value' => 1,
			'name' => jols__('Opacity', 'LayerSlider'),
			'keys' => 'opacityloop',
			'tooltip' => jols__('Fades the layer to the given value.', 'LayerSlider'),
			'attrs' => array( 'min' => 0, 'max' => 1, 'step' => 0.01 )
		),

		'loopRotate' => array(
			'value' => 0,
			'name' => jols__('Rotate', 'LayerSlider'),
			'keys' => 'rotateloop',
			'tooltip' => jols__('Rotates the layer clockwise to the given angle. Negative values are allowed for anticlockwise rotation.', 'LayerSlider')
		),

		'loopRotateX' => array(
			'value' => 0,
			'name' => jols__('RotateX', 'LayerSlider'),
			'keys' => 'rotatexloop',
			'tooltip' => jols__('Rotates the layer along the X (horizontal) axis to the given angle. Negative values are allowed for reverse direction.', 'LayerSlider')
		),

		'loopRotateY' => array(
			'value' => 0,
			'name' => jols__('RotateY', 'LayerSlider'),
			'keys' => 'rotateyloop',
			'tooltip' => jols__('Rotates the layer along the Y (vertical) axis to the given angle. Negative values are allowed for reverse direction.', 'LayerSlider')
		),

		'loopSkewX' => array(
			'value' => 0,
			'name' => jols__('SkewX', 'LayerSlider'),
			'keys' => 'skewxloop',
			'tooltip' => jols__('Skews the layer along the X (horizontal) axis to the given angle. Negative values are allowed for reverse direction.', 'LayerSlider')
		),

		'loopSkewY' => array(
			'value' => 0,
			'name' => jols__('SkewY', 'LayerSlider'),
			'keys' => 'skewyloop',
			'tooltip' => jols__('Skews the layer along the Y (vertical) axis to the given angle. Negative values are allowed for reverse direction.', 'LayerSlider'),
		),

		'loopScaleX' => array(
			'value' => 1,
			'name' => jols__('ScaleX', 'LayerSlider'),
			'keys' => 'scalexloop',
			'tooltip' => jols__("Scales the layer's width to the given value.", "LayerSlider"),
			'attrs' => array( 'step' => 0.1 )
		),

		'loopScaleY' => array(
			'value' => 1,
			'name' => jols__('ScaleY', 'LayerSlider'),
			'keys' => 'scaleyloop',
			'tooltip' => jols__("Scales the layer's height to the given value.", "LayerSlider"),
			'attrs' => array( 'step' => 0.1 )
		),

		'loopTransformOrigin' => array(
			'value' => '',
      'attrs' => array( 'placeholder' => 'inherit' ),
			'name' => jols__('TransformOrigin', 'LayerSlider'),
			'keys' => 'transformoriginloop',
			'tooltip' => jols__('This option allows you to modify the origin for transformations of the layer according to its position. The three values represent the X, Y and Z axis in 3D space. OriginX can be left, center, right, a number or a percentage value. OriginY can be top, center, bottom, a number or a percentage value. OriginZ can be a number and corresponds the depth in 3D space.', 'LayerSlider'),
		),

		'loopCount' => array(
			'value' => 0,
			'name' => jols__('Count', 'LayerSlider'),
			'keys' => 'countloop',
			'tooltip' => jols__("-1: infinite, 0: no loop", "LayerSlider"),
			'attrs' => array( 'step' => 1 )
		),

		'loopWait' => array(
			'value' => 0,
			'name' => jols__('Wait', 'LayerSlider'),
			'keys' => 'waitloop',
			'tooltip' => jols__('Delays the next loop with the given amount of milliseconds. A second is equal to 1000 milliseconds.', 'LayerSlider'),
			'attrs' => array( 'min' => 0, 'step' => 50 )
		),

		'loopYoyo' => array(
			'value' => '',
			'name' => jols__('Yoyo', 'LayerSlider'),
			'keys' => 'yoyoloop',
			'tooltip' => jols__('Every second loops will be played backward.', 'LayerSlider')
		),

		'yoyoDuration' => array(
			'value' => null,
			'name' => jols__('Yoyo reverse<br>duration', 'LayerSlider'),
			'keys' => 'durationyoyo',
			'tooltip' => jols__('The duration of the yoyo transition in milliseconds. A second is equal to 1000 milliseconds.', 'LayerSlider'),
			'attrs' => array( 'min' => 0, 'step' => 50, 'placeholder' => 'same')
		),

		'yoyoEasing' => array(
			'value' => '',
			'name' => jols__('Yoyo reverse<br>easing', 'LayerSlider'),
			'keys' => 'easingyoyo',
			'tooltip' => jols__("The timing function of the yoyo animation to manipualte the layer's movement. Click on the link next to this field to open easings.net for examples and more information", "LayerSlider")
		),
    // END LOOP

    // HOVER
		'hoverOffsetX' => array(
			'value' => '0',
			'name' => jols__('OffsetX', 'LayerSlider'),
			'keys' => 'offsetxhover',
			'tooltip' => jols__("Move the layer horizontally to the given value. Positive and negative numbers are allowed or enter left / right to position the layer out of the frame.", "LayerSlider")
		),

		'hoverOffsetY' => array(
			'value' => '0',
			'name' => jols__('OffsetY', 'LayerSlider'),
			'keys' => 'offsetyhover',
			'tooltip' => jols__("Move the layer vertically to the given value. Positive and negative numbers are allowed or write top / bottom to position the layer out of the frame.", "LayerSlider")
		),

		'hoverDuration' => array(
			'value' => 500,
			'name' => jols__('Duration', 'LayerSlider'),
			'keys' => 'durationhover',
			'tooltip' => jols__('The transition duration in milliseconds. A second is equal to 1000 milliseconds.', 'LayerSlider'),
			'attrs' => array( 'min' => 0, 'step' => 50 )
		),

		'hoverDelay' => array(
			'value' => 0,
			'name' => jols__('Delay', 'LayerSlider'),
			'keys' => 'delayhover',
			'tooltip' => jols__('Delays the transition with the given amount of milliseconds. A second is equal to 1000 milliseconds.', 'LayerSlider'),
			'attrs' => array( 'step' => 50 )
		),

		'hoverEasing' => array(
			'value' => 'easeOutQuint',
			'name' => jols__('Easing', 'LayerSlider'),
			'keys' => 'easinghover',
			'tooltip' => jols__("The timing function of the animation to manipualte the layer's movement. Click on the link next to this field to open easings.net for examples and more information", "LayerSlider")
		),

		'hoverOpacity' => array(
			'value' => 1,
			'name' => jols__('Opacity', 'LayerSlider'),
			'keys' => 'opacityhover',
			'tooltip' => jols__('Fades the layer to the given value.', 'LayerSlider'),
			'attrs' => array( 'min' => 0, 'max' => 1, 'step' => 0.01 )
		),

		'hoverRotate' => array(
			'value' => 0,
			'name' => jols__('Rotate', 'LayerSlider'),
			'keys' => 'rotatehover',
			'tooltip' => jols__('Rotates the layer clockwise to the given angle. Negative values are allowed for anticlockwise rotation.', 'LayerSlider')
		),

		'hoverRotateX' => array(
			'value' => 0,
			'name' => jols__('RotateX', 'LayerSlider'),
			'keys' => 'rotatexhover',
			'tooltip' => jols__('Rotates the layer along the X (horizontal) axis to the given angle. Negative values are allowed for reverse direction.', 'LayerSlider')
		),

		'hoverRotateY' => array(
			'value' => 0,
			'name' => jols__('RotateY', 'LayerSlider'),
			'keys' => 'rotateyhover',
			'tooltip' => jols__('Rotates the layer along the Y (vertical) axis to the given angle. Negative values are allowed for reverse direction.', 'LayerSlider')
		),

		'hoverSkewX' => array(
			'value' => 0,
			'name' => jols__('SkewX', 'LayerSlider'),
			'keys' => 'skewxhover',
			'tooltip' => jols__('Skews the layer along the X (horizontal) axis to the given angle. Negative values are allowed for reverse direction.', 'LayerSlider')
		),

		'hoverSkewY' => array(
			'value' => 0,
			'name' => jols__('SkewY', 'LayerSlider'),
			'keys' => 'skewyhover',
			'tooltip' => jols__('Skews the layer along the Y (vertical) axis to the given angle. Negative values are allowed for reverse direction.', 'LayerSlider'),
		),

		'hoverScaleX' => array(
			'value' => 1,
			'name' => jols__('ScaleX', 'LayerSlider'),
			'keys' => 'scalexhover',
			'tooltip' => jols__("Scales the layer's width to the given value.", "LayerSlider"),
			'attrs' => array( 'step' => 0.1 )
		),

		'hoverScaleY' => array(
			'value' => 1,
			'name' => jols__('ScaleY', 'LayerSlider'),
			'keys' => 'scaleyhover',
			'tooltip' => jols__("Scales the layer's height to the given value.", "LayerSlider"),
			'attrs' => array( 'step' => 0.1 )
		),

		'hoverTransformOrigin' => array(
			'value' => '',
      'attrs' => array( 'placeholder' => 'inherit' ),
			'name' => jols__('TransformOrigin', 'LayerSlider'),
			'keys' => 'transformoriginhover',
			'tooltip' => jols__('This option allows you to modify the origin for transformations of the layer according to its position. The three values represent the X, Y and Z axis in 3D space. OriginX can be left, center, right, a number or a percentage value. OriginY can be top, center, bottom, a number or a percentage value. OriginZ can be a number and corresponds the depth in 3D space.', 'LayerSlider'),
		),

		'hoverBackground' => array(
			'value' => '',
			'name' => jols__('Background', 'LayerSlider'),
			'keys' => 'backgroundhover',
			'tooltip' => jols__("The background color of your layer. You can use color names, hexadecimal, RGB or RGBA values as well as the 'transparent' keyword. Example: #FFF", "LayerSlider")
		),

		'hoverColor' => array(
			'value' => '',
			'name' => jols__('Color', 'LayerSlider'),
			'keys' => 'colorhover',
			'tooltip' => jols__('The color of your text. You can use color names, hexadecimal, RGB or RGBA values. Example: #333', 'LayerSlider')
		),

		'hoverBorderRadius' => array(
			'value' => '',
			'name' => jols__('Rounded<br>corners', 'LayerSlider'),
			'keys' => 'borderradiushover',
			'tooltip' => jols__('If you want rounded corners, you can set here its radius. Example: 5px', 'LayerSlider')
		),

		'hoverBoxShadow' => array(
			'value' => '',
			'name' => jols__('TextShadow', 'LayerSlider'),
			'keys' => 'boxshadowhover',
			'tooltip' => jols__('', 'LayerSlider')
		),

		'hoverTextShadow' => array(
			'value' => '',
			'name' => jols__('TextShadow', 'LayerSlider'),
			'keys' => 'textshadowhover',
			'tooltip' => jols__('', 'LayerSlider')
		),

		'hoverEnable' => array(
			'value' => 0,
			'name' => jols__('Enable', 'LayerSlider'),
			'keys' => 'enablehover'
		),

		'hoverConnect' => array(
			'value' => '',
			'name' => jols__('Connect', 'LayerSlider'),
			'keys' => 'connecthover',
			'tooltip' => jols__('Connect hover transition to the selected layer or to the whole slide.', 'LayerSlider')
		),

		'hoverConnectName' => array(
			'value' => jols__('- This layer -', 'LayerSlider'),
			'keys' => 'connectname',
			'attr' => array('type' => 'hidden'),
			'props' => array('meta' => true)
		),

		'lsId' => array(
			'value' => null,
			'keys' => 'lsid',
			'attr' => array('type' => 'hidden')
		),

		'reverseDuration' => array(
			'value' => null,
			'name' => jols__('Reverse<br>duration', 'LayerSlider'),
			'keys' => 'durationreverse',
			'tooltip' => jols__('The duration of the reverse transition in milliseconds. A second is equal to 1000 milliseconds.', 'LayerSlider'),
			'attrs' => array( 'min' => 0, 'step' => 50, 'placeholder' => 'same')
		),

		'reverseEasing' => array(
			'value' => '',
			'name' => jols__('Reverse<br>easing', 'LayerSlider'),
			'keys' => 'easingreverse',
			'tooltip' => jols__("The timing function of the reverse animation to manipualte the layer's movement. Click on the link next to this field to open easings.net for examples and more information", "LayerSlider")
		),

    // END HOVER
*/
		'linkURL' => array(
			'value' => '',
			'name' => jols__('Enter URL', 'LayerSlider'),
			'keys' => 'url',
			'tooltip' => jols__('If you want to link your layer, type here the URL. You can use a hash mark followed by a number to link this layer to another slide. Example: #3 - this will switch to the third slide.', 'LayerSlider'),
			'props' => array(
				'meta' => true
			)
		),

		'linkTarget' => array(
			'value' => '_self',
			'name' => jols__('URL target', 'LayerSlider'),
			'keys' => 'target',
			'options' => array(
				'_self' => 'Open on the same page',
				'_blank' => 'Open on new page',
				'_parent' => 'Open in parent frame',
				'_top' => 'Open in main frame',
				'ls-gallery' => 'Open in gallery',
				'ls-scroll-to' => 'Scroll to element (ID)'
			),
			'props' => array(
				'meta' => true
			)
		),

		// Styles

		'width' => array(
			'value' => '',
			'name' => jols__('Width', 'LayerSlider'),
			'keys' => 'width',
			'tooltip' => jols__("You can set the width of your layer. You can use pixels, percentage, or the default value 'auto'. Examples: 100px, 50% or auto.", "LayerSlider"),
			'props' => array(
				'meta' => true
			)
		),

		'height' => array(
			'value' => '',
			'name' => jols__('Height', 'LayerSlider'),
			'keys' => 'height',
			'tooltip' => jols__("You can set the height of your layer. You can use pixels, percentage, or the default value 'auto'. Examples: 100px, 50% or auto", "LayerSlider"),
			'props' => array(
				'meta' => true
			)
		),

		'top' => array(
			'value' => '0px',
			'name' => jols__('Top', 'LayerSlider'),
			'keys' => 'top',
			'tooltip' => jols__("The layer position from the top of the slide. You can use pixels and percentage. Examples: 100px or 50%. You can move your layers in the preview above with a drag n' drop, or set the exact values here.", "LayerSlider"),
			'props' => array(
				'meta' => true
			)
		),

		'left' => array(
			'value' => '0px',
			'name' => jols__('Left', 'LayerSlider'),
			'keys' => 'left',
			'tooltip' => jols__("The layer position from the left side of the slide. You can use pixels and percentage. Examples: 100px or 50%. You can move your layers in the preview above with a drag n' drop, or set the exact values here.", "LayerSlider"),
			'props' => array(
				'meta' => true
			)
		),

    // transform styles

    'opacity' => array(
			'value' => '',
			'name' => jols__('Opacity', 'LayerSlider'),
			'keys' => 'opacity',
			'props' => array(
				'meta' => true
			)
    ),
    'rotate' => array(
			'value' => '',
			'name' => jols__('Rotate', 'LayerSlider'),
			'keys' => 'rotate',
			'tooltip' => jols__("Rotates the layer clockwise by the given angle. Negative values are allowed for anticlockwise rotation.", "LayerSlider")
    ),
    'skewX' => array(
			'value' => '',
			'name' => jols__('SkewX', 'LayerSlider'),
			'keys' => 'skewx',
			'tooltip' => jols__("Skews the layer along the X (horizontal) axis. Negative values are allowed for reverse direction.", "LayerSlider")
    ),
    'skewY' => array(
			'value' => '',
			'name' => jols__('SkewY', 'LayerSlider'),
			'keys' => 'skewx',
			'tooltip' => jols__("Skews the layer along the Y (vertical) axis. Negative values are allowed for reverse direction.", "LayerSlider")
    ),

		'paddingTop' => array(
			'value' => '',
			'name' => jols__('Top', 'LayerSlider'),
			'keys' => 'padding-top',
			'tooltip' => jols__('Padding on the top of the layer. Example: 10px', 'LayerSlider'),
			'props' => array(
				'meta' => true
			)
		),

		'paddingRight' => array(
			'value' => '',
			'name' => jols__('Right', 'LayerSlider'),
			'keys' => 'padding-right',
			'tooltip' => jols__('Padding on the right side of the layer. Example: 10px', 'LayerSlider'),
			'props' => array(
				'meta' => true
			)
		),

		'paddingBottom' => array(
			'value' => '',
			'name' => jols__('Bottom', 'LayerSlider'),
			'keys' => 'padding-bottom',
			'tooltip' => jols__('Padding on the bottom of the layer. Example: 10px', 'LayerSlider'),
			'props' => array(
				'meta' => true
			)
		),

		'paddingLeft' => array(
			'value' => '',
			'name' => jols__('Left', 'LayerSlider'),
			'keys' => 'padding-left',
			'tooltip' => jols__('Padding on the left side of the layer. Example: 10px', 'LayerSlider'),
			'props' => array(
				'meta' => true
			)
		),

		'borderTop' => array(
			'value' => '',
			'name' => jols__('Top', 'LayerSlider'),
			'keys' => 'border-top',
			'tooltip' => jols__('Border on the top of the layer. Example: 5px solid #000', 'LayerSlider'),
			'props' => array(
				'meta' => true
			)
		),

		'borderRight' => array(
			'value' => '',
			'name' => jols__('Right', 'LayerSlider'),
			'keys' => 'border-right',
			'tooltip' => jols__('Border on the right side of the layer. Example: 5px solid #000', 'LayerSlider'),
			'props' => array(
				'meta' => true
			)
		),

		'borderBottom' => array(
			'value' => '',
			'name' => jols__('Bottom', 'LayerSlider'),
			'keys' => 'border-bottom',
			'tooltip' => jols__('Border on the bottom of the layer. Example: 5px solid #000', 'LayerSlider'),
			'props' => array(
				'meta' => true
			)
		),

		'borderLeft' => array(
			'value' => '',
			'name' => jols__('Left', 'LayerSlider'),
			'keys' => 'border-left',
			'tooltip' => jols__('Border on the left side of the layer. Example: 5px solid #000', 'LayerSlider'),
			'props' => array(
				'meta' => true
			)
		),

		'fontFamily' => array(
			'value' => '',
			'name' => jols__('Family', 'LayerSlider'),
			'keys' => 'font-family',
			'tooltip' => jols__('List of your chosen fonts separated with a comma. Please use apostrophes if your font names contains white spaces. Example: Helvetica, Arial, sans-serif', 'LayerSlider'),
			'props' => array(
				'meta' => true
			)
		),

		'fontSize' => array(
			'value' => '',
			'name' => jols__('Size', 'LayerSlider'),
			'keys' => 'font-size',
			'tooltip' => jols__('The font size in pixels. Example: 16px.', 'LayerSlider'),
			'props' => array(
				'meta' => true
			)
		),

		'lineHeight' => array(
			'value' => '',
			'name' => jols__('Line-height', 'LayerSlider'),
			'keys' => 'line-height',
			'tooltip' => jols__("The line height of your text. The default setting is 'normal'. Example: 22px", "LayerSlider"),
			'props' => array(
				'meta' => true
			)
		),

		'color' => array(
			'value' => '',
			'name' => jols__('Color', 'LayerSlider'),
			'keys' => 'color',
			'tooltip' => jols__('The color of your text. You can use color names, hexadecimal, RGB or RGBA values. Example: #333', 'LayerSlider'),
			'props' => array(
				'meta' => true
			)
		),

		'background' => array(
			'value' => '',
			'name' => jols__('Background', 'LayerSlider'),
			'keys' => 'background',
			'tooltip' => jols__("The background color of your layer. You can use color names, hexadecimal, RGB or RGBA values as well as the 'transparent' keyword. Example: #FFF", "LayerSlider"),
			'props' => array(
				'meta' => true
			)
		),

		'borderRadius' => array(
			'value' => '',
			'name' => jols__('Rounded<br>corners', 'LayerSlider'),
			'keys' => 'border-radius',
			'tooltip' => jols__('If you want rounded corners, you can set its radius here. Example: 5px', 'LayerSlider'),
			'props' => array(
				'meta' => true
			)
		),

		'wordWrap' => array(
			'value' => false,
			'name' => 'Word-wrap',
			'keys' => 'wordwrap',
			'tooltip' => 'If you use custom sized layers, you have to enable this setting to wrap your text.',
			'props' => array(
				'meta' => true
			)
		),

		'style' => array(
			'value' => '',
			'name' => jols__('Custom styles', 'LayerSlider'),
			'keys' => 'style',
			'tooltip' => jols__('If you want to set style settings other then above, you can use here any CSS codes. Please make sure to write valid markup.', 'LayerSlider'),
			'props' => array(
				'meta' => true
			)
		),

		'styles' => array(
			'value' => '',
			'keys' => 'styles',
			'props' => array(
				'meta' => true,
				'raw' => true
			)
		),

		// Attributes

		'ID' => array(
			'value' => '',
			'name' => jols__('ID', 'LayerSlider'),
			'keys' => 'id',
			'tooltip' => jols__('You can apply an ID attribute on the HTML element of this layer to work with it in your custom CSS or Javascript code.', 'LayerSlider'),
			'props' => array(
				'meta' => true
			)
		),

		'class' => array(
			'value' => '',
			'name' => jols__('Classes', 'LayerSlider'),
			'keys' => 'class',
			'tooltip' => jols__('You can apply classes on the HTML element of this layer to work with it in your custom CSS or Javascript code.', 'LayerSlider'),
			'props' => array(
				'meta' => true
			)
		),

		'title' => array(
			'value' => '',
			'name' => jols__('Title', 'LayerSlider'),
			'keys' => 'title',
			'tooltip' => jols__('You can add a title to this layer which will display as a tooltip if someone holds his mouse cursor over the layer.', 'LayerSlider'),
			'props' => array(
				'meta' => true
			)
		),

		'alt' => array(
			'value' => '',
			'name' => jols__('Alt', 'LayerSlider'),
			'keys' => 'alt',
			'tooltip' => jols__('You can add an alternative text to your layer which is indexed by search engine robots and it helps people with certain disabilities.', 'LayerSlider'),
			'props' => array(
				'meta' => true
			)
		),

		'rel' => array(
			'value' => '',
			'name' => jols__('Rel', 'LayerSlider'),
			'keys' => 'rel',
			'tooltip' => jols__('Some plugin may use the rel attribute of a linked content, here you can specify it to make interaction with these plugins.', 'LayerSlider'),
			'props' => array(
				'meta' => true
			)
		)

	),

	'easings' => array(
		'linear',
		'swing',
		'easeInQuad',
		'easeOutQuad',
		'easeInOutQuad',
		'easeInCubic',
		'easeOutCubic',
		'easeInOutCubic',
		'easeInQuart',
		'easeOutQuart',
		'easeInOutQuart',
		'easeInQuint',
		'easeOutQuint',
		'easeInOutQuint',
		'easeInSine',
		'easeOutSine',
		'easeInOutSine',
		'easeInExpo',
		'easeOutExpo',
		'easeInOutExpo',
		'easeInCirc',
		'easeOutCirc',
		'easeInOutCirc',
		'easeInElastic',
		'easeOutElastic',
		'easeInOutElastic',
		'easeInBack',
		'easeOutBack',
		'easeInOutBack',
		'easeInBounce',
		'easeOutBounce',
		'easeInOutBounce'
	)
);
