<?php
/**
 * @version    CVS: 1.0.20
 * @package    Com_Vwebadmin
 * @author     Marcel Venema <marcel.venema@v-web.nl>
 * @copyright  2017 V-Web.nl
 * @license    GNU General Public License versie 2 of hoger; Zie LICENSE.txt
 */

defined('_JEXEC') or die;

// Include dependancies
jimport('joomla.application.component.controller');

JLoader::registerPrefix('Vwebadmin', JPATH_COMPONENT);
JLoader::register('VwebadminController', JPATH_COMPONENT . '/controller.php');


// Execute the task.
$controller = JControllerLegacy::getInstance('Vwebadmin');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
