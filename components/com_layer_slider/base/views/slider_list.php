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

	$db = JFactory::getDbo();
  $query = $db->getQuery(true);
  $query->select($db->quoteName(array('id', 'title', 'params','published')));
  $query->from($db->quoteName('#__modules'));
  $query->where($db->quoteName('module') . ' LIKE '. $db->quote('%mod_layer_slider%'));

  // Reset the query using our newly populated query object.
  $db->setQuery($query);

  // Load the results as a list of stdClass objects (see later for more options on retrieving data).
  $results = $db->loadAssocList();

  $module_assets= array();
  foreach($results as &$result){
    $module_assets[@json_decode($result['params'])->slider][] = $result;
  }

  $query = $db->getQuery(true);
  $query->select($db->quoteName(array('extension_id')));
  $query->from($db->quoteName('#__extensions'));
  $query->where($db->quoteName('element') . ' LIKE '. $db->quote('%mod_layer_slider%'));
  $db->setQuery($query);
  $eid = $db->loadResult();

  if (!JPluginHelper::isEnabled('system', 'offlajnparams'))
  	JFactory::getApplication()->enqueueMessage(
  		'Please enable "Offlajn Params" plugin <a href="index.php?option=com_plugins&filter_search=offlajn">here</a>!<br>If it is missing please reinstall the extension.', 'error');
  else {
	  $filepath = JPATH_SITE."/modules/mod_layer_slider/mod_layer_slider.xml";
	  $hash = JFactory::getXML($filepath)->xpath('hash');
	  $hash = strtr(call_user_func('base'.'64_encode', (string) @$hash[0]), '+/=', '-_,');

	  $generalInfo = '<script>
	  	jQuery(window).on("load resize", function() {jQuery(".column.left .box-content, .column.mid .box-content").height(jQuery(".column.right").height() - 31)});
	  	jQuery.post(location.pathname+"?task=offlajninfo&v='.LS_PLUGIN_VERSION.'", "hash='.$hash.'", function(r) {jQuery(".column.left .box-content").html(r);});
	  </script>';
	  $relatedNews = '<script>jQuery.get(location.pathname+"?task=offlajnnews&tag=Layer Slider", function(r) {jQuery(".column.mid .box-content").html(r)})</script>';
	}

  $supportTicketUrl = JURI::root()."administrator/components/com_layer_slider/assets/images/support-ticket-button.png";
  $supportUsUrl = JURI::root()."administrator/components/com_layer_slider/assets/images/support-us-button.png";

	// Auto-updates
	$code = jols_get_option('layerslider-purchase-code', '');
	$validity = jols_get_option('layerslider-authorized-site', '0');
	$channel = jols_get_option('layerslider-release-channel', 'stable');

	// Google Fonts
	$googleFonts = jols_get_option('ls-google-fonts', array());
	$googleFontScripts = jols_get_option('ls-google-font-scripts', array('latin', 'latin-ext'));

	// Box toggles
	$lsBoxToggles = jols_get_option('ls-collapsed-boxes', array());
	$lsAdvSettingsToggle = isset($lsBoxToggles['ls-advanced-settings-toggle']) ? $lsBoxToggles['ls-advanced-settings-toggle'] : true;
	$lsGoogleFontsToggle = isset($lsBoxToggles['ls-google-fonts-toggle']) ? $lsBoxToggles['ls-google-fonts-toggle'] : false;

	// Notification messages
	$notifications = array(
		'removeSelectError' => jols__('No sliders were selected to remove.', 'LayerSlider'),
		'removeSuccess' => jols__('The selected sliders were removed.', 'LayerSlider'),
		'deleteSelectError' => jols__('No sliders were selected.', 'LayerSlider'),
		'deleteSuccess' => jols__('The selected sliders were permanently deleted.', 'LayerSlider'),
		'mergeSelectError' => jols__('You need to select at least 2 sliders to merge them.', 'LayerSlider'),
		'mergeSuccess' => jols__('The selected items were merged together as a new slider.', 'LayerSlider'),
		'restoreSelectError' => jols__('No sliders were selected.', 'LayerSlider'),
		'restoreSuccess' => jols__('The selected sliders were restored.', 'LayerSlider'),

		'exportNotFound' => jols__('No sliders were found to export.', 'LayerSlider'),
		'exportSelectError' => jols__('No sliders were selected to export.', 'LayerSlider'),
		'exportZipError' => jols__('The PHP ZipArchive extension is required to import .zip files.', 'LayerSlider'),

		'importSelectError' => jols__('Choose a file to import sliders.', 'LayerSlider'),
		'importFailed' => jols__('The import file seems to be invalid or corrupted.', 'LayerSlider'),
		'importSuccess' => jols__('Your slider has been imported.', 'LayerSlider'),
		'permissionError' => jols__('Your account does not have the necessary permission you have chosen, and your settings have not been saved in order to prevent locking yourself out of the plugin.', 'LayerSlider'),
		'permissionSuccess' => jols__('Permission changes has been updated.', 'LayerSlider'),
		'googleFontsUpdated' => jols__('Your Google Fonts library has been updated.', 'LayerSlider'),
		'generalUpdated' => jols__('Your settings has been updated.', 'LayerSlider')
	);
