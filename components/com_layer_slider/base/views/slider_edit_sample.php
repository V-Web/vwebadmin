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
?>
<div id="ls-sample">
	<div class="ls-box ls-layer-box">
		<input type="hidden" name="layerkey" value="0">
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
				<input type="hidden" name="post_offset" value="-1">
				<input type="hidden" name="3d_transitions">
				<input type="hidden" name="2d_transitions">
				<input type="hidden" name="custom_3d_transitions">
				<input type="hidden" name="custom_2d_transitions">
				<tr>
					<td class="slide-image">
						<h3 class="subheader"><?php jols_e('Slide Background Image', 'LayerSlider') ?></h3>
						<div class="inner">
							<div class="float">
								<input type="hidden" name="backgroundId">
								<input type="hidden" name="background">
								<div class="ls-image ls-upload ls-bulk-upload ls-slide-image" data-help="<?php echo $lsDefaults['slides']['image']['tooltip'] ?>">
									<a href="javascript:;" onclick="openModal(this);" class="modal">
										<div><img src="<?php echo LS_ROOT_URL.'/static/img/not_set.png' ?>" alt=""></div>
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
									<?php lsGetSelect($lsDefaults['slides']['imageSize'], null, array('class' => 'layerprop')) ?>
								</div>
								<div class="row-helper">
									<?php echo $lsDefaults['slides']['imagePosition']['name'] ?>
									<?php lsGetSelect($lsDefaults['slides']['imagePosition'], null, array('class' => 'layerprop')) ?>
								</div>
								<div class="row-helper">
									<?php echo $lsDefaults['slides']['imageAlt']['name'] ?>
									<?php lsGetInput($lsDefaults['slides']['imageAlt'], null, array('class' => 'layerprop')) ?>
								</div>
							</div>
						</div>
					</td>
					<td class="slide-thumb">
						<h3 class="subheader"><?php jols_e('Slide Thumbnail', 'LayerSlider') ?></h3>
						<div class="inner">
							<input type="hidden" name="thumbnailId">
							<input type="hidden" name="thumbnail">
							<div class="ls-image ls-upload ls-slide-thumbnail" data-help="<?php echo $lsDefaults['slides']['thumbnail']['tooltip'] ?>">
								<a href="javascript:;" onclick="openModal(this);" class="modal">
									<div><img src="<?php echo LS_ROOT_URL.'/static/img/not_set.png' ?>" alt=""></div>
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
								<?php lsGetInput($lsDefaults['slides']['delay'], null, array('class' => 'layerprop')) ?> ms <br>
							</div>
							<div class="row-helper">
								<?php echo $lsDefaults['slides']['timeshift']['name'] ?>
								<?php lsGetInput($lsDefaults['slides']['timeshift'], null, array('class' => 'layerprop')) ?> ms
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
								<?php lsGetInput($lsDefaults['slides']['linkUrl'], null, array('placeholder' => $lsDefaults['slides']['linkUrl']['name'] )) ?>
							</div>
							<div class="row-helper">
								<span class="indent">
									<?php jols_e('or', 'LayerSlider') ?> <a href="#" class="ls-post-url"><?php jols_e('use dynamic URL', 'LayerSlider') ?></a>
								</span>
								<?php lsGetSelect($lsDefaults['slides']['linkTarget'], null) ?>
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
								<?php lsGetInput($lsDefaults['slides']['ID'], null) ?>
							</div>
							<div class="row-helper">
								<?php echo $lsDefaults['slides']['deeplink']['name'] ?>
								<?php lsGetInput($lsDefaults['slides']['deeplink'], null) ?>
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
								<input type="checkbox" name="skip" class="checkbox large" data-help="<?php jols_e("If you don't want to use this slide in your front-page, but you want to keep it, you can hide it with this switch.", "LayerSlider") ?>">
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
				<tr class="active">
					<td>
						<div class="ls-sublayer-wrapper">
							<span class="ls-sublayer-sortable-handle dashicons dashicons-menu"></span>
							<span class="ls-sublayer-number">1</span>
							<input type="text" name="subtitle" class="ls-sublayer-title" value="Layer #1">

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

									<input type="hidden" name="media" value="img">
									<div class="ls-layer-kind">
										<ul>
											<li data-section="img" class="active"><span class="dashicons dashicons-format-image"></span><?php jols_e('Image', 'LayerSlider') ?></li>
											<li data-section="text"><span class="dashicons dashicons-text"></span><?php jols_e('Text', 'LayerSlider') ?></li>
											<li data-section="html"><span class="dashicons dashicons-video-alt3"></span><?php jols_e('HTML / Video / Audio', 'LayerSlider') ?></li>
											<li data-section="post"><span class="dashicons dashicons-update"></span><?php jols_e('Dynamic content', 'LayerSlider') ?></li>
										</ul>
									</div>
									<!-- End of Layer Media Type -->

									<!-- Layer Element Type -->
									<input type="hidden" name="type" value="p">
									<ul class="ls-sublayer-element ls-hidden">
										<li class="ls-type active" data-element="p"><?php jols_e('Paragraph', 'LayerSlider') ?></li>
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
										<div class="ls-image-uploader slide-image clearfix">
											<input type="hidden" name="imageId">
											<input type="hidden" name="image">
											<div class="ls-image ls-upload <?php echo $uploadClass ?>">
												<a href="javascript:;" onclick="openModal(this);" class="modal">
													<div><img src="<?php echo LS_ROOT_URL.'/static/img/not_set.png' ?>" alt=""></div>
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
										<div class="ls-html-code ls-hidden">
											<textarea name="html" cols="50" rows="5" placeholder="Enter layer content here" data-help="<?php jols_e('Type here the contents of your layer. You can use any HTML codes in this field to insert content others then text. This field is also shortcode-aware, so you can insert content from other plugins as well as video embed codes.', 'LayerSlider') ?>"></textarea>
										</div>

										<!-- Dynamic Layer -->
										<div class="ls-post-section ls-hidden">
											<div class="ls-posts-configured">
													<ul class="ls-post-placeholders clearfix">
													<?php echo $generator->generateList() ?>
													</ul>
												<p>
													<?php jols_e("Click on one or more placeholders to insert them into your layer's content. Placeholders are acting like shortcodes, and they will be filled with the actual content.", "LayerSlider") ?><br>
													<?php jols_e('Limit text length (if any)', 'LayerSlider') ?>
													<input type="number" name="post_text_length">
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
									<table>
										<tbody>
											<tr>
												<td rowspan="3"><?php jols_e('Transition in', 'LayerSlider') ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['transitionInOffsetX']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['transitionInOffsetX'], null, array('class' => 'sublayerprop')) ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['transitionInOffsetY']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['transitionInOffsetY'], null, array('class' => 'sublayerprop')) ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['transitionInDuration']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['transitionInDuration'], null, array('class' => 'sublayerprop')) ?> ms</td>
												<td class="right"><?php echo $lsDefaults['layers']['transitionInDelay']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['transitionInDelay'], null, array('class' => 'sublayerprop')) ?> ms</td>
												<td class="right"><a href="http://easings.net/" target="_blank"><?php echo $lsDefaults['layers']['transitionInEasing']['name'] ?></a></td>
												<td><?php lsGetSelect($lsDefaults['layers']['transitionInEasing'], null, array('class' => 'sublayerprop', 'options' => $lsDefaults['easings'])) ?></td>
											</tr>
											<tr>
												<td class="right"><?php echo $lsDefaults['layers']['transitionInFade']['name'] ?></td>
												<td><?php lsGetCheckbox($lsDefaults['layers']['transitionInFade'], null, array('class' => 'sublayerprop')) ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['transitionInRotate']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['transitionInRotate'], null, array('class' => 'sublayerprop')) ?> &deg;</td>
												<td class="right"><?php echo $lsDefaults['layers']['transitionInRotateX']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['transitionInRotateX'], null, array('class' => 'sublayerprop')) ?> &deg;</td>
												<td class="right"><?php echo $lsDefaults['layers']['transitionInRotateY']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['transitionInRotateY'], null, array('class' => 'sublayerprop')) ?> &deg;</td>
												<td colspan="2" rowspan="2" class="center">
													<?php echo $lsDefaults['layers']['transitionInTransformOrigin']['name'] ?><br>
													<i class="dashicons dashicons-admin-post"></i>
													<?php lsGetInput($lsDefaults['layers']['transitionInTransformOrigin'], null, array('class' => 'sublayerprop')) ?>
												</td>
											</tr>

											<tr>
												<td class="right"><?php echo $lsDefaults['layers']['transitionInSkewX']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['transitionInSkewX'], null, array('class' => 'sublayerprop')) ?> &deg;</td>
												<td class="right"><?php echo $lsDefaults['layers']['transitionInSkewY']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['transitionInSkewY'], null, array('class' => 'sublayerprop')) ?> &deg;</td>
												<td class="right"><?php echo $lsDefaults['layers']['transitionInScaleX']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['transitionInScaleX'], null, array('class' => 'sublayerprop')) ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['transitionInScaleY']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['transitionInScaleY'], null, array('class' => 'sublayerprop')) ?></td>
											</tr>
											<tr class="splittext">
												<td></td>
												<td class="right"><?php echo $lsDefaults['layers']['transitionInSplit']['name'] ?></td>
												<td><?php lsGetSelect($lsDefaults['layers']['transitionInSplit'], null, array('class' => 'sublayerprop')) ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['transitionInShift']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['transitionInShift'], null, array('class' => 'sublayerprop')) ?> ms</td>
												<td colspan="6"></td>
											</tr>
											<tr class="ls-separator"><td colspan="11"></td></tr>
											<tr>
												<td rowspan="3"><?php jols_e('Transition out', 'LayerSlider') ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['transitionOutOffsetX']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['transitionOutOffsetX'], null, array('class' => 'sublayerprop')) ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['transitionOutOffsetY']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['transitionOutOffsetY'], null, array('class' => 'sublayerprop')) ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['transitionOutDuration']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['transitionOutDuration'], null, array('class' => 'sublayerprop')) ?> ms</td>
												<td class="right"><?php echo $lsDefaults['layers']['showUntil']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['showUntil'], null, array('class' => 'sublayerprop')) ?> ms</td>
												<td class="right"><a href="http://easings.net/" target="_blank"><?php echo $lsDefaults['layers']['transitionOutEasing']['name'] ?></a></td>
												<td><?php lsGetSelect($lsDefaults['layers']['transitionOutEasing'], null, array('class' => 'sublayerprop', 'options' => $lsDefaults['easings'])) ?></td>
											</tr>
											<tr>
												<td class="right"><?php echo $lsDefaults['layers']['transitionOutFade']['name'] ?></td>
												<td><?php lsGetCheckbox($lsDefaults['layers']['transitionOutFade'], null, array('class' => 'sublayerprop')) ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['transitionOutRotate']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['transitionOutRotate'], null, array('class' => 'sublayerprop')) ?> &deg;</td>
												<td class="right"><?php echo $lsDefaults['layers']['transitionOutRotateX']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['transitionOutRotateX'], null, array('class' => 'sublayerprop')) ?> &deg;</td>
												<td class="right"><?php echo $lsDefaults['layers']['transitionOutRotateY']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['transitionOutRotateY'], null, array('class' => 'sublayerprop')) ?> &deg;</td>
												<td colspan="2" rowspan="2" class="center">
													<?php echo $lsDefaults['layers']['transitionOutTransformOrigin']['name'] ?><br>
													<i class="dashicons dashicons-admin-post"></i>
													<?php lsGetInput($lsDefaults['layers']['transitionOutTransformOrigin'], null, array('class' => 'sublayerprop')) ?>
												</td>
											</tr>

											<tr>
												<td class="right"><?php echo $lsDefaults['layers']['transitionOutSkewX']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['transitionOutSkewX'], null, array('class' => 'sublayerprop')) ?> &deg;</td>
												<td class="right"><?php echo $lsDefaults['layers']['transitionOutSkewY']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['transitionOutSkewY'], null, array('class' => 'sublayerprop')) ?> &deg;</td>
												<td class="right"><?php echo $lsDefaults['layers']['transitionOutScaleX']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['transitionOutScaleX'], null, array('class' => 'sublayerprop')) ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['transitionOutScaleY']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['transitionOutScaleY'], null, array('class' => 'sublayerprop')) ?></td>
											</tr>
											<tr class="splittext">
												<td></td>
												<td class="right"><?php echo $lsDefaults['layers']['transitionOutSplit']['name'] ?></td>
												<td><?php lsGetSelect($lsDefaults['layers']['transitionOutSplit'], null, array('class' => 'sublayerprop')) ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['transitionOutShift']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['transitionOutShift'], null, array('class' => 'sublayerprop')) ?> ms</td>
												<td colspan="6"></td>
											</tr>
											<tr class="ls-separator"><td colspan="11"></td></tr>
											<tr>
												<td rowspan="3"><?php jols_e('Other options', 'LayerSlider') ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['transitionParallaxLevel']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['transitionParallaxLevel'], null, array('class' => 'sublayerprop')) ?></td>
												<td class="right"><?php jols_e('Hidden', 'LayerSlider') ?></td>
												<td><input type="checkbox" name="skip" class="checkbox" data-help="<?php jols_e("If you don't want to use this layer, but you want to keep it, you can hide it with this switch.", "LayerSlider") ?>"></td>
												<td colspan="4"></td>
												<td class="right">
													<a href="javascript:;" class="copy dashicons dashicons-admin-page" data-storage="lsTransition" data-help="Copy all transition settings"></a>
													<a href="javascript:;" class="paste dashicons dashicons-clipboard" data-storage="lsTransition" data-help="Paste all transition settings"></a>
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
												<td><?php lsGetInput($lsDefaults['layers']['loopOffsetX'], null, array('class' => 'sublayerprop')) ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['loopOffsetY']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['loopOffsetY'], null, array('class' => 'sublayerprop')) ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['loopDuration']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['loopDuration'], null, array('class' => 'sublayerprop')) ?> ms</td>
												<td class="right"><?php echo $lsDefaults['layers']['loopDelay']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['loopDelay'], null, array('class' => 'sublayerprop')) ?> ms</td>
												<td class="right"><a href="http://easings.net/" target="_blank"><?php echo $lsDefaults['layers']['loopEasing']['name'] ?></a></td>
												<td><?php lsGetSelect($lsDefaults['layers']['loopEasing'], null, array('class' => 'sublayerprop', 'options' => $lsDefaults['easings'])) ?></td>
											</tr>
											<tr>
												<td class="right"><?php echo $lsDefaults['layers']['loopOpacity']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['loopOpacity'], null, array('class' => 'sublayerprop')) ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['loopRotate']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['loopRotate'], null, array('class' => 'sublayerprop')) ?> &deg;</td>
												<td class="right"><?php echo $lsDefaults['layers']['loopRotateX']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['loopRotateX'], null, array('class' => 'sublayerprop')) ?> &deg;</td>
												<td class="right"><?php echo $lsDefaults['layers']['loopRotateY']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['loopRotateY'], null, array('class' => 'sublayerprop')) ?> &deg;</td>
												<td colspan="2" rowspan="2" class="center">
													<?php echo $lsDefaults['layers']['loopTransformOrigin']['name'] ?><br>
													<?php lsGetInput($lsDefaults['layers']['loopTransformOrigin'], null, array('class' => 'sublayerprop')) ?>
												</td>
											</tr>

											<tr>
												<td class="right"><?php echo $lsDefaults['layers']['loopSkewX']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['loopSkewX'], null, array('class' => 'sublayerprop')) ?> &deg;</td>
												<td class="right"><?php echo $lsDefaults['layers']['loopSkewY']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['loopSkewY'], null, array('class' => 'sublayerprop')) ?> &deg;</td>
												<td class="right"><?php echo $lsDefaults['layers']['loopScaleX']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['loopScaleX'], null, array('class' => 'sublayerprop')) ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['loopScaleY']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['loopScaleY'], null, array('class' => 'sublayerprop')) ?></td>
											</tr>
											<tr class="ls-separator"><td colspan="12"></td></tr>
											<tr>
												<td><?php jols_e('Loop', 'LayerSlider') ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['loopCount']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['loopCount'], null, array('class' => 'sublayerprop')) ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['loopWait']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['loopWait'], null, array('class' => 'sublayerprop')) ?> ms</td>
												<td class="right"><?php echo $lsDefaults['layers']['loopYoyo']['name'] ?></td>
												<td><?php lsGetCheckbox($lsDefaults['layers']['loopYoyo'], null, array('class' => 'sublayerprop')) ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['yoyoDuration']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['yoyoDuration'], null, array('class' => 'sublayerprop')) ?> ms</td>
												<td class="right"><a href="http://easings.net/" target="_blank"><?php echo $lsDefaults['layers']['yoyoEasing']['name'] ?></a></td>
												<td><?php lsGetSelect($lsDefaults['layers']['yoyoEasing'], null, array('class' => 'sublayerprop', 'options' => array_merge(array('' => '- Same easing -'), $lsDefaults['easings']) )) ?></td>

												<!--td class="right"><label data-help="<?php jols_e('If you will use similar loop for a layer, just copy and paste it on the other.', 'LayerSlider') ?>" >Settings</label></td>
												<td colspan="4"><a href="javascript:;" onclick="localStorage.lsLoop=jQuery(this).parents('table:first').inputsToObj();" class="copy dashicons dashicons-admin-page" data-help="Copy all loop settings"></a>
																				<a href="javascript:;" onclick="jQuery(this).parents('table:first').objToInputs(localStorage.lsLoop);" class="paste dashicons dashicons-clipboard" data-help="Paste all loop settings"></a></td!-->
											</tr>
									</table>
								</div>
								<div class="ls-sublayer-page ls-sublayer-hover">
									<table>
										<tbody>
											<tr>
												<td rowspan="4"><?php jols_e('Transition', 'LayerSlider') ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['hoverOffsetX']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['hoverOffsetX'], null, array('class' => 'sublayerprop')) ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['hoverOffsetY']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['hoverOffsetY'], null, array('class' => 'sublayerprop')) ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['hoverDuration']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['hoverDuration'], null, array('class' => 'sublayerprop')) ?> ms</td>
												<td class="right"><?php echo $lsDefaults['layers']['hoverEnable']['name'] ?></td>
												<td><?php lsGetCheckbox($lsDefaults['layers']['hoverEnable'], null, array('class' => 'sublayerprop')) ?></td>
												<td class="right"><a href="http://easings.net/" target="_blank"><?php echo $lsDefaults['layers']['hoverEasing']['name'] ?></a></td>
												<td><?php lsGetSelect($lsDefaults['layers']['hoverEasing'], null, array('class' => 'sublayerprop', 'options' => $lsDefaults['easings'])) ?></td>
											</tr>
											<tr>
												<td class="right"><?php echo $lsDefaults['layers']['hoverOpacity']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['hoverOpacity'], null, array('class' => 'sublayerprop')) ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['hoverRotate']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['hoverRotate'], null, array('class' => 'sublayerprop')) ?> &deg;</td>
												<td class="right"><?php echo $lsDefaults['layers']['hoverRotateX']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['hoverRotateX'], null, array('class' => 'sublayerprop')) ?> &deg;</td>
												<td class="right"><?php echo $lsDefaults['layers']['hoverRotateY']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['hoverRotateY'], null, array('class' => 'sublayerprop')) ?> &deg;</td>
												<td colspan="2" rowspan="2" class="center">
													<?php echo $lsDefaults['layers']['hoverTransformOrigin']['name'] ?><br>
													<?php lsGetInput($lsDefaults['layers']['hoverTransformOrigin'], null, array('class' => 'sublayerprop')) ?>
												</td>
											</tr>
											<tr>
												<td class="right"><?php echo $lsDefaults['layers']['hoverSkewX']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['hoverSkewX'], null, array('class' => 'sublayerprop')) ?> &deg;</td>
												<td class="right"><?php echo $lsDefaults['layers']['hoverSkewY']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['hoverSkewY'], null, array('class' => 'sublayerprop')) ?> &deg;</td>
												<td class="right"><?php echo $lsDefaults['layers']['hoverScaleX']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['hoverScaleX'], null, array('class' => 'sublayerprop')) ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['hoverScaleY']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['hoverScaleY'], null, array('class' => 'sublayerprop')) ?></td>
											</tr>
											<tr>
												<td class="right"><?php echo $lsDefaults['layers']['hoverBackground']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['hoverBackground'], null, array('class' => 'sublayerprop ls-colorpicker')) ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['hoverColor']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['hoverColor'], null, array('class' => 'sublayerprop ls-colorpicker')) ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['hoverBorderRadius']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['hoverBorderRadius'], null, array('class' => 'sublayerprop')) ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['reverseDuration']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['reverseDuration'], null, array('class' => 'sublayerprop')) ?> ms</td>
												<td class="right"><a href="http://easings.net/" target="_blank"><?php echo $lsDefaults['layers']['reverseEasing']['name'] ?></a></td>
												<td><?php lsGetSelect($lsDefaults['layers']['reverseEasing'], null, array('class' => 'sublayerprop', 'options' => array_merge(array('' => '- Same easing -'), $lsDefaults['easings']) )) ?></td>
											<tr class="ls-separator"><td colspan="11"></td></tr>
											<tr>
												<td><?php jols_e('Hover', 'LayerSlider') ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['hoverEnable']['name'] ?></td>
												<td><?php lsGetCheckbox($lsDefaults['layers']['hoverEnable'], null, array('class' => 'sublayerprop')) ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['hoverConnect']['name'] ?></td>
												<td>
													<?php lsGetSelect($lsDefaults['layers']['hoverConnect'], null, array('class' => 'sublayerprop connect-hover', 'options' => array('' => jols__('- This layer -', 'LayerSlider')) )) ?>
													<?php lsGetInput($lsDefaults['layers']['hoverConnectName'], null, array('class' => 'sublayerprop connect-name')) ?>
													<?php lsGetInput($lsDefaults['layers']['lsId'], null, array('class' => 'sublayerprop ls-id')) ?>
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
														<div><?php lsGetInput($lsDefaults['layers']['linkURL'], null, array('placeholder' => $lsDefaults['layers']['linkURL']['name'] )) ?></div>
														or <a href="#" class="ls-post-url"><?php jols_e('use dynamic URL', 'LayerSlider') ?></a>
														<span><?php lsGetSelect($lsDefaults['layers']['linkTarget'], null) ?></span>
													</div>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="ls-sublayer-page ls-sublayer-style">
									<input type="hidden" name="styles">
									<table>
										<tbody>
											<tr>
												<td><?php jols_e('Layout & Positions', 'LayerSlider') ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['width']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['width'], null, array('class' => 'auto')) ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['height']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['height'], null, array('class' => 'auto')) ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['top']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['top'], null, array('class' => 'ls-top')) ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['left']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['left'], null, array('class' => 'ls-left')) ?></td>
											</tr>
											<?php /*
											<tr>
												<td><?php jols_e('Transform', 'LayerSlider') ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['opacity']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['opacity'], null, array('class' => 'auto')) ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['rotate']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['rotate'], null, array('class' => 'auto')) ?> &deg;</td>
												<td class="right"><?php echo $lsDefaults['layers']['skewX']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['skewX'], null, array('class' => 'auto')) ?> &deg;</td>
												<td class="right"><?php echo $lsDefaults['layers']['skewY']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['skewY'], null, array('class' => 'auto')) ?> &deg;</td>
											</tr>
											*/ ?>
											<tr>
												<td><?php jols_e('Padding', 'LayerSlider') ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['paddingTop']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['paddingTop'], null, array('class' => 'auto')) ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['paddingRight']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['paddingRight'], null, array('class' => 'auto')) ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['paddingBottom']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['paddingBottom'], null, array('class' => 'auto')) ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['paddingLeft']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['paddingLeft'], null, array('class' => 'auto')) ?></td>
											</tr>
											<tr>
												<td><?php jols_e('Border', 'LayerSlider') ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['borderTop']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['borderTop'], null, array('class' => 'auto')) ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['borderRight']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['borderRight'], null, array('class' => 'auto')) ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['borderBottom']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['borderBottom'], null, array('class' => 'auto')) ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['borderLeft']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['borderLeft'], null, array('class' => 'auto')) ?></td>
											</tr>
											<tr>
												<td><?php jols_e('Font', 'LayerSlider') ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['fontFamily']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['fontFamily'], null, array('class' => 'auto')) ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['fontSize']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['fontSize'], null, array('class' => 'auto')) ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['lineHeight']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['lineHeight'], null, array('class' => 'auto')) ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['color']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['color'], null, array('class' => 'auto ls-colorpicker')) ?></td>
											</tr>
											<tr>
												<td><?php jols_e('Misc', 'LayerSlider') ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['background']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['background'], null, array('class' => 'auto ls-colorpicker')) ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['borderRadius']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['borderRadius'], null, array('class' => 'auto')) ?></td>
												<td class="right"><?php jols_e('Word-wrap', 'LayerSlider') ?></td>
												<td><input type="checkbox" name="wordwrap" data-help="<?php jols_e('If you use custom sized layers, you have to enable this setting to wrap your text.', 'LayerSlider') ?>" class="checkbox"></td>
												<td class="right">
													<a href="javascript:;" class="copy dashicons dashicons-admin-page" data-storage="lsStyle" data-help="Copy all style settings"></a>
													<a href="javascript:;" class="paste dashicons dashicons-clipboard" data-storage="lsStyle" data-help="Paste all style settings"></a>
												</td>
												<td><label data-help="<?php jols_e('If you will use similar style settings for a layer, just copy and paste it on the other.', 'LayerSlider') ?>" >Style settings</label></td>
											</tr>
											<tr class="ls-separator"><td colspan="11"></td></tr>
											<tr>
												<td><?php jols_e('Custom CSS', 'LayerSlider') ?></td>
												<td colspan="8"><textarea rows="5" cols="50" name="style" class="style" data-help="<?php jols_e('If you want to set style settings other then above, you can use here any CSS codes. Please make sure to write valid markup.', 'LayerSlider') ?>"></textarea></td>
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
												<td><?php lsGetInput($lsDefaults['layers']['ID'], null) ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['class']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['class'], null, array('class' => 'ls-classes')) ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['title']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['title'], null) ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['alt']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['alt'], null) ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['rel']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['rel'], null) ?></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
		<a href="#" class="ls-add-sublayer">
			<i class="dashicons dashicons-plus"></i> <?php jols_e('Add new layer', 'LayerSlider') ?>
		</a>
	</div>
</div>
