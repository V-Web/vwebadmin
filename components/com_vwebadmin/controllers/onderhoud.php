<?php

/**
 * @version    CVS: 1.0.20
 * @package    Com_Vwebadmin
 * @author     Marcel Venema <marcel.venema@v-web.nl>
 * @copyright  2017 V-Web.nl
 * @license    GNU General Public License versie 2 of hoger; Zie LICENSE.txt
 */
// No direct access
defined('_JEXEC') or die;

/**
 * Onderhoud controller class.
 *
 * @since  1.6
 */
class VwebadminControllerOnderhoud extends JControllerLegacy
{
	/**
	 * Method to check out an item for editing and redirect to the edit form.
	 *
	 * @return void
	 *
	 * @since    1.6
	 */
	public function edit()
	{
		$app = JFactory::getApplication();

		// Get the previous edit id (if any) and the current edit id.
		$previousId = (int) $app->getUserState('com_vwebadmin.edit.onderhoud.id');
		$editId     = $app->input->getInt('id', 0);

		// Set the user id for the user to edit in the session.
		$app->setUserState('com_vwebadmin.edit.onderhoud.id', $editId);

		// Get the model.
		$model = $this->getModel('Onderhoud', 'VwebadminModel');

		// Check out the item
		if ($editId)
		{
			$model->checkout($editId);
		}

		// Check in the previous user.
		if ($previousId && $previousId !== $editId)
		{
			$model->checkin($previousId);
		}

		// Redirect to the edit screen.
		$this->setRedirect(JRoute::_('index.php?option=com_vwebadmin&view=onderhoudform&layout=edit', false));
	}

