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

/**
 * Vwebadmin helper.
 *
 * @since  1.6
 */
class VwebadminHelpersVwebadmin
{
	/**
	 * Configure the Linkbar.
	 *
	 * @param   string  $vName  string
	 *
	 * @return void
	 */
	public static function addSubmenu($vName = '')
	{
		JHtmlSidebar::addEntry(
			JText::_('COM_VWEBADMIN_TITLE_KLANTEN'),
			'index.php?option=com_vwebadmin&view=klanten',
			$vName == 'klanten'
		);

JHtmlSidebar::addEntry(
			JText::_('COM_VWEBADMIN_TITLE_WEBSITES'),
			'index.php?option=com_vwebadmin&view=websites',
			$vName == 'websites'
		);

JHtmlSidebar::addEntry(
			JText::_('COM_VWEBADMIN_TITLE_CMSTYPEN'),
			'index.php?option=com_vwebadmin&view=cmstypen',
			$vName == 'cmstypen'
		);

JHtmlSidebar::addEntry(
			JText::_('COM_VWEBADMIN_TITLE_CMSVERSIES'),
			'index.php?option=com_vwebadmin&view=cmsversies',
			$vName == 'cmsversies'
		);

JHtmlSidebar::addEntry(
			JText::_('COM_VWEBADMIN_TITLE_ONDERHOUDS'),
			'index.php?option=com_vwebadmin&view=onderhouds',
			$vName == 'onderhouds'
		);

JHtmlSidebar::addEntry(
			JText::_('COM_VWEBADMIN_TITLE_ONDERHOUDSPAKKETTEN'),
			'index.php?option=com_vwebadmin&view=onderhoudspakketten',
			$vName == 'onderhoudspakketten'
		);

JHtmlSidebar::addEntry(
			JText::_('COM_VWEBADMIN_TITLE_HOSTINGS'),
			'index.php?option=com_vwebadmin&view=hostings',
			$vName == 'hostings'
		);

JHtmlSidebar::addEntry(
			JText::_('COM_VWEBADMIN_TITLE_HOSTINGPAKKETTEN'),
			'index.php?option=com_vwebadmin&view=hostingpakketten',
			$vName == 'hostingpakketten'
		);

JHtmlSidebar::addEntry(
			JText::_('COM_VWEBADMIN_TITLE_DOMEINEN'),
			'index.php?option=com_vwebadmin&view=domeinen',
			$vName == 'domeinen'
		);

		JHtmlSidebar::addEntry(
			JText::_('COM_VWEBADMIN_TITLE_DASHBOARDS'),
			'index.php?option=com_vwebadmin&view=dashboards',
			$vName == 'dashboards'
		);
	}

	/**
	 * Gets the files attached to an item
	 *
	 * @param   int     $pk     The item's id
	 *
	 * @param   string  $table  The table's name
	 *
	 * @param   string  $field  The field's name
	 *
	 * @return  array  The files
	 */
	public static function getFiles($pk, $table, $field)
	{
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);

		$query
			->select($field)
			->from($table)
			->where('id = ' . (int) $pk);

		$db->setQuery($query);

		return explode(',', $db->loadResult());
	}

	/**
	 * Gets a list of the actions that can be performed.
	 *
	 * @return    JObject
	 *
	 * @since    1.6
	 */
	public static function getActions()
	{
		$user   = JFactory::getUser();
		$result = new JObject;

		$assetName = 'com_vwebadmin';

		$actions = array(
			'core.admin', 'core.manage', 'core.create', 'core.edit', 'core.edit.own', 'core.edit.state', 'core.delete'
		);

		foreach ($actions as $action)
		{
			$result->set($action, $user->authorise($action, $assetName));
		}

		return $result;
	}
}


class VwebadminHelper extends VwebadminHelpersVwebadmin
{

}
