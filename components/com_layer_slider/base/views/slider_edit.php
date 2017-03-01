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

	/*GET avaible genarators*/
	$avaible_generators = array();
	if ($handle = opendir(JPATH_COMPONENT.'/generators/')) {
			while (false !== ($entry = readdir($handle))) {
					if ($entry != "." && $entry != ".." && is_dir(JPATH_COMPONENT.'/generators/'.$entry)) {
							if (is_file(JPATH_COMPONENT.'/generators/'.$entry.'/generator.php')){
								require_once JPATH_COMPONENT.'/generators/'.$entry.'/generator.php';
								$class = 'OfflajnGenerator_'.$entry;
								if(is_dir(JPATH_ROOT.$class::$path)){
									$avaible_generators[$entry] = $class::$name;
								}
							}
					}
			}
			closedir($handle);
	}


	// Get the IF of the slider
	$id = (int) $_GET['id'];

	// Get slider
	$slider = LS_Sliders::find($id);
	$slider = $slider['data'];

	$root = isset($slider['properties']['cmsrelativeurls']) ? rtrim(JURI::root(true), '/') : '';

	if(function_exists( 'wp_enqueue_media' )) {
		$uploadClass = 'ls-mass-upload';
	} else {
		$uploadClass = 'ls-upload';
	}

	// Get screen options
	$lsScreenOptions = jols_get_option('ls-screen-options', '0');
	$lsScreenOptions = ($lsScreenOptions == 0) ? array() : $lsScreenOptions;
	$lsScreenOptions = is_array($lsScreenOptions) ? $lsScreenOptions : unserialize($lsScreenOptions);

	// Defaults
	if(!isset($lsScreenOptions['showTooltips'])) {
		$lsScreenOptions['showTooltips'] = 'true';
	}

	// Get phpQuery
	if(!class_exists('phpQuery')) {
		libxml_use_internal_errors(true);
		include LS_ROOT_PATH.'/helpers/phpQuery.php';
	}

	// Get defaults
	include LS_ROOT_PATH . '/config/defaults.php';
	include LS_ROOT_PATH . '/helpers/admin.ui.tools.php';


	// Run filters
	if(jols_has_filter('layerslider_override_defaults')) {
		$newDefaults = apply_filters('layerslider_override_defaults', $lsDefaults);
		if(!empty($newDefaults) && is_array($newDefaults)) {
			$lsDefaults = $newDefaults;
			unset($newDefaults);
		}
	}

	// Show tab
	$settingsTabClass = isset($_GET['showsettings']) ? 'active' : '';
	$slidesTabClass = !isset($_GET['showsettings']) ? 'active' : '';

	// Fixes
	if(!isset($slider['layers'][0]['properties'])) {
		$slider['layers'][0]['properties'] = array();
	}

	// Get post types
	//$postTypes = LS_Posts::getPostTypes();

	$generator = "imagesfromfolder";

	if (isset($slider['properties']['generator_type']))
		$generator = $slider['properties']['generator_type'];
	$class = "OfflajnGenerator_".$generator;

	$generator = new $class($slider['properties']);

	$postCategories = jols_get_categories();
	$postTags = jols_get_tags();
	$postTaxonomies = jols_get_taxonomies(array('_builtin' => false), 'objects');
?>
<div id="ls-screen-options" class="metabox-prefs hidden">
	<div id="screen-options-wrap" class="hidden">
		<form id="ls-screen-options-form" action="<?php echo $_SERVER['REQUEST_URI']?>" method="post">
			<h5><?php jols_e('Show on screen', 'LayerSlider') ?></h5>
			<label>
				<input type="checkbox" name="showTooltips"<?php echo $lsScreenOptions['showTooltips'] == 'true' ? ' checked="checked"' : ''?>> Tooltips
			</label>
		</form>
	</div>
	<div id="screen-options-link-wrap" class="hide-if-no-js screen-meta-toggle">
		<a href="#screen-options-wrap" id="show-settings-link" class="show-settings"><?php jols_e('Screen Options', 'LayerSlider') ?></a>
	</div>
</div>

<!-- Share sheet template -->
<?php
	$time = time();
	$installed = jols_get_option('ls-date-installed', 0);
	$level = jols_get_option('ls-share-displayed', 1);

	switch($level){
		case 1:
			$time = $time-60*60*24*14;
			$odds = 100;
			break;

		case 2:
			$time = $time-60*60*24*30*2;
			$odds = 200;
			break;

		case 3:
			$time = $time-60*60*24*30*6;
			$odds = 300;
			break;

		default:
			$time = $time-60*60*24*14;
			$odds = 100;
			break;
	}

	if($installed && $time > $installed) {
		if(mt_rand(1, $odds) == 3) {
			jols_update_option('ls-share-displayed', ++$level);
?>
<div class="ls-overlay" data-manualclose="true"></div>
<link href='http://fonts.googleapis.com/css?family=Indie+Flower' rel='stylesheet' type='text/css'>
<div id="ls-share-template" class="ls-modal ls-box">
	<h3>
		<?php jols_e('Enjoy using LayerSlider?', 'LayerSlider') ?>
		<a href="#" class="dashicons dashicons-no-alt"></a>
	</h3>
	<div class="inner desc">
		<?php jols_e("If so, please consider recommending it to your friends on your favorite social network!", "LayerSlider"); ?>
	</div>
	<div class="inner">
		<a href="https://www.facebook.com/sharer/sharer.php?u=http://kreaturamedia.com/layerslider-responsive-wordpress-slider-plugin/" target="_blank">
			<i class="dashicons dashicons-facebook-alt"></i> Share
		</a>

		<a href="http://www.twitter.com/share?url=http%3A%2F%2Fkreaturamedia.com%2Flayerslider-responsive-wordpress-slider-plugin%2F&amp;text=Check%20out%20LayerSlider%20WP%2C%20an%20awesome%20%23slider%20%23plugin%20for%20%23WordPress&amp;via=kreaturamedia" target="_blank">
			<i class="dashicons dashicons-twitter"></i> Tweet
		</a>

		<a href="https://plus.google.com/share?url=http://kreaturamedia.com/layerslider-responsive-wordpress-slider-plugin/" target="_blank">
			<i class="dashicons dashicons-googleplus"></i> +1
		</a>
	</div>
</div>
<?php } } ?>
<!-- End of Share sheet template -->

<div id="ls-transition-window" class="ls-modal ls-box">
	<header>
		<h2>Select slide transitions</h2>
		<div class="filters">
			<span>Show:</span>
			<ul>
				<li class="active">2D</li>
				<li>3D</li>
				<li>Custom</li>
			</ul>
		</div>
		<b class="dashicons dashicons-no"></b>
		<i>Apply to others</i>
		<i class="off">Select all</i>
	</header>
	<div class="inner">
		<table></table>
	</div>
</div>