?>
<div id="ls-screen-options" class="metabox-prefs hidden">
	<div id="screen-options-wrap" class="hidden">
		<form id="ls-screen-options-form" action="<?php echo $_SERVER['REQUEST_URI']?>" method="post">
			<h5><?php jols_e('Show on screen', 'LayerSlider') ?></h5>
			<label><input type="checkbox" name="showTooltips"<?php echo $lsScreenOptions['showTooltips'] == 'true' ? ' checked="checked"' : ''?>> <?php jols_e('Tooltips', 'LayerSlider') ?></label>
			<label><input type="checkbox" name="showRemovedSliders" class="reload"<?php echo $lsScreenOptions['showRemovedSliders'] == 'true' ? ' checked="checked"' : ''?>> <?php jols_e('Removed sliders', 'LayerSlider') ?></label><br><br>

			<input type="number" name="numberOfSliders" min="3" step="1" value="<?php echo $lsScreenOptions['numberOfSliders'] ?>"> <?php jols_e('Sliders', 'LayerSlider') ?>
			<button class="button"><?php jols_e('Apply', 'LayerSlider') ?></button>
		</form>
	</div>
	<div id="screen-options-link-wrap" class="hide-if-no-js screen-meta-toggle">
		<a href="#screen-options-wrap" id="show-settings-link" class="show-settings"><?php jols_e('Screen Options', 'LayerSlider') ?></a>
	</div>
