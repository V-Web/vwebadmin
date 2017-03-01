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

jimport('joomla.application.component.view');

/**
 * View class for a list of Vwebadmin.
 *
 * @since  1.6
 */
class VwebadminViewDashboards extends JViewLegacy
{
	protected $items;

	protected $pagination;

	protected $state;

	/**
	 * Display the view
	 *
	 * @param   string  $tpl  Template name
	 *
	 * @return void
	 *
	 * @throws Exception
	 */
	public function display($tpl = null)
	{
		$this->state = $this->get('State');

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			throw new Exception(implode("\n", $errors));
		}

		VwebadminHelpersVwebadmin::addSubmenu('dashboards');

		$this->addToolbar();

		$this->sidebar = JHtmlSidebar::render();
		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @return void
	 *
	 * @since    1.6
	 */
	protected function addToolbar()
	{
		$state = $this->get('State');
		$canDo = VwebadminHelpersVwebadmin::getActions();

		JToolBarHelper::title(JText::_('COM_VWEBADMIN_TITLE_DASHBOARDS'), 'dashboards.png');

		// Check if the form exists before showing the add/edit buttons
		$formPath = JPATH_COMPONENT_ADMINISTRATOR . '/views/dashboard';

		if (file_exists($formPath))
		{
			if ($canDo->get('core.create'))
			{
				JToolBarHelper::addNew('dashboard.add', 'JTOOLBAR_NEW');

				if (isset($this->items[0]))
				{
					JToolbarHelper::custom('dashboards.duplicate', 'copy.png', 'copy_f2.png', 'JTOOLBAR_DUPLICATE', true);
				}
			}

			if ($canDo->get('core.edit') && isset($this->items[0]))
			{
				JToolBarHelper::editList('dashboard.edit', 'JTOOLBAR_EDIT');
			}
		}

		if ($canDo->get('core.edit.state'))
		{
			if (isset($this->items[0]->state))
			{
				JToolBarHelper::divider();
				JToolBarHelper::custom('dashboards.publish', 'publish.png', 'publish_f2.png', 'JTOOLBAR_PUBLISH', true);
				JToolBarHelper::custom('dashboards.unpublish', 'unpublish.png', 'unpublish_f2.png', 'JTOOLBAR_UNPUBLISH', true);
			}
			elseif (isset($this->items[0]))
			{
				// If this component does not use state then show a direct delete button as we can not trash
				JToolBarHelper::deleteList('', 'dashboards.delete', 'JTOOLBAR_DELETE');
			}

			if (isset($this->items[0]->state))
			{
				JToolBarHelper::divider();
				JToolBarHelper::archiveList('dashboards.archive', 'JTOOLBAR_ARCHIVE');
			}

			if (isset($this->items[0]->checked_out))
			{
				JToolBarHelper::custom('dashboards.checkin', 'checkin.png', 'checkin_f2.png', 'JTOOLBAR_CHECKIN', true);
			}
		}

		// Show trash and delete for components that uses the state field
		if (isset($this->items[0]->state))
		{
			if ($state->get('filter.state') == -2 && $canDo->get('core.delete'))
			{
				JToolBarHelper::deleteList('', 'dashboards.delete', 'JTOOLBAR_EMPTY_TRASH');
				JToolBarHelper::divider();
			}
			elseif ($canDo->get('core.edit.state'))
			{
				JToolBarHelper::trash('dashboards.trash', 'JTOOLBAR_TRASH');
				JToolBarHelper::divider();
			}
		}

		if ($canDo->get('core.admin'))
		{
			JToolBarHelper::preferences('com_vwebadmin');
		}

		// Set sidebar action - New in 3.0
		JHtmlSidebar::setAction('index.php?option=com_vwebadmin&view=dashboards');

		$this->extra_sidebar = '';
	}

	/**
	 * Method to order fields 
	 *
	 * @return void 
	 */
	protected function getSortFields()
	{
		return array(
			'a.`website`' => JText::_('COM_VWEBADMIN_DOMEINEN_WEBSITE'),
			'a.`subscription_start`' => JText::_('COM_VWEBADMIN_DOMEINEN_SUBSCRIPTION_START'),
			'a.`subscription_end`' => JText::_('COM_VWEBADMIN_DOMEINEN_SUBSCRIPTION_END'),
			'a.`ordering`' => JText::_('JGRID_HEADING_ORDERING'),
		);
	}
}