<?php include LS_ROOT_PATH . '/views/slider_edit_sample.php'; ?>
<form action="<?php echo $_SERVER['REQUEST_URI']?>" method="post" class="wrap" id="ls-slider-form" novalidate="novalidate">

	<input type="hidden" name="slider_id" value="<?php echo $id ?>">
	<input type="hidden" name="action" value="ls_save_slider">

	<!-- Title -->
	<h2>
		<?php jols_e('Editing slider:', 'LayerSlider') ?>
		<?php echo apply_filters('ls_slider_title', $slider['properties']['title'], 35) ?>
		<a href="?option=com_layer_slider" class="add-new-h2"><?php jols_e('Back to the list', 'LayerSlider') ?></a>
	</h2>

	<!-- Main menu bar -->
	<div id="ls-main-nav-bar">
		<a href="#" class="settings <?php echo $settingsTabClass ?>">
			<i class="dashicons dashicons-admin-tools"></i>
			<?php jols_e('Slider Settings', 'LayerSlider') ?>
		</a>
		<a href="#" class="layers <?php echo $slidesTabClass ?>">
			<i class="dashicons dashicons-images-alt"></i>
			<?php jols_e('Slides', 'LayerSlider') ?>
		</a>
		<a href="#" class="callbacks">
			<i class="dashicons dashicons-redo"></i>
			<?php jols_e('Event Callbacks', 'LayerSlider') ?>
		</a>
		<a href="http://support.kreaturamedia.com/faq/4/layerslider-for-wordpress/" target="_blank" class="faq right unselectable">
			<i class="dashicons dashicons-sos"></i>
			<?php jols_e('FAQ', 'LayerSlider') ?>
		</a>
		<a href="#" class="support right unselectable">
			<i class="dashicons dashicons-editor-help"></i>
			<?php jols_e('Documentation', 'LayerSlider') ?>
		</a>
		<span class="right help"><?php jols_e('Need help? Try these:', 'LayerSlider') ?></span>
		<a href="#" class="clear unselectable"></a>
	</div>

	<!-- Post options -->
	<?php include LS_ROOT_PATH . '/views/slider_edit_posts.php'; ?>

	<!-- Pages -->
	<div id="ls-pages">

		<!-- Slider Settings -->
		<div class="ls-page ls-settings ls-slider-settings <?php echo $settingsTabClass ?>">
			<?php include LS_ROOT_PATH . '/views/slider_edit_settings.php'; ?>
		</div>

		<!-- Slides -->
		<div class="ls-page <?php echo $slidesTabClass ?>">

			<!-- Slide tabs -->
			<div id="ls-layer-tabs">
				<?php foreach($slider['layers'] as $key => $layer) : ?>
				<?php $active = empty($key) ? 'active' : '' ?>
				<a href="#" class="<?php echo $active ?>">Slide #<?php echo ($key+1) ?><span class="dashicons dashicons-dismiss"></span></a>
				<?php endforeach; ?>
				<a href="#"  title="<?php jols_e('Add new slide', 'LayerSlider') ?>" class="unsortable" id="ls-add-layer"><i class="dashicons dashicons-plus"></i></a>
				<div class="unsortable clear"></div>
			</div>

			<!-- Slides -->
			<div id="ls-layers" class="ls-desktop">
				<?php if(!empty($slider['layers'])) : ?>
				<?php foreach($slider['layers'] as $key => $layer) : ?>
				<?php
					$layerProps = !empty($layer['properties']) ? $layer['properties'] : array();
					$active = empty($key) ? 'active' : '';
					$layerProps['background'] = !empty($layerProps['background']) ? ls_cmsroot($root, $layerProps['background']) : null;
					$layerProps['backgroundId'] = !empty($layerProps['backgroundId']) ? $layerProps['backgroundId'] : null;
					$layerProps['thumbnailId'] = !empty($layerProps['thumbnailId']) ? $layerProps['thumbnailId'] : null;
					$layerProps['thumbnail'] = !empty($layerProps['thumbnail']) ? ls_cmsroot($root, $layerProps['thumbnail']) : null;
				?>
				<div class="ls-box ls-layer-box <?php echo $active ?>">
					<table>
						<thead class="ls-layer-options-thead">
							<tr>
								<td colspan="4">
									<i class="dashicons dashicons-welcome-write-blog"></i>
									<h4><?php jols_e('Slide Options', 'LayerSlider') ?></h4>
								</td>
							</tr>
						</thead>
						<tbody class="ls-slide-options">
							<input type="hidden" name="post_offset" value="<?php echo isset($layerProps['post_offset']) ? $layerProps['post_offset'] : '-1' ?>">
							<input type="hidden" name="3d_transitions" value="<?php echo isset($layerProps['3d_transitions']) ? $layerProps['3d_transitions'] : '' ?>">
							<input type="hidden" name="2d_transitions" value="<?php echo isset($layerProps['2d_transitions']) ? $layerProps['2d_transitions'] : '' ?>">
							<input type="hidden" name="custom_3d_transitions" value="<?php echo isset($layerProps['custom_3d_transitions']) ? $layerProps['custom_3d_transitions'] : '' ?>">
							<input type="hidden" name="custom_2d_transitions" value="<?php echo isset($layerProps['custom_2d_transitions']) ? $layerProps['custom_2d_transitions'] : '' ?>">
							<tr>
								<td class="slide-image">
									<h3 class="subheader"><?php jols_e('Slide Background Image', 'LayerSlider') ?></h3>
									<div class="inner">
										<div class="float">
										<?php
											$background = !empty($layerProps['background']) ? $layerProps['background'] : '';
											if($background == '[image-url]') {
												$src = LS_ROOT_URL.'/static/img/blank.gif';
											} else {
												$src = apply_filters('ls_get_thumbnail', $layerProps['backgroundId'], $layerProps['background']);
											}
										?>
										<input type="hidden" name="backgroundId" value="<?php echo !empty($layerProps['backgroundId']) ? $layerProps['backgroundId'] : '' ?>">
										<input type="hidden" name="background" value="<?php echo !empty($layerProps['background']) ? $layerProps['background'] : '' ?>">
											<div class="ls-image ls-upload ls-bulk-upload ls-slide-image" data-help="<?php echo $lsDefaults['slides']['image']['tooltip'] ?>">
												<a href="javascript:;" onclick="openModal(this);" class="modal">
													<div><img src="<?php echo $src ?>" alt=""></div>
												</a>
												<a href="#" class="dashicons dashicons-dismiss"></a>
											</div>
											<span class="indent">
												<?php jols_e('or', 'LayerSlider') ?> <a href="#" class="ls-url-prompt"><?php jols_e('enter URL', 'LayerSlider') ?></a>
												<?php jols_e('|', 'LayerSlider') ?> <a href="#" class="ls-post-image"><?php jols_e('use dynamic img', 'LayerSlider') ?></a>
											</span>
										</div>
										<div class="float">
											<div class="row-helper">
												<?php echo $lsDefaults['slides']['imageSize']['name'] ?>
												<?php lsGetSelect($lsDefaults['slides']['imageSize'], $layerProps, array('class' => 'layerprop')) ?>
											</div>
											<div class="row-helper">
												<?php echo $lsDefaults['slides']['imagePosition']['name'] ?>
												<?php lsGetSelect($lsDefaults['slides']['imagePosition'], $layerProps, array('class' => 'layerprop')) ?>
											</div>
											<div class="row-helper">
												<?php echo $lsDefaults['slides']['imageAlt']['name'] ?>
												<?php lsGetInput($lsDefaults['slides']['imageAlt'], $layerProps, array('class' => 'layerprop')) ?>
											</div>
										</div>
									</div>
								</td>
								<td class="slide-thumb">
									<h3 class="subheader"><?php jols_e('Slide Thumbnail', 'LayerSlider') ?></h3>
									<div class="inner">
										<input type="hidden" name="thumbnailId" value="<?php echo !empty($layerProps['thumbnailId']) ? $layerProps['thumbnailId'] : '' ?>">
										<input type="hidden" name="thumbnail" value="<?php echo !empty($layerProps['thumbnail']) ? $layerProps['thumbnail'] : '' ?>">
										<div class="ls-image ls-upload ls-slide-thumbnail" data-help="<?php echo $lsDefaults['slides']['thumbnail']['tooltip'] ?>">
											<a href="javascript:;" onclick="openModal(this);" class="modal">
												<div><img src="<?php echo apply_filters('ls_get_thumbnail', $layerProps['thumbnailId'], $layerProps['thumbnail']) ?>" alt=""></div>
											</a>
											<a href="#" class="dashicons dashicons-dismiss"></a>
										</div>
										<span class="indent">
											<?php jols_e('or', 'LayerSlider') ?> <a href="#" class="ls-url-prompt"><?php jols_e('enter URL', 'LayerSlider') ?></a>
										</span>
									</div>
								</td>
								<td class="slide-timing">
									<h3 class="subheader"><?php jols_e('Slide Timing', 'LayerSlider') ?></h3>
									<div class="inner">
										<div class="row-helper">
											<?php echo $lsDefaults['slides']['delay']['name'] ?>
											<?php lsGetInput($lsDefaults['slides']['delay'], $layerProps, array('class' => 'layerprop')) ?> ms <br>
										</div>
										<div class="row-helper">
											<?php echo $lsDefaults['slides']['timeshift']['name'] ?>
											<?php lsGetInput($lsDefaults['slides']['timeshift'], $layerProps, array('class' => 'layerprop')) ?> ms
										</div>
									</div>
								</td>
								<td class="slide-transition">
									<h3 class="subheader"><?php jols_e('Slide Transition', 'LayerSlider') ?></h3>
									<div class="inner">
										<button type="button" class="button ls-select-transitions new" data-help="<?php jols_e('You can select your desired slide transitions by clicking on this button.', 'LayerSlider') ?>">Select transitions</button> <br>
									</div>
								</td>
							</tr>
							<tr>
								<td class="slide-link">
									<h3 class="subheader"><?php jols_e('Slide Linking', 'LayerSlider') ?></h3>
									<div class="inner">
										<div class="row-helper">
											<?php lsGetInput($lsDefaults['slides']['linkUrl'], $layerProps, array('placeholder' => $lsDefaults['slides']['linkUrl']['name'] )) ?>
										</div>
										<div class="row-helper">
											<span class="indent">
												<?php jols_e('or', 'LayerSlider') ?> <a href="#" class="ls-post-url"><?php jols_e('use dynamic URL', 'LayerSlider') ?></a>
											</span>
											<?php lsGetSelect($lsDefaults['slides']['linkTarget'], $layerProps) ?>
										</div>
									</div>
								</td>
								<td class="post-options">
									<h3 class="subheader"></h3>
									<div class="inner">
										<button type="button" class="button ls-configure-posts"><span class="dashicons dashicons-update"></span><?php jols_e('Configure<br>dynamic content', 'LayerSlider') ?></button>
									</div>
								</td>
								<td class="additional-settings">
									<h3 class="subheader"><?php jols_e('Additional Settings', 'LayerSlider') ?></h3>
									<div class="inner">
										<div class="row-helper">
											<?php echo $lsDefaults['slides']['ID']['name'] ?>
											<?php lsGetInput($lsDefaults['slides']['ID'], $layerProps) ?>
										</div>
										<div class="row-helper">
											<?php echo $lsDefaults['slides']['deeplink']['name'] ?>
											<?php lsGetInput($lsDefaults['slides']['deeplink'], $layerProps) ?>
										</div>
									</div>
								</td>
								<td class="slide-actions">
									<h3 class="subheader"></h3>
									<div class="inner">
										<div class="row-helper">
											<button type="button" class="button ls-layer-duplicate"><span class="dashicons dashicons-admin-page"></span><?php jols_e('Duplicate slide', 'LayerSlider') ?></button>
										</div>
										<div class="row-helper">
											<span>
												<?php jols_e('Hide this slide', 'LayerSlider') ?>
											</span>
											<input type="checkbox" name="skip" class="checkbox large" <?php echo isset($layerProps['skip']) ? 'checked="checked"' : '' ?> data-help="<?php jols_e("If you don't want to use this slide in your front-page, but you want to keep it, you can hide it with this switch.", "LayerSlider") ?>">
										</div>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
					<table>
						<thead>
							<tr>
								<td width="33.3%">
									<i class="dashicons dashicons-editor-video ls-preview-icon"></i>
									<h4>
										<span><?php jols_e('Preview', 'LayerSlider') ?></span>
										<div class="ls-editor-zoom">
											<span class="ls-editor-slider-text">Size:</span>
											<div class="ls-editor-slider"></div>
											<span class="ls-editor-slider-val">100%</span>
										</div>
									</h4>
								</td>
								<td width="33.3%" class="ls-preview-mode">
									<i class="dashicons dashicons-smartphone"></i>
									<i class="dashicons dashicons-tablet"></i>
									<i class="dashicons dashicons-desktop active"></i>
								</td>
								<td width="33.3%" class="ls-positioning">
									<h4>
										<?php jols_e('Positioning', 'LayerSlider') ?>
										<span class="ls-editor-slider-text">
											<i class="ls-ico ls-move-horz" data-move="left" data-help="Move layer to left"></i>
											<i class="ls-ico ls-move-horz" data-move="center" data-help="Move layer to center"></i>
											<i class="ls-ico ls-move-horz" data-move="right" data-help="Move layer to right"></i>
										</span>
										<span class="ls-editor-slider-text">
											<i class="ls-ico ls-move-vert" data-move="top" data-help="Move layer to top"></i>
											<i class="ls-ico ls-move-vert" data-move="middle" data-help="Move layer to middle"></i>
											<i class="ls-ico ls-move-vert" data-move="bottom" data-help="Move layer to bottom"></i>
										</span>
									</h4>
								</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td colspan="3" class="ls-preview-td">
									<div class="ls-preview-wrapper">
										<div class="ls-preview" data-dragover="<?php jols_e('Drop image(s) here', 'LayerSlider') ?>">
											<div class="draggable ls-layer"></div>
										</div>
										<div class="ls-real-time-preview"></div>
									</div>
									<button type="button" class="button ls-preview-button"><?php jols_e('Enter Preview', 'LayerSlider') ?></button>
								</td>
							</tr>
						</tbody>
					</table>
					<table>
						<thead>
							<tr>
								<td>
									<div class="dashicons dashicons-images-alt ls-layers-icon"></div>
									<h4><?php jols_e('Layers', 'LayerSlider') ?><a href="#" class="ls-tl-toggle">[ <?php jols_e('timeline view', 'LayerSlider') ?> ]</a></h4>
								</td>
							</tr>
						</thead>
						<tbody class="ls-sublayers ls-sublayer-sortable">
							<?php if(!empty($layer['sublayers'])) : ?>
							<?php foreach($layer['sublayers'] as $key => $sublayer) : ?>
							<?php $active = (count($layer['sublayers']) == ($key+1)) ? ' class="active"' : '' ?>
							<?php $title = empty($sublayer['subtitle']) ? 'Layer #'.($key+1).'' : htmlspecialchars(stripslashes($sublayer['subtitle'])); ?>
							<tr<?php echo $active ?>>
								<td>
									<div class="ls-sublayer-wrapper">
										<span class="ls-sublayer-sortable-handle dashicons dashicons-menu"></span>
										<span class="ls-sublayer-number"><?php echo ($key + 1) ?></span>
										<input type="text" name="subtitle" class="ls-sublayer-title" value="<?php echo $title ?>">

										<div class="ls-tl">
											<table>
												<tr>
													<td data-help="Delay in: " class="ls-tl-delayin"></td>
													<td data-help="Duration in: " class="ls-tl-durationin"></td>
													<td data-help="Show Until: " class="ls-tl-showuntil"></td>
													<td data-help="Duration out: " class="ls-tl-durationout"></td>
												</tr>
											</table>
										</div>

										<div class="ls-devices">
											<i data-help="<?php jols_e('Hide layer on phone', 'LayerSlider') ?>" class="dashicons dashicons-smartphone"></i>
											<i data-help="<?php jols_e('Hide layer on tablet', 'LayerSlider') ?>" class="dashicons dashicons-tablet"></i>
											<i data-help="<?php jols_e('Hide layer on desktop', 'LayerSlider') ?>" class="dashicons dashicons-desktop"></i>
										</div>

										<span class="ls-sublayer-controls">
											<span class="ls-highlight dashicons dashicons-lightbulb" data-help="<?php jols_e('Highlight layer in editor.', 'LayerSlider') ?>"></span>
											<span class="ls-icon-lock dashicons dashicons-lock" data-help="<?php jols_e('Prevent layer from dragging in editor.', 'LayerSlider') ?>"></span>
											<span class="ls-icon-eye dashicons dashicons-visibility" data-help="<?php jols_e('Hide layer in editor.', 'LayerSlider') ?>"></span>
										</span>
										<div class="clear"></div>
										<div class="ls-sublayer-nav">
											<a href="#" class="active"><?php jols_e('Content', 'LayerSlider') ?></a>
											<a href="#"><?php jols_e('Transition', 'LayerSlider') ?></a>
											<?php /*
											<a href="#"><?php jols_e('Loop', 'LayerSlider') ?></a>
											<a href="#"><?php jols_e('Hover', 'LayerSlider') ?></a>
											*/ ?>
											<a href="#"><?php jols_e('Link', 'LayerSlider') ?></a>
											<a href="#"><?php jols_e('Styles', 'LayerSlider') ?></a>
											<a href="#"><?php jols_e('Attributes', 'LayerSlider') ?></a>
											<a href="#" data-help="<?php jols_e('Duplicate this layer', 'LayerSlider') ?>" class="dashicons dashicons-admin-page duplicate"></a>
											<a href="#" title="<?php jols_e('Remove this layer', 'LayerSlider') ?>" class="dashicons dashicons-trash remove"></a>
										</div>
										<div class="ls-sublayer-pages">
											<div class="ls-sublayer-page ls-sublayer-basic active">

												<!-- Layer Media Type -->
												<?php
													if(empty($sublayer['media'])) {
														switch($sublayer['type']) {
															case 'img': $sublayer['media'] = 'img'; break;
															case 'div': $sublayer['media'] = 'html'; break;
															default: $sublayer['media'] = 'text'; break;
														}
													}
													$sublayer['type'] = ($sublayer['type'] == 'span') ? 'p' : $sublayer['type'];
													$sublayer['type'] = ($sublayer['type'] == 'img') ? 'p' : $sublayer['type'];
												?>
												<input type="hidden" name="media" value="<?php echo $sublayer['media'] ?>">
												<div class="ls-layer-kind">
													<ul>
														<li data-section="img"><span class="dashicons dashicons-format-image"></span><?php jols_e('Image', 'LayerSlider') ?></li>
														<li data-section="text"><span class="dashicons dashicons-text"></span><?php jols_e('Text', 'LayerSlider') ?></li>
														<li data-section="html"><span class="dashicons dashicons-video-alt3"></span><?php jols_e('HTML / Video / Audio', 'LayerSlider') ?></li>
														<li data-section="post"><span class="dashicons dashicons-update"></span><?php jols_e('Dynamic content', 'LayerSlider') ?></li>
													</ul>
												</div>
												<!-- End of Layer Media Type -->

												<!-- Layer Element Type -->
												<input type="hidden" name="type" value="<?php echo $sublayer['type'] ?>">
												<ul class="ls-sublayer-element">
													<li class="ls-type" data-element="p"><?php jols_e('Paragraph', 'LayerSlider') ?></li>
													<li class="ls-type" data-element="h1"><?php jols_e('H1', 'LayerSlider') ?></li>
													<li class="ls-type" data-element="h2"><?php jols_e('H2', 'LayerSlider') ?></li>
													<li class="ls-type" data-element="h3"><?php jols_e('H3', 'LayerSlider') ?></li>
													<li class="ls-type" data-element="h4"><?php jols_e('H4', 'LayerSlider') ?></li>
													<li class="ls-type" data-element="h5"><?php jols_e('H5', 'LayerSlider') ?></li>
													<li class="ls-type" data-element="h6"><?php jols_e('H6', 'LayerSlider') ?></li>
												</ul>
												<!-- End of Layer Element Type -->

												<div class="ls-layer-sections">

													<!-- Image Layer -->
													<div class="ls-image-uploader slide-image clearfix ls-hidden">
														<?php
															if($sublayer['image'] == '[image-url]') {
																$src = LS_ROOT_URL.'/static/img/blank.gif';
															} else {
																$src = ls_cmsroot($root, apply_filters('ls_get_thumbnail', $sublayer['imageId'], $sublayer['image']));
															}
														?>
														<?php $sublayer['imageId'] = !empty($sublayer['imageId']) ? $sublayer['imageId'] : null; ?>
														<input type="hidden" name="imageId"  value="<?php echo !empty($sublayer['imageId']) ? $sublayer['imageId'] : '' ?>">
														<input type="hidden" name="image" value="<?php echo !empty($sublayer['image']) ? ls_cmsroot($root, $sublayer['image']) : '' ?>">
														<div class="ls-image ls-upload <?php echo $uploadClass ?>">
														<a href="javascript:;" onclick="openModal(this);" class="modal">
																<div><img src="<?php echo $src ?>" alt=""></div>
														</a>
															<a href="#" class="dashicons dashicons-dismiss"></a>
														</div>
														<p>
															<?php jols_e('Click on the image preview to open Media Library <br> or', 'LayerSlider') ?>
															<a href="#" class="ls-url-prompt"><?php jols_e('insert from URL', 'LayerSlider') ?></a> |
															<a href="#" class="ls-post-image"><?php jols_e('use dynamic image', 'LayerSlider') ?></a>
														</p>
													</div>

													<!-- Text/HTML Layer -->
													<div class="ls-html-code">
														<textarea name="html" cols="50" rows="5" placeholder="Enter layer content here" data-help="<?php jols_e('Type here the contents of your layer. You can use any HTML codes in this field to insert content others then text. This field is also shortcode-aware, so you can insert content from other plugins as well as video embed codes.', 'LayerSlider') ?>"><?php echo stripslashes($sublayer['html']) ?></textarea>
													</div>

													<!-- Dynamic Layer -->
													<div class="ls-post-section ls-hidden">
														<div class="ls-posts-configured">
															<ul class="ls-post-placeholders clearfix">
																<?php
																echo $generator->generateList();
																?>

															</ul>
															<p>
																<?php jols_e("Click on one or more placeholders to insert them into your layer's content. Placeholders are acting like shortcodes, and they will be filled with the actual content.", "LayerSlider") ?><br>
																<?php jols_e('Limit text length (if any)', 'LayerSlider') ?>
																<input type="number" name="post_text_length" value="<?php echo !empty($sublayer['post_text_length']) ? $sublayer['post_text_length'] : '' ?>">
																<button type="button" class="button ls-configure-posts">
																	<span class="dashicons dashicons-update"></span> <?php jols_e('Configure dynamic content', 'LayerSlider') ?>
																</button>
															</p>
														</div>
													</div>
												</div>
											</div>
											<div class="ls-sublayer-page ls-sublayer-options">
												<input type="hidden" name="transition">
												<?php
													if(!isset($sublayer['transition'])) {
														switch($sublayer['slidedirection']) {
															case 'fade': $sublayer['fadein'] = true; $sublayer['offsetxin'] = '0'; $sublayer['offsetyin'] = '0'; break;
															case 'auto': $sublayer['offsetxin'] = 'right'; $sublayer['offsetyin'] = '0'; break;
															default:
																$sublayer['offsetxin'] = ($sublayer['slidedirection'] == 'left' || $sublayer['slidedirection'] == 'right') ? $sublayer['slidedirection'] : 0;
																$sublayer['offsetyin'] = ($sublayer['slidedirection'] == 'top' || $sublayer['slidedirection'] == 'bottom') ? $sublayer['slidedirection'] : 0;
																break;
														}

														switch($sublayer['slideoutdirection']) {
															case 'fade': $sublayer['fadeout'] = true; $sublayer['offsetxout'] = '0'; $sublayer['offsetyout'] = '0'; break;
															case 'auto':
																if($sublayer['slidedirection'] == 'fade') {
																	$sublayer['fadeout'] = true;
																	$sublayer['offsetxout'] = '0';
																} else { $sublayer['offsetxout'] = 'right'; }
															break;
															default:
																$sublayer['offsetxout'] = ($sublayer['slideoutdirection'] == 'left' || $sublayer['slideoutdirection'] == 'right') ? $sublayer['slideoutdirection'] : 0;
																$sublayer['offsetyout'] = ($sublayer['slideoutdirection'] == 'top' || $sublayer['slideoutdirection'] == 'bottom') ? $sublayer['slideoutdirection'] : 0;
																break;
														}

														$sublayer['scalexin'] = $sublayer['scalein'];
														$sublayer['scaleyin'] = $sublayer['scalein'];
														$sublayer['scalexout'] = $sublayer['scaleout'];
														$sublayer['scaleyout'] = $sublayer['scaleout'];
													}

													$sublayer['transition'] = !empty($sublayer['transition']) ? json_decode(stripslashes($sublayer['transition']), true) : array();
													$sublayer = array_merge($sublayer, $sublayer['transition']);
												?>
												<table>
													<tbody>
														<tr>
															<td rowspan="3"><?php jols_e('Transition in', 'LayerSlider') ?></td>
															<td class="right"><?php echo $lsDefaults['layers']['transitionInOffsetX']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['transitionInOffsetX'], $sublayer, array('class' => 'sublayerprop')) ?></td>
															<td class="right"><?php echo $lsDefaults['layers']['transitionInOffsetY']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['transitionInOffsetY'], $sublayer, array('class' => 'sublayerprop')) ?></td>
															<td class="right"><?php echo $lsDefaults['layers']['transitionInDuration']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['transitionInDuration'], $sublayer, array('class' => 'sublayerprop')) ?> ms</td>
															<td class="right"><?php echo $lsDefaults['layers']['transitionInDelay']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['transitionInDelay'], $sublayer, array('class' => 'sublayerprop')) ?> ms</td>
															<td class="right"><a href="http://easings.net/" target="_blank"><?php echo $lsDefaults['layers']['transitionInEasing']['name'] ?></a></td>
															<td><?php lsGetSelect($lsDefaults['layers']['transitionInEasing'], $sublayer, array('class' => 'sublayerprop', 'options' => $lsDefaults['easings'])) ?></td>
														</tr>
														<tr>
															<td class="right"><?php echo $lsDefaults['layers']['transitionInFade']['name'] ?></td>
															<td><?php lsGetCheckbox($lsDefaults['layers']['transitionInFade'], $sublayer, array('class' => 'sublayerprop')) ?></td>
															<td class="right"><?php echo $lsDefaults['layers']['transitionInRotate']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['transitionInRotate'], $sublayer, array('class' => 'sublayerprop')) ?> &deg;</td>
															<td class="right"><?php echo $lsDefaults['layers']['transitionInRotateX']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['transitionInRotateX'], $sublayer, array('class' => 'sublayerprop')) ?> &deg;</td>
															<td class="right"><?php echo $lsDefaults['layers']['transitionInRotateY']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['transitionInRotateY'], $sublayer, array('class' => 'sublayerprop')) ?> &deg;</td>
															<td colspan="2" rowspan="2" class="center">
																<?php echo $lsDefaults['layers']['transitionInTransformOrigin']['name'] ?><br>
																<i class="dashicons dashicons-admin-post"></i>
																<?php lsGetInput($lsDefaults['layers']['transitionInTransformOrigin'], $sublayer, array('class' => 'sublayerprop')) ?>
															</td>
														</tr>

														<tr>
															<td class="right"><?php echo $lsDefaults['layers']['transitionInSkewX']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['transitionInSkewX'], $sublayer, array('class' => 'sublayerprop')) ?> &deg;</td>
															<td class="right"><?php echo $lsDefaults['layers']['transitionInSkewY']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['transitionInSkewY'], $sublayer, array('class' => 'sublayerprop')) ?> &deg;</td>
															<td class="right"><?php echo $lsDefaults['layers']['transitionInScaleX']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['transitionInScaleX'], $sublayer, array('class' => 'sublayerprop')) ?></td>
															<td class="right"><?php echo $lsDefaults['layers']['transitionInScaleY']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['transitionInScaleY'], $sublayer, array('class' => 'sublayerprop')) ?></td>
														</tr>
														<tr class="splittext">
															<td></td>
															<td class="right"><?php echo $lsDefaults['layers']['transitionInSplit']['name'] ?></td>
															<td><?php lsGetSelect($lsDefaults['layers']['transitionInSplit'], $sublayer, array('class' => 'sublayerprop')) ?></td>
															<td class="right"><?php echo $lsDefaults['layers']['transitionInShift']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['transitionInShift'], $sublayer, array('class' => 'sublayerprop')) ?> ms</td>
															<td colspan="6"></td>
														</tr>
														<tr class="ls-separator"><td colspan="11"></td></tr>
														<tr>
															<td rowspan="3"><?php jols_e('Transition out', 'LayerSlider') ?></td>
															<td class="right"><?php echo $lsDefaults['layers']['transitionOutOffsetX']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['transitionOutOffsetX'], $sublayer, array('class' => 'sublayerprop')) ?></td>
															<td class="right"><?php echo $lsDefaults['layers']['transitionOutOffsetY']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['transitionOutOffsetY'], $sublayer, array('class' => 'sublayerprop')) ?></td>
															<td class="right"><?php echo $lsDefaults['layers']['transitionOutDuration']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['transitionOutDuration'], $sublayer, array('class' => 'sublayerprop')) ?> ms</td>
															<td class="right"><?php echo $lsDefaults['layers']['showUntil']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['showUntil'], $sublayer, array('class' => 'sublayerprop')) ?> ms</td>
															<td class="right"><a href="http://easings.net/" target="_blank"><?php echo $lsDefaults['layers']['transitionOutEasing']['name'] ?></a></td>
															<td><?php lsGetSelect($lsDefaults['layers']['transitionOutEasing'], $sublayer, array('class' => 'sublayerprop', 'options' => $lsDefaults['easings'])) ?></td>
														</tr>
														<tr>
															<td class="right"><?php echo $lsDefaults['layers']['transitionOutFade']['name'] ?></td>
															<td><?php lsGetCheckbox($lsDefaults['layers']['transitionOutFade'], $sublayer, array('class' => 'sublayerprop')) ?></td>
															<td class="right"><?php echo $lsDefaults['layers']['transitionOutRotate']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['transitionOutRotate'], $sublayer, array('class' => 'sublayerprop')) ?> &deg;</td>
															<td class="right"><?php echo $lsDefaults['layers']['transitionOutRotateX']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['transitionOutRotateX'], $sublayer, array('class' => 'sublayerprop')) ?> &deg;</td>
															<td class="right"><?php echo $lsDefaults['layers']['transitionOutRotateY']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['transitionOutRotateY'], $sublayer, array('class' => 'sublayerprop')) ?> &deg;</td>
															<td colspan="2" rowspan="2" class="center">
																<?php echo $lsDefaults['layers']['transitionOutTransformOrigin']['name'] ?><br>
																<i class="dashicons dashicons-admin-post"></i>
																<?php lsGetInput($lsDefaults['layers']['transitionOutTransformOrigin'], $sublayer, array('class' => 'sublayerprop')) ?>
															</td>
														</tr>

														<tr>
															<td class="right"><?php echo $lsDefaults['layers']['transitionOutSkewX']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['transitionOutSkewX'], $sublayer, array('class' => 'sublayerprop')) ?> &deg;</td>
															<td class="right"><?php echo $lsDefaults['layers']['transitionOutSkewY']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['transitionOutSkewY'], $sublayer, array('class' => 'sublayerprop')) ?> &deg;</td>
															<td class="right"><?php echo $lsDefaults['layers']['transitionOutScaleX']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['transitionOutScaleX'], $sublayer, array('class' => 'sublayerprop')) ?></td>
															<td class="right"><?php echo $lsDefaults['layers']['transitionOutScaleY']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['transitionOutScaleY'], $sublayer, array('class' => 'sublayerprop')) ?></td>
														</tr>
														<tr class="splittext">
															<td></td>
															<td class="right"><?php echo $lsDefaults['layers']['transitionOutSplit']['name'] ?></td>
															<td><?php lsGetSelect($lsDefaults['layers']['transitionOutSplit'], $sublayer, array('class' => 'sublayerprop')) ?></td>
															<td class="right"><?php echo $lsDefaults['layers']['transitionOutShift']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['transitionOutShift'], $sublayer, array('class' => 'sublayerprop')) ?> ms</td>
															<td colspan="6"></td>
														</tr>
														<tr class="ls-separator"><td colspan="11"></td></tr>
														<tr>
															<td><?php jols_e('Other options', 'LayerSlider') ?></td>
															<td class="right"><?php echo $lsDefaults['layers']['transitionParallaxLevel']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['transitionParallaxLevel'], $sublayer, array('class' => 'sublayerprop')) ?></td>
															<td class="right"><?php jols_e('Hidden', 'LayerSlider') ?></td>
															<td><input type="checkbox" name="skip" class="checkbox" data-help="<?php jols_e("If you don't want to use this layer, but you want to keep it, you can hide it with this switch.", "LayerSlider") ?>" <?php echo isset($sublayer['skip']) ? 'checked="checked"' : '' ?>></td>
															<td colspan="4"></td>
															<td class="right">
																<i class="copy dashicons dashicons-admin-page" data-storage="lsTransition" data-help="Copy all transition settings"></i>
																<i class="paste dashicons dashicons-clipboard" data-storage="lsTransition" data-help="Paste all transition settings"></i>
															</td>
															<td><label data-help="<?php jols_e('If you will use similar transition for a layer, just copy and paste it on the other.', 'LayerSlider') ?>" >Transition settings</label></td>
														</tr>
												</table>
											</div>
											<?php /*
											<div class="ls-sublayer-page ls-sublayer-loop">
												<table>
													<tbody>
														<tr>
															<td rowspan="3"><?php jols_e('Transition', 'LayerSlider') ?></td>
															<td class="right"><?php echo $lsDefaults['layers']['loopOffsetX']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['loopOffsetX'], $sublayer, array('class' => 'sublayerprop')) ?></td>
															<td class="right"><?php echo $lsDefaults['layers']['loopOffsetY']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['loopOffsetY'], $sublayer, array('class' => 'sublayerprop')) ?></td>
															<td class="right"><?php echo $lsDefaults['layers']['loopDuration']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['loopDuration'], $sublayer, array('class' => 'sublayerprop')) ?> ms</td>
															<td class="right"><?php echo $lsDefaults['layers']['loopDelay']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['loopDelay'], $sublayer, array('class' => 'sublayerprop')) ?> ms</td>
															<td class="right"><a href="http://easings.net/" target="_blank"><?php echo $lsDefaults['layers']['loopEasing']['name'] ?></a></td>
															<td><?php lsGetSelect($lsDefaults['layers']['loopEasing'], $sublayer, array('class' => 'sublayerprop', 'options' => $lsDefaults['easings'])) ?></td>
														</tr>
														<tr>
															<td class="right"><?php echo $lsDefaults['layers']['loopOpacity']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['loopOpacity'], $sublayer, array('class' => 'sublayerprop')) ?></td>
															<td class="right"><?php echo $lsDefaults['layers']['loopRotate']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['loopRotate'], $sublayer, array('class' => 'sublayerprop')) ?> &deg;</td>
															<td class="right"><?php echo $lsDefaults['layers']['loopRotateX']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['loopRotateX'], $sublayer, array('class' => 'sublayerprop')) ?> &deg;</td>
															<td class="right"><?php echo $lsDefaults['layers']['loopRotateY']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['loopRotateY'], $sublayer, array('class' => 'sublayerprop')) ?> &deg;</td>
															<td colspan="2" rowspan="2" class="center">
																<?php echo $lsDefaults['layers']['loopTransformOrigin']['name'] ?><br>
																<?php lsGetInput($lsDefaults['layers']['loopTransformOrigin'], $sublayer, array('class' => 'sublayerprop')) ?>
															</td>
														</tr>

														<tr>
															<td class="right"><?php echo $lsDefaults['layers']['loopSkewX']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['loopSkewX'], $sublayer, array('class' => 'sublayerprop')) ?> &deg;</td>
															<td class="right"><?php echo $lsDefaults['layers']['loopSkewY']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['loopSkewY'], $sublayer, array('class' => 'sublayerprop')) ?> &deg;</td>
															<td class="right"><?php echo $lsDefaults['layers']['loopScaleX']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['loopScaleX'], $sublayer, array('class' => 'sublayerprop')) ?></td>
															<td class="right"><?php echo $lsDefaults['layers']['loopScaleY']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['loopScaleY'], $sublayer, array('class' => 'sublayerprop')) ?></td>
														</tr>
														<tr class="ls-separator"><td colspan="12"></td></tr>
														<tr>
															<td><?php jols_e('Loop', 'LayerSlider') ?></td>
															<td class="right"><?php echo $lsDefaults['layers']['loopCount']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['loopCount'], $sublayer, array('class' => 'sublayerprop')) ?></td>
															<td class="right"><?php echo $lsDefaults['layers']['loopWait']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['loopWait'], $sublayer, array('class' => 'sublayerprop')) ?> ms</td>
															<td class="right"><?php echo $lsDefaults['layers']['loopYoyo']['name'] ?></td>
															<td><label style="display:inline" data-help="<?php echo $lsDefaults['layers']['loopYoyo']['tooltip'] ?>"><?php lsGetCheckbox($lsDefaults['layers']['loopYoyo'], $sublayer, array('class' => 'sublayerprop')) ?></label></td>
															<td class="right"><?php echo $lsDefaults['layers']['yoyoDuration']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['yoyoDuration'], $sublayer, array('class' => 'sublayerprop')) ?> ms</td>
															<td class="right"><a href="http://easings.net/" target="_blank"><?php echo $lsDefaults['layers']['yoyoEasing']['name'] ?></a></td>
															<td><?php lsGetSelect($lsDefaults['layers']['yoyoEasing'], $sublayer, array('class' => 'sublayerprop', 'options' => array_merge(array('' => '- Same easing -'), $lsDefaults['easings']) )) ?></td>

															<!--td class="right"><label data-help="<?php jols_e('If you will use similar loop for a layer, just copy and paste it on the other.', 'LayerSlider') ?>" >Settings</label></td>
															<td colspan="4"><a href="javascript:;" onclick="localStorage.lsLoop=jQuery(this).parents('table:first').inputsToObj();" class="copy dashicons dashicons-admin-page" data-help="Copy all loop settings"></a>
																							<a href="javascript:;" onclick="jQuery(this).parents('table:first').objToInputs(localStorage.lsLoop);" class="paste dashicons dashicons-clipboard" data-help="Paste all loop settings"></a></td-->
														</tr>
													</tbody>
												</table>
											</div>
											<div class="ls-sublayer-page ls-sublayer-hover">
												<table>
													<tbody>
														<tr>
															<td rowspan="4"><?php jols_e('Transition', 'LayerSlider') ?></td>
															<td class="right"><?php echo $lsDefaults['layers']['hoverOffsetX']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['hoverOffsetX'], $sublayer, array('class' => 'sublayerprop')) ?></td>
															<td class="right"><?php echo $lsDefaults['layers']['hoverOffsetY']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['hoverOffsetY'], $sublayer, array('class' => 'sublayerprop')) ?></td>
															<td class="right"><?php echo $lsDefaults['layers']['hoverDuration']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['hoverDuration'], $sublayer, array('class' => 'sublayerprop')) ?> ms</td>
															<td class="right"><?php echo $lsDefaults['layers']['hoverDelay']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['hoverDelay'], $sublayer, array('class' => 'sublayerprop')) ?> ms</td>
															<td class="right"><a href="http://easings.net/" target="_blank"><?php echo $lsDefaults['layers']['hoverEasing']['name'] ?></a></td>
															<td><?php lsGetSelect($lsDefaults['layers']['hoverEasing'], $sublayer, array('class' => 'sublayerprop', 'options' => $lsDefaults['easings'])) ?></td>
														</tr>
														<tr>
															<td class="right"><?php echo $lsDefaults['layers']['hoverOpacity']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['hoverOpacity'], $sublayer, array('class' => 'sublayerprop')) ?></td>
															<td class="right"><?php echo $lsDefaults['layers']['hoverRotate']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['hoverRotate'], $sublayer, array('class' => 'sublayerprop')) ?> &deg;</td>
															<td class="right"><?php echo $lsDefaults['layers']['hoverRotateX']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['hoverRotateX'], $sublayer, array('class' => 'sublayerprop')) ?> &deg;</td>
															<td class="right"><?php echo $lsDefaults['layers']['hoverRotateY']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['hoverRotateY'], $sublayer, array('class' => 'sublayerprop')) ?> &deg;</td>
															<td colspan="2" rowspan="2" class="center">
																<?php echo $lsDefaults['layers']['hoverTransformOrigin']['name'] ?><br>
																<?php lsGetInput($lsDefaults['layers']['hoverTransformOrigin'], $sublayer, array('class' => 'sublayerprop')) ?>
															</td>
														</tr>
														<tr>
															<td class="right"><?php echo $lsDefaults['layers']['hoverSkewX']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['hoverSkewX'], $sublayer, array('class' => 'sublayerprop')) ?> &deg;</td>
															<td class="right"><?php echo $lsDefaults['layers']['hoverSkewY']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['hoverSkewY'], $sublayer, array('class' => 'sublayerprop')) ?> &deg;</td>
															<td class="right"><?php echo $lsDefaults['layers']['hoverScaleX']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['hoverScaleX'], $sublayer, array('class' => 'sublayerprop')) ?></td>
															<td class="right"><?php echo $lsDefaults['layers']['hoverScaleY']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['hoverScaleY'], $sublayer, array('class' => 'sublayerprop')) ?></td>
														</tr>
														<tr>
															<td class="right"><?php echo $lsDefaults['layers']['hoverBackground']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['hoverBackground'], $sublayer, array('class' => 'sublayerprop ls-colorpicker')) ?></td>
															<td class="right"><?php echo $lsDefaults['layers']['hoverColor']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['hoverColor'], $sublayer, array('class' => 'sublayerprop ls-colorpicker')) ?></td>
															<td class="right"><?php echo $lsDefaults['layers']['hoverBorderRadius']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['hoverBorderRadius'], $sublayer, array('class' => 'sublayerprop')) ?></td>
															<td class="right"><?php echo $lsDefaults['layers']['reverseDuration']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['reverseDuration'], $sublayer, array('class' => 'sublayerprop')) ?> ms</td>
															<td class="right"><a href="http://easings.net/" target="_blank"><?php echo $lsDefaults['layers']['reverseEasing']['name'] ?></a></td>
															<td><?php lsGetSelect($lsDefaults['layers']['reverseEasing'], $sublayer, array('class' => 'sublayerprop', 'options' => array_merge(array('' => '- Same easing -'), $lsDefaults['easings']) )) ?></td>
														</tr>
														<tr class="ls-separator"><td colspan="11"></td></tr>
														<tr>
															<td><?php jols_e('Hover', 'LayerSlider') ?></td>
															<td class="right"><?php echo $lsDefaults['layers']['hoverEnable']['name'] ?></td>
															<td><?php lsGetCheckbox($lsDefaults['layers']['hoverEnable'], $sublayer, array('class' => 'sublayerprop')) ?></td>
															<td class="right"><?php echo $lsDefaults['layers']['hoverConnect']['name'] ?></td>
															<td>
																<?php $option = @$sublayer['connecthover'] ? array($sublayer['connecthover'] => $sublayer['connectname']) : array('' => jols__('- This layer -', 'LayerSlider')) ?>
																<?php lsGetSelect($lsDefaults['layers']['hoverConnect'], $sublayer, array('class' => 'sublayerprop connect-hover', 'options' => $option)) ?>
																<?php lsGetInput($lsDefaults['layers']['hoverConnectName'], $sublayer, array('class' => 'sublayerprop connect-name')) ?>
																<?php lsGetInput($lsDefaults['layers']['lsId'], isset($sublayer['lsid']) ? $sublayer : array('lsid' => uniqid('ls')), array('class' => 'sublayerprop ls-id')) ?>
															</td>
															<td class="right"><label data-help="<?php jols_e('If you will use similar hover for a layer, just copy and paste it on the other.', 'LayerSlider') ?>" >Settings</label></td>
															<td colspan="4"><a href="javascript:;" onclick="localStorage.lsHover=jQuery(this).parents('table:first').inputsToObj();" class="copy dashicons dashicons-admin-page" data-help="Copy all hover settings"></a>
																							<a href="javascript:;" onclick="jQuery(this).parents('table:first').objToInputs(localStorage.lsHover);" class="paste dashicons dashicons-clipboard" data-help="Paste all hover settings"></a></td>
														</tr>
													</tbody>
												</table>
											</div>
											*/ ?>
											<div class="ls-sublayer-page ls-sublayer-link">
												<table>
													<tbody>
														<tr>
															<td>
																<div class="ls-slide-link">
																	<div><?php lsGetInput($lsDefaults['layers']['linkURL'], $sublayer, array('placeholder' => $lsDefaults['layers']['linkURL']['name'] )) ?></div>
																	 or <a href="#" class="ls-post-url"><?php jols_e('use dynamic URL', 'LayerSlider') ?></a>
																	<span><?php lsGetSelect($lsDefaults['layers']['linkTarget'], $sublayer) ?></span>
																</div>
															</td>
														</tr>
													</tbody>
												</table>
											</div>
											<div class="ls-sublayer-page ls-sublayer-style">
												<?php $layerStyles = !empty($sublayer['styles']) ? json_decode($sublayer['styles'], true) : array(); ?>
												<?php if($layerStyles === null) { $layerStyles = json_decode(stripslashes($sublayer['styles']), true); } ?>
												<?php $sublayer['styles'] = $layerStyles;  ?>
												<input type="hidden" name="styles">
												<table>
													<tbody>
														<tr>
															<td><?php jols_e('Layout & Positions', 'LayerSlider') ?></td>
															<td class="right"><?php echo $lsDefaults['layers']['width']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['width'], $sublayer['styles'], array('class' => 'auto')) ?></td>
															<td class="right"><?php echo $lsDefaults['layers']['height']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['height'], $sublayer['styles'], array('class' => 'auto')) ?></td>
															<td class="right"><?php echo $lsDefaults['layers']['top']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['top'], $sublayer, array('class' => 'ls-top')) ?></td>
															<td class="right"><?php echo $lsDefaults['layers']['left']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['left'], $sublayer, array('class' => 'ls-left')) ?></td>
														</tr>
														<?php /*
														<tr>
															<td><?php jols_e('Transform', 'LayerSlider') ?></td>
															<td class="right"><?php echo $lsDefaults['layers']['opacity']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['opacity'], $sublayer['styles'], array('class' => 'auto')) ?></td>
															<td class="right"><?php echo $lsDefaults['layers']['rotate']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['rotate'], $sublayer['styles'], array('class' => 'auto')) ?> &deg;</td>
															<td class="right"><?php echo $lsDefaults['layers']['skewX']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['skewX'], $sublayer['styles'], array('class' => 'auto')) ?> &deg;</td>
															<td class="right"><?php echo $lsDefaults['layers']['skewY']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['skewY'], $sublayer['styles'], array('class' => 'auto')) ?> &deg;</td>
														</tr>
														*/ ?>
														<tr>
															<td><?php jols_e('Padding', 'LayerSlider') ?></td>
															<td class="right"><?php echo $lsDefaults['layers']['paddingTop']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['paddingTop'], $sublayer['styles'], array('class' => 'auto')) ?></td>
															<td class="right"><?php echo $lsDefaults['layers']['paddingRight']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['paddingRight'], $sublayer['styles'], array('class' => 'auto')) ?></td>
															<td class="right"><?php echo $lsDefaults['layers']['paddingBottom']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['paddingBottom'], $sublayer['styles'], array('class' => 'auto')) ?></td>
															<td class="right"><?php echo $lsDefaults['layers']['paddingLeft']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['paddingLeft'], $sublayer['styles'], array('class' => 'auto')) ?></td>
														</tr>
														<tr>
															<td><?php jols_e('Border', 'LayerSlider') ?></td>
															<td class="right"><?php echo $lsDefaults['layers']['borderTop']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['borderTop'], $sublayer['styles'], array('class' => 'auto')) ?></td>
															<td class="right"><?php echo $lsDefaults['layers']['borderRight']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['borderRight'], $sublayer['styles'], array('class' => 'auto')) ?></td>
															<td class="right"><?php echo $lsDefaults['layers']['borderBottom']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['borderBottom'], $sublayer['styles'], array('class' => 'auto')) ?></td>
															<td class="right"><?php echo $lsDefaults['layers']['borderLeft']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['borderLeft'], $sublayer['styles'], array('class' => 'auto')) ?></td>
														</tr>
														<tr>
															<td><?php jols_e('Font', 'LayerSlider') ?></td>
															<td class="right"><?php echo $lsDefaults['layers']['fontFamily']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['fontFamily'], $sublayer['styles'], array('class' => 'auto')) ?></td>
															<td class="right"><?php echo $lsDefaults['layers']['fontSize']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['fontSize'], $sublayer['styles'], array('class' => 'auto')) ?></td>
															<td class="right"><?php echo $lsDefaults['layers']['lineHeight']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['lineHeight'], $sublayer['styles'], array('class' => 'auto')) ?></td>
															<td class="right"><?php echo $lsDefaults['layers']['color']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['color'], $sublayer['styles'], array('class' => 'auto ls-colorpicker')) ?></td>
														</tr>
														<tr>
															<td><?php jols_e('Misc', 'LayerSlider') ?></td>
															<td class="right"><?php echo $lsDefaults['layers']['background']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['background'], $sublayer['styles'], array('class' => 'auto ls-colorpicker')) ?></td>
															<td class="right"><?php echo $lsDefaults['layers']['borderRadius']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['borderRadius'], $sublayer['styles'], array('class' => 'auto')) ?></td>
															<td class="right"><?php jols_e('Word-wrap', 'LayerSlider') ?></td>
															<td><input type="checkbox" name="wordwrap" data-help="<?php jols_e('If you use custom sized layers, you have to enable this setting to wrap your text.', 'LayerSlider') ?>" class="checkbox"<?php echo isset($sublayer['wordwrap']) ? ' checked="checked"' : '' ?>></td>
															<td class="right">
																<i class="copy dashicons dashicons-admin-page" data-storage="lsStyle" data-help="Copy all style settings"></i>
																<i class="paste dashicons dashicons-clipboard" data-storage="lsStyle" data-help="Paste all style settings"></i>
															</td>
															<td><label data-help="<?php jols_e('If you will use similar style settings for a layer, just copy and paste it on the other.', 'LayerSlider') ?>" >Style settings</label></td>
														</tr>
														<tr class="ls-separator"><td colspan="11"></td></tr>
														<tr>
															<td><?php jols_e('Custom CSS', 'LayerSlider') ?></td>
															<td colspan="8"><textarea rows="5" cols="50" name="style" class="style" data-help="<?php jols_e('If you want to set style settings other then above, you can use here any CSS codes. Please make sure to write valid markup.', 'LayerSlider') ?>"><?php echo !empty($sublayer['style']) ? stripslashes($sublayer['style']) : '' ?></textarea></td>
														</tr>
													</tbody>
												</table>
											</div>
											<div class="ls-sublayer-page ls-sublayer-attributes">
												<table>
													<tbody>
														<tr>
															<td><?php jols_e('Attributes', 'LayerSlider') ?></td>
															<td class="right"><?php echo $lsDefaults['layers']['ID']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['ID'], $sublayer) ?></td>
															<td class="right"><?php echo $lsDefaults['layers']['class']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['class'], $sublayer, array('class' => 'ls-classes')) ?></td>
															<td class="right"><?php echo $lsDefaults['layers']['title']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['title'], $sublayer) ?></td>
															<td class="right"><?php echo $lsDefaults['layers']['alt']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['alt'], $sublayer) ?></td>
															<td class="right"><?php echo $lsDefaults['layers']['rel']['name'] ?></td>
															<td><?php lsGetInput($lsDefaults['layers']['rel'], $sublayer) ?></td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</td>
							</tr>
							<?php endforeach; ?>
							<?php endif; ?>
						</tbody>
					</table>
					<a href="#" class="ls-add-sublayer">
						<i class="dashicons dashicons-plus"></i> <?php jols_e('Add new layer', 'LayerSlider') ?>
					</a>
				</div>
				<?php endforeach; ?>
			<?php endif; ?>
			</div>
		</div>

		<!-- Event Callbacks -->
		<div class="ls-page ls-callback-page">
			<div class="ls-box ls-callback-box">
				<h3 class="header">
					cbInit
					<figure><span>|</span> <?php jols_e('Fires when LayerSlider has loaded', 'LayerSlider') ?></figure>
				</h3>
				<div>
					<textarea name="cbinit" cols="20" rows="5" class="ls-codemirror"><?php echo !empty($slider['properties']['cbinit']) ? stripslashes($slider['properties']['cbinit']) : $lsDefaults['slider']['cbInit']['value'] ?></textarea>
				</div>
			</div>

			<div class="ls-box ls-callback-box">
				<h3 class="header">
					cbStart
					<figure><span>|</span> <?php jols_e('Calling when the slideshow has started.', 'LayerSlider') ?></figure>
				</h3>
				<div>
					<textarea name="cbstart" cols="20" rows="5" class="ls-codemirror"><?php echo !empty($slider['properties']['cbstart']) ? stripslashes($slider['properties']['cbstart']) : $lsDefaults['slider']['cbStart']['value'] ?></textarea>
				</div>
			</div>

			<div class="ls-box ls-callback-box side">
				<h3 class="header">
					cbStop
					<figure><span>|</span> <?php jols_e('Calling when the slideshow is stopped by the user.', 'LayerSlider') ?></figure>
				</h3>
				<div>
					<textarea name="cbstop" cols="20" rows="5" class="ls-codemirror"><?php echo !empty($slider['properties']['cbstop']) ? stripslashes($slider['properties']['cbstop']) : $lsDefaults['slider']['cbStop']['value'] ?></textarea>
				</div>
			</div>

			<div class="ls-box ls-callback-box">
				<h3 class="header">
					cbPause
					<figure><span>|</span> <?php jols_e('Fireing when the slideshow is temporary on hold (e.g.: "Pause on hover" feature).', 'LayerSlider') ?></figure>
				</h3>
				<div>
					<textarea name="cbpause" cols="20" rows="5" class="ls-codemirror"><?php echo !empty($slider['properties']['cbpause']) ? stripslashes($slider['properties']['cbpause']) : $lsDefaults['slider']['cbPause']['value'] ?></textarea>
				</div>
			</div>

			<div class="ls-box ls-callback-box">
				<h3 class="header">
					cbAnimStart
					<figure><span>|</span> <?php jols_e('Calling when the slider commencing slide change (animation start).', 'LayerSlider') ?></figure>
				</h3>
				<div>
					<textarea name="cbanimstart" cols="20" rows="5" class="ls-codemirror"><?php echo !empty($slider['properties']['cbanimstart']) ? stripslashes($slider['properties']['cbanimstart']) : $lsDefaults['slider']['cbAnimStart']['value'] ?></textarea>
				</div>
			</div>

			<div class="ls-box ls-callback-box side">
				<h3 class="header">
					cbAnimStop
					<figure><span>|</span> <?php jols_e('Fireing when the slider finished a slide change (animation end).', 'LayerSlider') ?></figure>
				</h3>
				<div>
					<textarea name="cbanimstop" cols="20" rows="5" class="ls-codemirror"><?php echo !empty($slider['properties']['cbanimstop']) ? stripslashes($slider['properties']['cbanimstop']) : $lsDefaults['slider']['cbAnimStop']['value'] ?></textarea>
				</div>
			</div>

			<div class="ls-box ls-callback-box">
				<h3 class="header">
					cbPrev
					<figure><span>|</span> <?php jols_e('Calling when the slider will change to the previous slide by the user.', 'LayerSlider') ?></figure>
				</h3>
				<div>
					<textarea name="cbprev" cols="20" rows="5" class="ls-codemirror"><?php echo !empty($slider['properties']['cbprev']) ? stripslashes($slider['properties']['cbprev']) : $lsDefaults['slider']['cbPrev']['value'] ?></textarea>
				</div>
			</div>

			<div class="ls-box ls-callback-box">
				<h3 class="header">
					cbNext
					<figure><span>|</span> <?php jols_e('Calling when the slider will change to the next slide by the user.', 'LayerSlider') ?></figure>
				</h3>
				<div>
					<textarea name="cbnext" cols="20" rows="5" class="ls-codemirror"><?php echo !empty($slider['properties']['cbnext']) ? stripslashes($slider['properties']['cbnext']) : $lsDefaults['slider']['cbNext']['value'] ?></textarea>
				</div>
			</div>
			<div class="clear"></div>
		</div>
	</div>

	<div class="ls-publish">
		<button type="submit" class="button button-primary button-hero"><?php jols_e('Save changes', 'LayerSlider') ?></button>
		<div class="ls-save-shortcode">
			<p><span>Use shortcode:</span><br><span>{layerslider id="<?php echo $id ?>"}</span></p>
		</div>
	</div>
</form>


<script type="text/javascript">

	// Plugin path
	var pluginPath = '<?php echo LS_ROOT_URL ?>/static/';

	// Transition images
	var lsTrImgPath = '<?php echo LS_ROOT_URL ?>/static/img/';

	// New Media Library
	<?php if(function_exists( 'wp_enqueue_media' )) { ?>
	var newMediaUploader = true;
	<?php } else { ?>
	var newMediaUploader = false;
	<?php } ?>

	// Screen options
	var lsScreenOptions = <?php echo json_encode($lsScreenOptions) ?>;
</script>