	/**
	 * Method to save a user's profile data.
	 *
	 * @return    void
	 *
	 * @throws Exception
	 * @since    1.6
	 */
	public function publish()
	{
		// Initialise variables.
		$app = JFactory::getApplication();

		// Checking if the user can remove object
		$user = JFactory::getUser();

		if ($user->authorise('core.edit', 'com_vwebadmin') || $user->authorise('core.edit.state', 'com_vwebadmin'))
		{
			$model = $this->getModel('Onderhoud', 'VwebadminModel');

			// Get the user data.
			$id    = $app->input->getInt('id');
			$state = $app->input->getInt('state');

			// Attempt to save the data.
			$return = $model->publish($id, $state);

			// Check for errors.
			if ($return === false)
			{
				$this->setMessage(JText::sprintf('Save failed: %s', $model->getError()), 'warning');
			}

			// Clear the profile id from the session.
			$app->setUserState('com_vwebadmin.edit.onderhoud.id', null);

			// Flush the data from the session.
			$app->setUserState('com_vwebadmin.edit.onderhoud.data', null);

			// Redirect to the list screen.
			$this->setMessage(JText::_('COM_VWEBADMIN_ITEM_SAVED_SUCCESSFULLY'));
			$menu = JFactory::getApplication()->getMenu();
			$item = $menu->getActive();

			if (!$item)
			{
				// If there isn't any menu item active, redirect to list view
				$this->setRedirect(JRoute::_('index.php?option=com_vwebadmin&view=onderhouds', false));
			}
			else
			{
				$this->setRedirect(JRoute::_($item->link . $menuitemid, false));
			}
		}
		else
		{
			throw new Exception(500);
		}
	}
	public function sendmymail()
	{
		$app = JFactory::getApplication();
		$user = JFactory::getUser();

		$model = $this->getModel('Onderhoud', 'VwebadminModel');

		$id = $app->input->getInt('id', 0);

		$return = $model->mailinfo($id);

		$test = print_r($return);

		$mailer = JFactory::getMailer();

		$sender = array('info@v-web.nl', 'V-Web.nl Security Team');
		 
		$mailer->setSender($sender);

		$user = JFactory::getUser();
		$recipient = $return['email'];
		 
		$mailer->addRecipient($recipient);

		$mailer->setSubject('Uw website is zojuist van nieuwe software voorzien!');

		$body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'
				. '<html xmlns="http://www.w3.org/1999/xhtml">'
				. '<head>'
				. '<meta name="viewport" content="width=device-width" />'
				. '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />'
				. '<title>V-Web.nl Security Team</title>'
				. '<link rel="stylesheet" type="text/css" href="stylesheets/email.css" />'
				. '<style>'
				. '* {margin:0; padding:0; }'
				. '* {font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; }'
				. 'img {max-width: 100%; }'
				. '.collapse {margin:0; padding:0; }'
				. 'body {-webkit-font-smoothing:antialiased; -webkit-text-size-adjust:none; width: 100%!important; height: 100%; }'
				. 'a { color: #2F419A;}'
				. '.btn {text-decoration:none; color: #FFF; background-color: #666; padding:10px 16px; font-weight:bold; margin-right:10px; text-align:center; cursor:pointer; display: inline-block; }'
				. 'p.callout {padding:15px; background-color:#ECF8FF; margin-bottom: 15px; }'
				. '.callout a {font-weight:bold; color: #2BA6CB; }'
				. 'table.social {background-color: #ebebeb; }'
				. '.social .soc-btn {padding: 3px 7px; font-size:12px; margin-bottom:10px; text-decoration:none; color: #FFF;font-weight:bold; display:block; text-align:center; }'
				. 'a.fb { background-color: #3B5998!important; }'
				. 'a.tw { background-color: #1daced!important; }'
				. 'a.gp { background-color: #DB4A39!important; }'
				. 'a.ms { background-color: #000!important; }'
				. '.sidebar .soc-btn {display:block; width:100%; }'
				. 'table.head-wrap { width: 100%;}'
				. '.header.container table td.logo { padding: 15px; }'
				. '.header.container table td.label { padding: 15px; padding-left:0px;}'
				. 'table.body-wrap { width: 100%;}'
				. 'table.footer-wrap { width: 100%;	clear:both!important; }'
				. '.footer-wrap .container td.content  p { border-top: 1px solid rgb(215,215,215); padding-top:15px;}'
				. '.footer-wrap .container td.content p {font-size:10px; font-weight: bold; }'
				. 'h1,h2,h3,h4,h5,h6 {font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif; line-height: 1.1; margin-bottom:15px; color:#000; }'
				. 'h1 small, h2 small, h3 small, h4 small, h5 small, h6 small { font-size: 60%; color: #6f6f6f; line-height: 0; text-transform: none; }'
				. 'h1 { font-weight:200; font-size: 38px;}'
				. 'h2 { font-weight:200; font-size: 30px;}'
				. 'h3 { font-weight:500; font-size: 22px;}'
				. 'h4 { font-weight:500; font-size: 20px;}'
				. 'h5 { font-weight:900; font-size: 17px;}'
				. 'h6 { font-weight:900; font-size: 14px; text-transform: uppercase; color:#fff;}'
				. '.collapse { margin:0!important;}'
				. 'p, ul {margin-bottom: 10px; font-weight: normal; font-size:14px; line-height:1.6; }'
				. 'p.lead { font-size:17px; }'
				. 'p.last { margin-bottom:0px;}'
				. 'ul li {margin-left:5px; list-style-position: inside; }'
				. 'ul.sidebar {background:#ebebeb; display:block; list-style-type: none; }'
				. 'ul.sidebar li { display: block; margin:0;}'
				. 'ul.sidebar li a {text-decoration:none; color: #666; padding:10px 16px; margin-right:10px; text-align:center; cursor:pointer; border-bottom: 1px solid #777777; border-top: 1px solid #FFFFFF; display:block; margin:0; }'
				. 'ul.sidebar li a.last { border-bottom-width:0px;}'
				. 'ul.sidebar li a h1,ul.sidebar li a h2,ul.sidebar li a h3,ul.sidebar li a h4,ul.sidebar li a h5,ul.sidebar li a h6,ul.sidebar li a p { margin-bottom:0!important;}'
				. '.container {display:block!important; max-width:600px!important; margin:0 auto!important; /* makes it centered */ clear:both!important; }'
				. '.content {padding:15px; max-width:600px; margin:0 auto; display:block; }'
				. '.content table { width: 100%; }'
				. '.column {width: 300px; float:left; }'
				. '.column tr td { padding: 15px; }'
				. '.column-wrap {padding:0!important; margin:0 auto; max-width:600px!important; }'
				. '.column table { width:100%;}'
				. '.social .column {width: 280px; min-width: 279px; float:left; }'
				. '.clear { display: block; clear: both; }'
				. '@media only screen and (max-width: 600px) {a[class="btn"] { display:block!important; margin-bottom:10px!important; background-image:none!important; margin-right:0!important;}'
				. 'div[class="column"] { width: auto!important; float:none!important;}'	
				. 'table.social div[class="column"] {width:auto!important; }'
				. '}'
				. '</style>'
				. '</head>'
				. '<body bgcolor="#FFFFFF">'
				. '<table class="head-wrap" bgcolor="#4e5aa7">'
				. '<tr>'
				. '<td></td>'
				. '<td class="header container">'			
				. '<div class="content">'
				. '<table bgcolor="#4e5aa7">'
				. '<tr>'
				. '<td align="right"><h6 class="collapse"><a href="https://www.v-web.nl/" alt="Naar uw persoonlijke dashboard">Naar uw dashboard</h6></a></td>'
				. '</tr>'
				. '</table>'
				. '</div>'
				. '</td>'
				. '<td></td>'
				. '</tr>'
				. '</table>'
				. '<table class="body-wrap">'
				. '<tr>'
				. '<td></td>'
				. '<td class="container" bgcolor="#FFFFFF">'
				. '<div class="content">'
				. '<table>'
				. '<tr>'
				. '<td>'
				. '<p style="text-align: center; "><img src="http://www.v-web.nl/images/logo/v-web-logo.png" /></p>'
				. '<h3>Beste ' . $return['name'] . '</h3>'
				. '<p>Wij hebben zojuist uw website ' . $return['website'] . ' bijgewerkt naar <strong>' . $return['cms'] . " " . $return['version'] . '</strong></p>'
				. '<h4>Belangrijkste wijzigingen aan ' . $return['cms'] . " " . $return['version'] . '<h4>'
				. '<p>' . $return['changelog'] . '</p>'
				. '<p><strong><a href="' . $return['changelog_link'] . '" alt="Volledige Changelog">Bekijk hier het volledige changelog</a></strong></p>'
				. '<p><strong>Heef u vragen over deze update?</strong> Ons onderhoudsteam staat klaar om deze te beantwoorden. U kunt hiervoor een mail sturen naar <a href="mailto:info@v-web.nl">info@v-web.nl</a>. U kunt ook inloggen op uw persoonlijke dashboard voor meer informatie omtrent het onderhoud van uw website.</p>'
				. '</td>'
				. '</tr>'
				. '</table>'
				. '</div>'									
				. '</td>'
				. '<td></td>'
				. '</tr>'
				. '</table>'
				. '<table class="footer-wrap">'
				. '<tr>'
				. '<td></td>'
				. '<td class="container">'			
				. '<div class="content">'
				. '<table>'
				. '<tr>'
				. '<td align="center" bgcolor="#4e5aa7">'
				. '<p><a style="color: #FFFFFF;" href="http://www.v-web.nl">Bezoek onze website</a></p>'
				. '</td>'
				. '</tr>'
				. '</table>'
				. '</div>'				
				. '</td>'
				. '<td></td>'
				. '</tr>'
				. '</table>'
				. '</body>'
				. '</html>';

		$mailer->isHtml(true);
		$mailer->Encoding = 'base64';
		$mailer->setBody($body);
		$send = $mailer->Send();
		if ( $send !== true ) {
		 echo 'Error sending email: ' . $send->__toString();
		} else {
		 echo 'Mail sent';
		}

		return $send;
	}

