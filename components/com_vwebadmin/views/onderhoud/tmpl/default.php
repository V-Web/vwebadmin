<?php
/**
 * @version    CVS: 1.0.9
 * @package    Com_Vwebadmin
 * @author     Marcel Venema <marcel.venema@v-web.nl>
 * @copyright  2017 V-Web.nl
 * @license    GNU General Public License versie 2 of hoger; Zie LICENSE.txt
 */
// No direct access
defined('_JEXEC') or die;
JHtml::_('stylesheet', 'media/com_vwebadmin/css/item-information.css');

$user       = JFactory::getUser();
$userId     = $user->get('id');
$model = $this->getModel();
$this->cms = $model->getCms($this->item->cms);
$this->cmsversion = $model->getCmsversion($this->item->cms_version);
$this->hosting = $model->getHosting($this->item->website);
$this->domain = $model->getDomain($this->item->website);
$this->mpackage = $model->getMaintenancepackage($this->item->package);
$this->websitename = $model->getSitename($this->item->website);
$this->owner = $model->getOwner($this->item->website);
$now = time();
// DATE DIFF FOR ONDERHOUD
$end_date_onderhoud = strtotime($this->item->subscription_end);
$datediff_onderhoud = $end_date_onderhoud - $now;
$remaining_onderhoud = floor($datediff_onderhoud / (60*60*24));
$datepercentage_onderhoud = floor(((365 - $remaining_onderhoud) / 365) * 100);
// DATE DIFF FOR HOSTING
$end_date_hosting = strtotime($this->hosting['subscription_end']);
$datediff_hosting = $end_date_hosting - $now;
$remaining_hosting = floor($datediff_hosting / (60*60*24));
$datepercentage_hosting = floor(((365 - $remaining_hosting) / 365) * 100);
// DATE DIFF FOR DOMAIN
$end_date_domain = strtotime($this->domain['subscription_end']);
$datediff_domain = $end_date_domain - $now;
$remaining_domain = floor($datediff_domain / (60*60*24));
$datepercentage_domain = floor(((365 - $remaining_domain) / 365) * 100);
?>
<!--
<pre>
	<?php print_r($this->item); ?>
