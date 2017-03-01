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
$canCreate  = $user->authorise('core.create', 'com_vwebadmin') && file_exists(JPATH_COMPONENT . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . 'forms' . DIRECTORY_SEPARATOR . 'websiteform.xml');
$canEdit    = $user->authorise('core.edit', 'com_vwebadmin') && file_exists(JPATH_COMPONENT . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . 'forms' . DIRECTORY_SEPARATOR . 'websiteform.xml');
$canCheckin = $user->authorise('core.manage', 'com_vwebadmin');
$canChange  = $user->authorise('core.edit.state', 'com_vwebadmin');
$canDelete  = $user->authorise('core.delete', 'com_vwebadmin');
?>

<form action="<?php echo JRoute::_('index.php?option=com_vwebadmin&view=websites'); ?>" method="post"
      name="adminForm" id="adminForm">

	<?php echo JLayoutHelper::render('default_filter', array('view' => $this), dirname(__FILE__)); ?>
	<table class="table table-striped" id="websiteList">
		<thead>
		<tr>
			<?php if (isset($this->items[0]->state)): ?>
				
			<?php endif; ?>

							<th class=''>
				<?php echo JHtml::_('grid.sort',  'COM_VWEBADMIN_WEBSITES_OWNER', 'a.owner', $listDirn, $listOrder); ?>
				</th>
				<th class=''>
				<?php echo JHtml::_('grid.sort',  'COM_VWEBADMIN_WEBSITES_WEBSITE', 'a.website', $listDirn, $listOrder); ?>
				</th>
				<th class=''>
				<?php echo JHtml::_('grid.sort',  'COM_VWEBADMIN_WEBSITES_ONDERHOUD', 'a.onderhoud', $listDirn, $listOrder); ?>
				</th>
				<th class=''>
				<?php echo JHtml::_('grid.sort',  'COM_VWEBADMIN_WEBSITES_HOSTING', 'a.hosting', $listDirn, $listOrder); ?>
				</th>
				<th class=''>
				<?php echo JHtml::_('grid.sort',  'COM_VWEBADMIN_WEBSITES_DOMEIN', 'a.domein', $listDirn, $listOrder); ?>
				</th>
				<th class=''>
				<?php echo JHtml::_('grid.sort',  'COM_VWEBADMIN_WEBSITES_CMS_GUESS', 'a.cms_guess', $listDirn, $listOrder); ?>
				</th>


							<?php if ($canEdit || $canDelete): ?>
					<th class="center">
				<?php echo JText::_('COM_VWEBADMIN_WEBSITES_ACTIONS'); ?>
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

					<?php echo $item->owner; ?>
				</td>
				<td>

					<?php echo $item->website; ?>
				</td>
				<td>

					<?php if (!empty($item->onderhoud)): ?>
						<?php echo JText::_('COM_VWEBADMIN_WEBSITES_ONDERHOUD_OPTION_ON'); ?>
					<?php else: ?>
						<?php echo JText::_('COM_VWEBADMIN_WEBSITES_ONDERHOUD_OPTION_OFF'); ?>
					<?php endif; ?>				</td>
				<td>

					<?php if (!empty($item->hosting)): ?>
						<?php echo JText::_('COM_VWEBADMIN_WEBSITES_HOSTING_OPTION_ON'); ?>
					<?php else: ?>
						<?php echo JText::_('COM_VWEBADMIN_WEBSITES_HOSTING_OPTION_OFF'); ?>
					<?php endif; ?>				</td>
				<td>

					<?php if (!empty($item->domein)): ?>
						<?php echo JText::_('COM_VWEBADMIN_WEBSITES_DOMEIN_OPTION_ON'); ?>
					<?php else: ?>
						<?php echo JText::_('COM_VWEBADMIN_WEBSITES_DOMEIN_OPTION_OFF'); ?>
					<?php endif; ?>				</td>
				<td>

					<?php echo $item->cms_guess; ?>
				</td>


								<?php if ($canEdit || $canDelete): ?>
					<td class="center">
						<?php if ($canEdit): ?>
							<a href="<?php echo JRoute::_('index.php?option=com_vwebadmin&task=websiteform.edit&id=' . $item->id, false, 2); ?>" class="btn btn-mini" type="button"><i class="icon-edit" ></i></a>
						<?php endif; ?>
						<?php if ($canDelete): ?>
							<a href="<?php echo JRoute::_('index.php?option=com_vwebadmin&task=websiteform.remove&id=' . $item->id, false, 2); ?>" class="btn btn-mini delete-button" type="button"><i class="icon-trash" ></i></a>
						<?php endif; ?>
					</td>
				<?php endif; ?>

			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>

	<?php if ($canCreate) : ?>
		<a href="<?php echo JRoute::_('index.php?option=com_vwebadmin&task=websiteform.edit&id=0', false, 0); ?>"
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
