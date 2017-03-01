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

// Post Options
$queryArgs = array('post_status' => 'publish', 'limit' => 30, 'posts_per_page' => 30);

if(!empty($slider['properties']['post_orderby'])) {
	$queryArgs['orderby'] = $slider['properties']['post_orderby']; }

if(!empty($slider['properties']['post_order'])) {
	$queryArgs['order'] = $slider['properties']['post_order']; }

if(!empty($slider['properties']['post_type'])) {
	$queryArgs['post_type'] = $slider['properties']['post_type']; }

if(!empty($slider['properties']['post_categories'][0])) {
	$queryArgs['category__in'] = $slider['properties']['post_categories']; }

if(!empty($slider['properties'][0])) {
	$queryArgs['tag__in'] = $slider['properties']['post_tags']; }

if(!empty($slider['properties']['post_taxonomy']) && !empty($slider['properties']['post_tax_terms'])) {
	$queryArgs['tax_query'][] = array(
		'taxonomy' => $slider['properties']['post_taxonomy'],
		'field' => 'id',
		'terms' => $slider['properties']['post_tax_terms']
	);
}

$posts = $generator->getData();

?>
<script type="text/javascript" class="ls-hidden" id="ls-posts-json">window.lsPostsJSON = <?php echo json_encode($posts) ?>;</script>
<div id="ls-post-options">
	<div class="ls-box ls-modal ls-configure-posts-modal">
		<h2 class="header">
			<?php jols_e('Dynamic generator content', 'LayerSlider') ?>
			<a href="#" class="dashicons dashicons-no"></a>
		</h2>

		<div class="inner clearfix">
			<!-- Post types -->
			<select class="generator_type" data-param="generator_type" name="generator_type">
				<?php foreach($avaible_generators as $item => $name) : ?>
					<?php if(isset($slider['properties']['generator_type']) &&  $item == $slider['properties']['generator_type']) : ?>
  					<option value="<?php echo $item ?>" selected="selected"><?php echo $name ?></option>
					<?php else : ?>
  					<option value="<?php echo $item ?>"><?php echo $name ?></option>
					<?php endif ?>
				<?php endforeach; ?>
			</select>
		</div>

		<h3 class="subheader preview-subheader"><?php echo jols_e('Generator Settings', 'LayerSlider') ?></h3>
		<div class="inner clearfix">
			<div class="ls-post-filters clearfix generator-middle">
				<!-- Post types -->
				<?php echo $generator->getFilters(); ?>
			</div>
		</div>
		<h3 class="subheader clearfix">
			<div class="half"><?php echo jols_e('Order results by', 'LayerSlider') ?></div>
			<div class="half"><?php echo jols_e('On this slide', 'LayerSlider') ?></div>
		</h3>
		<div class="ls-post-adv-settings clearfix">

			<!-- Order  -->
			<div class="half">
				<?php echo $generator->getOrderBys() ?>
				<?php lsGetSelect($lsDefaults['slider']['postOrder'], $slider['properties'], array('data-param' => $lsDefaults['slider']['postOrder']['keys'])) ?>
			</div>

			<!-- Post offset -->
			<div class="half">
				<?php jols_e('Get the ', 'LayerSlider') ?>
				<select data-param="post_offset" name="post_offset" class="offset">
					<option value="-1"><?php jols_e('following', 'LayerSlider') ?></option>
					<?php for($c = 0; $c < 30; $c++) : ?>
					<option value="<?php echo $c ?>"><?php echo ls_ordinal_number($c+1) ?></option>
					<?php endfor ?>
				</select>
				<?php jols_e('item in the set of matched selection', 'LayerSlider') ?>
			</div>
		</div>
		<h3 class="subheader preview-subheader"><?php echo jols_e('Preview from currenty matched elements', 'LayerSlider') ?></h3>
		<div class="ls-post-previews"><ul></ul></div>
	</div>
</div>
