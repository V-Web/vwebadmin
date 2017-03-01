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

	// Get all skins
	$skins = array_map('basename', glob(LS_ROOT_PATH . '/static/skins/*', GLOB_ONLYDIR));
	$skin = !empty($_GET['skin']) ? $_GET['skin'] : $skins[0];
	$folder = LS_ROOT_PATH.'/static/skins/'.$skin;
	$file = LS_ROOT_PATH.'/static/skins/'.$skin.'/skin.css';
	// Get screen options
	$lsScreenOptions = jols_get_option('ls-screen-options', '0');
	$lsScreenOptions = ($lsScreenOptions == 0) ? array() : $lsScreenOptions;
	$lsScreenOptions = is_array($lsScreenOptions) ? $lsScreenOptions : unserialize($lsScreenOptions);
	// Defaults
	if(!isset($lsScreenOptions['showTooltips'])) {
		$lsScreenOptions['showTooltips'] = 'true';
	}

?>

<div id="ls-screen-options" class="metabox-prefs hidden">
	<div id="screen-options-wrap" class="hidden">
		<form id="ls-screen-options-form" action="<?php echo $_SERVER['REQUEST_URI']?>" method="post">
			<h5><?php jols_e('Show on screen', 'LayerSlider') ?></h5>
			<label>
				<input type="checkbox" name="showTooltips"<?php echo $lsScreenOptions['showTooltips'] == 'true' ? ' checked="checked"' : ''?>> <?php jols_e('Tooltips', 'LayerSlider') ?>
			</label>
		</form>
	</div>
	<div id="screen-options-link-wrap" class="hide-if-no-js screen-meta-toggle">
		<a href="#screen-options-wrap" id="show-settings-link" class="show-settings"><?php jols_e('Screen Options', 'LayerSlider') ?></a>
	</div>
</div>

<div class="wrap">

	<!-- Page title -->
	<h2>
		<?php jols_e('LayerSlider Skin Editor', 'LayerSlider') ?>
		<a href="?option=com_layer_slider" class="add-new-h2"><?php jols_e('Back to the list', 'LayerSlider') ?></a>
	</h2>

	<!-- Error messages -->
	<?php if(isset($_GET['edited'])) : ?>
	<div class="ls-notification updated">
		<div><?php jols_e('Your changes has been saved!', 'LayerSlider') ?></div>
	</div>
	<?php endif; ?>
	<!-- End of error messages -->

	<!-- Editor box -->
	<form action="<?php echo $_SERVER['REQUEST_URI'] ?>&task=save_skin" method="post" class="ls-box ls-skin-editor-box">
		<input type="hidden" name="ls-user-skins" value="1">
		<?php jols_nonce_field('save-user-skin'); ?>
		<h3 class="header medium">
			<?php jols_e('Skin Editor', 'LayerSlider') ?>
			<figure><span>|</span><?php jols_e('Ctrl+Q to fold/unfold a block', 'LayerSlider') ?></figure>
			<p>
				<span><?php jols_e('Choose a skin:', 'LayerSlider') ?></span>
				<select name="skin" class="ls-skin-editor-select">
					<?php foreach($skins as $item) : ?>
					<?php if($item['handle'] == $skin['handle']) { ?>
					<option value="<?php echo $item['handle'] ?>" selected="selected"><?php echo $item['name'] ?></option>
					<?php } else { ?>
					<option value="<?php echo $item['handle'] ?>"><?php echo $item['name'] ?></option>
					<?php } ?>
					<?php endforeach; ?>
				</select>
			</p>
		</h3>
		<p class="inner"><?php jols_e('Built-in skins will be overwritten by plugin updates. Making changes should be done through the Custom Styles Editor.', 'LayerSlider') ?></p>
		<div class="inner">
			<textarea rows="10" cols="50" name="contents" class="ls-codemirror"><?php echo htmlentities(file_get_contents($file)); ?></textarea>
			<p class="footer">
				<?php if(!is_writable($file)) { ?>
				<?php jols_e('You need to make this file writable in order to save your changes.', 'LayerSlider') ?>
				<?php } else { ?>
				<button class="button-primary"><?php jols_e('Save changes', 'LayerSlider') ?></button>
				<?php jols_e("Modifying a skin with invalid code can break your sliders' appearance. Changes cannot be reverted after saving.", "LayerSlider") ?>
				<?php } ?>
			</p>
		</div>
	</form>
</div>
<script type="text/javascript">
	// Screen options
	var lsScreenOptions = <?php echo json_encode($lsScreenOptions) ?>;
</script>
