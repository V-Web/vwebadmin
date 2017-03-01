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

	// Get screen options
	$lsScreenOptions = jols_get_option('ls-screen-options', '0');
	$lsScreenOptions = ($lsScreenOptions == 0) ? array() : $lsScreenOptions;
	$lsScreenOptions = is_array($lsScreenOptions) ? $lsScreenOptions : unserialize($lsScreenOptions);

	// Defaults
	if(!isset($lsScreenOptions['showTooltips'])) { $lsScreenOptions['showTooltips'] = 'true'; }
	if(!isset($lsScreenOptions['showRemovedSliders'])) { $lsScreenOptions['showRemovedSliders'] = 'false'; }
	if(!isset($lsScreenOptions['numberOfSliders'])) { $lsScreenOptions['numberOfSliders'] = '10'; }

	// Get current page
	$curPage = (!empty($_GET['paged']) && is_numeric($_GET['paged'])) ? (int) $_GET['paged'] : 1;
	// $curPage = ($curPage >= $maxPage) ? $maxPage : $curPage;

	// Set filters
	$filters = array('page' => $curPage, 'limit' => (int) $lsScreenOptions['numberOfSliders']);
	if($lsScreenOptions['showRemovedSliders'] == 'true') {
		$filters['exclude'] = array('hidden'); }

	// Find sliders
	$sliders = LS_Sliders::find($filters);

	// Pager
	$maxItem = LS_Sliders::$count;
	$maxPage = ceil($maxItem / (int) $lsScreenOptions['numberOfSliders']);
	$maxPage = $maxPage ? $maxPage : 1;

	// Custom capability
	$custom_capability = $custom_role = jols_get_option('layerslider_custom_capability', 'manage_options');
	$default_capabilities = array('manage_network', 'manage_options', 'publish_pages', 'publish_posts', 'edit_posts');

	if(in_array($custom_capability, $default_capabilities)) {
		$custom_capability = '';
	} else {
		$custom_role = 'custom';
	}

	// Auto-updates
	$code = jols_get_option('layerslider-purchase-code', '');
	$validity = jols_get_option('layerslider-validated', '0');
	$channel = jols_get_option('layerslider-release-channel', 'stable');

	// Google Fonts
	$googleFonts = jols_get_option('ls-google-fonts', array());

	// Box toggles
	$lsBoxToggles = jols_get_option('ls-collapsed-boxes', array());
	$lsAdvSettingsToggle = isset($lsBoxToggles['ls-advanced-settings-toggle']) ? $lsBoxToggles['ls-advanced-settings-toggle'] : true;
	$lsGoogleFontsToggle = isset($lsBoxToggles['ls-google-fonts-toggle']) ? $lsBoxToggles['ls-google-fonts-toggle'] : true;

	// Notification messages
	$notifications = array(
		'removeSelectError' => jols__('No sliders were selected to remove.', 'LayerSlider'),
		'removeSuccess' => jols__('The selected sliders were removed.', 'LayerSlider'),
		'deleteSelectError' => jols__('No sliders were selected.', 'LayerSlider'),
		'deleteSuccess' => jols__('The selected sliders were deleted permanently.', 'LayerSlider'),
		'mergeSelectError' => jols__('You need to select at least 2 sliders to merge them.', 'LayerSlider'),
		'mergeSuccess' => jols__('The selected items were merged together as a new slider.', 'LayerSlider'),
		'restoreSelectError' => jols__('No sliders were selected.', 'LayerSlider'),
		'restoreSuccess' => jols__('The selected sliders were restored.', 'LayerSlider'),

		'exportSelectError' => jols__('No sliders were selected to export.', 'LayerSlider'),
		'exportZipError' => jols__('The PHP ZipArchive extension is required to import ZIPs.', 'LayerSlider'),

		'importSelectError' => jols__('Choose a file to import sliders.', 'LayerSlider'),
		'importFailed' => jols__('The import file seems to be invalid or corrupted.', 'LayerSlider'),
		'importSuccess' => jols__('Your slider has been imported.', 'LayerSlider'),
		'permissionError' => jols__('Your account does not have the necessary permission you chose, and your settings have not been saved to prevent locking yourself out of the plugin.', 'LayerSlider'),
		'permissionSuccess' => jols__('Permission changes has been updated.', 'LayerSlider'),
		'googleFontsUpdated' => jols__('Your Google Fonts library has been updated.', 'LayerSlider'),
		'generalUpdated' => jols__('Your settings has been updated.', 'LayerSlider')
	);
?>
<div class="wrap" id="ls-list-page">

	<form action="<?php echo $_SERVER['REQUEST_URI'] ?>&task=manage_sliders" method="post">
		<input type="hidden" name="ls-bulk-action" value="1">
		<?php jols_nonce_field('bulk-action'); ?>
		<div class="ls-box ls-sliders-list" style="margin:0;">
			<table>
				<thead class="header">
					<tr>
						<td><?php jols_e('ID', 'LayerSlider') ?></td>
						<td class="preview"><?php jols_e('Slider preview', 'LayerSlider') ?></td>
						<td><?php jols_e('Name', 'LayerSlider') ?></td>
						<td><?php jols_e('Slides', 'LayerSlider') ?></td>
						<td><?php jols_e('Created', 'LayerSlider') ?></td>
						<td><?php jols_e('Modified', 'LayerSlider') ?></td>
					</tr>
				</thead>
				<tbody>
					<?php if(!empty($sliders)) : ?>
					<?php foreach($sliders as $key => $item) : ?>
					<?php $class = ($item['flag_deleted'] == '1') ? ' class="faded"' : '' ?>
					<tr<?php echo $class ?>>
						<td><?php echo $item['id'] ?></td>
						<td class="preview">
							<div>
								<a onclick="if (window.parent) window.parent.jSelectLayerSlider(<?php echo $item['id'] ?>);" href="javascript:void(0)" href="#">
									<img src="<?php echo apply_filters('ls_get_preview_for_slider', $item ) ?>" alt="Slider preview">
								</a>
							</div>
						</td>
						<td class="name">
							<a onclick="if (window.parent) window.parent.jSelectLayerSlider(<?php echo $item['id'] ?>);" href="javascript:void(0)" href="#">
								<?php echo apply_filters('ls_slider_title', $item['name'], 40) ?>
							</a>
						</td>
						<td><?php echo count($item['data']['layers']) ?></td>
						<td><?php echo date('d/m/y', $item['date_c']) ?></td>
						<td><?php echo jols_human_time_diff($item['date_m']) ?> <?php jols_e('ago', 'LayerSlider') ?></td>
					</tr>
					<?php endforeach; ?>
					<?php endif; ?>
					<?php if(empty($sliders)) : ?>
					<tr>
						<td colspan="9"><?php jols_e('You haven\'t created any a slider yet. Click on the "Add New" button above to add one.', 'LayerSlider') ?></td>
					</tr>
					<?php endif; ?>
				</tbody>
			</table>

		</div>
	</form>
</div>

<!-- Help menu WP Pointer -->
<?php

// Get users data
global $current_user;
jols_get_currentuserinfo();
?>
<script type="text/javascript">
	var lsScreenOptions = <?php echo json_encode($lsScreenOptions) ?>;
</script>
