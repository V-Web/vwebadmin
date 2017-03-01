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

class LS_ExportUtil {

	/**
	 * The managed ZipArchieve instance.
	 */
	private $zip;

	/**
	 * A temporary file in /wp-content/uploads/ to manipulate
	 * ZIPs on the fly without permanently saving to file system.
	 */
	private $file;


	/**
	 * Prepares a ZipArchieve instance and the file system
	 * to work with the class.
	 *
	 * @since 5.0.3
	 * @access public
	 * @return void
	 */
	public function __construct() {

		// Check for ZipArchieve
		if(class_exists('ZipArchive')) {

			// Temporary directory for file operations
			$upload_dir = jols_upload_dir();
			$tmp_dir = $upload_dir['basedir'];

			// Prepare ZIP to work with
			$this->file = tempnam($tmp_dir, "zip");
			$this->zip = new ZipArchive;
			$this->zip->open($this->file, ZIPARCHIVE::CREATE | ZIPARCHIVE::OVERWRITE);
		}
	}


	/**
	 * Adds slider settings .json file to ZIP
	 *
	 * @since 5.0.3
	 * @access public
	 * @param string $data Slider settings JSON
	 * @return void
	 */
	public function addSettings($data, $folder = '') {
		$folder = !empty($folder) ? $folder.'/' : '';
		$this->zip->addFromString($folder.'settings.json', $data);
	}


	/**
	 * Adds slider images to ZIP
	 *
	 * @since 5.0.3
	 * @access public
	 * @param string $path Image path to add
	 * @return void
	 */
	public function addImage($files, $folder = '') {

		// Check file
		if(empty($files)) { return false; }

		// Check file type
		if(!is_array($files)) { $files = array($files); }

		// Check folder
		$folder = is_string($folder) ? $folder.'/uploads/' : 'uploads/';

		// Add contents to ZIP
		foreach($files as $file) {
			if(!empty($file) && is_string($file)) {
				$this->zip->addFile($file,
					$folder.jols_sanitize_file_name(basename($file))
				);
			}
		}
	}


	/**
	 * Closes all pending operations and downloads the ZIP file.
	 *
	 * @since 5.0.3
	 * @access public
	 * @return void
	 */
	public function download() {

		// Close ZIP operations
		$this->zip->close();

		// Set headers and to user
		header('Content-Type: application/zip');
		header('Content-Disposition: attachment; filename="LayerSlider_Export_'.date('Y-m-d').'_at_'.date('H.i.s').'.zip"');
		header("Content-length: " . filesize($this->file));
		header('Pragma: no-cache');
		header('Expires: 0');
		readfile($this->file);

		// Remove temporary file
		unlink($this->file);
		die();
	}


	public function getImagesForSlider($data) {

		// Array to hold image URLs
		$images = array();
		$root = isset($data['properties']['cmsrelativeurls']) ? rtrim(JURI::root(true), '/') : '';

		// Slider settings
		if(!empty($data['properties']['backgroundimage'])) {
			$images[] = ls_cmsroot($root, $data['properties']['backgroundimage']); }

		if(!empty($data['properties']['yourlogo'])) {
			$images[] = ls_cmsroot($root, $data['properties']['yourlogo']); }


		// Slides
		if(!empty($data['layers']) && is_array($data['layers'])) {
		foreach($data['layers'] as $slide) {

				if(!empty($slide['properties']['background'])) {
					$images[] = ls_cmsroot($root, $slide['properties']['background']); }

				if(!empty($slide['properties']['thumbnail'])) {
					$images[] = ls_cmsroot($root, $slide['properties']['thumbnail']); }

				// Layers
				if(!empty($slide['sublayers']) && is_array($slide['sublayers'])) {
					foreach($slide['sublayers'] as $layer) {

						if(!empty($layer['image'])) {
							$images[] = ls_cmsroot($root, $layer['image']); }
					}
				}
			}
		}

		return $images;
	}


	public function getFSPaths($urls) {

		if(!empty($urls) && is_array($urls)) {

			$paths = array();

			foreach($urls as $url) {

				$path = $_SERVER['DOCUMENT_ROOT'] . parse_url($url, PHP_URL_PATH);
				if(file_exists($path)) {
					$paths[] = $path;
				}
			}

			return $paths;
		}

		return array();
	}
}