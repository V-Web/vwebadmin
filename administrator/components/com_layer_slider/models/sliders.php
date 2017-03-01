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
defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');

if (!class_exists('ZipArchive')) {
	jimport( 'joomla.filesystem.archive' );
	class ZipArchive {

		const CREATE = 1;
		const OVERWRITE = 8;

		private $archive;
		private $mode;
		private $files;

		public function open($archive, $mode = 0) {
			$this->archive = $archive;
			$this->mode = $mode;
			$this->files = array();
			if (!$mode) return file_exists($archive);
		}

		public function extractTo($tmpDir) {
			if (!$this->mode) {
				$zip = JArchive::getAdapter('zip');
				return $zip->extract($this->archive, $tmpDir);
			}
		}

		public function addFromString($file, $data) {
			$this->files[] = array('name' => $file, 'data' => $data);
		}

		public function addFile($filepath, $file) {
			$this->files[] = array('name' => $file, 'data' => file_get_contents($filepath));
		}

		public function close() {
			if ($this->mode) {
				$zip = JArchive::getAdapter('zip');
				$zip->create($this->archive, $this->files);
			}
		}

	}
}

/**
 * Methods supporting a list of Layer_slider records.
 */
class Layer_sliderModelSliders extends JModelList {

	/**
	 * Constructor.
	 *
	 * @param    array    An optional associative array of configuration settings.
	 * @see        JController
	 * @since    1.6
	 */
	public function __construct($config = array()) {
		if (empty($config['filter_fields'])) {
			$config['filter_fields'] = array();
		}

		parent::__construct($config);
	}

	/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 */
	protected function populateState($ordering = null, $direction = null) {
		// Initialise variables.
		$app = JFactory::getApplication('administrator');

		// Load the filter state.
		$search = $app->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
		$this->setState('filter.search', $search);

		$published = $app->getUserStateFromRequest($this->context . '.filter.state', 'filter_published', '', 'string');
		$this->setState('filter.state', $published);

		// Load the parameters.
		$params = JComponentHelper::getParams('com_layer_slider');
		$this->setState('params', $params);

		// List state information.
		parent::populateState('a.id', 'asc');
	}

	/**
	 * Method to get a store id based on model configuration state.
	 *
	 * This is necessary because the model is used by the component and
	 * different modules that might need different sets of data or different
	 * ordering requirements.
	 *
	 * @param	string		$id	A prefix for the store id.
	 * @return	string		A store id.
	 * @since	1.6
	 */
	protected function getStoreId($id = '') {
		// Compile the store id.
		$id.= ':' . $this->getState('filter.search');
		$id.= ':' . $this->getState('filter.state');

		return parent::getStoreId($id);
	}


	public function importSampleSlider($slider){
		include LS_ROOT_PATH.'/classes/class.ls.importutil.php';

		// Check reference
		if(!empty($_GET['slider']) && $_GET['slider'] == 'all') {
			foreach(glob(LS_ROOT_PATH.'/demos/*') as $item) {
				$item = basename($item);
				if(substr($item, strrpos($item, '.')+1) == 'zip') {
					$import = new LS_ImportUtil(LS_ROOT_PATH.'/demos/'.basename($item));
				}
			}
		} elseif(!empty($_GET['slider']) && is_string($_GET['slider'])) {
			if(file_exists(LS_ROOT_PATH.'/demos/'.basename($_GET['slider']))) {
				$import = new LS_ImportUtil(LS_ROOT_PATH.'/demos/'.basename($_GET['slider']));
			}
		}

		header('Location: index.php?option=com_layer_slider');
		die();
	}

	public function downloadSlider($id){
		$app = JFactory::getApplication();
		$source = 'http://offlajn.com/index2.php?option=com_ls_import&task=download&id='.$id;
		$error = '';
		$curl = function_exists('curl_version');
		$allow_url_fopen = ini_get('allow_url_fopen');

		if ($curl || $allow_url_fopen) {
			set_time_limit(300);
			// create file
			$destination = JFactory::getConfig()->get('tmp_path', sys_get_temp_dir()) .'/'. basename($id) .'.zip';
			$file = fopen($destination, 'wb');
			$data = false;

			if ($curl) {
				$ch = curl_init($source);
				$sn = strtolower($_SERVER['SERVER_NAME']);
				if (preg_match('/^([-\w]+\.)*[-\w]+\.[a-z]{2,14}$/', $sn) || (preg_match('/^(\d{1,3}\.){3}\d{1,3}$/', $sn) && strpos($sn, '192.168') !== 0)) {
					curl_setopt($ch, CURLOPT_INTERFACE, $sn);
				}
				curl_setopt($ch, CURLOPT_TIMEOUT, 300);
				curl_setopt($ch, CURLOPT_FILE, $file);
				$data = curl_exec($ch);
				if ($errno = curl_errno($ch)) {
					$error = "Error $errno - ".curl_error($ch);
				}
				curl_close($ch);
			}
			if (!$data && $allow_url_fopen) {
				if ($data = @file_get_contents($source))
					fputs($file, $data);
				else
					$error.= '<p>Error during file_get_contents</p>';
			}

			fclose($file);

			if ($data) {
				if (file_exists($destination)) {
					// import file
					include LS_ROOT_PATH.'/classes/class.ls.importutil.php';
					$import = new LS_ImportUtil($destination);
					@unlink($destination);
					// redirect after import
					$app->redirect('index.php?option=com_layer_slider&view=slider&id='.$import->slider_id);
				} else {
					$error = 'Unable to write file: '.$destination;
				}
			}
		} else {
			$error = 'Please install cURL or enable allow_url_fopen for importing!';
		}
		// display error
		$app->enqueueMessage($error ? $error : 'Unknown error!', 'error');
		$app->redirect('index.php?option=com_layer_slider');
	}

