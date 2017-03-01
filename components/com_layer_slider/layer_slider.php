<?php
/*-------------------------------------------------------------------------
# com_layer_slider - com_layer_slider
# -------------------------------------------------------------------------
# @ author    John Gera, George Krupa, Janos Biro, Balint Polgarfi
# @ copyright Copyright (C) 2015 Offlajn.com  All Rights Reserved.
# @ license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# @ website   http://www.offlajn.com
-------------------------------------------------------------------------*/
$revision = '5.5.291';
$revision = '5.5.291';
?><?php
defined('_JEXEC') or die;

// Include dependancies
jimport('joomla.application.component.controller');

// Execute the task.
$controller	= JControllerLegacy::getInstance('Layer_slider');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
