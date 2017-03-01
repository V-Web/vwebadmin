<?php
/**
 * @version    CVS: 1.0.20
 * @package    Com_Vwebadmin
 * @author     Marcel Venema <marcel.venema@v-web.nl>
 * @copyright  2017 V-Web.nl
 * @license    GNU General Public License versie 2 of hoger; Zie LICENSE.txt
 */
// No direct access
defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');

// Load admin language file
$lang = JFactory::getLanguage();
$lang->load('com_vwebadmin', JPATH_SITE);
$doc = JFactory::getDocument();
$doc->addScript(JUri::base() . '/media/com_vwebadmin/js/form.js');

$user    = JFactory::getUser();
$canEdit = VwebadminHelpersVwebadmin::canUserEdit($this->item, $user);


?>

<div class="website-edit front-end-edit">
	<?php if (!$canEdit) : ?>
		<h3>
			<?php throw new Exception(JText::_('COM_VWEBADMIN_ERROR_MESSAGE_NOT_AUTHORISED'), 403); ?>
		</h3>
	<?php else : ?>
		<?php if (!empty($this->item->id)): ?>
			<h1><?php echo JText::sprintf('COM_VWEBADMIN_EDIT_ITEM_TITLE', $this->item->id); ?></h1>
		<?php else: ?>
			<h1><?php echo JText::_('COM_VWEBADMIN_ADD_ITEM_TITLE'); ?></h1>
		<?php endif; ?>

		<form id="form-website"
			  action="<?php echo JRoute::_('index.php?option=com_vwebadmin&task=website.save'); ?>"
			  method="post" class="form-validate form-horizontal" enctype="multipart/form-data">
			
	<input type="hidden" name="jform[id]" value="<?php echo $this->item->id; ?>" />

	<?php echo $this->form->renderField('owner'); ?>

	<?php foreach((array)$this->item->owner as $value): ?>
		<?php if(!is_array($value)): ?>
			<input type="hidden" class="owner" name="jform[ownerhidden][<?php echo $value; ?>]" value="<?php echo $value; ?>" />
		<?php endif; ?>
	<?php endforeach; ?>
	<?php echo $this->form->renderField('website'); ?>

	<?php echo $this->form->renderField('onderhoud'); ?>

	<?php echo $this->form->renderField('hosting'); ?>

	<?php echo $this->form->renderField('domein'); ?>

	<input type="hidden" name="jform[ordering]" value="<?php echo $this->item->ordering; ?>" />

	<?php echo $this->form->renderField('cms_guess'); ?>

	<?php foreach((array)$this->item->cms_guess as $value): ?>
		<?php if(!is_array($value)): ?>
			<input type="hidden" class="cms_guess" name="jform[cms_guesshidden][<?php echo $value; ?>]" value="<?php echo $value; ?>" />
		<?php endif; ?>
	<?php endforeach; ?>
	<input type="hidden" name="jform[state]" value="<?php echo $this->item->state; ?>" />

	<input type="hidden" name="jform[checked_out]" value="<?php echo $this->item->checked_out; ?>" />

	<input type="hidden" name="jform[checked_out_time]" value="<?php echo $this->item->checked_out_time; ?>" />

				<?php echo $this->form->getInput('created_by'); ?>
				<?php echo $this->form->getInput('modified_by'); ?>				<div class="fltlft" <?php if (!JFactory::getUser()->authorise('core.admin','vwebadmin')): ?> style="display:none;" <?php endif; ?> >
                <?php echo JHtml::_('sliders.start', 'permissions-sliders-'.$this->item->id, array('useCookie'=>1)); ?>
                <?php echo JHtml::_('sliders.panel', JText::_('ACL Configuration'), 'access-rules'); ?>
                <fieldset class="panelform">
                    <?php echo $this->form->getLabel('rules'); ?>
                    <?php echo $this->form->getInput('rules'); ?>
                </fieldset>
                <?php echo JHtml::_('sliders.end'); ?>
            </div>
				<?php if (!JFactory::getUser()->authorise('core.admin','vwebadmin')): ?>
                <script type="text/javascript">
                    jQuery.noConflict();
                    jQuery('.tab-pane select').each(function(){
                       var option_selected = jQuery(this).find(':selected');
                       var input = document.createElement("input");
                       input.setAttribute("type", "hidden");
                       input.setAttribute("name", jQuery(this).attr('name'));
                       input.setAttribute("value", option_selected.val());
                       document.getElementById("form-website").appendChild(input);
                    });
                </script>
             <?php endif; ?>
			<div class="control-group">
				<div class="controls">

					<?php if ($this->canSave): ?>
						<button type="submit" class="validate btn btn-primary">
							<?php echo JText::_('JSUBMIT'); ?>
						</button>
					<?php endif; ?>
					<a class="btn"
					   href="<?php echo JRoute::_('index.php?option=com_vwebadmin&task=websiteform.cancel'); ?>"
					   title="<?php echo JText::_('JCANCEL'); ?>">
						<?php echo JText::_('JCANCEL'); ?>
					</a>
				</div>
			</div>

			<input type="hidden" name="option" value="com_vwebadmin"/>
			<input type="hidden" name="task"
				   value="websiteform.save"/>
			<?php echo JHtml::_('form.token'); ?>
		</form>
	<?php endif; ?>
</div>
