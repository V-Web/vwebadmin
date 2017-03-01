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
class Layer_sliderModelSlider extends JModelAdmin
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

  public function addNewSlider($title){
    $id = LS_Sliders::add($title);
  	header('Location: index.php?option=com_layer_slider&view=slider&id='.$id.'&showsettings=1');
  	die();
  }

  public function saveSlider(){

  	// DB stuff
    $db = JFactory::getDbo();
    $user = JFactory::getUser();

		// Vars
		$id = (int) $_POST['id'];
		$settings = $slides = $callbacks = $data = array();

		$magic_quotes = get_magic_quotes_gpc();
		$root = rtrim(JURI::root(true), '/');
		$rootlen = strlen($root);

		// Decode data
		parse_str($_POST['settings'], $settings);
		parse_str($_POST['callbacks'], $callbacks);

		$bgimg = $settings['ls_data']['properties']['backgroundimage'];
		if ($rootlen && $bgimg && strpos($bgimg, $root) === 0) {
			$settings['ls_data']['properties']['backgroundimage'] = substr($bgimg, $rootlen);
		}
		$logo = $settings['ls_data']['properties']['yourlogo'];
		if ($rootlen && $logo && strpos($logo, $root) === 0) {
			$settings['ls_data']['properties']['yourlogo'] = substr($logo, $rootlen);
		}

		if(!empty($_POST['slides']) && is_array($_POST['slides'])) {
			foreach($_POST['slides'] as $key => $val) {
				$tmp = array();
				parse_str($val, $tmp);

				$background = $tmp['ls_data']['layers'][$key]['properties']['background'];
				if ($rootlen && $background && strpos($background, $root) === 0) {
					$tmp['ls_data']['layers'][$key]['properties']['background'] = substr($background, $rootlen);
				}
				$thumbnail = $tmp['ls_data']['layers'][$key]['properties']['thumbnail'];
				if ($rootlen && $thumbnail && strpos($thumbnail, $root) === 0) {
					$tmp['ls_data']['layers'][$key]['properties']['thumbnail'] = substr($thumbnail, $rootlen);
				}

				if (isset($tmp['ls_data']['layers'][$key]['sublayers'])) {
					foreach ($tmp['ls_data']['layers'][$key]['sublayers'] as &$sublayer) {
						if ($rootlen && $sublayer['image'] && strpos($sublayer['image'], $root) === 0) {
							$sublayer['image'] = substr($sublayer['image'], $rootlen);
						}

						if (!$magic_quotes) { // magic_quotes fix
							$sublayer['transition'] = addslashes($sublayer['transition']);
							$sublayer['styles'] = addslashes($sublayer['styles']);
						}
					}
				}
				$slides['ls_data']['layers'][$key] = $tmp['ls_data']['layers'][$key];
			}
		}
		$data = array_merge_recursive($settings, $slides, $callbacks);
		$data = $data['ls_data'];
		$title = $data['properties']['title'];
		$slug = !empty($data['properties']['slug']) ? $data['properties']['slug'] : '';

		// Relative URL
		if(isset($data['properties']['relativeurls'])) {
			require_once(JPATH_SITE.'/modules/mod_layer_slider/layer_slider_helper.php');
			$data = layerslider_convert_urls($data);
		}

  	// Save slider
    $query = $db->getQuery(true);

    // Create and populate an object.
    $datas = new stdClass();
    $datas->id = $id;
    $datas->author = $user->id;
    $datas->name = $db->escape($data['properties']['title']);
    $datas->slug = !empty($data['properties']['slug']) ? $db->escape($data['properties']['slug']) : '';
    $datas->data = json_encode($data);
    $datas->date_m =time();

    // Insert the object into the user profile table.
    $result = JFactory::getDbo()->updateObject('#__layerslider', $datas, 'id');

  	die(json_encode(array('status' => 'ok')));
  }

  public function duplicateSlider($id){

    $sliders = LS_Sliders::find($id);
    $slider = $sliders['data'];

  	// Name check
  	if(empty($slider['properties']['title'])) {
  		$slider['properties']['title'] = 'Unnamed';
  	}

  	// Insert the duplicate
  	$slider['properties']['title'] .= ' copy';

		// Save as new
		$name = $slider['properties']['title'];
		LS_Sliders::add($name, $slider);

  	// Reload page
  	header('Location: index.php?option=com_layer_slider');
  	die();
  }

	/**
	 * Prepare and sanitise the table prior to saving.
	 *
	 * @since	1.6
	 */
	protected function prepareTable($table)
	{
		jimport('joomla.filter.output');

		if (empty($table->id)) {

			// Set ordering to the last item if not set
			if (@$table->ordering === '') {
				$db = JFactory::getDbo();
				$db->setQuery('SELECT MAX(ordering) FROM slider');
				$max = $db->loadResult();
				$table->ordering = $max+1;
			}

		}
	}

}