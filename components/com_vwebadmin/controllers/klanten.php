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

/**
 * Klanten list controller class.
 *
 * @since  1.6
 */
class VwebadminControllerKlanten extends VwebadminController
{
	/**
	 * Proxy for getModel.
	 *
	 * @param   string  $name    The model name. Optional.
	 * @param   string  $prefix  The class prefix. Optional
	 * @param   array   $config  Configuration array for model. Optional
	 *
	 * @return object	The model
	 *
	 * @since	1.6
	 */
	public function &getModel($name = 'Klanten', $prefix = 'VwebadminModel', $config = array())
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));

		return $model;
	}
}
