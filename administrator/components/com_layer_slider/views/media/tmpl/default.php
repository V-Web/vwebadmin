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
defined('_JEXEC') or die;
?>
<?php if (JFactory::getUser()->authorise('core.create', 'com_media')): ?>
<style>
html { overflow: hidden; }
html, body, form, #upload-file {
	margin: 0;
	padding: 0;
	width: 100%;
	height: 100%;
}
#upload-file { display: block; }
#system-message-container { display: none; }
</style>
<script>
	window.onload = function() {
		var upload = document.getElementById('upload-file');
		upload.ondrop = function(e) {
			window.parent.previewDropX = e.clientX;
			window.parent.previewDropY = e.clientY;
		};
		upload.onchange = function() {
			document.uploadForm.submit();
		};
		document.body.ondragleave = function() {
			window.parent.LS_Preview.removeClass('ls-draghover');
		};
	};
</script>
<?php $this->session->set('com_media.return_url', 'index.php?option=com_layer_slider&view=media&tmpl=component') ?>
<form action="<?php echo JUri::base().'index.php?option=com_layer_slider&amp;task=file.upload&amp;tmpl=component&amp;'.$this->session->getName().'='.$this->session->getId().'&amp;'.JSession::getFormToken().'=1&amp;folder=layerslider' ?>" id="uploadForm" name="uploadForm" method="post" enctype="multipart/form-data">
	<input type="file" id="upload-file" name="Filedata[]" multiple />
	<?php //echo $this->config->get('upload_maxsize') == '0' ? JText::_('COM_MEDIA_UPLOAD_FILES_NOLIMIT') : JText::sprintf('COM_MEDIA_UPLOAD_FILES', $this->config->get('upload_maxsize')); ?>
</form>
<?php endif ?>
