<?php
/*-------------------------------------------------------------------------
# com_layer_slider - com_layer_slider
# -------------------------------------------------------------------------
# @ author    John Gera, George Krupa, Janos Biro, Balint Polgarfi
# @ copyright Copyright (C) 2015 Offlajn.com  All Rights Reserved.
# @ license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# @ website   http://www.offlajn.com
-------------------------------------------------------------------------*/
?><?php
// No direct access.
defined('_JEXEC') or die;

jimport('joomla.application.component.modeladmin');

/**
 * Layer_slider model.
 */
class Layer_sliderModelGenerator extends JModelAdmin
{
	/**
	 * @var		string	The prefix to use with controller messages.
	 * @since	1.6
	 */
	protected $text_prefix = 'COM_LAYER_SLIDER';


	/**
	 * Returns a reference to the a Table object, always creating it.
	 *
	 * @param	type	The table type to instantiate
	 * @param	string	A prefix for the table class name. Optional.
	 * @param	array	Configuration array for model. Optional.
	 * @return	JTable	A database object
	 * @since	1.6
	 */
	public function getForm($data = array(), $loadData = true)
	{
		return $form;
	}

  public function getDynamicContent(){
    $generator_name = $_POST['params']['generator_type'];

    if (strpos($generator_name,'.') !== false)
      die();

    if(is_dir(JPATH_COMPONENT.'/generators/'.$generator_name)){
      if (is_file(JPATH_COMPONENT.'/generators/'.$generator_name.'/generator.php')){
        require_once JPATH_COMPONENT.'/generators/'.$generator_name.'/generator.php';
        $class = 'OfflajnGenerator_'.$generator_name;
      }
    }
    $jinput = JFactory::getApplication()->input;
    $generator = new $class($jinput->post->get('params', null, null));
    echo json_encode($generator->getData());
    exit;
  }

  public function getDynamicFilters(){
    $generator_name = $_POST['params']['generator_type'];

    if (strpos($generator_name,'.') !== false)
      die();

    if(is_dir(JPATH_COMPONENT.'/generators/'.$generator_name)){
      if (is_file(JPATH_COMPONENT.'/generators/'.$generator_name.'/generator.php')){
        require_once JPATH_COMPONENT.'/generators/'.$generator_name.'/generator.php';
        $class = 'OfflajnGenerator_'.$generator_name;
      }
    }
    $jinput = JFactory::getApplication()->input;

//    print_r($jinput->post->get('params', null, null));exit;
    $generator = new $class($jinput->post->get('params', null, null));

    $result = array(
      "filters" => $generator->getFilters(),
      "orderby" => $generator->getOrderBys(),
      "taglist" => $generator->generateList()
    );

    echo json_encode($result);
    exit;
  }

}