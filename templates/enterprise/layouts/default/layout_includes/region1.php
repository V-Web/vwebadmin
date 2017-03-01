<?php 
	switch ($params->xtcstyle) {
	case 'style1':
	$insetmodule='inset';
	break;
	case 'style2':
	$insetmodule='inset';
	break;
	case 'style3':
	$insetmodule='inset';
	break;
	case 'style4':
	$insetmodule='inset';
	break;
	case 'style5':
	$insetmodule='inset';
	break;
	case 'style6':
	$insetmodule='inset';
	break;
	default:
	$insetmodule = 'inset';
}
define('INSET_MODULE', $insetmodule);
if ($this->countModules( $insetmodule )) { ?>
 <div id="region1wrap" class="xtc-bodygutter">
  <div id="region1pad" class="xtc-wrapperpad">
  <div id="region1" class="row-fluid xtc-wrapper r1spacer">
   <jdoc:include type="modules" name="<?php echo $insetmodule;?>" style="xtc"/>
  </div>
 <div id="r1separator"></div>
 </div>
 </div>
<?php } ?>