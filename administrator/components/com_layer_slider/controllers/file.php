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

jimport('joomla.filesystem.file');
jimport('joomla.filesystem.folder');

class Layer_SliderControllerFile extends JControllerLegacy
{
	/*
	 * The folder we are uploading into
	 */
	protected $folder = '';

	public function upload()
	{
		require_once JPATH_BASE.'/components/com_media/helpers/media.php';

		// Check for request forgeries
		JSession::checkToken('request') or jexit(JText::_('JINVALID_TOKEN'));

		// Load language file
		JFactory::getLanguage()->load('com_media');

		$params = JComponentHelper::getParams('com_media');
		define('COM_MEDIA_BASE', JPATH_ROOT.'/'.$params->get('image_path', 'images'));

		// Get some data from the request
		$files = JRequest::getVar('Filedata', '', 'files', 'array');
		$this->folder	= JRequest::getVar('folder', '', '', 'path');

		// Set the redirect
		$this->setRedirect('index.php?option=com_layer_slider&view=media&tmpl=component');

		// Authorize the user
		if (!JFactory::getUser()->authorise('core.create', 'com_media'))
		{
			// User is not authorised
			JError::raiseWarning(403, '<div class="mediaerr">'.JText::_('JLIB_APPLICATION_ERROR_CREATE_NOT_PERMITTED').'</div>');
			return false;
		}

		if (
			$_SERVER['CONTENT_LENGTH']>($params->get('upload_maxsize', 0) * 1024 * 1024) ||
			$_SERVER['CONTENT_LENGTH']>(int)(ini_get('upload_max_filesize'))* 1024 * 1024 ||
			$_SERVER['CONTENT_LENGTH']>(int)(ini_get('post_max_size'))* 1024 * 1024 ||
			(($_SERVER['CONTENT_LENGTH'] > (int) (ini_get('memory_limit')) * 1024 * 1024) && ((int) (ini_get('memory_limit')) != -1))
		)
		{
			JError::raiseWarning(100, '<div class="mediaerr">'.JText::_('COM_MEDIA_ERROR_WARNFILETOOLARGE').'</div>');
			return false;
		}
		// Input is in the form of an associative array containing numerically indexed arrays
		// We want a numerically indexed array containing associative arrays
		// Cast each item as array in case the Filedata parameter was not sent as such
		$files = array_map( array($this, 'reformatFilesArray'),
			(array) $files['name'], (array) $files['type'], (array) $files['tmp_name'], (array) $files['error'], (array) $files['size']
		);

		// Set FTP credentials, if given
		JClientHelper::setCredentialsFromRequest('ftp');

		// Perform basic checks on file info before attempting anything
		foreach ($files as &$file)
		{
			// The request is valid
			$err = null;

			if (JFile::exists($file['filepath']))
			{
				// A file with this name already exists
				$file['name'] = preg_replace('/\.[^.]+$/', '_'.time().'$0', $file['name']);
				$file['filepath'] = dirname($file['filepath']).'/'.$file['name'];
			}

			if ($file['error'] == 1)
			{
				JError::raiseWarning(100, '<div class="mediaerr">'.$file['name'].': '.JText::_('COM_MEDIA_ERROR_WARNFILETOOLARGE').'</div>');
			}
			elseif ($file['size'] > $params->get('upload_maxsize', 0) * 1024 * 1024)
			{
				JError::raiseWarning(100, '<div class="mediaerr">'.$file['name'].': '.JText::_('COM_MEDIA_ERROR_WARNFILETOOLARGE').'</div>');
			}
			elseif (!isset($file['name']))
			{
				// No filename (after the name was cleaned by JFile::makeSafe)
				JError::raiseWarning(100, '<div class="mediaerr">'.$file['name'].': '.JText::_('COM_MEDIA_INVALID_REQUEST').'</div>');
			}
			elseif (!MediaHelper::canUpload($file, $err))
			{
				// The file can't be upload
				JError::raiseWarning(100, '<div class="mediaerr">'.$file['name'].': '.JText::_($err).'</div>');
			}
			elseif (!JFile::upload($file['tmp_name'], $file['filepath']))
			{
				// Error in upload
				JError::raiseWarning(100, '<div class="mediaerr">'.$file['name'].': '.JText::_('COM_MEDIA_ERROR_UNABLE_TO_UPLOAD_FILE').'</div>');
			}
			else
			{
				$root = JURI::root(true);
				if ($root == '/') $root = '';
				JError::raiseWarning(100, '<div class="mediaok">'. $root.str_replace('\\', '/', substr($file['filepath'], strlen(JPATH_ROOT)) ).'</div>');
			}
		}

		return true;
	}

	protected function reformatFilesArray($name, $type, $tmp_name, $error, $size)
	{
		$name = JFile::makeSafe($name);
		return array(
			'name'		=> $name,
			'type'		=> $type,
			'tmp_name'	=> $tmp_name,
			'error'		=> $error,
			'size'		=> $size,
			'filepath'	=> JPath::clean(implode(DIRECTORY_SEPARATOR, array(COM_MEDIA_BASE, $this->folder, $name)))
		);
	}

}