	/**
	 * Remove data
	 *
	 * @return void
	 *
	 * @throws Exception
	 */
	public function remove()
	{
		// Initialise variables.
		$app = JFactory::getApplication();

		// Checking if the user can remove object
		$user = JFactory::getUser();

		if ($user->authorise('core.delete', 'com_vwebadmin'))
		{
			$model = $this->getModel('Onderhoud', 'VwebadminModel');

			// Get the user data.
			$id = $app->input->getInt('id', 0);

			// Attempt to save the data.
			$return = $model->delete($id);

			// Check for errors.
			if ($return === false)
			{
				$this->setMessage(JText::sprintf('Delete failed', $model->getError()), 'warning');
			}
			else
			{
				// Check in the profile.
				if ($return)
				{
					$model->checkin($return);
				}

                $app->setUserState('com_vwebadmin.edit.inventory.id', null);
                $app->setUserState('com_vwebadmin.edit.inventory.data', null);

                $app->enqueueMessage(JText::_('COM_VWEBADMIN_ITEM_DELETED_SUCCESSFULLY'), 'success');
                $app->redirect(JRoute::_('index.php?option=com_vwebadmin&view=onderhouds', false));
			}

			// Redirect to the list screen.
			$menu = JFactory::getApplication()->getMenu();
			$item = $menu->getActive();
			$this->setRedirect(JRoute::_($item->link, false));
		}
		else
		{
			throw new Exception(500);
		}
	}
}
