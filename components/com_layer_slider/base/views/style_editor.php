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

	// Get uploads dir
	$upload_dir = jols_upload_dir();
	$file = $upload_dir['basedir'].'/layerslider.custom.css';

	// Get contents
	$contents = file_exists($file) ? file_get_contents($file) : '';

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
		<?php jols_e('LayerSlider Custom Styles Editor', 'LayerSlider') ?>
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
	<div class="ls-box ls-skin-editor-box">
		<h3 class="header medium">
			<?php jols_e('Contents of your custom CSS file', 'LayerSlider') ?>
			<figure><span>|</span><?php jols_e('Ctrl+Q to fold/unfold a block', 'LayerSlider') ?></figure>
		</h3>
		<form action="<?php echo $_SERVER['REQUEST_URI'] ?>&task=save_style" method="post" class="inner">
			<input type="hidden" name="ls-user-css" value="1">
			<?php jols_nonce_field('save-user-css'); ?>
			<textarea rows="10" cols="50" name="contents" class="ls-codemirror"><?php if(!empty($contents)) {
					echo htmlentities($contents);
				} else {
					jols_e('/* You can type here any CSS code that will be loaded both on your admin and front-end pages.', 'LayerSlider');
					echo NL;
					jols_e('Let us help you by giving a few example CSS classes: */', 'LayerSlider');
					echo NL . NL;
					echo '/* Front-end sliders & preview */' . NL . NL;
					echo '.ls-container { /* The slider itself */' . NL . NL . '}' .NL.NL;
					echo '.ls-slide { ' . NL  . NL . '}' . NL.NL;
					echo '.ls-slide a:hover {' . NL.TAB . 'color: blue;' . NL.TAB . 'text-decoration: underline;' . NL . '}' . NL.NL;
					echo '.ls-slide #yourID {' . NL  . NL . '}' . NL.NL;
					echo '.ls-slide .yourClass {' . NL  . NL . '}' . NL.NL;
					echo '/* Side color of 3D objects */' . NL;
					echo '.ls-3d-box div { background: #777; }' .NL;
				}?></textarea>
			<p class="footer">
				<?php if(!is_writable($upload_dir['basedir'])) { ?>
				<?php jols_e('You need to make your uploads folder writable in order to save your changes.', 'LayerSlider') ?>
				<?php } else { ?>
				<button class="button-primary"><?php jols_e('Save changes', 'LayerSlider') ?></button>
				<?php jols_e('Using invalid CSS code could break the appearance of your site or your sliders. Changes cannot be reverted after saving.','LayerSlider') ?>
				<?php } ?>
			</p>
		</form>
	</div>
</div>
<script type="text/javascript">
	// Screen options
	var lsScreenOptions = <?php echo json_encode($lsScreenOptions) ?>;
</script>
