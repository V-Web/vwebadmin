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
// No direct access
defined('_JEXEC') or die;

class Layer_sliderController extends JControllerLegacy
{
	/**
	 * Method to display a view.
	 *
	 * @param	boolean			$cachable	If true, the view output will be cached
	 * @param	array			$urlparams	An array of safe url parameters and their variable types, for valid values see {@link JFilterInput::clean()}.
	 *
	 * @return	JController		This object to support chaining.
	 * @since	1.5
	 */
	public function display($cachable = false, $urlparams = false)
	{

		$view		= JFactory::getApplication()->input->getCmd('view', 'sliders');
    JFactory::getApplication()->input->set('view', $view);

    if ($view != 'media') {
      require_once JPATH_COMPONENT.'/helpers/layer_slider.php';
    }

		parent::display($cachable, $urlparams);

		return $this;
	}

  public function add_new_slider($cachable = false, $urlparams = false){
    require_once JPATH_COMPONENT.'/helpers/layer_slider.php';
    $jinput = JFactory::getApplication()->input;

    $model = $this->getModel("slider"); // model

    if ($jinput->get("ls-add-new-slider",0,"INTEGER") == 1)
      $model->addNewSlider($jinput->get("title",0,"STRING"));


    $view		= JFactory::getApplication()->input->getCmd('view', 'sliders');
    JFactory::getApplication()->input->set('view', $view);
    parent::display($cachable, $urlparams);
    return $this;
  }

  public function duplicate_slider($cachable = false, $urlparams = false){
    require_once JPATH_COMPONENT.'/helpers/layer_slider.php';
    $jinput = JFactory::getApplication()->input;
    $model = $this->getModel("slider"); // model
    $model->duplicateSlider($jinput->get("id",0,"INTEGER"));

    $view		= JFactory::getApplication()->input->getCmd('view', 'sliders');
    JFactory::getApplication()->input->set('view', $view);
    parent::display($cachable, $urlparams);
    return $this;
  }

  public function manage_sliders($cachable = false, $urlparams = false){
    require_once JPATH_COMPONENT.'/helpers/layer_slider.php';
    $jinput = JFactory::getApplication()->input;
    $model = $this->getModel("sliders"); // model

    switch ($jinput->get("action",0,"STRING")) {
      case "remove":
        $model->removeSlider($jinput->get("sliders",$jinput->get("id",0,"ARRAY"),"ARRAY"));
      	break;
      case "delete":
        $model->deleteSlider($jinput->get("sliders",0,"ARRAY"));
      	break;
      case "restore":
        $model->restoreSlider($jinput->get("sliders",0,"ARRAY"));
      	break;
      case "merge":
        $model->mergeSliders($jinput->get("sliders",0,"ARRAY"));
      	break;
      case "createstatic":
        $model->createstaticSlider($jinput->get("sliders",0,"ARRAY"));
      	break;
      default:

    	break;
    }

    if ($jinput->get("ls-add-new-slider",0,"INTEGER") == 1)
      $model->addNewSlider($jinput->get("title",0,"STRING"));

    $view		= JFactory::getApplication()->input->getCmd('view', 'sliders');
    JFactory::getApplication()->input->set('view', $view);
    parent::display($cachable, $urlparams);
    return $this;
  }

  public function save_slider($cachable = false, $urlparams = false){

    require_once JPATH_COMPONENT.'/helpers/layer_slider.php';
    $model = $this->getModel("slider"); // model

    $model->saveSlider();

    $view		= JFactory::getApplication()->input->getCmd('view', 'sliders');
    JFactory::getApplication()->input->set('view', $view);
    parent::display($cachable, $urlparams);
    return $this;
  }

	public function import_slider($cachable = false, $urlparams = false){
    $jinput = JFactory::getApplication()->input;
    require_once JPATH_COMPONENT.'/helpers/layer_slider.php';

    $model = $this->getModel("sliders"); // model
    $model->importSlider();


    $view		= JFactory::getApplication()->input->getCmd('view', 'sliders');
    JFactory::getApplication()->input->set('view', $view);
    parent::display($cachable, $urlparams);
    return $this;
  }

	public function export_slider($cachable = false, $urlparams = false){
    $jinput = JFactory::getApplication()->input;
    require_once JPATH_COMPONENT.'/helpers/layer_slider.php';

    $model = $this->getModel("sliders"); // model
    $model->exportSlider();


    $view		= JFactory::getApplication()->input->getCmd('view', 'sliders');
    JFactory::getApplication()->input->set('view', $view);
    parent::display($cachable, $urlparams);
    return $this;
  }


