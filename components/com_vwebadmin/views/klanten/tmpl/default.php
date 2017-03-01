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
$canCreate  = $user->authorise('core.create', 'com_vwebadmin') && file_exists(JPATH_COMPONENT . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . 'forms' . DIRECTORY_SEPARATOR . 'klantform.xml');
$canEdit    = $user->authorise('core.edit', 'com_vwebadmin') && file_exists(JPATH_COMPONENT . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . 'forms' . DIRECTORY_SEPARATOR . 'klantform.xml');
$canCheckin = $user->authorise('core.manage', 'com_vwebadmin');
$canChange  = $user->authorise('core.edit.state', 'com_vwebadmin');
$canDelete  = $user->authorise('core.delete', 'com_vwebadmin');
?>

<form action="<?php echo JRoute::_('index.php?option=com_vwebadmin&view=klanten'); ?>" method="post"
      name="adminForm" id="adminForm">

	<?php echo JLayoutHelper::render('default_filter', array('view' => $this), dirname(__FILE__)); ?>
	<table class="table table-striped" id="klantList">
		<thead>
		<tr>
			<?php if (isset($this->items[0]->state)): ?>
				
			<?php endif; ?>

							<th class=''>
				<?php echo JHtml::_('grid.sort',  'COM_VWEBADMIN_KLANTEN_COMPANY_NAME', 'a.company_name', $listDirn, $listOrder); ?>
				</th>
				<th class=''>
				<?php echo JHtml::_('grid.sort',  'COM_VWEBADMIN_KLANTEN_EMAIL', 'a.email', $listDirn, $listOrder); ?>
				</th>
				<th class=''>
				<?php echo JHtml::_('grid.sort',  'COM_VWEBADMIN_KLANTEN_PHONE', 'a.phone', $listDirn, $listOrder); ?>
				</th>


							<?php if ($canEdit || $canDelete): ?>
					<th class="center">
				<?php echo JText::_('COM_VWEBADMIN_KLANTEN_ACTIONS'); ?>
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

							<?php if (!$canEdit && $user->authorise('core.edit.own', 'com_vwebadmin')): ?>
					<?php $canEdit = JFactory::getUser()->id == $item->created_by; ?>
				<?php endif; ?>

			<tr class="row<?php echo $i % 2; ?>">

				<?php if (isset($this->items[0]->state)) : ?>
					<?php $class = ($canChange) ? 'active' : 'disabled'; ?>
					
				<?php endif; ?>

								<td>
				<?php if (isset($item->checked_out) && $item->checked_out) : ?>
					<?php echo JHtml::_('jgrid.checkedout', $i, $item->uEditor, $item->checked_out_time, 'klanten.', $canCheckin); ?>
				<?php endif; ?>
				<a href="<?php echo JRoute::_('index.php?option=com_vwebadmin&view=klant&id='.(int) $item->id); ?>">
				<?php echo $this->escape($item->company_name); ?></a>
				</td>
				<td>

					<?php echo $item->email; ?>
				</td>
				<td>

					<?php echo $item->phone; ?>
				</td>


								<?php if ($canEdit || $canDelete): ?>
					<td class="center">
						<?php if ($canEdit): ?>
							<a href="<?php echo JRoute::_('index.php?option=com_vwebadmin&task=klantform.edit&id=' . $item->id, false, 2); ?>" class="btn btn-mini" type="button"><i class="icon-edit" ></i></a>
						<?php endif; ?>
						<?php if ($canDelete): ?>
							<a href="<?php echo JRoute::_('index.php?option=com_vwebadmin&task=klantform.remove&id=' . $item->id, false, 2); ?>" class="btn btn-mini delete-button" type="button"><i class="icon-trash" ></i></a>
						<?php endif; ?>
					</td>
				<?php endif; ?>

			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>

	<?php if ($canCreate) : ?>
		<a href="<?php echo JRoute::_('index.php?option=com_vwebadmin&task=klantform.edit&id=0', false, 0); ?>"
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
