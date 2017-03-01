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

class LS_ImportUtil {

	/**
	 * The managed ZipArchieve instance.
	 */
	private $zip;

	/**
	 * Target folders
	 */
	private $targetDir, $targetURL, $tmpDir;

	// Imported images
	private $imported = array();


	// Accepts $_FILES
	public function __construct($archive, $name = null) {

		if(empty($name)) {
			$name = $archive;
		}

		// TODO: check file extension to support old import method
		$type = jols_check_filetype(basename($name), array(
			'zip' => 'application/zip',
			'json' => 'application/json'
		));

		// Check for ZIP
		if(!empty($type['ext']) && $type['ext'] == 'zip') {
			if(class_exists('ZipArchive')) {

				// Remove previous uploads (if any)
				$this->cleanup();

				// Extract ZIP
				$this->zip = new ZipArchive;

				if($this->zip->open($archive)) {
					if($this->unpack($archive)) {

						// Uploaded folders
						foreach(glob($this->tmpDir.'/*', GLOB_ONLYDIR) as $key => $dir) {

							$this->imported = array();
							$this->uploadMedia($dir);

							if(file_exists($dir.'/settings.json')) {
								$this->slider_id = $this->addSlider($dir.'/settings.json');
							}
						}

						// Finishing up
						$this->cleanup();
						return true;
					}

					// Close ZIP
					$this->zip->close();
				}
			} else {
				return false;
			}


		// Check for JSON
		} elseif(!empty($type['ext']) && $type['ext'] == 'json') {

			// Get decoded file data
			$data = file_get_contents($archive);
			if($decoded = call_user_func('base'.'64_decode', $data, true)) {
				if(!$parsed = json_decode($decoded, true)) {
					$parsed = unserialize($decoded);
				}

			// Since v5.1.1
			} else {
				$parsed = array(json_decode($data, true));
			}

			// Iterate over imported sliders
			if(is_array($parsed)) {

				// Import sliders
				foreach($parsed as $item) {

					// Fix for export issue in v4.6.4
					if(is_string($item)) { $item = json_decode($item, true); }

					LS_Sliders::add($item['properties']['title'], $item);
				}
			}
		}

		// Return false otherwise
		return false;
	}



	public function unpack($archive) {

		// Get uploads folder
		$uploads = jols_upload_dir();

		// Check if /uploads dir is writable
		if(is_writable($uploads['basedir'])) {

			// Get target folders
			$this->targetDir = $targetDir = $uploads['basedir'].'/layerslider';
			$this->root = rtrim(JURI::root(true), '/');
			$this->targetURL = $this->root.'/images/layerslider';
			$this->tmpDir = $tmpDir = $uploads['basedir'].'/layerslider/tmp';

			// Create necessary folders under /uploads
			if(!file_exists($targetDir)) { mkdir($targetDir, 0755); }
			if(!file_exists($targetDir)) { mkdir($targetDir, 0755); }

			// Unpack archive
			if($this->zip->extractTo($tmpDir)) {
				return true;
			}
		}

		return false;
	}




	public function uploadMedia($dir = null) {

		// Check provided data
		if(empty($dir) || !is_string($dir) || !file_exists($dir.'/uploads')) {
			return false;
		}

		// Create folder if it isn't exists already
		$targetDir = $this->targetDir . '/' . basename($dir);
		if(!file_exists($targetDir)) { mkdir($targetDir, 0755); }


		// Iterate through directory
		foreach(glob($dir.'/uploads/*') as $filePath) {

			$fileName = jols_sanitize_file_name(basename($filePath));

			$targetFile = $targetDir.'/'.$fileName;

			// Validate media
			$filetype = jols_check_filetype($fileName, null);

			if(!empty($filetype['ext']) && $filetype['ext'] != 'php') {

				// Move item to place
				rename($filePath, $targetFile);

				$this->imported[$fileName] = array(
					'url' => $this->targetURL.'/'.basename($dir).'/'.$fileName
				);
			}
		}

		return true;
	}



