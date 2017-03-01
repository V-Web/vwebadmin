<?php

/**
 * @version    CVS: 1.0.20
 * @package    Com_Vwebadmin
 * @author     Marcel Venema <marcel.venema@v-web.nl>
 * @copyright  2017 V-Web.nl
 * @license    GNU General Public License versie 2 of hoger; Zie LICENSE.txt
 */
// No direct access.
defined('_JEXEC') or die;

jimport('joomla.application.component.modelitem');
jimport('joomla.event.dispatcher');

use Joomla\Utilities\ArrayHelper;
/**
 * Vwebadmin model.
 *
 * @since  1.6
 */
class VwebadminModelOnderhoud extends JModelItem
{
	/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @return void
	 *
	 * @since    1.6
	 *
	 */
	protected function populateState()
	{
		$app  = JFactory::getApplication('com_vwebadmin');
        $user = JFactory::getUser();

        // Check published state
        if ((!$user->authorise('core.edit.state', 'com_vwebadmin')) && (!$user->authorise('core.edit', 'com_vwebadmin')))
        {
            $this->setState('filter.published', 1);
            $this->setState('fileter.archived', 2);
        }

		// Load state from the request userState on edit or from the passed variable on default
		if (JFactory::getApplication()->input->get('layout') == 'edit')
		{
			$id = JFactory::getApplication()->getUserState('com_vwebadmin.edit.onderhoud.id');
		}
		else
		{
			$id = JFactory::getApplication()->input->get('id');
			JFactory::getApplication()->setUserState('com_vwebadmin.edit.onderhoud.id', $id);
		}

		$this->setState('onderhoud.id', $id);

		// Load the parameters.
		$params       = $app->getParams();
		$params_array = $params->toArray();

		if (isset($params_array['item_id']))
		{
			$this->setState('onderhoud.id', $params_array['item_id']);
		}

		$this->setState('params', $params);
	}

	/**
	 * Method to get an object.
	 *
	 * @param   integer  $id  The id of the object to get.
	 *
	 * @return  mixed    Object on success, false on failure.
	 */
	public function &getData($id = null)
	{
		if ($this->_item === null)
		{
			$this->_item = false;

			if (empty($id))
			{
				$id = $this->getState('onderhoud.id');
			}

			// Get a level row instance.
			$table = $this->getTable();

			// Attempt to load the row.
			if ($table->load($id))
			{
				// Check published state.
				if ($published = $this->getState('filter.published'))
				{
					if (isset($table->state) && $table->state != $published)
					{
						throw new Exception(JText::_('COM_VWEBADMIN_ITEM_NOT_LOADED'), 403);
					}
				}

				// Convert the JTable to a clean JObject.
				$properties  = $table->getProperties(1);
				$this->_item = ArrayHelper::toObject($properties, 'JObject');
			}
		}

		

			if (isset($this->_item->website) && $this->_item->website != '') {
				if (is_object($this->_item->website))
				{
					$this->_item->website = \Joomla\Utilities\ArrayHelper::fromObject($this->_item->website);
				}
				$values = (is_array($this->_item->website)) ? $this->_item->website : explode(',',$this->_item->website);

				$textValue = array();
				foreach ($values as $value)
				{
					$db = JFactory::getDbo();
					$query = $db->getQuery(true);
					$query
						->select('`#__vwebadmin_websites_2605672`.`website`')
						->from($db->quoteName('#__vwebadmin_websites', '#__vwebadmin_websites_2605672'))
						->where($db->quoteName('id') . ' = ' . $db->quote($db->escape($value)));
					$db->setQuery($query);
					$results = $db->loadObject();
					if ($results) {
						$textValue[] = $results->website;
					}
				}


			}

			if (isset($this->_item->package) && $this->_item->package != '') {
				if (is_object($this->_item->package))
				{
					$this->_item->package = \Joomla\Utilities\ArrayHelper::fromObject($this->_item->package);
				}
				$values = (is_array($this->_item->package)) ? $this->_item->package : explode(',',$this->_item->package);

				$textValue = array();
				foreach ($values as $value)
				{
					$db = JFactory::getDbo();
					$query = $db->getQuery(true);
					$query
						->select('`#__vwebadmin_maintenance_package_2605711`.`package_name`')
						->from($db->quoteName('#__vwebadmin_maintenance_package', '#__vwebadmin_maintenance_package_2605711'))
						->where($db->quoteName('id') . ' = ' . $db->quote($db->escape($value)));
					$db->setQuery($query);
					$results = $db->loadObject();
					if ($results) {
						$textValue[] = $results->package_name;
					}
				}

			//$this->_item->package = !empty($textValue) ? implode(', ', $textValue) : $this->_item->package;

			}

			if (isset($this->_item->cms) && $this->_item->cms != '') {
				if (is_object($this->_item->cms))
				{
					$this->_item->cms = \Joomla\Utilities\ArrayHelper::fromObject($this->_item->cms);
				}
				$values = (is_array($this->_item->cms)) ? $this->_item->cms : explode(',',$this->_item->cms);

				$textValue = array();
				foreach ($values as $value)
				{
					$db = JFactory::getDbo();
					$query = $db->getQuery(true);
					$query
						->select('`#__vwebadmin_website_cms_2619000`.`cms`')
						->from($db->quoteName('#__vwebadmin_website_cms', '#__vwebadmin_website_cms_2619000'))
						->where($db->quoteName('id') . ' = ' . $db->quote($db->escape($value)));
					$db->setQuery($query);
					$results = $db->loadObject();
					if ($results) {
						$textValue[] = $results->cms;
					}
				}

			//$this->_item->cms = !empty($textValue) ? implode(', ', $textValue) : $this->_item->cms;

			}

			if (isset($this->_item->cms_version) && $this->_item->cms_version != '') {
				if (is_object($this->_item->cms_version))
				{
					$this->_item->cms_version = \Joomla\Utilities\ArrayHelper::fromObject($this->_item->cms_version);
				}
				$values = (is_array($this->_item->cms_version)) ? $this->_item->cms_version : explode(',',$this->_item->cms_version);

				$textValue = array();
				foreach ($values as $value)
				{
					$db = JFactory::getDbo();
					$query = $db->getQuery(true);
					$query
						->select('`#__vwebadmin_website_cms_version_2619002`.`version`')
						->from($db->quoteName('#__vwebadmin_website_cms_version', '#__vwebadmin_website_cms_version_2619002'))
						->where($db->quoteName('id') . ' = ' . $db->quote($db->escape($value)));
					$db->setQuery($query);
					$results = $db->loadObject();
					if ($results) {
						$textValue[] = $results->version;
					}
				}

			//$this->_item->cms_version = !empty($textValue) ? implode(', ', $textValue) : $this->_item->cms_version;

			}if (isset($this->_item->created_by) )
		{
			$this->_item->created_by_name = JFactory::getUser($this->_item->created_by)->name;
		}if (isset($this->_item->modified_by) )
		{
			$this->_item->modified_by_name = JFactory::getUser($this->_item->modified_by)->name;
		}

		return $this->_item;
	}

