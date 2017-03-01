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

$canEdit = JFactory::getUser()->authorise('core.edit', 'com_vwebadmin.' . $this->item->id);

if (!$canEdit && JFactory::getUser()->authorise('core.edit.own', 'com_vwebadmin' . $this->item->id))
{
	$canEdit = JFactory::getUser()->id == $this->item->created_by;
}
?>

<div class="item_fields">

	<table class="table">
		

		<tr>
			<th><?php echo JText::_('COM_VWEBADMIN_FORM_LBL_KLANT_RELATED_USER_ACCOUNT'); ?></th>
			<td><?php echo $this->item->related_user_account_name; ?></td>
		</tr>

		<tr>
			<th><?php echo JText::_('COM_VWEBADMIN_FORM_LBL_KLANT_COMPANY_NAME'); ?></th>
			<td><?php echo $this->item->company_name; ?></td>
		</tr>

		<tr>
			<th><?php echo JText::_('COM_VWEBADMIN_FORM_LBL_KLANT_EMAIL'); ?></th>
			<td><?php echo $this->item->email; ?></td>
		</tr>

		<tr>
			<th><?php echo JText::_('COM_VWEBADMIN_FORM_LBL_KLANT_PHONE'); ?></th>
			<td><?php echo $this->item->phone; ?></td>
		</tr>

	</table>

</div>

<?php if($canEdit && $this->item->checked_out == 0): ?>

	<a class="btn" href="<?php echo JRoute::_('index.php?option=com_vwebadmin&task=klant.edit&id='.$this->item->id); ?>"><?php echo JText::_("COM_VWEBADMIN_EDIT_ITEM"); ?></a>

<?php endif; ?>

<?php if (JFactory::getUser()->authorise('core.delete','com_vwebadmin.klant.'.$this->item->id)) : ?>

	<a class="btn btn-danger" href="#deleteModal" role="button" data-toggle="modal">
		<?php echo JText::_("COM_VWEBADMIN_DELETE_ITEM"); ?>
	</a>

	<div id="deleteModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h3><?php echo JText::_('COM_VWEBADMIN_DELETE_ITEM'); ?></h3>
		</div>
		<div class="modal-body">
			<p><?php echo JText::sprintf('COM_VWEBADMIN_DELETE_CONFIRM', $this->item->id); ?></p>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal">Close</button>
			<a href="<?php echo JRoute::_('index.php?option=com_vwebadmin&task=klant.remove&id=' . $this->item->id, false, 2); ?>" class="btn btn-danger">
				<?php echo JText::_('COM_VWEBADMIN_DELETE_ITEM'); ?>
			</a>
		</div>
	</div>

<?php endif; ?>