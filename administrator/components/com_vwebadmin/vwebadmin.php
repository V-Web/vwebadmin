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

// Access check.
if (!JFactory::getUser()->authorise('core.manage', 'com_vwebadmin'))
{
	throw new Exception(JText::_('JERROR_ALERTNOAUTHOR'));
}

// Include dependancies
jimport('joomla.application.component.controller');

JLoader::registerPrefix('Vwebadmin', JPATH_COMPONENT_ADMINISTRATOR);

$controller = JControllerLegacy::getInstance('Vwebadmin');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
