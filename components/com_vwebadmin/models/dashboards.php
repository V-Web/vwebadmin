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
class VwebadminModelDashboards extends JModelList
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
	 *
	 * @since    1.6
	 */
	protected function populateState($ordering = null, $direction = null)
	{
		$app  = JFactory::getApplication();
		$list = $app->getUserState($this->context . '.list');

		$ordering  = isset($list['filter_order'])     ? $list['filter_order']     : null;
		$direction = isset($list['filter_order_Dir']) ? $list['filter_order_Dir'] : null;

		$list['limit']     = (int) JFactory::getConfig()->get('list_limit', 20);
		$list['start']     = $app->input->getInt('start', 0);
		$list['ordering']  = $ordering;
		$list['direction'] = $direction;

		$app->setUserState($this->context . '.list', $list);
		$app->input->set('list', null);

		// List state information.
		parent::populateState($ordering, $direction);

        $app = JFactory::getApplication();

        $ordering  = $app->getUserStateFromRequest($this->context . '.ordercol', 'filter_order', $ordering);
        $direction = $app->getUserStateFromRequest($this->context . '.orderdirn', 'filter_order_Dir', $ordering);

        $this->setState('list.ordering', $ordering);
        $this->setState('list.direction', $direction);

        $start = $app->getUserStateFromRequest($this->context . '.limitstart', 'limitstart', 0, 'int');
        $limit = $app->getUserStateFromRequest($this->context . '.limit', 'limit', 0, 'int');

        if ($limit == 0)
        {
            $limit = $app->get('list_limit', 0);
        }

        $this->setState('list.limit', $limit);
        $this->setState('list.start', $start);
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
		$db	= $this->getDbo();
		$query	= $db->getQuery(true);

		return $query;
	}

	/**
	 * Method to get an array of data items
	 *
	 * @return  mixed An array of data on success, false on failure.
	 */
	public function getItems()
	{
		$items = parent::getItems();
		
		foreach ($items as $item)
		{
			if (isset($item->website) && $item->website != '')
			{
				if (is_object($item->website))
				{
					$item->website = \Joomla\Utilities\ArrayHelper::fromObject($item->website);
				}

				$values = (is_array($item->website)) ? $item->website : explode(',', $item->website);
				$textValue = array();

				foreach ($values as $value)
				{
					$db = JFactory::getDbo();
					$query = $db->getQuery(true);
					$query
							->select('`#__vwebadmin_websites_2605743`.`website`')
							->from($db->quoteName('#__vwebadmin_websites', '#__vwebadmin_websites_2605743'))
						->where($db->quoteName('id') . ' = ' . $db->quote($db->escape($value)));
					$db->setQuery($query);
					$results = $db->loadObject();

					if ($results)
					{
						$textValue[] = $results->website;
					}
				}

				$item->website = !empty($textValue) ? implode(', ', $textValue) : $item->website;
			}

		}

		return $items;
	}

	/**
	 * Overrides the default function to check Date fields format, identified by
	 * "_dateformat" suffix, and erases the field if it's not correct.
	 *
	 * @return void
	 */
	protected function loadFormData()
	{
		$app              = JFactory::getApplication();
		$filters          = $app->getUserState($this->context . '.filter', array());
		$error_dateformat = false;

		foreach ($filters as $key => $value)
		{
			if (strpos($key, '_dateformat') && !empty($value) && $this->isValidDate($value) == null)
			{
				$filters[$key]    = '';
				$error_dateformat = true;
			}
		}

		if ($error_dateformat)
		{
			$app->enqueueMessage(JText::_("COM_VWEBADMIN_SEARCH_FILTER_DATE_FORMAT"), "warning");
			$app->setUserState($this->context . '.filter', $filters);
		}

		return parent::loadFormData();
	}

	/**
	 * Checks if a given date is valid and in a specified format (YYYY-MM-DD)
	 *
	 * @param   string  $date  Date to be checked
	 *
	 * @return bool
	 */
	private function isValidDate($date)
	{
		$date = str_replace('/', '-', $date);
		return (date_create($date)) ? JFactory::getDate($date)->format("Y-m-d") : null;
	}
	public function getNomaintenance()
	{
		$user       = JFactory::getUser();
		$userId     = $user->get('id');
		// Create a new query object.
		$db    = $this->getDbo();
		$query = $db->getQuery(true);

		// Select the required fields from the table.
		$query
			->select(
				$this->getState(
					'list.select', 'DISTINCT a.*'
				)
			);

		$query->from('`#__vwebadmin_maintenance` AS a');
		
		// Join over the foreign key 'website'
		$query->select('`#__vwebadmin_websites_2605672`.`website` AS websites_fk_value_2605672');
		$query->join('LEFT', '#__vwebadmin_websites AS #__vwebadmin_websites_2605672 ON #__vwebadmin_websites_2605672.`id` = a.`website`');
		$query->where($db->quoteName('owner')." = ".$db->quote($userId));

		$db->setQuery($query);
		$db->execute();

		$num_rows = $db->getNumRows();

		return $num_rows;
	}
	public function getNohosting()
	{
		$user       = JFactory::getUser();
		$userId     = $user->get('id');
		// Create a new query object.
		$db    = $this->getDbo();
		$query = $db->getQuery(true);

		// Select the required fields from the table.
		$query
			->select(
				$this->getState(
					'list.select', 'DISTINCT a.*'
				)
			);

		$query->from('`#__vwebadmin_hosting` AS a');
		
		// Join over the foreign key 'website'
		$query->select('`#__vwebadmin_websites_2605672`.`website` AS websites_fk_value_2605672');
		$query->join('LEFT', '#__vwebadmin_websites AS #__vwebadmin_websites_2605672 ON #__vwebadmin_websites_2605672.`id` = a.`website`');
		$query->where($db->quoteName('owner')." = ".$db->quote($userId));

		$db->setQuery($query);
		$db->execute();

		$num_rows = $db->getNumRows();

		return $num_rows;
	}
	public function getNodomain()
	{
		$user       = JFactory::getUser();
		$userId     = $user->get('id');
		// Create a new query object.
		$db    = $this->getDbo();
		$query = $db->getQuery(true);

		// Select the required fields from the table.
		$query
			->select(
				$this->getState(
					'list.select', 'DISTINCT a.*'
				)
			);

		$query->from('`#__vwebadmin_domains` AS a');
		
		// Join over the foreign key 'website'
		$query->select('`#__vwebadmin_websites_2605672`.`website` AS websites_fk_value_2605672');
		$query->join('LEFT', '#__vwebadmin_websites AS #__vwebadmin_websites_2605672 ON #__vwebadmin_websites_2605672.`id` = a.`website`');
		$query->where($db->quoteName('owner')." = ".$db->quote($userId));

		$db->setQuery($query);
		$db->execute();

		$num_rows = $db->getNumRows();

		return $num_rows;
	}
}