	/**
	 * Get an instance of JTable class
	 *
	 * @param   string  $type    Name of the JTable class to get an instance of.
	 * @param   string  $prefix  Prefix for the table class name. Optional.
	 * @param   array   $config  Array of configuration values for the JTable object. Optional.
	 *
	 * @return  JTable|bool JTable if success, false on failure.
	 */
	public function getTable($type = 'Onderhoud', $prefix = 'VwebadminTable', $config = array())
	{
		$this->addTablePath(JPATH_ADMINISTRATOR . '/components/com_vwebadmin/tables');

		return JTable::getInstance($type, $prefix, $config);
	}

	/**
	 * Get the id of an item by alias
	 *
	 * @param   string  $alias  Item alias
	 *
	 * @return  mixed
	 */
	public function getItemIdByAlias($alias)
	{
		$table = $this->getTable();

		$table->load(array('alias' => $alias));

		return $table->id;
	}

	/**
	 * Method to check in an item.
	 *
	 * @param   integer  $id  The id of the row to check out.
	 *
	 * @return  boolean True on success, false on failure.
	 *
	 * @since    1.6
	 */
	public function checkin($id = null)
	{
		// Get the id.
		$id = (!empty($id)) ? $id : (int) $this->getState('onderhoud.id');

		if ($id)
		{
			// Initialise the table
			$table = $this->getTable();

			// Attempt to check the row in.
			if (method_exists($table, 'checkin'))
			{
				if (!$table->checkin($id))
				{
					return false;
				}
			}
		}

		return true;
	}

	/**
	 * Method to check out an item for editing.
	 *
	 * @param   integer  $id  The id of the row to check out.
	 *
	 * @return  boolean True on success, false on failure.
	 *
	 * @since    1.6
	 */
	public function checkout($id = null)
	{
		// Get the user id.
		$id = (!empty($id)) ? $id : (int) $this->getState('onderhoud.id');

		if ($id)
		{
			// Initialise the table
			$table = $this->getTable();

			// Get the current user object.
			$user = JFactory::getUser();

			// Attempt to check the row out.
			if (method_exists($table, 'checkout'))
			{
				if (!$table->checkout($user->get('id'), $id))
				{
					return false;
				}
			}
		}

		return true;
	}

	/**
	 * Get the name of a category by id
	 *
	 * @param   int  $id  Category id
	 *
	 * @return  Object|null	Object if success, null in case of failure
	 */
	public function getCategoryName($id)
	{
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query
			->select('title')
			->from('#__categories')
			->where('id = ' . $id);
		$db->setQuery($query);

		return $db->loadObject();
	}

