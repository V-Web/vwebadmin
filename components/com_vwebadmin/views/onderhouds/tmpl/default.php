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
JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');

$user       = JFactory::getUser();
$userId     = $user->get('id');
$listOrder  = $this->state->get('list.ordering');
$listDirn   = $this->state->get('list.direction');
$canCreate  = $user->authorise('core.create', 'com_vwebadmin') && file_exists(JPATH_COMPONENT . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . 'forms' . DIRECTORY_SEPARATOR . 'onderhoudform.xml');
$canEdit    = $user->authorise('core.edit', 'com_vwebadmin') && file_exists(JPATH_COMPONENT . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . 'forms' . DIRECTORY_SEPARATOR . 'onderhoudform.xml');
$canCheckin = $user->authorise('core.manage', 'com_vwebadmin');
$canChange  = $user->authorise('core.edit.state', 'com_vwebadmin');
$canDelete  = $user->authorise('core.delete', 'com_vwebadmin');
?>

<form action="<?php echo JRoute::_('index.php?option=com_vwebadmin&view=onderhouds'); ?>" method="post"
      name="adminForm" id="adminForm">

	
	<table class="table table-striped" id="onderhoudList">
		<thead>
		<tr>
			<?php if (isset($this->items[0]->state)): ?>
				
			<?php endif; ?>

							<th class=''>
				<?php echo JHtml::_('grid.sort',  'COM_VWEBADMIN_ONDERHOUDS_WEBSITE', 'a.website', $listDirn, $listOrder); ?>
				</th>
				<th class=''>
				<?php echo JHtml::_('grid.sort',  'COM_VWEBADMIN_ONDERHOUDS_PACKAGE', 'a.package', $listDirn, $listOrder); ?>
				</th>
				<th class=''>
				<?php echo JHtml::_('grid.sort',  'COM_VWEBADMIN_ONDERHOUDS_SUBSCRIPTION_START', 'a.subscription_start', $listDirn, $listOrder); ?>
				</th>
				<th class=''>
				<?php echo JHtml::_('grid.sort',  'COM_VWEBADMIN_ONDERHOUDS_SUBSCRIPTION_END', 'a.subscription_end', $listDirn, $listOrder); ?>
				</th>
				<th class=''>
				<?php echo JHtml::_('grid.sort',  'COM_VWEBADMIN_ONDERHOUDS_CMS', 'a.cms', $listDirn, $listOrder); ?>
				</th>
				<th class=''>
				<?php echo JHtml::_('grid.sort',  'COM_VWEBADMIN_ONDERHOUDS_CMS_VERSION', 'a.cms_version', $listDirn, $listOrder); ?>
				</th>
				<th>
				Details
				</th>


							<?php if ($canEdit || $canDelete): ?>
					<th class="center">
				<?php echo JText::_('COM_VWEBADMIN_ONDERHOUDS_ACTIONS'); ?>
				</th>
				<?php endif; ?>

		</tr>
		</thead>
		<tfoot>
		<tr>
			<td colspan="<?php echo isset($this->items[0]) ? count(get_object_vars($this->items[0])) : 10; ?>">
				<?php echo $this->pagination->getListFooter(); ?>
			</td>
		</tr>
		</tfoot>
		<tbody>
		<?php foreach ($this->items as $i => $item) : ?>
			<?php $canEdit = $user->authorise('core.edit', 'com_vwebadmin'); ?>

			
			<tr class="row<?php echo $i % 2; ?>">

				<?php if (isset($this->items[0]->state)) : ?>
					<?php $class = ($canChange) ? 'active' : 'disabled'; ?>
					
				<?php endif; ?>

								<td>

					<?php echo $item->website; ?>
				</td>
				<td>

					<?php echo $item->package; ?>
				</td>
				<td>

					<?php echo $item->subscription_start; ?>
				</td>
				<td>

					<?php echo $item->subscription_end; ?>
				</td>
				<td>

					<?php echo $item->cms; ?>
				</td>
				<td>

					<?php echo $item->cms_version; ?>
				</td>
				<td class="center">
						<a href="<?php echo JRoute::_('index.php?option=com_vwebadmin&task=onderhoud&id=' . $item->id, false, 2); ?>" class="btn btn-mini" type="button"><i class="icon-edit" ></i></a>
					</td>


								<?php if ($canEdit || $canDelete): ?>
					<td class="center">
					</td>
				<?php endif; ?>

			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>

	<?php if ($canCreate) : ?>
		<a href="<?php echo JRoute::_('index.php?option=com_vwebadmin&task=onderhoudform.edit&id=0', false, 0); ?>"
		   class="btn btn-success btn-small"><i
				class="icon-plus"></i>
			<?php echo JText::_('COM_VWEBADMIN_ADD_ITEM'); ?></a>
	<?php endif; ?>

	<input type="hidden" name="task" value=""/>
	<input type="hidden" name="boxchecked" value="0"/>
	<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>"/>
	<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>"/>
	<?php echo JHtml::_('form.token'); ?>
</form>

<?php if($canDelete) : ?>
<script type="text/javascript">

	jQuery(document).ready(function () {
		jQuery('.delete-button').click(deleteItem);
	});

	function deleteItem() {

		if (!confirm("<?php echo JText::_('COM_VWEBADMIN_DELETE_MESSAGE'); ?>")) {
			return false;
		}
	}
</script>
<?php endif; ?>
