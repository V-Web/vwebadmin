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
class VwebadminViewWebsites extends JViewLegacy
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
		$this->items = $this->get('Items');
		$this->pagination = $this->get('Pagination');

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			throw new Exception(implode("\n", $errors));
		}

		VwebadminHelpersVwebadmin::addSubmenu('websites');

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

		JToolBarHelper::title(JText::_('COM_VWEBADMIN_TITLE_WEBSITES'), 'websites.png');

		// Check if the form exists before showing the add/edit buttons
		$formPath = JPATH_COMPONENT_ADMINISTRATOR . '/views/website';

		if (file_exists($formPath))
		{
			if ($canDo->get('core.create'))
			{
				JToolBarHelper::addNew('website.add', 'JTOOLBAR_NEW');

				if (isset($this->items[0]))
				{
					JToolbarHelper::custom('websites.duplicate', 'copy.png', 'copy_f2.png', 'JTOOLBAR_DUPLICATE', true);
				}
			}

			if ($canDo->get('core.edit') && isset($this->items[0]))
			{
				JToolBarHelper::editList('website.edit', 'JTOOLBAR_EDIT');
			}
		}

		if ($canDo->get('core.edit.state'))
		{
			if (isset($this->items[0]->state))
			{
				JToolBarHelper::divider();
				JToolBarHelper::custom('websites.publish', 'publish.png', 'publish_f2.png', 'JTOOLBAR_PUBLISH', true);
				JToolBarHelper::custom('websites.unpublish', 'unpublish.png', 'unpublish_f2.png', 'JTOOLBAR_UNPUBLISH', true);
			}
			elseif (isset($this->items[0]))
			{
				// If this component does not use state then show a direct delete button as we can not trash
				JToolBarHelper::deleteList('', 'websites.delete', 'JTOOLBAR_DELETE');
			}

			if (isset($this->items[0]->state))
			{
				JToolBarHelper::divider();
				JToolBarHelper::archiveList('websites.archive', 'JTOOLBAR_ARCHIVE');
			}

			if (isset($this->items[0]->checked_out))
			{
				JToolBarHelper::custom('websites.checkin', 'checkin.png', 'checkin_f2.png', 'JTOOLBAR_CHECKIN', true);
			}
		}

		// Show trash and delete for components that uses the state field
		if (isset($this->items[0]->state))
		{
			if ($state->get('filter.state') == -2 && $canDo->get('core.delete'))
			{
				JToolBarHelper::deleteList('', 'websites.delete', 'JTOOLBAR_EMPTY_TRASH');
				JToolBarHelper::divider();
			}
			elseif ($canDo->get('core.edit.state'))
			{
				JToolBarHelper::trash('websites.trash', 'JTOOLBAR_TRASH');
				JToolBarHelper::divider();
			}
		}

		if ($canDo->get('core.admin'))
		{
			JToolBarHelper::preferences('com_vwebadmin');
		}

		// Set sidebar action - New in 3.0
		JHtmlSidebar::setAction('index.php?option=com_vwebadmin&view=websites');

		$this->extra_sidebar = '';                                                
        //Filter for the field owner;
        jimport('joomla.form.form');
        $options = array();
        JForm::addFormPath(JPATH_COMPONENT . '/models/forms');
        $form = JForm::getInstance('com_vwebadmin.website', 'website');

        $field = $form->getField('owner');

        $query = $form->getFieldAttribute('filter_owner','query');
        $translate = $form->getFieldAttribute('filter_owner','translate');
        $key = $form->getFieldAttribute('filter_owner','key_field');
        $value = $form->getFieldAttribute('filter_owner','value_field');

        // Get the database object.
        $db = JFactory::getDbo();

        // Set the query and get the result list.
        $db->setQuery($query);
        $items = $db->loadObjectlist();

        // Build the field options.
        if (!empty($items))
        {
            foreach ($items as $item)
            {
                if ($translate == true)
                {
                    $options[] = JHtml::_('select.option', $item->$key, JText::_($item->$value));
                }
                else
                {
                    $options[] = JHtml::_('select.option', $item->$key, $item->$value);
                }
            }
        }

        JHtmlSidebar::addFilter(
            '$Klant',
            'filter_owner',
            JHtml::_('select.options', $options, "value", "text", $this->state->get('filter.owner')),
            true
        );
		JHtmlSidebar::addFilter(

			JText::_('JOPTION_SELECT_PUBLISHED'),

			'filter_published',

			JHtml::_('select.options', JHtml::_('jgrid.publishedOptions'), "value", "text", $this->state->get('filter.state'), true)

		);
	}

	/**
	 * Method to order fields 
	 *
	 * @return void 
	 */
	protected function getSortFields()
	{
		return array(
			'a.`owner`' => JText::_('COM_VWEBADMIN_WEBSITES_OWNER'),
			'a.`website`' => JText::_('COM_VWEBADMIN_WEBSITES_WEBSITE'),
			'a.`onderhoud`' => JText::_('COM_VWEBADMIN_WEBSITES_ONDERHOUD'),
			'a.`hosting`' => JText::_('COM_VWEBADMIN_WEBSITES_HOSTING'),
			'a.`domein`' => JText::_('COM_VWEBADMIN_WEBSITES_DOMEIN'),
			'a.`ordering`' => JText::_('JGRID_HEADING_ORDERING'),
			'a.`cms_guess`' => JText::_('COM_VWEBADMIN_WEBSITES_CMS_GUESS'),
		);
	}
}
