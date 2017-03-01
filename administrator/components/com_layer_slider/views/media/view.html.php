<?php
/*-------------------------------------------------------------------------
# mod_layer_slider - Layer Slider
# -------------------------------------------------------------------------
# @ author    John Gera, George Krupa, Janos Biro, Balint Polgarfi
# @ copyright Copyright (C) 2016 Offlajn.com  All Rights Reserved.
# @ license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# @ website   http://www.offlajn.com
-------------------------------------------------------------------------*/
?><?php
// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

/**
 * View to edit
 */
class Layer_sliderViewMedia extends JViewLegacy
{

	/**
	 * Display the view
	 */
	public function display($tpl = null)
	{
		$this->session = JFactory::getSession();
		$this->config = JComponentHelper::getParams('com_media');
		//$this->require_ftp = !JClientHelper::hasCredentials('ftp');

		parent::display($tpl);
	}

}