	public function importSlider(){
		// Check export file if any
		if(!is_uploaded_file($_FILES['import_file']['tmp_name'])) {
			header('Location: '.$_SERVER['REQUEST_URI'].'&error=1&message=importSelectError');
			die('No data received.');
		}

		include LS_ROOT_PATH.'/classes/class.ls.importutil.php';
		$import = new LS_ImportUtil($_FILES['import_file']['tmp_name'], $_FILES['import_file']['name']);

		header('Location: index.php?option=com_layer_slider');
		die();
	}

	public function exportSlider(){

		if(isset($_POST['sliders'][0]) && $_POST['sliders'][0] == -1) {
			$sliders = LS_Sliders::find(array('limit' => 200));
		} elseif(!empty($_POST['sliders'])) {
			$sliders = LS_Sliders::find($_POST['sliders']);
		} else {
//		header('Location: admin.php?page=layerslider&error=1&message=exportSelectError');
			die('Invalid data received.');
		}

		if(class_exists('ZipArchive')) {
			include LS_ROOT_PATH.'/classes/class.ls.exportutil.php';
			$zip = new LS_ExportUtil;
		}

		foreach($sliders as $item) {

			// get slider fonts
			$fonts = array();
			foreach ($item['data']['layers'] as $layer) {
				if (isset($layer['sublayers'])) foreach ($layer['sublayers'] as $sublayer) {
					if (!empty($sublayer['styles'])) {
						$styles = json_decode($sublayer['styles'], true);
						if ($styles === null) $styles = json_decode(stripslashes($sublayer['styles']), true);

						if (!empty($styles['font-family'])) {
							list($family) = explode(',', $styles['font-family']);
							$family = trim( preg_replace('/[^\w ]/', '', $family) );
							if ($family) $fonts[ strtolower($family) ] = true;
						}
					}
				}
			}

			// get google fonts
			$googlefonts = array();
			foreach (jols_get_option('ls-google-fonts', array()) as $font) {
				list($family, $weights) = explode(':', $font['param']);
				$family = strtolower( str_replace('+', ' ', $family) );

				if (isset($fonts[$family])) {
					$font['admin'] = false;
					$googlefonts[] = $font;
				}
			}

			// add google-fonts to data
			$item['data']['googlefonts'] = &$googlefonts;

			// Slider settings array for fallback mode
			$data[] = $item['data'];

			// If ZipArchive is available
			if(class_exists('ZipArchive')) {
				// Add slider folder and settings.json
				$name = jols_sanitize_file_name($item['name']);
				$zip->addSettings(json_encode($item['data']), $name);
				// Add images?
				if(isset($_POST['exportWithImages'])) {
					$images = $zip->getImagesForSlider($item['data']);
					$images = $zip->getFSPaths($images);
					$zip->addImage($images, $name);
				}
			}
		}

		if(class_exists('ZipArchive')) {
			$zip->download();
		} else {
			$name = 'LayerSlider Export '.date('Y-m-d').' at '.date('H.i.s').'.json';
			header('Content-type: application/force-download');
			header('Content-Disposition: attachment; filename="'.str_replace(' ', '_', $name).'"');
			die( call_user_func('base'.'64_encode', json_encode($data)) );
		}

	}

	public function removeSlider($ids) {
		foreach ($ids as $id) {
			// Check received data
			if(empty($id)) { return false; }
			// Remove the slider
			LS_Sliders::remove( intval($id) );
		}

		// Reload page
		header('Location: index.php?option=com_layer_slider');
		die();
	}

	public function deleteSlider($ids) {

		foreach ($ids as $id) {
			// Check received data
			if(empty($id)) { return false; }
			// Remove the slider
			LS_Sliders::delete( intval($id) );
		}

		// Reload page
		header('Location: index.php?option=com_layer_slider');
		die();
	}