</div>
<div class="wrap" id="ls-list-page">
	<h2>
		<?php jols_e('LayerSlider sliders', 'LayerSlider') ?>
		<a href="#" id="ls-add-slider-button" class="add-new-h2"><?php jols_e('Add New', 'LayerSlider') ?></a>
		<?php if (function_exists('curl_version') || ini_get('allow_url_fopen')): ?>
		<a href="#" id="ls-import-sliders-button" class="add-new-h2"><?php jols_e('Import sample sliders', 'LayerSlider') ?></a>
		<?php else: ?>
		<a href="<?php echo jols_nonce_url('?page=layerslider&action=import_sample', 'import-sample-sliders') ?>" id="ls-import-samples-button" class="add-new-h2"><?php jols_e('Import sample sliders', 'LayerSlider') ?></a>
		<?php endif ?>
	</h2>

	<!-- Error messages -->
	<?php if(isset($_GET['message'])) : ?>
	<div class="ls-notification <?php echo isset($_GET['error']) ? 'error' : 'updated' ?>">
		<div><?php echo $notifications[ $_GET['message'] ] ?></div>
	</div>
	<?php endif; ?>
	<!-- End of error messages -->

	<!-- Version number -->
	<?php if(strpos(LS_PLUGIN_VERSION, 'b') !== false) : ?>
	<div class="ls-version-number">
		<?php jols_e('Using beta version', 'LayerSlider') ?> (<?php echo LS_PLUGIN_VERSION ?>)
		<a href="mailto:support@kreaturamedia.com?subject=LayerSlider WP Beta Feedback"><?php jols_e('Send feedback', 'LayerSlider') ?></a>
	</div>
	<?php endif; ?>
	<!-- End of version number -->

	<!-- Add slider template -->
	<form action="?option=com_layer_slider&view=slider&task=add_new_slider" method="post" id="ls-add-slider-template" class="ls-pointer ls-box">
		<?php jols_nonce_field('add-slider'); ?>
		<input type="hidden" name="ls-add-new-slider" value="1">
		<span class="ls-mce-arrow"></span>
		<h3 class="header"><?php jols_e('Name your new slider', 'LayerSlider') ?></h3>
		<div class="inner">
			<input type="text" name="title" placeholder="<?php jols_e('e.g. Homepage slider', 'LayerSlider') ?>">
			<button class="button"><?php jols_e('Add slider', 'LayerSlider') ?></button>
		</div>
	</form>
	<!-- End of Add slider template -->

	<?php if (function_exists('curl_version') || ini_get('allow_url_fopen')): ?>
	<div id="ls-import-sliders-template" class="ls-pointer ls-box"></div>
	<?php else: ?>
	<!-- Import sample sliders template -->
	<div id="ls-import-samples-template" class="ls-pointer ls-box">
		<span class="ls-mce-arrow"></span>
		<h3 class="header"><?php jols_e('Choose a demo slider to import', 'LayerSlider') ?></h3>
		<ul class="inner">
			<li>
				<a href="<?php echo jols_nonce_url('?page=layerslider&action=import_sample&slider=v5.zip', 'import-sample-sliders') ?>">
					<div class="preview"><img src="<?php echo LS_ROOT_URL.'/demos/v5.jpg' ?>"></div>
					<div class="title">LayerSlider 5 responsive demo slider</div>
				</a>
			</li>
			<li>
				<a href="<?php echo jols_nonce_url('?page=layerslider&action=import_sample&slider=fullwidth.zip', 'import-sample-sliders') ?>">
					<div class="preview"><img src="<?php echo LS_ROOT_URL.'/demos/fullwidth.jpg' ?>"></div>
					<div class="title">Full width demo slider</div>
				</a>
			</li>
		</ul>
		<ul class="inner sep">
			<li>
				<a href="<?php echo jols_nonce_url('?page=layerslider&action=import_sample&slider=all', 'import-sample-sliders') ?>">
					<div class="title">Import all demo sliders</div>
				</a>
			</li>
		</ul>
	</div>
	<!-- End of Import sample sliders template -->
	<?php endif ?>

	<form action="<?php echo $_SERVER['REQUEST_URI'] ?>&task=manage_sliders" method="post">
		<input type="hidden" name="ls-bulk-action" value="1">
		<?php jols_nonce_field('bulk-action'); ?>
		<div class="ls-box ls-sliders-list">
			<table>
				<thead class="header">
					<tr>
						<td></td>
						<td><?php jols_e('ID', 'LayerSlider') ?></td>
						<td class="preview"><?php jols_e('Slider preview', 'LayerSlider') ?></td>
						<td><?php jols_e('Name', 'LayerSlider') ?></td>
						<td><?php jols_e('Module assignments', 'LayerSlider') ?></td>
						<td><?php jols_e('Shortcode', 'LayerSlider') ?></td>
						<td><?php jols_e('Slides', 'LayerSlider') ?></td>
						<td><?php jols_e('Created', 'LayerSlider') ?></td>
						<td><?php jols_e('Modified', 'LayerSlider') ?></td>
						<td></td>
					</tr>
				</thead>
				<tbody>
					<?php if(!empty($sliders)) : ?>
					<?php foreach($sliders as $key => $item) : ?>
					<?php $class = ($item['flag_deleted'] == '1') ? ' class="faded"' : '' ?>
					<tr<?php echo $class ?>>
						<td><input type="checkbox" name="sliders[]" value="<?php echo $item['id'] ?>"></td>
						<td><?php echo $item['id'] ?></td>
						<td class="preview">
							<div>
								<a href="?page=layerslider&action=edit&id=<?php echo $item['id'] ?>">
									<img src="<?php echo apply_filters('ls_get_preview_for_slider', $item ) ?>" alt="Slider preview">
								</a>
							</div>
						</td>
						<td class="name">
							<a href="?page=layerslider&action=edit&id=<?php echo $item['id'] ?>">
								<?php echo apply_filters('ls_slider_title', $item['name'], 40) ?>
							</a>
						</td>
						<td><?php
              if(isset($module_assets[$item['id']])){
                foreach($module_assets[$item['id']] as $module){
                  echo '<a data-help="Edit existing module" href="index.php?option=com_modules&task=module.edit&id='.$module['id'].'" class="module_tag '.(($module['published']!=1)?'unpublished':"").'">'.$module['title'].'</a>';
                }
                echo '<div style="clear:both"></div>';
              }
                echo '<a class="create_module_tag" href="index.php?option=com_modules&task=module.add&eid='.$eid.'&params[slider]='.$item['id'].'">Create module</a>';
              ?>
            </td>
						<td><input type="text" class="ls-shortcode" value="{layerslider id=&quot;<?php echo !empty($item['slug']) ? $item['slug'] : $item['id'] ?>&quot;}" readonly></td>
						<td><?php echo isset($item['data']['layers']) ? count($item['data']['layers']) : 0 ?></td>
						<td><?php echo date('d/m/y', $item['date_c']) ?></td>
						<td><?php echo jols_human_time_diff($item['date_m']) ?> <?php jols_e('ago', 'LayerSlider') ?></td>
						<td>
							<?php if(!$item['flag_deleted']) : ?>
							<a href="<?php echo jols_nonce_url('?option=com_layer_slider&task=duplicate_slider&id='.$item['id'], 'duplicate_'.$item['id']) ?>">
								<span class="dashicons dashicons-admin-page" data-help="<?php jols_e('Duplicate this slider', 'LayerSlider') ?>"></span></a>
							<a href="<?php echo jols_nonce_url('?page=layerslider&action=remove&id='.$item['id'], 'remove_'.$item['id']) ?>" class="remove">
								<span class="dashicons dashicons-trash" data-help="<?php jols_e('Remove this slider', 'LayerSlider') ?>"></span></a>
							<?php else : ?>
							<a href="<?php echo jols_nonce_url('?page=layerslider&action=restore&id='.$item['id'], 'restore_'.$item['id']) ?>">
								<span class="dashicons dashicons-backup" data-help="<?php jols_e('Restore removed slider', 'LayerSlider') ?>"></span>
							</a>
							<?php endif; ?>
						</td>
					</tr>
					<?php endforeach; ?>
					<?php endif; ?>
					<?php if(empty($sliders)) : ?>
					<tr>
						<td colspan="9"><?php jols_e('You haven\'t created any slider yet. Click on the "Add New" button above to add one.', 'LayerSlider') ?></td>
					</tr>
					<?php endif; ?>
				</tbody>
			</table>
			<div class="ls-bulk-actions">
			<select name="action">
				<option value="0"><?php jols_e('- Choose an action -', 'LayerSlider') ?></option>
				<option value="remove"><?php jols_e('Remove selected', 'LayerSlider') ?></option>
				<option value="delete"><?php jols_e('Delete permanently', 'LayerSlider') ?></option>
				<?php if($lsScreenOptions['showRemovedSliders'] == 'true') : ?>
				<option value="restore"><?php jols_e('Restore removed', 'LayerSlider') ?></option>
				<?php endif; ?>
				<option value="merge"><?php jols_e('Merge selected as new', 'LayerSlider') ?></option>
				<option value="createstatic"><?php jols_e('Create static slider from dynamic', 'LayerSlider') ?></option>
			</select>
			<button class="button"><?php jols_e('Apply', 'LayerSlider') ?></button>
		</div>
		</div>
	</form>
	<div class="ls-pagination tablenav bottom">
		<div class="tablenav-pages">
			<span class="displaying-num"><?php echo $maxItem ?> <?php jols_e('items', 'LayerSlider') ?></span>
			<span class="pagination-links">
				<a class="first-page<?php echo ($curPage <= 1) ? ' disabled' : ''; ?>" title="Go to the first page" href="admin.php?page=layerslider">«</a>
				<a class="prev-page <?php echo ($curPage <= 1) ? ' disabled' : ''; ?>" title="Go to the previous page" href="admin.php?page=layerslider&amp;paged=<?php echo ($curPage-1) ?>">‹</a>
				<form action="admin.php" method="get" class="paging-input">
					<input type="hidden" name="page" value="layerslider">
					<input class="current-page" title="Current page" type="text" name="paged" value="<?php echo $curPage ?>" size="1"> of
					<span class="total-pages"><?php echo $maxPage ?></span>
				</form>
				<a class="next-page <?php echo ($curPage >= $maxPage) ? ' disabled' : ''; ?>" title="Go to the next page" href="admin.php?page=layerslider&amp;paged=<?php echo ($curPage+1) ?>">›</a>
				<a class="last-page <?php echo ($curPage >= $maxPage) ? ' disabled' : ''; ?>" title="Go to the last page" href="admin.php?page=layerslider&amp;paged=<?php echo $maxPage ?>">»</a>
			</span>
		</div>
	</div>


	<div class="ls-export-wrapper columns clearfix">
		<div class="half" style="width:calc(40% - 15px)">
			<div class="ls-import-export-box ls-box">
				<h3 class="header medium"><?php jols_e('Import Sliders', 'LayerSlider') ?></h3>
				<form action="<?php echo $_SERVER['REQUEST_URI'] ?>&task=import_slider" method="post" enctype="multipart/form-data" class="ls-import-box">
					<?php jols_nonce_field('import-sliders'); ?>
					<input type="hidden" name="ls-import" value="1">
					<table data-help="<?php jols_e('Choose a LayerSlider export file downloaded previously to import your sliders. In order to import from outdated versions, you need to create a file and paste the export code into it. The file needs to have a .json extension.', 'LayerSlider') ?>">
						<tbody>
							<tr>
								<td><input type="file" name="import_file"></td>
								<td><button class="button"><?php jols_e('Import', 'LayerSlider') ?></button></td>
							</tr>
						</tbody>
					</table>
				</form>
			</div>
			<div class="ls-import-export-box ls-box">
				<h3 class="header medium"><?php jols_e('Export Sliders', 'LayerSlider') ?></h3>
				<form action="<?php echo $_SERVER['REQUEST_URI'] ?>&task=export_slider" method="post" class="ls-export-form">
					<?php jols_nonce_field('export-sliders'); ?>
					<input type="hidden" name="ls-export" value="1">
					<table>
						<tbody>
							<tr>
								<td>
									<select name="sliders[]" multiple="multiple" data-help="<?php jols_e('Downloads an export file that contains your selected sliders to import on your new site. You can select multiple sliders by holding the Ctrl/Cmd button while clicking.', 'LayerSlider') ?>">
										<option value="-1" selected> <?php jols_e('All Sliders', 'LayerSlider') ?></option>
										<?php foreach($sliders as $slider) : ?>
										<option value="<?php echo $slider['id'] ?>">
											#<?php echo str_replace(' ', '&nbsp;', str_pad($slider['id'], 3, " ")) ?> -
											<?php echo apply_filters('ls_slider_title', $slider['name'], 30) ?>
										</option>
										<?php endforeach; ?>
									</select>

									<label style="float:left">
										<input type="checkbox"  class="checkbox" name="exportWithImages" checked> Export with images
									</label>
									<button class="button" style="float:right; margin-top:10px"><?php jols_e('Export', 'LayerSlider') ?></button>
								</td>
							</tr>
						</tbody>
					</table>
				</form>
			</div>
		</div>

		<div class="half" style="width:calc(60% - 15px)">
			<form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post" class="ls-box ls-import-export-box panel dashboard" id="offlajn-dashboard">
				<?php jols_nonce_field('save-access-permissions'); ?>
				<input type="hidden" name="ls-access-permission" value="1">
				<h3 class="header medium">
					<?php jols_e('OFFLAJN Product Info', 'LayerSlider') ?>
				</h3>
          <div class="pane-slider content" style="padding-top: 0px; border-top: medium none; padding-bottom: 0px; border-bottom: medium none; overflow: hidden;">
            <div>
            	<div class="column left">
            	 <div class="dashboard-box">
                <div class="box-title">
                 General <b>Information</b>
                </div>
                <div class="box-content">
                 <?php
                  echo @$generalInfo;
                 ?>
                </div>
                </div>
              </div>
            	<div class="column mid">
            	 <div class="dashboard-box">
                <div class="box-title">
                 Related <b>News</b>
                </div>
                <div class="box-content">
                 <?php
                  echo @$relatedNews;
                 ?>
                </div>
              </div>
              </div>
            	<div class="column right">
            	 <div class="dashboard-box">
                <div class="box-title">
                 Product <b>Support</b>
                </div>
                <div class="box-content">
                  <div class="content-inner">
                     If you have any problem with Layer Slider just write us and we will help ASAP!
                     <div style="background-image:url('<?php echo $supportTicketUrl?>');" class="support-ticket-button"><a href="http://offlajn.com/contact-us.html#department=5&amp;product=49" target="_blank"></a></div>
                     <div class="clr"></div>
                  </div>
                </div>
                </div>
            	 <div class="dashboard-box">
                <div class="box-title">
                 Rate <b>Us</b>
                </div>
                <div class="box-content">
                  <div class="content-inner">
                    If you use Layer Slider, please post a rating and a review at the Joomla! Extensions Directory. With this small gesture you will help the community a lot. Thank you very much!
                     <div style="background-image:url('<?php echo $supportUsUrl?>');" class="support-us-button"><a href="http://extensions.joomla.org/extensions/extension/photos-a-images/slideshow/layer-slider" target="_blank"></a></div>
                     <div class="clr"></div>
                  </div>
                </div>
                </div>
              </div>
              <div class="clr"></div>
            </div>
          </div>
			</form>
		</div>

	</div>

	<form action="<?php echo $_SERVER['REQUEST_URI']?>&task=save_google_fonts" method="post" class="ls-box ls-google-fonts<?php echo $lsGoogleFontsToggle ? ' collapsed' : '' ?>">
		<?php jols_nonce_field('save-google-fonts'); ?>
		<input type="hidden" name="ls-save-google-fonts" value="1">

		<!-- Google Fonts Header -->
		<h2 class="header medium">
			<?php jols_e('Load Google Fonts', 'LayerSlider') ?>
			<span id="ls-google-fonts-toggle" class="dashicons dashicons-arrow-<?php echo $lsGoogleFontsToggle ? 'right' : 'down' ?> ls-ficon ls-box-toggle"></span>
		</h2>

		<!-- Google Fonts list -->
		<div class="inner">
			<ul class="ls-font-list">
				<li class="ls-hidden">
					<a href="#" class="remove dashicons dashicons-dismiss" title="Remove this font"></a>
					<input type="text" name="urlParams[]" readonly="readonly">
					<input type="checkbox" name="onlyOnAdmin[]">
					<?php jols_e('Load only on admin interface', 'LayerSlider') ?>
				</li>
				<?php if(is_array($googleFonts) && !empty($googleFonts)) : ?>
				<?php foreach($googleFonts as $item) : ?>
				<li>
					<a href="#" class="remove dashicons dashicons-dismiss" title="Remove this font"></a>
					<input type="text" name="urlParams[]" value="<?php echo $item['param'] ?>" readonly="readonly">
					<input type="checkbox" name="onlyOnAdmin[]" <?php echo $item['admin'] ? ' checked="checked"' : '' ?>>
					<?php jols_e('Load only on admin interface', 'LayerSlider') ?>
				</li>
				<?php endforeach ?>
				<?php else : ?>
				<li class="ls-notice"><?php jols_e("You didn't add any Google font to your library yet.", "LayerSlider") ?></li>
				<?php endif ?>
			</ul>
		</div>
		<div class="inner ls-font-search">

			<input type="text" placeholder="<?php jols_e('Enter a font name to add to your collection', 'LayerSlider') ?>">
			<button class="button"><?php jols_e('Search', 'LayerSlider') ?></button>

			<!-- Google Fonts search pointer -->
			<div class="ls-box ls-pointer">
				<h3 class="header"><?php jols_e('Choose a font family', 'LayerSlider') ?></h3>
				<div class="fonts">
					<ul class="inner"></ul>
				</div>
				<div class="variants">
					<ul class="inner"></ul>
					<div class="inner">
						<button class="button add-font"><?php jols_e('Add font', 'LayerSlider') ?></button>
						<button class="button right"><?php jols_e('Back to results', 'LayerSlider') ?></button>
					</div>
				</div>
			</div>
		</div>

		<!-- Google Fonts search bar -->
		<div class="inner footer">
			<button type="submit" class="button"><?php jols_e('Save changes', 'LayerSlider') ?></button>
			<?php
				$scripts = array(
					'cyrillic' => jols__('Cyrillic', 'LayerSlider'),
					'cyrillic-ext' => jols__('Cyrillic Extended', 'LayerSlider'),
					'devanagari' => jols__('Devanagari', 'LayerSlider'),
					'greek' => jols__('Greek', 'LayerSlider'),
					'greek-ext' => jols__('Greek Extended', 'LayerSlider'),
					'khmer' => jols__('Khmer', 'LayerSlider'),
					'latin' => jols__('Latin', 'LayerSlider'),
					'latin-ext' => jols__('Latin Extended', 'LayerSlider'),
					'vietnamese' => jols__('Vietnamese', 'LayerSlider')
				);
			?>
			<div class="right">
				<div>
					<select>
						<option><?php jols_e('Select new', 'LayerSlider') ?></option>
						<?php foreach($scripts as $key => $val) : ?>
						<option value="<?php echo $key ?>"><?php echo $val ?></option>
						<?php endforeach ?>
					</select>
				</div>
				<ul class="ls-google-font-scripts">
					<li class="ls-hidden">
						<span></span>
						<a href="#" class="dashicons dashicons-dismiss" title="<?php jols_e('Remove character set', 'LayerSlider') ?>"></a>
						<input type="hidden" name="scripts[]" value="">
					</li>
					<?php if(!empty($googleFontScripts) && is_array($googleFontScripts)) : ?>
					<?php foreach($googleFontScripts as $item) : ?>
					<li>
						<span><?php echo $scripts[$item] ?></span>
						<a href="#" class="dashicons dashicons-dismiss" title="<?php jols_e('Remove character set', 'LayerSlider') ?>"></a>
						<input type="hidden" name="scripts[]" value="<?php echo $item ?>">
					</li>
					<?php endforeach ?>
					<?php else : ?>
					<li>
						<span>Latin</span>
						<a href="#" class="dashicons dashicons-dismiss" title="<?php jols_e('Remove character set', 'LayerSlider') ?>"></a>
						<input type="hidden" name="scripts[]" value="latin">
					</li>
					<?php endif ?>
				</ul>
				<div><?php jols_e('Use character sets:', 'LayerSlider') ?></div>
			</div>
		</div>

	</form>

	<form action="<?php echo $_SERVER['REQUEST_URI'] ?>&task=save_advanced_settings" method="post" class="ls-box ls-global-settings<?php echo ($lsAdvSettingsToggle) ? ' collapsed' : '' ?>">
		<?php jols_nonce_field('save-advanced-settings'); ?>
		<input type="hidden" name="ls-save-advanced-settings">
		<h2 class="header medium">
			<?php jols_e('Advanced Settings', 'LayerSlider') ?>
			<span id="ls-advanced-settings-toggle" class="dashicons dashicons-arrow-<?php echo $lsAdvSettingsToggle ? 'right' : 'down' ?> ls-ficon ls-box-toggle"></span>
		</h2>
		<div class="inner">
			<table>
				<tr>
					<td><?php jols_e('Load jQuery on frontend', 'LayerSlider') ?></td>
					<td><input type="checkbox" name="load_jquery" <?php echo jols_get_option('load_jquery', false) ? 'checked="checked"' : '' ?>></td>
					<td class="desc"><?php jols_e('Switch this option off if jQuery is already loaded on your site.', 'LayerSlider') ?></td>
				</tr>
				<tr>
					<td><?php jols_e('Load Google fonts dynamically', 'LayerSlider') ?></td>
					<td><input type="checkbox" name="load_fonts_dynamic" <?php echo jols_get_option('load_fonts_dynamic', false) ? 'checked="checked"' : '' ?>></td>
					<td class="desc"><?php jols_e('Switch this option on if you want to load only those Google fonts which are used in your slider(s).', 'LayerSlider') ?></td>
				</tr>
				<tr>
					<td><?php jols_e('Enable load module', 'LayerSlider') ?></td>
					<td><input type="checkbox" name="load_module" <?php echo jols_get_option('load_module', false) ? 'checked="checked"' : '' ?>></td>
					<td class="desc"><?php jols_e('Within layer\'s content this option accepts module positions, Syntax: {loadposition user1} or Modules by name, Syntax: {loadmodule mod_login}. Optionally can specify module style and for loadmodule a specific module title.', 'LayerSlider') ?></td>
				</tr>
				<tr>
					<td><?php jols_e('Load uncompressed JS & CSS files', 'LayerSlider') ?></td>
					<td><input type="checkbox" name="load_uncompressed" <?php echo jols_get_option('load_uncompressed', false) ? 'checked="checked"' : '' ?>></td>
					<td class="desc"><?php jols_e('Switch this option on if you want to debug the code', 'LayerSlider') ?></td>
				</tr>
			</table>
			<div class="footer">
				<button type="submit" class="button"><?php jols_e('Save changes', 'LayerSlider') ?></button>
			</div>
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