	public function import_sample($cachable = false, $urlparams = false){
    $jinput = JFactory::getApplication()->input;
    require_once JPATH_COMPONENT.'/helpers/layer_slider.php';

    $model = $this->getModel("sliders"); // model
    $model->importSampleSlider($jinput->get("slider",0,"STRING"));


    $view		= JFactory::getApplication()->input->getCmd('view', 'sliders');
    JFactory::getApplication()->input->set('view', $view);
    parent::display($cachable, $urlparams);
    return $this;
  }

  public function download_slider($cachable = false, $urlparams = false){
    $jinput = JFactory::getApplication()->input;
    require_once JPATH_COMPONENT.'/helpers/layer_slider.php';

    $model = $this->getModel("sliders"); // model
    $model->downloadSlider($jinput->get('id', '', 'STRING'));

    $view   = JFactory::getApplication()->input->getCmd('view', 'sliders');
    JFactory::getApplication()->input->set('view', $view);
    parent::display($cachable, $urlparams);
    return $this;
  }

  public function save_advanced_settings($cachable = false, $urlparams = false){
    $jinput = JFactory::getApplication()->input;
    require_once JPATH_COMPONENT.'/helpers/layer_slider.php';
    $model = $this->getModel("sliders"); // model

    $settings = array();
    $settings['load_jquery'] = $jinput->get('load_jquery', 'off', 'STRING') == 'on' ? 1 : 0;
    $settings['load_fonts_dynamic'] = $jinput->get('load_fonts_dynamic', 'off', 'STRING') == 'on' ? 1 : 0;
    $settings['load_module'] = $jinput->get('load_module', 'off', 'STRING') == 'on' ? 1 : 0;
    $settings['load_uncompressed'] = $jinput->get('load_uncompressed', 'off', 'STRING') == 'on' ? 1 : 0;

    $model->saveAdvancedSetting($settings);

    $view = JFactory::getApplication()->input->getCmd('view', 'sliders');
    JFactory::getApplication()->input->set('view', $view);
    parent::display($cachable, $urlparams);
    return $this;
  }

  public function save_google_fonts($cachable = false, $urlparams = false){
    $jinput = JFactory::getApplication()->input;
    require_once JPATH_COMPONENT.'/helpers/layer_slider.php';
    $model = $this->getModel("sliders"); // model

    $model->saveGoogleFonts($jinput->get("urlParams",0,"ARRAY"));

    $view		= JFactory::getApplication()->input->getCmd('view', 'sliders');
    JFactory::getApplication()->input->set('view', $view);
    parent::display($cachable, $urlparams);
    return $this;
  }

  public function save_transitions($cachable = false, $urlparams = false){
    $jinput = JFactory::getApplication()->input;
    require_once JPATH_COMPONENT.'/helpers/layer_slider.php';
    $model = $this->getModel("transitions"); // transition builder

    $model->saveTransitions($jinput);

    $view		= JFactory::getApplication()->input->getCmd('view', 'sliders');
    JFactory::getApplication()->input->set('view', $view);
    parent::display($cachable, $urlparams);
    return $this;
  }

  public function save_skin($cachable = false, $urlparams = false){
    $jinput = JFactory::getApplication()->input;
    require_once JPATH_COMPONENT.'/helpers/layer_slider.php';
    $model = $this->getModel("skins"); // transition builder

    $model->saveSkin($jinput);

    $view		= JFactory::getApplication()->input->getCmd('view', 'sliders');
    JFactory::getApplication()->input->set('view', $view);
    parent::display($cachable, $urlparams);
    return $this;
  }

  public function save_style($cachable = false, $urlparams = false){
    $jinput = JFactory::getApplication()->input;
    require_once JPATH_COMPONENT.'/helpers/layer_slider.php';
    $model = $this->getModel("styles"); // transition builder

    $model->saveStyles($jinput);

    $view		= JFactory::getApplication()->input->getCmd('view', 'sliders');
    JFactory::getApplication()->input->set('view', $view);
    parent::display($cachable, $urlparams);
    return $this;
  }

  public function get_dynamiccontent($cachable = false, $urlparams = false){

    require_once JPATH_COMPONENT.'/helpers/layer_slider.php';
    $model = $this->getModel("generator"); // model

    $model->getDynamicContent();

    $view		= JFactory::getApplication()->input->getCmd('view', 'sliders');
    JFactory::getApplication()->input->set('view', $view);
    parent::display($cachable, $urlparams);
    return $this;
  }

  public function get_dynamicfilters($cachable = false, $urlparams = false){

    require_once JPATH_COMPONENT.'/helpers/layer_slider.php';
    $model = $this->getModel("generator"); // model

    $model->getDynamicFilters();

    $view		= JFactory::getApplication()->input->getCmd('view', 'sliders');
    JFactory::getApplication()->input->set('view', $view);
    parent::display($cachable, $urlparams);
    return $this;
  }

}