	public function restoreSlider($ids) {

		foreach ($ids as $id) {
			// Check received data
			if(empty($id)) { return false; }
			// Remove the slider
			LS_Sliders::restore( intval($id) );
		}

		// Reload page
		header('Location: index.php?option=com_layer_slider');
		die();
	}

	public function mergeSliders($ids) {
		if($sliders = LS_Sliders::find($ids)) {
			foreach($sliders as $key => $item) {

				// Get IDs
				$ids[] = '#' . $item['id'];

				// Merge slides
				if($key === 0) { $data = $item['data']; }
				else { $data['layers'] = array_merge($data['layers'], $item['data']['layers']); }
			}

			// Save as new
			$name = 'Merged sliders of ' . implode(', ', $ids);
			$data['properties']['title'] = $name;
			LS_Sliders::add($name, $data);
		}

		// Reload page
		header('Location: index.php?option=com_layer_slider');
		die();
	}

	public function createstaticSlider($ids) {
		if($sliders = LS_Sliders::find($ids)) {
			foreach($sliders as $key => &$item) {

				// Get IDs
				$ids[] = '#' . $item['id'];
				if(!isset($item['data']['properties']['generator_type'])) continue;
				$gen = $item['data']['properties']['generator_type'];

				if(is_dir(JPATH_ADMINISTRATOR.'/components/com_layer_slider/generators/'.$gen)){

					if (is_file(JPATH_ADMINISTRATOR.'/components/com_layer_slider/generators/'.$gen.'/generator.php')){
						require_once JPATH_ADMINISTRATOR.'/components/com_layer_slider/generators/'.$gen.'/generator.php';
						$class = 'OfflajnGenerator_'.$gen;
						$generator = new $class($item['data']['properties']);
					}
				}
				$postContent = $generator;
				$queryArgs = array();

				foreach($item['data']['layers'] as $slidekey => &$slide) {
					if(isset($slide['properties']['post_offset'])) {
						if($slide['properties']['post_offset'] == -1) {
							$slide['properties']['post_offset'] = $slidekey;
						}

						$queryArgs['properties'] = $slide['properties']['post_offset'];
					}
					$postContent->setSliderCounter($queryArgs['properties']);

					if($slide['properties']['background'] == '[image-url]') {
						$slide['properties']['background'] = $postContent->getWithFormat($slide['properties']['background']);
					}

					if(!empty($slide['sublayers']) && is_array($slide['sublayers'])) {
						foreach($slide['sublayers'] as $layerkey => &$layer) {
							if(!empty($layer['media']) && $layer['media'] == 'post') {
								$layer['post_text_length'] = !empty($layer['post_text_length']) ? $layer['post_text_length'] : 0;
								$layer['html'] = $postContent->getWithFormat($layer['html'], $layer['post_text_length']);
							}

							if($layer['url'] == '[url]') {
								$layer['url'] = $postContent->getWithFormat($layer['url']);
							}

							if($layer['background'] == '[image-url]') {
								$layer['background'] = $postContent->getWithFormat($layer['background']);
							}

							if($layer['image'] == '[image-url]') {
								$src = $postContent->getWithFormat($layer['image']);
							}
					 }
					}
					if($slide['linkUrl'] == '[url]') {
						$slide['linkUrl'] = $postContent->getWithFormat($slide['linkUrl']);
					}

				}

				$name = 'Static slider of #' . $item['id'];
				$data['properties'] = $item['data']['properties'];
				$data['properties']['title'] = $name;
				$data['layers'] = $item['data']['layers'];

				LS_Sliders::add($name, $data);
			}

			// Save as new
		}

		// Reload page
		header('Location: index.php?option=com_layer_slider');
		die();
	}


		/**
		 * Build an SQL query to load the list data.
		 *
		 * @return	JDatabaseQuery
		 * @since	1.6
		 */
	protected function getListQuery() {
		$db		= $this->getDbo();
		$query	= $db->getQuery(true);
		return $query;
	}

	public function getItems() {
		$items = parent::getItems();
		return $items;
	}

	public function saveGoogleFonts($urlParams){
		// Build object to save
		$fonts = array();
		if(isset($urlParams)) {
			foreach($urlParams as $key => $val) {
				if(!empty($val)) {
					$fonts[] = array(
						'param' => $val,
						'admin' => isset($_POST['onlyOnAdmin'][$key]) ? true : false
					);
				}
			}
		}

		// Google Fonts character sets
		array_shift($_POST['scripts']);
		jols_update_option('ls-google-font-scripts', $_POST['scripts']);

		// Save & redirect back
		jols_update_option('ls-google-fonts', $fonts);
		header('Location: index.php?option=com_layer_slider');

		return false;
	}

	public function saveAdvancedSetting(&$settings){
		foreach ($settings as $name => $data) {
			jols_update_option($name, $data);
		}
		header('Location: index.php?option=com_layer_slider');
	}


}
