<?php
/**
 * @version    CVS: 1.0.2
 * @package    Com_Webmaintenance
 * @author     Marcel Venema <marcel.venema@v-web.nl>
 * @copyright  2017 V-Web.nl
 * @license    GNU General Public License versie 2 of hoger; Zie LICENSE.txt
 */
// No direct access
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');
JHtml::_('stylesheet', 'media/com_vwebadmin/css/dashboard.css');

$user       = JFactory::getUser();
$app  		= JFactory::getApplication();
$userId     = $user->get('id');
$listOrder  = $this->state->get('list.ordering');
$listDirn   = $this->state->get('list.direction');
$canCreate  = $user->authorise('core.create', 'com_webmaintenance') && file_exists(JPATH_COMPONENT . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . 'forms' . DIRECTORY_SEPARATOR . 'customerform.xml');
$canEdit    = $user->authorise('core.edit', 'com_webmaintenance') && file_exists(JPATH_COMPONENT . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . 'forms' . DIRECTORY_SEPARATOR . 'customerform.xml');
$canCheckin = $user->authorise('core.manage', 'com_webmaintenance');
$canChange  = $user->authorise('core.edit.state', 'com_webmaintenance');
$canDelete  = $user->authorise('core.delete', 'com_webmaintenance');
?>
<?php
// I'm India so my timezone is Asia/Calcutta
date_default_timezone_set('Europe/Amsterdam');

// 24-hour format of an hour without leading zeros (0 through 23)
$Hour = date('G');

if ( $Hour >= 5 && $Hour <= 11 ) {
    $greeting = "Goedemorgen";
} else if ( $Hour >= 12 && $Hour <= 18 ) {
    $greeting = "Goedemiddag";
} else if ( $Hour >= 19 || $Hour <= 4 ) {
    $greeting = "Goedenavond";
}
?>
<?php
if($user->id != 0)
{ ?>
<h1><?php echo $greeting . " " . $user->name . '<br />'; ?></h1>
<div class="uk-grid">
	<div class="uk-width-large-1-3">
		<div class="products maintenance-count">
			<?php if($this->nomaintenance >= 1): ?>
				<a href="/dashboard/website-onderhoud">
			<?php endif; ?>
				<div class="icon">
					<i class="fa fa-cogs companyaddress-icons"> </i>
				</div>
				<div class="stat"><?php echo $this->nomaintenance; ?></div>
				<div class="service-title">Onderhoud</div>
				<div class="highlight bg-color-blue"></div>
			<?php if($this->nomaintenance >= 1): ?>
				</a>
			<?php endif; ?>
		</div>
	</div>
	<div class="uk-width-large-1-3">
		<div class="products hosting-count">
			<?php if($this->nohosting >= 1): ?>
				<a href="/dashboard/website-hosting">
			<?php endif; ?>
				<div class="icon">
					<i class="fa fa-database" aria-hidden="true"></i>
				</div>
				<div class="stat"><?php echo $this->nohosting; ?></div>
				<div class="service-title">Hosting</div>
				<div class="highlight bg-color-green"></div>
			<?php if($this->nohosting >= 1): ?>
				</a>
			<?php endif; ?>
		</div>
	</div>
	<div class="uk-width-large-1-3">
		<div class="products domain-count">
			<?php if($this->nodomain >= 1): ?>
				<a href="/dashboard/domeinen">
			<?php endif; ?>
				<div class="icon">
					<i class="fa fa-link companyaddress-icons"> </i>
				</div>
				<div class="stat"><?php echo $this->nodomain; ?></div>
				<div class="service-title">Domeinen</div>
				<div class="highlight bg-color-orange"></div>
			<?php if($this->nodomain >= 1): ?>
				</a>
			<?php endif; ?>
		</div>
	</div>
</div>
<div class="uk-grid">
	<div class="uk-width-large-1-2">
		<div class="user-messages">
			<h3 class="actuele-berichten">Actuele berichten</h3>
			<?php if($this->nomaintenance == 0) {
				echo "<div class='user-message'>Actief en tijdig onderhoud van uw website zorgt voor betere prestaties, vermindert de kans op technische problemen en beschermt tegen malware en hackers. Wij hebben een uitgebreid onderhoudsprogramma opgezet waarmee we u website of webshop in absolute topconditie houden.</div>";
			}	
			?>
			<?php if(($this->nohosting) < ($this->nomaintenance)) {
				echo "<div class='user-message'>U heeft momenteel 1 of meer websites bij ons in onderhoud waarbij de hosting van sommige websites niet door V-Web wordt verzorgt. Om uw website optimaal te laten presteren is het vaak verstandig om de hosting bij ons onder te brengen. Zo hebben we volledige controle over de server waarop uw website draait en kunnen we waar nodig zaken aanpassen.</div>";
			} elseif (($this->nohosting) > ($this->nomaintenance)) {
				echo "<div class='user-message'>U heeft momenteel 1 of meer websites waarvoor V-Web de hosting regelt. Deze websites zijn momenteel niet in onderhoud bij V-Web.</div>";
			}
			?>
			</div>
	</div>
	<div class="uk-width-large-1-2"></div>
</div>
<?php } else {
			    $message = "U dient in te loggen om uw dashboard te kunnen zien!";
			    $url = JRoute::_('index.php?option=com_users&view=login&return=') . base64_encode('index.php?option=com_vwebadmin&view=dashboard');
				$app->redirect($url, $message);
			}
			?>