</pre>
<p><?php echo $this->item->website; ?></p>
<p>Website Table: <?php print_r($this->owner); ?></p>
<p>CMS Information Table: <?php print_r($this->cms); ?></p>
<p>CMS Version Information Table: <?php print_r($this->cmsversion); ?></p>
<p>M Pakket Informatie: <?php print_r($this->mpackage); ?></p>
<p>Hosting informatie: <?php print_r($this->hosting); ?></p>
<p>Domein informatie: <?php print_r($this->domain); ?></p>
-->
<?php if($userId !== $this->owner['owner']) {
	echo "<h1>Helaas</h1><p>U heeft geen toegang tot dit item. Klik hier om naar uw dashboard terug te keren</p>";
} else { ?>
<h1><?php echo preg_replace('#^https?://#', '', $this->websitename); ?></h1>

<div class="uk-accordion" data-uk-accordion="{showfirst: false}">

    <h3 class="uk-accordion-title">Website Onderhoud</h3>
    <div class="uk-accordion-content">
    	<h2>Abonnement: <?php echo $this->mpackage['package_name']; ?></h2>
    	<div class="uk-grid">
			<div class="uk-width-large-1-1">
				<div class="uk-progress uk-progress-striped uk-active uk-progress-success">
				    <div class="uk-progress-bar" style="width: <?php echo $datepercentage_onderhoud; ?>%;"><?php echo $datepercentage_onderhoud; ?>%</div>
				</div>
			</div>
			<div class="uk-width-large-1-3 datefrom"><?php echo date("d-m-Y", strtotime($this->item->subscription_start)); ?></div>
			<div class="uk-width-large-1-3 extended">
				<?php
					$extenddate = date($this->item->subscription_end) . ' -2 months';
					echo "Wordt automatisch verlengd op" . " " . date("d-m-Y", strtotime($extenddate));
				?>
			</div>
			<div class="uk-width-large-1-3 dateto"><?php echo date("d-m-Y", strtotime($this->item->subscription_end)); ?></div>
			</div>
			<hr class="uk-divider-icon">
			<div class="uk-grid-divider uk-grid">
			<div class="uk-width-large-5-10">
				<h3>CMS Informatie</h3>
				<?php if($this->cms['image']): ?>
					<img src="<?php echo $this->cms['image']; ?>" alt="<?php echo $this->cms['cms']; ?>">
				<?php endif; ?>
				<table class="uk-table">
					<tbody>
						<tr>
							<td class="uk-width-1-2"><strong>Uw website CMS:</strong> </td>
							<td class="uk-width-1-2"><?php echo $this->cms['cms']; ?></td>
						</tr>
						<tr>
							<td><strong>Uw website CMS versie:</strong></td>
							<td><?php echo $this->cmsversion['version']; ?></td>
						</tr>
						<tr>
							<td colspan="2"><strong>Versie <?php echo $this->cmsversion['version']; ?> Changelog</strong></td>
						</tr>
						<tr>
							<td colspan="2"><a href="<?php echo $this->cmsversion['changelog_link']; ?>"><?php echo $this->cmsversion['changelog']; ?></a></td>
						</tr>
						<tr>
							<td><strong>Versie uitgegeven op</strong></td>
							<td><?php echo date("d-m-Y", strtotime($this->cmsversion['release_date'])); ?></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="uk-width-large-5-10">
				<h3>Over <?php echo $this->cms['cms']; ?></h3>
				<p><?php echo $this->cms['description']; ?></p>
			</div>			
		</div>
    </div>

    <h3 class="uk-accordion-title">Hosting</h3>
    <div class="uk-accordion-content">
    	<h3>Hostingpakket: <?php echo $this->hosting['package_name']; ?></h3>
    	<h5><?php echo $this->hosting['package_price']; ?></h5>
    	<div class="uk-grid">
			<div class="uk-width-large-1-1">
				<div class="uk-progress uk-progress-striped uk-active uk-progress-success">
				    <div class="uk-progress-bar" style="width: <?php echo $datepercentage_hosting; ?>%;"><?php echo $datepercentage; ?>%</div>
				</div>
			</div>
			<div class="uk-width-large-1-3 datefrom"><?php echo date("d-m-Y", strtotime($this->hosting['subscription_start'])); ?></div>
			<div class="uk-width-large-1-3 extended">
				<?php
					$extenddate = date($this->hosting['subscription_end']) . ' -2 months';
					echo "Wordt automatisch verlengd op" . " " . date("d-m-Y", strtotime($extenddate));
				?>
			</div>
			<div class="uk-width-large-1-3 dateto"><?php echo date("d-m-Y", strtotime($this->hosting['subscription_end'])); ?></div>			
		</div>
    </div>

    <h3 class="uk-accordion-title">Domeinregistratie <?php echo $this->websitename; ?></h3>
    <div class="uk-accordion-content">
    	<div class="uk-grid">
			<div class="uk-width-large-1-1">
				<div class="uk-progress uk-progress-striped uk-active uk-progress-success">
				    <div class="uk-progress-bar" style="width: <?php echo $datepercentage_domain; ?>%;"><?php echo $datepercentage; ?>%</div>
				</div>
			</div>
			<div class="uk-width-large-1-3 datefrom"><?php echo date("d-m-Y", strtotime($this->domain['subscription_start'])); ?></div>
			<div class="uk-width-large-1-3 extended">
				<?php
					$extenddate = date($this->domain['subscription_end']) . ' -2 months';
					echo "Wordt automatisch verlengd op" . " " . date("d-m-Y", strtotime($extenddate));
				?>
			</div>
			<div class="uk-width-large-1-3 dateto"><?php echo date("d-m-Y", strtotime($this->domain['subscription_end'])); ?></div>			
		</div>
    </div>

</div>

<div class="item_fields">
	<table class="table">
		<tr>
			<td>Test</td>
			<td><a class="btn" href="<?php echo JRoute::_('index.php?option=com_vwebadmin&task=onderhoud.sendmymail&id=' . $this->item->id, false, 2); ?>"><?php echo JText::_("COM_VWEBADMIN_DELETE_ITEM"); ?></a></td>
		</tr>
		<tr>
			<td>Image</td>
			<td> <img src="<?php echo $this->cms['image']; ?>" alt="<?php echo $this->cms['cms']; ?>"></td>
		</tr>

	</table>

</div>

<?php } ?>

