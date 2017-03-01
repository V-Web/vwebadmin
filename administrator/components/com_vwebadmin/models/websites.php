<?php

/**
 * @version    CVS: 1.0.20
 * @package    Com_Vwebadmin
 * @author     Marcel Venema <marcel.venema@v-web.nl>
 * @copyright  2017 V-Web.nl
 * @license    GNU General Public License versie 2 of hoger; Zie LICENSE.txt
 */
defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');

/**
 * Methods supporting a list of Vwebadmin records.
 *
 * @since  1.6
 */
class VwebadminModelWebsites extends JModelList
{
/**
	* Constructor.
	*
	* @param   array  $config  An optional associative array of configuration settings.
	*
	* @see        JController
	* @since      1.6
	*/
	public function __construct($config = array())
	{
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'id', 'a.`id`',
				'owner', 'a.`owner`',
				'website', 'a.`website`',
				'onderhoud', 'a.`onderhoud`',
				'hosting', 'a.`hosting`',
				'domein', 'a.`domein`',
				'ordering', 'a.`ordering`',
				'cms_guess', 'a.`cms_guess`',
				'state', 'a.`state`',
				'created_by', 'a.`created_by`',
				'modified_by', 'a.`modified_by`',
			);
		}

		parent::__construct($config);
	}

	/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @param   string  $ordering   Elements order
	 * @param   string  $direction  Order direction
	 *
	 * @return void
	 *
	 * @throws Exception
	 */
	protected function populateState($ordering = null, $direction = null)
	{
		// Initialise variables.
		$app = JFactory::getApplication('administrator');

		// Load the filter state.
		$search = $app->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
		$this->setState('filter.search', $search);

		$published = $app->getUserStateFromRequest($this->context . '.filter.state', 'filter_published', '', 'string');
		$this->setState('filter.state', $published);
		// Filtering owner
		$this->setState('filter.owner', $app->getUserStateFromRequest($this->context.'.filter.owner', 'filter_owner', '', 'string'));


		// Load the parameters.
		$params = JComponentHelper::getParams('com_vwebadmin');
		$this->setState('params', $params);

		// List state information.
		parent::populateState('a.owner', 'asc');
	}

	/**
	 * Method to get a store id based on model configuration state.
	 *
	 * This is necessary because the model is used by the component and
	 * different modules that might need different sets of data or different
	 * ordering requirements.
	 *
	 * @param   string  $id  A prefix for the store id.
	 *
	 * @return   string A store id.
	 *
	 * @since    1.6
	 */
	protected function getStoreId($id = '')
	{
		// Compile the store id.
		$id .= ':' . $this->getState('filter.search');
		$id .= ':' . $this->getState('filter.state');

		return parent::getStoreId($id);
	}

	/**
	 * Build an SQL query to load the list data.
	 *
	 * @return   JDatabaseQuery
	 *
	 * @since    1.6
	 */
	protected function getListQuery()
	{
		// Create a new query object.
		$db    = $this->getDbo();
		$query = $db->getQuery(true);

		// Select the required fields from the table.
		$query->select(
			$this->getState(
				'list.select', 'DISTINCT a.*'
			)
		);
		$query->from('`#__vwebadmin_websites` AS a');

		// Join over the users for the checked out user
		$query->select("uc.name AS uEditor");
		$query->join("LEFT", "#__users AS uc ON uc.id=a.checked_out");
		// Join over the foreign key 'owner'
		$query->select('`#__vwebadmin_customers_2605615`.`company_name` AS klanten_fk_value_2605615');
		$query->join('LEFT', '#__vwebadmin_customers AS #__vwebadmin_customers_2605615 ON #__vwebadmin_customers_2605615.`related_user_account` = a.`owner`');
		// Join over the foreign key 'cms_guess'
		$query->select('`#__vwebadmin_website_cms_2619635`.`cms` AS cmstypen_fk_value_2619635');
		$query->join('LEFT', '#__vwebadmin_website_cms AS #__vwebadmin_website_cms_2619635 ON #__vwebadmin_website_cms_2619635.`id` = a.`cms_guess`');

		// Join over the user field 'created_by'
		$query->select('`created_by`.name AS `created_by`');
		$query->join('LEFT', '#__users AS `created_by` ON `created_by`.id = a.`created_by`');

		// Join over the user field 'modified_by'
		$query->select('`modified_by`.name AS `modified_by`');
		$query->join('LEFT', '#__users AS `modified_by` ON `modified_by`.id = a.`modified_by`');

		// Filter by published state
		$published = $this->getState('filter.state');

		if (is_numeric($published))
		{
			$query->where('a.state = ' . (int) $published);
		}
		elseif ($published === '')
		{
			$query->where('(a.state IN (0, 1))');
		}

		// Filter by search in title
		$search = $this->getState('filter.search');

		if (!empty($search))
		{
			if (stripos($search, 'id:') === 0)
			{
				$query->where('a.id = ' . (int) substr($search, 3));
			}
			else
			{
				$search = $db->Quote('%' . $db->escape($search, true) . '%');
				$query->where('(#__vwebadmin_customers_2605615.company_name LIKE ' . $search . ' )');
			}
		}


		//Filtering owner
		$filter_owner = $this->state->get("filter.owner");
		if ($filter_owner)
		{
			$query->where("a.`owner` = '".$db->escape($filter_owner)."'");
		}
		// Add the list ordering clause.
		$orderCol  = $this->state->get('list.ordering');
		$orderDirn = $this->state->get('list.direction');

		if ($orderCol && $orderDirn)
		{
			$query->order($db->escape($orderCol . ' ' . $orderDirn));
		}

		return $query;
	}

	/**
	 * Get an array of data items
	 *
	 * @return mixed Array of data items on success, false on failure.
	 */
	public function getItems()
	{
		$items = parent::getItems();

		foreach ($items as $oneItem) {

			if (isset($oneItem->owner))
			{
				$values = explode(',', $oneItem->owner);

				$textValue = array();
				foreach ($values as $value){
					$db = JFactory::getDbo();
					$query = $db->getQuery(true);
					$query
							->select('`#__vwebadmin_customers_2605615`.`company_name`')
							->from($db->quoteName('#__vwebadmin_customers', '#__vwebadmin_customers_2605615'))
							->where($db->quoteName('related_user_account') . ' = '. $db->quote($db->escape($value)));
					$db->setQuery($query);
					$results = $db->loadObject();
					if ($results) {
						$textValue[] = $results->company_name;
					}
				}

			$oneItem->owner = !empty($textValue) ? implode(', ', $textValue) : $oneItem->owner;

			}

			if (isset($oneItem->cms_guess))
			{
				$values = explode(',', $oneItem->cms_guess);

				$textValue = array();
				foreach ($values as $value){
					$db = JFactory::getDbo();
					$query = $db->getQuery(true);
					$query
							->select('`#__vwebadmin_website_cms_2619635`.`cms`')
							->from($db->quoteName('#__vwebadmin_website_cms', '#__vwebadmin_website_cms_2619635'))
							->where($db->quoteName('id') . ' = '. $db->quote($db->escape($value)));
					$db->setQuery($query);
					$results = $db->loadObject();
					if ($results) {
						$textValue[] = $results->cms;
					}
				}

			$oneItem->cms_guess = !empty($textValue) ? implode(', ', $textValue) : $oneItem->cms_guess;

			}
		}
		return $items;
	}
}