	public function deleteDir($dir) {
		if(!file_exists($dir)) return true;
		if(!is_dir($dir)) return unlink($dir);
		foreach(scandir($dir) as $item) {
			if($item == '.' || $item == '..') continue;
			if(!$this->deleteDir($dir.DIRECTORY_SEPARATOR.$item)) return false;
		}
		return @rmdir($dir);
	}



	public function addSlider($file) {

		// Get slider data and title
		$data = json_decode(file_get_contents($file), true);
		$title = $data['properties']['title'];
		$slug = !empty($data['properties']['slug']) ? $data['properties']['slug'] : '';

		// google fonts
		if (isset($data['googlefonts'])) {
			// get current google fonts
			$googlefonts = jols_get_option('ls-google-fonts', array());

			// create associative array with font names
			$assocfonts = array();
			foreach ($googlefonts as &$googlefont) {
				list($family) = explode(':', $googlefont['param']);
				$assocfonts[$family] = $googlefont;
			}

			// merge google fonts
			foreach ($data['googlefonts'] as $font) {
				list($family, $weights) = explode(':', $font['param']);
				if (isset($assocfonts[$family])) {
					// merge weights
					$w = array();
					foreach (explode(',', $weights) as $weight) {
						$w[$weight] = true;
					}
					list($family, $weights) = explode(':', $assocfonts[$family]['param']);
					foreach (explode(',', $weights) as $weight) {
						$w[$weight] = true;
					}
					$assocfonts[$family] = $font;
					$assocfonts[$family]['param'] = $family .':'. implode(',', array_keys($w));
				} else {
					// add to list
					$assocfonts[$family] = $font;
				}
			}

			// update google fonts
			$googlefonts = array();
			foreach ($assocfonts as &$font) {
				$googlefonts[] = $font;
			}
			jols_update_option('ls-google-fonts', $googlefonts);
			unset($data['googlefonts']);
		}

		$this->cmsrelativeurls = isset($data['properties']['cmsrelativeurls']);

		// Slider settings
		if(!empty($data['properties']['backgroundimage'])) {
			$data['properties']['backgroundimage'] = $this->attachURLForImage($data['properties']['backgroundimage']);
		}

		if(!empty($data['properties']['yourlogo'])) {
			$data['properties']['yourlogoId'] = $this->attachIDForImage($data['properties']['yourlogo']);
			$data['properties']['yourlogo'] = $this->attachURLForImage($data['properties']['yourlogo']);
		}


		// Slides
		if(!empty($data['layers']) && is_array($data['layers'])) {
		foreach($data['layers'] as &$slide) {

			if(!empty($slide['properties']['background'])) {
				$slide['properties']['backgroundId'] = $this->attachIDForImage($slide['properties']['background']);
				$slide['properties']['background'] = $this->attachURLForImage($slide['properties']['background']);
			}

			if(!empty($slide['properties']['thumbnail'])) {
				$slide['properties']['thumbnailId'] = $this->attachIDForImage($slide['properties']['thumbnail']);
				$slide['properties']['thumbnail'] = $this->attachURLForImage($slide['properties']['thumbnail']);
			}

			// Layers
			if(!empty($slide['sublayers']) && is_array($slide['sublayers'])) {
			foreach($slide['sublayers'] as &$layer) {

				if(!empty($layer['image'])) {
					$layer['imageId'] = $this->attachIDForImage($layer['image']);
					$layer['image'] = $this->attachURLForImage($layer['image']);
				}
			}}
		}}

		// Add slider
		return LS_Sliders::add($title, $data, $slug);
	}



	public function attachURLForImage($file = '#') {

		if(isset($this->imported[basename($file)])) {
			if ($this->cmsrelativeurls && strpos($this->imported[basename($file)]['url'], $this->root) === 0)
				return substr($this->imported[basename($file)]['url'], strlen($this->root));
			else
				return $this->imported[basename($file)]['url'];
		}

		return $file;
	}


	public function attachIDForImage($file = '') {
		return '';
	}



	public function cleanup() {
		$this->deleteDir($this->tmpDir);
	}
}
?>