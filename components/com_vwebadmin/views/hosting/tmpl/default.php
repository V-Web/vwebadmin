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


?>

<div class="item_fields">

	<table class="table">
		

		<tr>
			<th><?php echo JText::_('COM_VWEBADMIN_FORM_LBL_HOSTING_WEBSITE'); ?></th>
			<td><?php echo $this->item->website; ?></td>
		</tr>

		<tr>
			<th><?php echo JText::_('COM_VWEBADMIN_FORM_LBL_HOSTING_PACKAGE'); ?></th>
			<td><?php echo $this->item->package; ?></td>
		</tr>

		<tr>
			<th><?php echo JText::_('COM_VWEBADMIN_FORM_LBL_HOSTING_SUBSCRIPTION_START'); ?></th>
			<td><?php echo $this->item->subscription_start; ?></td>
		</tr>

		<tr>
			<th><?php echo JText::_('COM_VWEBADMIN_FORM_LBL_HOSTING_SUBSCRIPTION_END'); ?></th>
			<td><?php echo $this->item->subscription_end; ?></td>
		</tr>

	</table>

</div>

