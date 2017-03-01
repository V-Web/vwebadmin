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

jimport('joomla.application.component.controllerform');

/**
 * Dashboard controller class.
 *
 * @since  1.6
 */
class VwebadminControllerDashboard extends JControllerForm
{
	/**
	 * Constructor
	 *
	 * @throws Exception
	 */
	public function __construct()
	{
		$this->view_list = 'dashboards';
		parent::__construct();
	}
}