	/**
	 * Publish the element
	 *
	 * @param   int  $id     Item id
	 * @param   int  $state  Publish state
	 *
	 * @return  boolean
	 */
	public function getOwner($id = '')
	{
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query
			->select(array('a.website','a.owner'))
			->from($db->quoteName('#__vwebadmin_websites','a'))
			->where($db->quoteName('a.id') . ' = ' . $db->quote($db->escape($id)));

		$db->setQuery($query);
		$owner = $db->loadAssoc();

		return $owner;
	}
	public function getCms($id = '')
	{

		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query
			->select('*')
			->from($db->quoteName('#__vwebadmin_website_cms'))		
			->where($db->quoteName('#__vwebadmin_website_cms.id') . ' = ' . $db->quote($db->escape($id)));

		$db->setQuery($query);
		$cms = $db->loadAssoc();

		return $cms;
	}
	public function getCmsversion($id = '')
	{

		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query
			->select('*')
			->from($db->quoteName('#__vwebadmin_website_cms_version'))		
			->where($db->quoteName('#__vwebadmin_website_cms_version.id') . ' = ' . $db->quote($db->escape($id)));

		$db->setQuery($query);
		$cmsversion = $db->loadAssoc();

		return $cmsversion;
	}
	public function getMaintenancepackage($id = '')
	{

		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query
			->select('*')
			->from($db->quoteName('#__vwebadmin_maintenance_package'))		
			->where($db->quoteName('#__vwebadmin_maintenance_package.id') . ' = ' . $db->quote($db->escape($id)));

		$db->setQuery($query);
		$mpackage = $db->loadAssoc();

		return $mpackage;
	}
	public function getHosting($id = '')
	{

		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query
			->select('*')
			->from($db->quoteName('#__vwebadmin_hosting','a'))
			//->join('INNER', $db->quoteName('#__vwebadmin_maintenance') . ' ON (' . $db->quoteName('a.id') . ' = ' . $db->quoteName('#__vwebadmin_maintenance.website') . ')')
			->join('INNER', $db->quoteName('#__vwebadmin_hosting_package') . ' ON (' . $db->quoteName('a.package') . ' = ' . $db->quoteName('#__vwebadmin_hosting_package.id') . ')')
			->where($db->quoteName('a.website') . ' = ' . $db->quote($db->escape($id)));

		$db->setQuery($query);
		$hosting = $db->loadAssoc();

		return $hosting;
	}
	public function getDomain($id = '')
	{

		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query
			->select('*')
			->from($db->quoteName('#__vwebadmin_domains','a'))
			//->join('INNER', $db->quoteName('#__vwebadmin_maintenance') . ' ON (' . $db->quoteName('a.id') . ' = ' . $db->quoteName('#__vwebadmin_maintenance.website') . ')')
			//->join('INNER', $db->quoteName('#__vwebadmin_hosting_package') . ' ON (' . $db->quoteName('a.package') . ' = ' . $db->quoteName('#__vwebadmin_hosting_package.id') . ')')
			->where($db->quoteName('a.website') . ' = ' . $db->quote($db->escape($id)));

		$db->setQuery($query);
		$domain = $db->loadAssoc();

		return $domain;
	}
	public function getSitename($id = '')
	{

		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query
			->select('#__vwebadmin_websites.website')
			->from($db->quoteName('#__vwebadmin_websites'))
			->join('INNER', $db->quoteName('#__vwebadmin_maintenance') . ' ON (' . $db->quoteName('#__vwebadmin_websites.id') . ' = ' . $db->quoteName('#__vwebadmin_maintenance.website') . ')')
			->where($db->quoteName('#__vwebadmin_maintenance.website') . ' = ' . $db->quote($db->escape($id)));

		$db->setQuery($query);
		$db->execute();

		$websitename = $db->loadResult();

		return $websitename;
	}
	public function Mailinfo($id = '')
	{

		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query
			->select('b.website')
			->from($db->quoteName('#__vwebadmin_maintenance','a'))
			->join('INNER', $db->quoteName('#__vwebadmin_websites','b') . ' ON (' . $db->quoteName('a.website') . ' = ' . $db->quoteName('b.id') . ')')
			
			->select('c.cms')
			->join('LEFT', $db->quoteName('#__vwebadmin_website_cms','c') . ' ON (' . $db->quoteName('a.cms') . ' = ' . $db->quoteName('c.id') . ')')

			->select(array('d.version','d.changelog','d.changelog_link'))
			->join('INNER', $db->quoteName('#__vwebadmin_website_cms_version','d') . ' ON (' . $db->quoteName('a.cms_version') . ' = ' . $db->quoteName('d.id') . ')')

			->select(array('e.name','e.email'))
			->join('LEFT', $db->quoteName('#__users','e') . ' ON (' . $db->quoteName('b.owner') . ' = ' . $db->quoteName('e.id') . ')')

			->where($db->quoteName('a.website') . ' = ' . $db->quote($db->escape($id)));
			
		$db->setQuery($query);
		$mailinfo = $db->loadAssoc();

		return $mailinfo;
	}
	public function publish($id, $state)
	{
		$table = $this->getTable();
		$table->load($id);
		$table->state = $state;

		return $table->store();
	}

	/**
	 * Method to delete an item
	 *
	 * @param   int  $id  Element id
	 *
	 * @return  bool
	 */
	public function delete($id)
	{
		$table = $this->getTable();

		return $table->delete($id);
	}

	
}
