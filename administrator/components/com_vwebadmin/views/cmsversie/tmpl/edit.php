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
		
	js('input:hidden.cms').each(function(){
		var name = js(this).attr('name');
		if(name.indexOf('cmshidden')){
			js('#jform_cms option[value="'+js(this).val()+'"]').attr('selected',true);
		}
	});
	js("#jform_cms").trigger("liszt:updated");
	});

	Joomla.submitbutton = function (task) {
		if (task == 'cmsversie.cancel') {
			Joomla.submitform(task, document.getElementById('cmsversie-form'));
		}
		else {
			
			if (task != 'cmsversie.cancel' && document.formvalidator.isValid(document.id('cmsversie-form'))) {
				
				Joomla.submitform(task, document.getElementById('cmsversie-form'));
			}
			else {
				alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
			}
		}
	}
</script>

<form
	action="<?php echo JRoute::_('index.php?option=com_vwebadmin&layout=edit&id=' . (int) $this->item->id); ?>"
	method="post" enctype="multipart/form-data" name="adminForm" id="cmsversie-form" class="form-validate">

	<div class="form-horizontal">
		<?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'general')); ?>

		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'general', JText::_('COM_VWEBADMIN_TITLE_CMSVERSIE', true)); ?>
		<div class="row-fluid">
			<div class="span10 form-horizontal">
				<fieldset class="adminform">

									<input type="hidden" name="jform[id]" value="<?php echo $this->item->id; ?>" />
				<?php echo $this->form->renderField('cms'); ?>

			<?php
				foreach((array)$this->item->cms as $value): 
					if(!is_array($value)):
						echo '<input type="hidden" class="cms" name="jform[cmshidden]['.$value.']" value="'.$value.'" />';
					endif;
				endforeach;
			?>				<?php echo $this->form->renderField('version'); ?>
				<?php echo $this->form->renderField('release_date'); ?>
				<?php echo $this->form->renderField('changelog'); ?>
				<?php echo $this->form->renderField('changelog_link'); ?>
				<input type="hidden" name="jform[ordering]" value="<?php echo $this->item->ordering; ?>" />
				<input type="hidden" name="jform[state]" value="<?php echo $this->item->state; ?>" />
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

		

		<?php echo JHtml::_('bootstrap.endTabSet'); ?>

		<input type="hidden" name="task" value=""/>
		<?php echo JHtml::_('form.token'); ?>

	</div>
</form>
