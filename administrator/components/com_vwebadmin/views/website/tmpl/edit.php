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

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');
JHtml::_('behavior.keepalive');

// Import CSS
$document = JFactory::getDocument();
$document->addStyleSheet(JUri::root() . 'media/com_vwebadmin/css/form.css');
?>
<script type="text/javascript">
	js = jQuery.noConflict();
	js(document).ready(function () {
		
	js('input:hidden.owner').each(function(){
		var name = js(this).attr('name');
		if(name.indexOf('ownerhidden')){
			js('#jform_owner option[value="'+js(this).val()+'"]').attr('selected',true);
		}
	});
	js("#jform_owner").trigger("liszt:updated");
	js('input:hidden.cms_guess').each(function(){
		var name = js(this).attr('name');
		if(name.indexOf('cms_guesshidden')){
			js('#jform_cms_guess option[value="'+js(this).val()+'"]').attr('selected',true);
		}
	});
	js("#jform_cms_guess").trigger("liszt:updated");
	});

	Joomla.submitbutton = function (task) {
		if (task == 'website.cancel') {
			Joomla.submitform(task, document.getElementById('website-form'));
		}
		else {
			
			if (task != 'website.cancel' && document.formvalidator.isValid(document.id('website-form'))) {
				
				Joomla.submitform(task, document.getElementById('website-form'));
			}
			else {
				alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
			}
		}
	}
</script>

<form
	action="<?php echo JRoute::_('index.php?option=com_vwebadmin&layout=edit&id=' . (int) $this->item->id); ?>"
	method="post" enctype="multipart/form-data" name="adminForm" id="website-form" class="form-validate">

	<div class="form-horizontal">
		<?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'general')); ?>

		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'general', JText::_('COM_VWEBADMIN_TITLE_WEBSITE', true)); ?>
		<div class="row-fluid">
			<div class="span10 form-horizontal">
				<fieldset class="adminform">

									<input type="hidden" name="jform[id]" value="<?php echo $this->item->id; ?>" />
				<?php echo $this->form->renderField('owner'); ?>

			<?php
				foreach((array)$this->item->owner as $value): 
					if(!is_array($value)):
						echo '<input type="hidden" class="owner" name="jform[ownerhidden]['.$value.']" value="'.$value.'" />';
					endif;
				endforeach;
			?>				<?php echo $this->form->renderField('website'); ?>
				<?php echo $this->form->renderField('onderhoud'); ?>
				<?php echo $this->form->renderField('hosting'); ?>
				<?php echo $this->form->renderField('domein'); ?>
				<input type="hidden" name="jform[ordering]" value="<?php echo $this->item->ordering; ?>" />
				<?php echo $this->form->renderField('cms_guess'); ?>

			<?php
				foreach((array)$this->item->cms_guess as $value): 
					if(!is_array($value)):
						echo '<input type="hidden" class="cms_guess" name="jform[cms_guesshidden]['.$value.']" value="'.$value.'" />';
					endif;
				endforeach;
			?>				<input type="hidden" name="jform[state]" value="<?php echo $this->item->state; ?>" />
				<input type="hidden" name="jform[checked_out]" value="<?php echo $this->item->checked_out; ?>" />
				<input type="hidden" name="jform[checked_out_time]" value="<?php echo $this->item->checked_out_time; ?>" />

				<?php echo $this->form->renderField('created_by'); ?>
				<?php echo $this->form->renderField('modified_by'); ?>

					<?php if ($this->state->params->get('save_history', 1)) : ?>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel('version_note'); ?></div>
						<div class="controls"><?php echo $this->form->getInput('version_note'); ?></div>
					</div>
					<?php endif; ?>
				</fieldset>
			</div>
		</div>
		<?php echo JHtml::_('bootstrap.endTab'); ?>

		<?php if (JFactory::getUser()->authorise('core.admin','vwebadmin')) : ?>
	<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'permissions', JText::_('JGLOBAL_ACTION_PERMISSIONS_LABEL', true)); ?>
		<?php echo $this->form->getInput('rules'); ?>
	<?php echo JHtml::_('bootstrap.endTab'); ?>
<?php endif; ?>

		<?php echo JHtml::_('bootstrap.endTabSet'); ?>

		<input type="hidden" name="task" value=""/>
		<?php echo JHtml::_('form.token'); ?>

	</div>
</form>